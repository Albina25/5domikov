<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\House $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="house-form mt-1">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'price_regular')->textInput() ?>

    <?= $form->field($model, 'price_weekend')->textInput() ?>

    <?= $form->field($model, 'deposit')->textInput() ?>

    <div class="form-group mt-1">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
