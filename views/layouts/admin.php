
<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AdminAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AdminAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav d-flex justify-content-center'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/admin/default/index']],
            ['label' => 'Дома', 'url' => ['/admin/house/index']],
            ['label' => 'Оплата', 'url' => ['/admin/payment/index']],
            /*Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'*/
        ]
    ]);
    NavBar::end();
    ?>
</header>
<!--<div class="middle-line">
    <div class="container1">
        <div class="middle-line__content">
            <p class="middle-line__title">Отдыхай с удовольствием</p>
        </div>
    </div>
</div>-->



<main id="main" class="main-block">
    <?php /*if (!empty($this->params['breadcrumbs'])): */?><!--
        <?/*= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) */?>
    <?php /*endif */?>
    --><?/*= Alert::widget() */?>
    <?= $content ?>
</main>

<footer id="footer" class="footer-block container">
    <div class="row text-muted">
        <div class="footer-block__years">&copy; <?= Html::encode($this->title) ?> <?= date('Y') ?></div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
