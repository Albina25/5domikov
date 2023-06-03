<?php

/** @var string $error */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Rent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'house_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_start')->textInput() ?>

    <?= $form->field($model, 'date_end')->textInput() ?>

    <?/*= $form->field($model, 'price_total')->textInput() */?>

    <?/*= $form->field($model, 'status')->textInput() */?>

    <?/*= $form->field($model, 'payment_status')->textInput() */?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?php if ($error) { ?>
        <p class="text-error"><?= $error ?></p>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
