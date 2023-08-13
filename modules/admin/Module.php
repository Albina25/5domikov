<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $layout = '/admin';

    public $controllerNamespace = 'app\modules\admin\controllers';

    public function behaviors()
       {
           return [
               'access' => [
                   //'except' => ['login'],
                  'class' => AccessControl::class,
                   'denyCallback' => function ($rule, $action) {
                        if (Yii::$app->user->identity->isAdmin === 0) {
                            Yii::$app->user->logout();
                            Yii::$app->session->setFlash('login_first', 'Доступ разрешен только администратору');
                            //throw new \yii\web\NotFoundHttpException('Ты не админ. Нет доступа');
                        } else {
                            Yii::$app->session->setFlash('login_first', 'Вначале необходимо войти');
                        }
                        return Yii::$app->response->redirect(['admin/auth/login']);
                   },
                   'rules' => [
                        [
                           'allow' => true,
                           'actions' => ['login'],
                           'roles' => ['?'],
                           'denyCallback'  => function () {
                               Yii::$app->session->setFlash('login_first', 'Необходимо войти в Личный кабинет');
                               return Yii::$app->response->redirect(['admin/auth/login']);
                           },
                        ],
                        [
                            'allow' => true,
                            'roles' => ['@'],

                            'matchCallback' => function () {
                                // Если пользователь имеет полномочия администратора, то правило доступа сработает.
                                return Yii::$app->user->identity->isAdmin === 1;
                            },
                            'denyCallback'  => function () {
                                // Если пользователь не подпадает под все условия, то завершаем работы и выдаем своё сообщение.
                                die('Эта страница доступна только администратору!');
                                //throw new \yii\web\NotFoundHttpException();
                            },
                   ],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        //Yii::$app->user->loginUrl = 'admin/auth/login';
        /*if (Yii::$app->user->isGuest && Yii::$app->controller->getRoute() != $this->loginUrl) {
            Yii::$app->controller->redirect([$this->loginUrl]);
        }*/
        // custom initialization code goes here
    }
}
