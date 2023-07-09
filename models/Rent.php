<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "rent".
 *
 * @property int $id
 * @property int|null $house_id
 * @property string|null $date_start
 * @property string|null $date_end
 * @property int|null $price_total
 * @property int|null $status
 * @property int|null $payment_status
 * @property string|null $created_at
 * @property string|null $comment
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $guests
 */
class Rent extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_BOOKING = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CENCEL = 3;

    //public $countHouses = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['house_id','date_start', 'date_end', 'phone'], 'required'],
            [['house_id', 'price_total', 'status', 'payment_status'], 'default', 'value' => null],
            ['house_id', 'default', 'value' => null],
            [['status'], 'default', 'value' => self::STATUS_PENDING],
            [['house_id', 'price_total', 'status', 'payment_status'], 'integer'],
            /*[['date_start', 'date_end', 'created_at'], 'safe'],*/
            [['comment', 'name', 'phone', 'email'], 'string'],
            /*['created_at', 'default', 'value' => time()],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'house_id' => 'Номер дома',
            'date_start' => 'Заезд',
            'date_end' => 'Выезд',
            'price_total' => 'Итоговая цена',
            'status' => 'Статус аренды',
            'payment_status' => 'Статус оплаты',
            'created_at' => 'Создан',
            'comment' => 'Кооментарий',
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'guests' => 'Количество гостей',
            //'countHouses' => 'Количество домиков'
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => 'updated_at',
                'value' => date('Y-m-d H:i:s', time()),
            ],
            [
                'class' => AttributeBehavior::class,
                'value' => function () {
                    return date('Y-m-d', strtotime($this->date_start));
                },
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date_start',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date_start',
                ],
            ],
            /*[
                'class' => AttributeBehavior::class,
                'value' => function () {
                    return date('d.m.Y', strtotime($this->date_start));
                },
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'date_start',
                ],
            ],*/
            [
                'class' => AttributeBehavior::class,
                'value' => function () {
                    return date('Y-m-d', strtotime($this->date_end));
                },
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date_end',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date_end',
                ],
            ],
            /*[
                'class' => AttributeBehavior::class,
                'value' => function () {
                    return date('d.m.Y', strtotime($this->date_end));
                },
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'date_end',
                ],
            ],*/
        ];
    }

    public static function status()
    {
        return [
            self::STATUS_CENCEL => 'Отменено',
            self::STATUS_BOOKING => 'Забронировано',
            self::STATUS_PENDING => 'В ожидании',
            self::STATUS_COMPLETED => 'Завершено',
        ];
    }

    public static function getStatus($id)
    {
        $list = self::status();
        return $list[$id] ?? null;
    }

    public function isDublicate()
    {
        return static::findOne(['phone' => $this->phone, 'name' => $this->name, 'date_start' => $this->date_start, 'date_end' => $this->date_end]);
    }

    public function periodBetweenDates($start, $end)
    {
        $day = 86400;
        $start = strtotime($start);
        $end = strtotime($end);
        $nums = round(($end - $start) / $day);

        $days = [];
        for ($i = 1; $i < $nums; $i++) {
            $days[] = date('Y-m-d', ($start + ($i * $day)));
        }
        return $days;
    }

    public function period($start, $end)
    {
        $day = 86400;
        $start = strtotime($start . '-1 day');
        $end = strtotime($end . '+1 day');
        $nums = round(($end - $start) / $day);

        $days = [];
        for ($i = 1; $i < $nums; $i++) {
            $days[] = date('Y-m-d', ($start + ($i * $day)));
        }
        return $days;
    }

    public function findFreeHouse()
    {
        $countAllHouses = count(House::find()->all());
        for ($houseId = 1; $houseId <= $countAllHouses; $houseId++) {
            $freeHouseId = $this->isFreeHouse($houseId);
            if ($freeHouseId) {
                return $freeHouseId;
            }
        }
        return false;
    }

    public function isFreeHouse($houseId)
    {
        $bookedDays = $this->bookedDaysInHouse($houseId);
        if ($bookedDays[1] && in_array($this->date_start, array_merge($bookedDays[0], $bookedDays[1])))  {
            return false;
        }
        if ($bookedDays[1] && in_array($this->date_end, array_merge($bookedDays[1], $bookedDays[2]))) {
            return false;
        }
        $checkingDays = $this->periodBetweenDates($this->date_start, $this->date_end);
        foreach ($checkingDays as $day) {
            if ($bookedDays[1] && in_array($day, array_merge($bookedDays[0], $bookedDays[1], $bookedDays[2]))) {
                return false;
            }
        }
        return $houseId;
    }

    public function bookedDaysInHouse($houseId)
    {
        $dates = [];

        $rents = Rent::find()->where(['house_id' => $houseId, 'status' => [self::STATUS_BOOKING, self::STATUS_PENDING]])->all();
        foreach($rents as $rent) {
            /*$dates[] = ['date'=>$rent->date_start, 'status'=>0];
            $dates[] = ['date'=>$rent->date_end, 'status'=>2];
            $period = $this->periodBetweenDates($rent->date_start, $rent->date_end);
            foreach ($period as $date) {
                $dates[] =  ['date'=>$date, 'status'=>1];;
            }*/
            $dates[0][] = date('Y-m-d', strtotime($rent->date_start));

            $period = $this->periodBetweenDates($rent->date_start, $rent->date_end);
            foreach ($period as $date) {
                $dates[1][] =  $date;
            }

            $dates[2][] = date('Y-m-d', strtotime($rent->date_end));
        }
        return $dates;
    }

    public function getTotalPrice($houseId)
    {
        $totalPrice = 0;
        $weekEnd = ['5', '6', '0'];
        $days = $this->period($this->date_start, $this->date_end);
        foreach ($days as $day) {
            if ($day != end($days)) {
                $week = date("N", strtotime($day));

                if (in_array($week, $weekEnd)) {
                    $priceInDay = House::findOne($houseId)->price_weekend;
                } else {
                    $priceInDay = House::findOne($houseId)->price_regular;
                }
                $totalPrice += $priceInDay;
            }
        }
        return $totalPrice;
    }

    public function saveRents($model, $countHouses)
    {
        $countRentedHouses = 0;
        for($i = 1; $i <= $countHouses; $i++) {
            $houseId = $this->findFreeHouse();
            if ($houseId) {
                $isSaveRent = $this->saveNewRent($model, $houseId);
                if ($isSaveRent) {
                    $countRentedHouses++;
                }
            }
        }
        return $countRentedHouses;
    }

    public function saveNewRent($model, $houseId)
    {
        $rent = new Rent;
        $rent->house_id = $houseId;
        if (!$model->price_total && $model->price_total <= 0) {
            $totalPrice = $this->getTotalPrice($houseId);
            $rent->price_total = $totalPrice;
        }
        $rent->date_start = date('Y-m-d', strtotime($model->date_start));
        $rent->date_end = date('Y-m-d', strtotime($model->date_end));
        $rent->comment = $model->comment;
        $rent->name = $model->name;
        $rent->email = $model->email;
        $rent->phone = $model->phone;

        return $rent->save();
    }

    public static function rentsInPending()
    {
        return Rent::find()->where(['status' => self::STATUS_PENDING])->count();
    }

    public function updateRent()
    {
        if (!$this->price_total) {
            $totalPrice = $this->getTotalPrice($this->house_id);
            $this->price_total = $totalPrice;
        }

        return $this->save();
    }
}
