<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;

class AuthController extends Controller
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => $this->isAdmin(),
                    ],
                ],
            ],
        ];
    }*/
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }*/
    public function isAdmin()
    {
        return Yii::$app->user->identity->isAdmin === 1;
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['default/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['default/index']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect( ['auth/login']);
    }
}