<?php
use app\models\Rent;

/** @var yii\web\View $this */
/** @var app\models\Rent $model */
/** @var boolean $isRentSaved */
/** @var string $error */

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
            <?php echo $this->render('parts/booking', ['model' => $model, 'isRentSaved' => $isRentSaved, 'error' => $error]);?>
        </div>
    </div>
    <div class="main-block__part main-block__images">
        <?php echo $this->render('parts/images');?>
    </div>
</section>