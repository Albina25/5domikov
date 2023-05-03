<?php

use app\assets\AdminAsset;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\House $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
AdminAsset::register($this);
?>
<div class="house-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tid' => $model->tid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tid' => $model->tid], [
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
            'price_regular',
            'price_weekend',
            'tid',
            'deposit',
        ],
    ]) ?>

</div>
