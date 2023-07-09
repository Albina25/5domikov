<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);

$this->title = $name;
?>
<div class="site-error mt-header container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Невозможно отобразить страницу.
    </p>
    <p>
        Пожалуйста, свяжитесь с нами.
    </p>

</div>

<style>
    .mt-header {
        margin-top: var(--header-size, 65px);
    }
</style>
