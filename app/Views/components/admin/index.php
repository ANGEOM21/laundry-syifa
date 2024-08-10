<?php

use App\Laundry\Core\Message;
Message::flash();
?>
<div class="content-admin">
    <div class="judul-page">
        <h3><img src="<?= BASEURL; ?>/img/admin/icons/dashboard.svg" alt="" style="filter: invert(60%) hue-rotate(180deg) contrast(400%);" width="35"> Dashboard </h3>
        <h3 class="page">/ Home</h3>
    </div>
    <div class="container">
        <div class="card px-4 pb-5 mx-1">
            <div class="card-body">
                <?php 
                include __DIR__.'/../fragments/admin/banner.php';
                include __DIR__.'/../fragments/admin/total_ctm.php';
                include __DIR__.'/../fragments/admin/pendapatan.php';
                include __DIR__.'/../fragments/admin/grafik.php';
                ?>
            </div>
        </div>
    </div>
</div>