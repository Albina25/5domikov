<?php

/** @var string $error */

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rent $model */

$this->title = 'Создать заявку на аренду';
$this->params['breadcrumbs'][] = ['label' => 'Rents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-create container flex-wrap">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'error' => $error,
    ]) ?>

</div>
