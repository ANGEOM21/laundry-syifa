<?php

use App\Laundry\Core\Message;

include __DIR__ . '/../../partials/header.php';
Message::flash();
include __DIR__ . '/../../components/admin/topbar.php';
include __DIR__ . '/../../components/admin/sidebar.php';
include __DIR__ . '/../../components/admin/index.php';
include __DIR__ . '/../../partials/footer.php';
