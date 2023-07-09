<?php

namespace app\modules\admin\controllers;

use app\models\Rent;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors()
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
    }
    public function actionIndex()
    {
        $countRentsInPending = Rent::rentsInPending();
        return $this->render('index', [
            'countRentsInPending' => $countRentsInPending
        ]);
    }
}
