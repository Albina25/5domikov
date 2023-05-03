<?php

use app\models\House;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\assets\AdminAsset;

/** @var yii\web\View $this */
/** @var app\models\HouseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
AdminAsset::register($this);

$this->title = 'Домики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-index container">

    <h1 class="mt-1"><?= Html::encode($this->title) ?></h1>

    <p class="mt-1">
        <?= Html::a('Добавить домик', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/

            'id',
            'price_regular',
            'price_weekend',
            'tid',
            'deposit',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, House $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'tid' => $model->tid]);
                 }
            ],
        ],
    ]); ?>


</div>
