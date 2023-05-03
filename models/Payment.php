<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int|null $rent_id
 * @property string|null $date
 * @property int|null $price
 * @property string|null $created_at
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rent_id', 'price'], 'default', 'value' => null],
            [['rent_id', 'price'], 'integer'],
            [['date', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rent_id' => 'Rent ID',
            'date' => 'Date',
            'price' => 'Price',
            'created_at' => 'Created At',
        ];
    }
}
