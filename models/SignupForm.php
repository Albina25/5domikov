<?php

namespace app\models;

use app\models\User;
use Yii;

class SignupForm extends \yii\base\Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            return $user->create();
        }
    }

}