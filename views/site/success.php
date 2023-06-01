<?php

use yii\bootstrap5\Modal;
use yii\widgets\Pjax;

Pjax::begin(["id" => "booking-success-pjax", "enablePushState" => false]);
?>
<div class="modal-body">
    <div class="close close-icon-block" data-dismiss="modal" aria-label="Close">
        X
    </div>
    <h4>Создать заказ</h4>
    <br>
    <br>
    <div class="alert alert-danger">Заявка успешно создана</div>
</div>

<?php
Pjax::end()
?>

