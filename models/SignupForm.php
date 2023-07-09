<?php

namespace app\models;

class SignupForm extends \yii\base\Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            ['name', 'string'],
            ['email', 'email'],
            [['email'], 'unique', 'targetClass' => 'app/model/User', 'targetAttribute' => 'email'],
        ];
    }

    public function signup()
    {
        if($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }

}