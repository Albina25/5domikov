<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
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
    const STATUS_CENCEL = 0;
    const STATUS_BOOKING = 1;
    const STATUS_PENDING = 2;
    const STATUS_COMPLETED = 3;

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
            [['date_start', 'date_end'], 'date', 'format'=>'php:Y-m-d'],
            [['house_id', 'price_total', 'status', 'payment_status'], 'default', 'value' => null],
            [['status'], 'default', 'value' => self::STATUS_PENDING],
            [['house_id', 'price_total', 'status', 'payment_status'], 'integer'],
            [['date_start', 'date_end', 'created_at'], 'safe'],
            [['comment', 'name', 'phone', 'email'], 'string'],
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
        ];
    }

/*    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::class,
                'value' => function () {
                    return date('d.m.Y', strtotime($this->date_start));
                },
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'date_start',
                ],
            ],
            [
                'class' => AttributeBehavior::class,
                'value' => function () {
                    return date('d.m.Y', strtotime($this->date_end));
                },
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'date_end',
                ],
            ],
        ];
    }*/

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
        $countHouses = count(House::find()->all());
        for ($houseId = 1; $houseId <= $countHouses; $houseId++) {
            $freeHouse = $this->isFreeHouse($houseId);
            if ($freeHouse) {
                return $freeHouse;
            }
        }
        return false;
    }

    public function isFreeHouse($houseId)
    {
        $bookedDays = $this->bookedDaysInHouse($houseId);
        //VarDumper::dump(array_merge($bookedDays[0], $bookedDays[1]), 10, true);die();
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

        $rents = Rent::find()->where(['house_id' => $houseId])->all();
        foreach($rents as $rent) {
            /*$dates[] = ['date'=>$rent->date_start, 'status'=>0];
            $dates[] = ['date'=>$rent->date_end, 'status'=>2];
            $period = $this->periodBetweenDates($rent->date_start, $rent->date_end);
            foreach ($period as $date) {
                $dates[] =  ['date'=>$date, 'status'=>1];;
            }*/
            $dates[0][] = $rent->date_start;

            $period = $this->periodBetweenDates($rent->date_start, $rent->date_end);
            foreach ($period as $date) {
                $dates[1][] =  $date;
            }

            $dates[2][] = $rent->date_end;
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
}
