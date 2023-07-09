<?php

use app\models\Rent;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Rent $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rent-view container flex-wrap">

    <h1>Заявка на аренду №<?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить заявку?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'house_id',
            'price_total',
            [
                "attribute" => "status",
                "format" => "text",
                "value" => function (Rent $model) {
                    return $model->getStatus($model->status);
                },
            ],
            'payment_status',
            'comment:ntext',
            'guests',
            'name',
            'email:email',
            'phone',
            'date_start',
            'date_end',
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'dd.MM.YYYY'],
            ],
        ],
    ]) ?>

</div>
