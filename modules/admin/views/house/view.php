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
<div class="house-view container flex-wrap">

    <h1>Дом <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'tid' => $model->tid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'tid' => $model->tid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить дом?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'price_regular',
            'price_weekend',
            'deposit',
        ],
    ]) ?>

</div>
