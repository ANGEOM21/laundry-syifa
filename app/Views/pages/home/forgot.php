<?php

use App\Laundry\Core\Message;

include __DIR__.'/../../partials/header.php';
Message::flash();
include __DIR__.'/../../components/layouts/forgot.php';
include __DIR__.'/../../partials/footer.php';
?>
