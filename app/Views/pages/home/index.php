<?php

use App\Laundry\Core\Message;

include __DIR__.'/../../partials/header.php';
include __DIR__.'/../../components/layouts/navbar.php';
include __DIR__.'/../../components/layouts/banner.php';
include __DIR__.'/../../components/layouts/pemesanan.php';
include __DIR__.'/../../components/layouts/kiloan.php';
include __DIR__.'/../../components/layouts/satuan.php';
include __DIR__.'/../../components/layouts/express.php';
include __DIR__.'/../../components/layouts/contact.php';
include __DIR__.'/../../components/fragments/footer/footer.php';
Message::flash();
include __DIR__.'/../../partials/footer.php';
?>
