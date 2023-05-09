<?php

use app\models\Rent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки на аренду';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-index container flex-wrap">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/

            'id',
            'house_id',
            'name',
            'date_start',
            'date_end',
            //'price_total',
            //'status',
            //'payment_status',
            //'comment:ntext',
            //'guests',

            'email:email',
            'phone',
            //'created_at',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Rent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
