<?php

use app\models\House;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\HouseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Дома';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-index container flex-wrap">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить дом', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'price_regular',
            'price_weekend',
            'deposit',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, House $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
