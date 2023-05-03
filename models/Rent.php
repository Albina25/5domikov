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
            [['house_id', 'price_total', 'status', 'payment_status'], 'default', 'value' => null],
            [['house_id', 'price_total', 'status', 'payment_status'], 'integer'],
            [['date_start', 'date_end', 'created_at'], 'safe'],
            [['comment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'house_id' => 'House ID',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'price_total' => 'Price Total',
            'status' => 'Status',
            'payment_status' => 'Payment Status',
            'created_at' => 'Created At',
            'comment' => 'Comment',
        ];
    }
}
