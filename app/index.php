<?php

use App\Laundry\Config\Config;
use App\Laundry\Core\Routes;

if (!session_id())
  session_start();

require_once __DIR__.'/../vendor/autoload.php';

Config::load();
$routes = new Routes();
$routes->run();