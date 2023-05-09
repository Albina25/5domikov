<?php
use app\models\Rent;

/** @var yii\web\View $this */
/** @var app\models\Rent $model */

$this->title = 'Пять домиков';
?>

<section class="main-block__head container">
    <div class="main-block__head-content container">
        <p class="main-block__head-title">Отдыхай с удовольствием</p>
    </div>
</section>
<section class="main-block__content container">
    <div class="main-block__part">
        <div class="main-block__info">
            <?php echo $this->render('parts/information');?>
        </div>
        <div class="main-block__info">
            <?php echo $this->render('parts/prices');?>
        </div>
        <div id="booking" class="main-block__info">
            <?php echo $this->render('parts/booking', ['model' => $model]);?>
        </div>
    </div>
    <div class="main-block__part main-block__images">
        <?php echo $this->render('parts/images');?>
    </div>
</section>

<!--<div class="hero-line">
    <div class="col-md-6 me-1">
        <section class="hero-line__info">
            <h3>Информация</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
        </section>
        <section class="hero-line__info">
            <h3>Цены</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
        </section>
        <section id="bookedBlock" class="hero-line__info">
            <h3>Бронь</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
        </section>
    </div>
    <div class="col-md-6 hero-line__photo">
        <div class="row1">
            <div class="column1">
                <img class="w-100" src="uploads/abc.jpg">
                <img class="w-100" src="uploads/p2.jpg">
                <img class="w-100" src="uploads/blog-grid.jpg">
                <img class="w-100" src="uploads/ins-2.jpg">
                <img class="w-100" src="uploads/ins-3.jpg">
            </div>
            <div class="column1">
                <img class="w-100" src="uploads/blog-1.jpg">
                <img class="w-100" src="uploads/me-cover.jpg">
                <img class="w-100" src="uploads/footer-img.png">
                <img class="w-100" src="uploads/ins-4.jpg">
                <img class="w-100" src="uploads/blog-2.jpg">
            </div>
        </div>
    </div>
</div>-->