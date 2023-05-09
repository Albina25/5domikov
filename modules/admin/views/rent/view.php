<?php

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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'status',
            'payment_status',
            'comment:ntext',
            'guests',
            'name',
            'email:email',
            'phone',
            'created_at',
            'date_start',
            'date_end',
        ],
    ]) ?>

</div>
