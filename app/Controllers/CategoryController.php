<?php

namespace App\Laundry\Controllers;

use App\Laundry\Core\BaseController;
// HOME CONTROLLER CATEGORY
class CategoryController extends BaseController
{
	public function kiloan()
	{
		$data = [
			'title' => 'kiloan',
			'owner' => 'Syifa Laundry'
		];
		$this->view('pages/home/kiloan', $data);
	}
	public function satuan()
	{
		$data = [
			'title' => 'satuan',
			'owner' => 'Syifa Laundry'
		];
		$this->view('pages/home/satuan', $data);
	}
	public function express()
	{
		$data = [
			'title' => 'express',
			'owner' => 'Syifa Laundry'
		];
		$this->view('pages/home/express', $data);
	}
}
