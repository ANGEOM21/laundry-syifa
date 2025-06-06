<?php

namespace App\Laundry\Config;

use App\Laundry\Core\DotEnv;

class Config
{
  public static function load()
  {
    (new DotEnv(__DIR__ . '/../../.env'))->load();
    define('BASEURL', getenv('BASE_URL'));
  }
}
