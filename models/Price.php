<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property int|null $house_id
 * @property int|null $price_regular
 * @property int|null $price_weekend
 * @property int|null $deposit
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['house_id', 'price_regular', 'price_weekend', 'deposit'], 'default', 'value' => null],
            [['house_id', 'price_regular', 'price_weekend', 'deposit'], 'integer'],
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
            'price_regular' => 'Price Regular',
            'price_weekend' => 'Price Weekend',
            'deposit' => 'Deposit',
        ];
    }
}
