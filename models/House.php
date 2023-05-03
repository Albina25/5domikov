<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house".
 *
 * @property int|null $id
 * @property int|null $price_regular
 * @property int|null $price_weekend
 * @property int|null $deposit
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'house';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price_regular', 'price_weekend', 'deposit'], 'default', 'value' => null],
            [['id', 'price_regular', 'price_weekend', 'deposit'], 'integer'],
            ['price_regular', 'required', 'message' => 'Поле обязательно для заполнения'],
            ['id', 'unique', 'message' => 'Домик с таким номер уже существует'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер домика',
            'price_regular' => 'Цена обычная',
            'price_weekend' => 'Цена в выходные',
            'deposit' => 'Депозит'
        ];
    }
}
