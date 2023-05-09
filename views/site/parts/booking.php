<?php
/** @var app\models\Rent $model */

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

?>

<h3 class="mb-10">Бронирование домиков</h3>
<?php $form = ActiveForm::begin([
    'id' => 'rent-form',
    'options' => ['class' => 'form-field position-relative flex-wrap'],
]); ?>

<?= $form->field($model, 'date_start')->widget(DatePicker::classname(), [
    'name' => 'dp_1',
    'type' => DatePicker::TYPE_INPUT,
    'options' => ['placeholder' => 'Дата заезда'],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy',
    ]
]);?>

<?= $form->field($model, 'date_end')->widget(DatePicker::classname(), [
    'name' => 'dp_2',
    'type' => DatePicker::TYPE_INPUT,
    'options' => ['placeholder' => 'Дата выезда'],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy',
    ]
]);?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'email')->input('email')->textInput(['placeholder' => 'Email для отправки брони']); ?>

<?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, ['mask' => '+7(999)999-99-99']) ?>

<div class="form-group">
    <?= Html::submitButton('Забронировать', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

<!--<form>
    <div class="form-field position-relative">
        <input class="form-field__input" type="date" id="checkIn" />
        <label class="form-field__label" for="checkIn">Заезд</label>
    </div>
    <div class="form-field position-relative">
        <input class="form-field__input" type="date" id="checkOut" />
        <label class="form-field__label" for="checkOut">Выезд</label>
    </div>
    <div class="form-field position-relative">
        <input class="form-field__input" type="text" id="guests" />
        <label class="form-field__label" for="guests">
            Кол-во гостей
        </label>
    </div>
    <div class="form-field position-relative">
        <input class="form-field__input" type="text" id="guests" />
        <label class="form-field__label" for="guests">
            ФИО
        </label>
    </div>
    <div class="form-field position-relative">
        <input class="form-field__input" type="text" id="guests" />
        <label class="form-field__label" for="guests">
            Телефон для связи
        </label>
    </div>
    <div class="form-field position-relative">
        <input class="form-field__input" type="text" id="guests" />
        <label class="form-field__label" for="guests">
            Email
        </label>
    </div>
    <input type="submit" value="Забронировать" />
</form>-->
