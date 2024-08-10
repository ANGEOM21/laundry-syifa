<?php
namespace App\Laundry\Core;
use App\Laundry\Core\Filter;

class BaseController extends Filter
{
    public function view($view, $data = [])
  {
      if (count($data)) {
        extract($data);
    }
    require_once __DIR__. '/../Views/' . $view . '.php';
  }
  public function redirect($url)
  {
      header('Location: ' . BASEURL . '/' . $url);
    exit;
  }
  public function model($model)
  {
      // require_once '../app/models/' . $model . '.php';
    return new $model();
  }
  public function api($view, $data = [])
  {
      if (count($data)) {
        extract($data);
    }
    require_once __DIR__. '/../app/API/' . $view . '.php';
  }
}