<?php

namespace app\models;

use Yii;

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
            [['date_start', 'date_end', 'phone'], 'required'],
            [['date_start', 'date_end'], 'date', 'format'=>'php:Y-m-d'],
            [['house_id', 'price_total', 'status', 'payment_status'], 'default', 'value' => null],
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
}
