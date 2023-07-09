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
            [
                'attribute' => 'id',
                'contentOptions' => ['width' => '50px'],
            ],
            //'id',
            [
                'attribute' => 'house_id',
                'contentOptions' => ['width' => '50px'],
            ],
            'name',
            /*[
                'label' => 'Даты аренды',
                'content' => function($model) {
                    return (date('d.m.Y', strtotime($model->date_start))) . '-' . (date('d.m.Y', strtotime($model->date_end)));
                },
            ],*/
            [
                'attribute' => 'date_start',
                'format' =>  ['date', 'dd.MM.YYYY'],
            ],
            [
                'attribute' => 'date_end',
                'format' =>  ['date', 'dd.MM.YYYY'],
                /*'content' => function($model) {
                    return (date('d.m.Y', strtotime($model->date_end)));
                },*/
            ],
            'phone',
            'price_total',
            [
                "attribute" => "status",
                "format" => "text",
                "value" => function (Rent $model) {
                    return $model->getStatus($model->status);
                },
                "contentOptions" => function ($model) {
                    return [
                        "class" =>($model->status === Rent::STATUS_PENDING ? "bg-waiting" : ""),
                    ];
                },
                "filter" => Rent::status(),
            ],
            //'payment_status',
            //'comment:ntext',
            //'guests',

            //'email:email',

            //'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{next_status} {cencel_status}',
                'contentOptions' => ['class' => 'buttons-container'],
                'buttons' => [
                    'next_status' => function ($url, $model) {
                        if ($model->status === Rent::STATUS_PENDING) {
                            return Html::a(
                                'Подтвердить',
                                Url::to(['rent/change-status', 'id' => $model->id, 'status' => Rent::STATUS_BOOKING]),
                                [
                                    'data-id' => $model->id,
                                    'data-pjax'=>true,
                                    'action'=>Url::to(['rent/change-status']),
                                    'class'=>'btn btn-success w-100',
                                ]
                            );
                        }
                        if ($model->status === Rent::STATUS_BOOKING) {
                            return Html::a(
                                'Завершить',
                                Url::to(['rent/change-status', 'id' => $model->id, 'status' => Rent::STATUS_COMPLETED]),
                                [
                                    'data-id' => $model->id,
                                    'data-pjax'=>true,
                                    'action'=>Url::to(['rent/change-status']),
                                    'class'=>'btn btn-success w-100',
                                ]
                            );
                        }
                    },
                    'cencel_status' => function ($url, $model) {
                        if ($model->status != Rent::STATUS_CENCEL) {
                            return Html::a(
                                'Отменить',
                                Url::to(['rent/change-status', 'id' => $model->id, 'status' => Rent::STATUS_CENCEL]),
                                [
                                    'data-id' => $model->id,
                                    'data-pjax' => true,
                                    'action' => Url::to(['rent/change-status']),
                                    'class' => 'btn btn-outline-warning w-100',
                                ]
                            );
                        } elseif ($model->status === Rent::STATUS_CENCEL) {
                            return Html::a(
                                'Восстановить',
                                Url::to(['rent/change-status', 'id' => $model->id, 'status' => Rent::STATUS_PENDING]),
                                [
                                    'data-id' => $model->id,
                                    'data-pjax' => true,
                                    'action' => Url::to(['rent/change-status']),
                                    'class' => 'btn btn-outline-primary w-100',
                                ]
                            );
                        }
                    },
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Rent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

<style>
    .buttons-container {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
</style>
