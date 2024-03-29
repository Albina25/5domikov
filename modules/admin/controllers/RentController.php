<?php

namespace app\modules\admin\controllers;

use app\models\Rent;
use app\models\RentSearch;
use app\models\User;
use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RentController implements the CRUD actions for Rent model.
 */
class RentController extends Controller
{
    /**
     * @inheritDoc
     */

    /*public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }*/

    /**
     * Lists all Rent models.
     *
     * @return string
     */
    public function actionIndex()
    {
        Rent::autoChangeRentStatuses();
        $searchModel = new RentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rent model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rent();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (!$model->isDublicate() && $model->updateRent()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $error = 'Такая заявка уже есть';
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'error' => $error,
        ]);
    }

    /**
     * Updates an existing Rent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->updateRent()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $error = 'Данные не были обновлены';
            }
        }

        return $this->render('update', [
            'model' => $model,
            'error' => $error,
        ]);
    }

    /**
     * Deletes an existing Rent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Rent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rent::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChangeStatus($id, $status)
    {
        $model = $this->findModel($id);
        if ($model) {
            $model->status = $status;
            if ((int)$status === Rent::STATUS_PENDING) {
                $freeHouseId = $model->findFreeHouse();
                $model->house_id = $freeHouseId;
                if (!$freeHouseId) {
                    $model->status = Rent::STATUS_CENCEL;
                }
            }

            $model->save();

        }
        return $this->redirect(['index']);
    }

    public function actionTest()
    {
        Rent::autoChangeRentStatuses();
    }
}
