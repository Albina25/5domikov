<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rent_user".
 *
 * @property int $id
 * @property int $rent_id
 * @property int $user_id
 */
class RentUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rent_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rent_id', 'user_id'], 'required'],
            [['rent_id', 'user_id'], 'default', 'value' => null],
            [['rent_id', 'user_id'], 'integer'],
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
            'user_id' => 'User ID',
        ];
    }
}
