<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\House $model */

$this->title = 'Update House: ' . $model->tid;
$this->params['breadcrumbs'][] = ['label' => 'Houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tid, 'url' => ['view', 'tid' => $model->tid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="house-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
