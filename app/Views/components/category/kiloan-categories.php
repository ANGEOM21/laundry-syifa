<?php
    $categories = [['Celana' => 'celana'], ['Kemeja' => 'kemeja'], ['Jaket' => 'jaket'], ['Kaos' => 'kaos']];
    $categories2 = [['Hoodie' => 'hoodie'], ['Celana Pendek' => 'celana-pendek'], ['Kerudung' => 'kerudung'], ['Rok' => 'rok']];
?>
<div class="category-kiloan mt-2" id="category-kiloan">
    <div class="container">
        <div class="row border-kiloan mx-3">
            <?php foreach($categories as $category) { ?>
                <?php foreach($category as $k => $v) { ?>
                    <div class="col-lg-3 gap-4 px-5">
                        <div class="category-kiloan-item wow fadeInUp" data-wow-delay="0.1s">
                            <div class="category-kiloan-img pt-4">
                                <img src="img/category/<?= $v ?>.webp" alt="<?= $v ?>" width="60">
                            </div>
                            <div class="category-kiloan-text mt-2">
                                <h2 class="text-center text-white"><?= $k ?></h2>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="row border-kiloan mx-3">
            <?php foreach($categories2 as $category) { ?>
                <?php foreach($category as $k => $v) { ?>
                    <div class="col-lg-3 gap-4 px-5">
                        <div class="category-kiloan-item wow fadeInUp" data-wow-delay="0.1s">
                            <div class="category-kiloan-img pt-4">
                                <img src="img/category/<?= $v ?>.png" alt="<?= $v ?>" width="50">
                            </div>
                            <div class="category-kiloan-text mt-2">
                                <h2 class="text-center text-white"><?= $k ?></h2>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
