<?php
$this->title = 'Пять домиков';
$a = Yii::$app->controller->getRoute();
?>

<div class="admin-default-index container">
    <!--<h1><?/*= $this->context->action->uniqueId */?></h1>-->
    <p>
        Заявок в ожидании - <?=$countRentsInPending?>
    </p>
    <!--<p>
        You may customize this page by editing the following file:<br>
        <code><?/*= __FILE__ */?></code>
    </p>-->
</div>
