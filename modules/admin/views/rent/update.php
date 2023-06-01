<?php

/** @var string $error */

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rent $model */

$this->title = 'Изменить заявку ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rent-update container flex-wrap">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'error' => $error,
    ]) ?>

</div>
