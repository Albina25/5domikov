<?php
/** @var app\models\Rent $model */
/** @var boolean $isRentSaved */
/** @var string $error */

use http\Url;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/*$script = <<< JS
$('#rent-date_start').change(function (){
    let dateStart = $(this).val();
    $.get('site/test', {dateStart: dateStart}, function(data) {
        alert(data);
    });
});
JS;
$this->registerJs($script);*/

?>

<h4 class="mb-10 title">Бронирование домиков</h4>
    <?php Pjax::begin([
        "id" => "booking-form-pjax",
        "enablePushState" => false,
    ]);
    ?>

    <?php $form = ActiveForm::begin([
        'id' => 'rent-form',
        'action' => ['site/save-rents'],
        'options' => [
            'data-pjax' => 1,
            'class' => 'form-field position-relative flex-wrap',
        ],

    ]); ?>
    <div>
        <label for="countHouses" class="form-group">Количество домиков</label>
        <?= Html::input('number', 'countHouses', 1,  ['class' => 'form-control', 'id' => 'countHouses']) ?>
    </div>

    <?= $form->field($model, 'date_start')->widget(DatePicker::classname(), [
        'name' => 'dp_1',
        'type' => DatePicker::TYPE_INPUT,
        'options' => ['placeholder' => 'Дата заезда'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd.mm.yyyy',
            'todayHighlight' => true,
            'startDate' => date('d.m.Y', time())
        ]
    ]);?>

    <?= $form->field($model, 'date_end')->widget(DatePicker::classname(), [
        'name' => 'dp_2',
        //'value' => date('d-M-Y', strtotime('+2 days')),
        'type' => DatePicker::TYPE_INPUT,
        'options' => ['placeholder' => 'Дата выезда'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd.mm.yyyy',
            'todayHighlight' => true,
            'startDate' => date('d.m.Y', time())
        ]
    ]);?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email')->input('email')->textInput(['placeholder' => 'Email для отправки брони']); ?>

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, ['mask' => '+7(999)999-99-99']) ?>

    <?php if ($isRentSaved === true) { ?>
        <div class="text-success">Заявка успешно принята</div>
    <?php } ?>
    <?php if ($error) { ?>
        <div class="text-error"><?=$error?></div>
    <?php } ?>

   <div class="form-group">
        <?= Html::submitButton('Забронировать', ['class' => 'btn btn-primary btn-test']) ?>
   </div>

    <?php ActiveForm::end(); ?>
<?php Pjax::end();?>

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
