<?php
namespace App\Laundry\Controllers;
use App\Laundry\Core\BaseController;
// CONTROLLER DEFAULT APP 404
class DefaultApp extends BaseController
{
    // CONTROLLER DEFAULT APP 404
  public function index()
  {
      $data = [
        'title' => '404',
      'error' => '404',
      'message' => 'Halaman Tidak Ditemukan',
      '' => null
    ];
    $this->view('pages/erorr/index', $data);
  }
}
