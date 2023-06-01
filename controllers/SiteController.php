<?php

namespace app\controllers;

use app\models\House;
use app\models\Rent;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $isRentSaved = false;
        $model = new Rent();
        $error = '';

/*
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $freeHouse = $model->findFreeHouse();
                if ($freeHouse) {
                    $model->house_id = $freeHouse;
                } else {
                    $error = 'На этот период нет свободных домиков';
                    return $this->render('index', [
                        'model' => $model,
                        'isRentSaved' => $isRentSaved,
                        'error' => $error,
                    ]);
                };
                $totalPrice = $model->getTotalPrice($freeHouse);

                $model->price_total = $totalPrice;
                $model->date_start = date('Y-m-d', strtotime($model->date_start));
                $model->date_end = date('Y-m-d', strtotime($model->date_end));
                if (!$model->isDublicate() && $model->save()) {
                    $isRentSaved = true;
                } else {
                    $error = 'У вас уже есть заявка на аренду домика';
                };
            }
        } else {
            $model->loadDefaultValues();
        }*/
        return $this->render('index', [
            'model' => $model,
            'isRentSaved' => $isRentSaved,
            'error' => $error,
        ]);
    }

    public function actionTest()
    {
        //VarDumper::dump($_POST['countHouses'], 10, true);die();
        $model = new Rent();

        $isRentSaved = false;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $count = $_POST['countHouses'];
                for($i = 1; $i <= $count; $i++) {
                }
                $freeHouse = $model->findFreeHouse();
                if ($freeHouse) {
                    $model->house_id = $freeHouse;
                } else {
                    $error = 'На этот период нет свободных домиков';
                    return $this->render('index', [
                        'model' => $model,
                        'isRentSaved' => $isRentSaved,
                        'error' => $error,
                    ]);
                };
                $totalPrice = $model->getTotalPrice($freeHouse);

                $model->price_total = $totalPrice;
                $model->date_start = date('Y-m-d', strtotime($model->date_start));
                $model->date_end = date('Y-m-d', strtotime($model->date_end));
                /*if (!$model->isDublicate() && $model->save()) {
                    $isRentSaved = true;
                } else {
                    $error = 'У вас уже есть заявка на аренду домика';
                };*/
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('index', [
            'model' => $model,
            'isRentSaved' => $isRentSaved,
            'error' => $error,
        ]);
        /*$model = new Rent();

        //$isRentSaved = false;

        //if ($dateStart) {
            if ($model->load($this->request->post())) {
                return $this->render('index', [
                    'model' => $model,
                    'isRentSaved' => true,
                    'error' => '',
                ]);
            //}
        } else {
            VarDumper::dump('Ничего не пришло 2');
        }*/
        /*if (isset ($_POST['data'])) {
            VarDumper::dump('$_POST["data"]');
        } else {
            VarDumper::dump('Ничего не пришло');
        }*/
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionBooking()
    {
        $model = new Rent();

        $isRentSaved = false;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->date_start = date('Y-m-d', strtotime($model->date_start));
                $model->date_end = date('Y-m-d', strtotime($model->date_end));
                if (!$model->isDublicate() && $model->save()) {
                    $isRentSaved = true;
                } else {
                    $error = 'У вас уже есть заявка на аренду домика';
                };
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('index', [
            'model' => $model,
            'isRentSaved' => $isRentSaved,
            'error' => $error,
        ]);
    }
}
