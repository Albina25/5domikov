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

        return $this->render('index', [
            'model' => $model,
            'isRentSaved' => $isRentSaved,
            'error' => $error,
        ]);
    }

    public function actionSaveRents()
    {
        $model = new Rent();
        $error = '';
        $isRentSaved = false;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $countHouses = $_POST['countHouses'];
                $transaction = Yii::$app->db->beginTransaction();
                $countRentedHouses = $model->saveRents($model, $countHouses);
                if ($countRentedHouses == $countHouses) {
                    $transaction->commit();
                    $isRentSaved = true;
                    $model->loadDefaultValues();
                    /*$model = new Rent();*/
                } else {
                    $error = 'На этот период нет свободных домиков';
                    $transaction->rollBack();
                    Yii::warning('transaction->rollBack');
                    return $this->render('index', [
                        'model' => $model,
                        'isRentSaved' => $isRentSaved,
                        'error' => $error,
                    ]);
                }
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

    /**
     * Login action.
     *
     * @return Response|string
     */
/*    public function actionLogin()
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
    }*/

    /**
     * Logout action.
     *
     * @return Response
     */
    /*public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }*/

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

    public function actionBooking()
    {
        $model = new Rent();

        $isRentSaved = false;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
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
