<?php

namespace App\Laundry\Controllers;

use App\Laundry\Core\BaseController;
use App\Laundry\Models\PesananModel;
use App\Laundry\Models\UserModel;
use Carbon\Carbon;
use Pusher\Pusher;

class CobaController extends BaseController
{
	// Visiblity private pesanan
	private $pesanan;
	private $user;
	public function __construct()
	{
		$this->pesanan = $this->model(PesananModel::class);
		$this->user = $this->model(UserModel::class);
	}
	public function index()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
		];

		date_default_timezone_set('Asia/Jakarta');
		$hari_ini = date('Y-m-d');

		$satu_minggu_lalu = date('Y-m-d', time() - 604800);
		$dua_minggu_lalu = date('Y-m-d', time() - 1209600);

		$satu_bulan_lalu = date('Y-m-d', time() - 2592000);
		$dua_bulan_lalu = date('Y-m-d', time() - 5184000);

		$satu_bulan_6 = date('Y-m-d', time() - 15552000);
		$dua_bulan_6 = date('Y-m-d', time() - 31104000);
		$satu_tahun = date('Y-m-d', time() - 31536000);
		$dua_tahun = date('Y-m-d', time() - 63072000);

		$data_minggu_lalu = $this->pesanan->getViewTotalByTgl($satu_minggu_lalu, $hari_ini) ?? 0;
		$data_dua_minggu_lalu = $this->pesanan->getViewTotalByTgl($dua_minggu_lalu, $satu_minggu_lalu) ?? $data_minggu_lalu;

		$data_bulan_lalu = $this->pesanan->getViewTotalByTgl($satu_bulan_lalu, $hari_ini) ?? 0;
		$data_dua_bulan_lalu = $this->pesanan->getViewTotalByTgl($dua_bulan_lalu, $satu_bulan_lalu) ?? $data_bulan_lalu;

		$data_6bulan_lalu = $this->pesanan->getViewTotalByTgl($satu_bulan_6, $hari_ini) ?? 0;
		$data_dua6bulan_lalu = $this->pesanan->getViewTotalByTgl($dua_bulan_6, $satu_bulan_6) ?? $data_6bulan_lalu;

		$data_tahun_lalu = $this->pesanan->getViewTotalByTgl($satu_tahun, $hari_ini) ?? 0;
		$data_dua_tahun_lalu = $this->pesanan->getViewTotalByTgl($dua_tahun, $satu_tahun) ?? $data_tahun_lalu;

		$data['1minggu'] = floor(($data_minggu_lalu % $data_dua_minggu_lalu / $data_dua_minggu_lalu) * 100);
		$data['1bulan'] = floor($data_bulan_lalu % $data_dua_bulan_lalu / $data_dua_bulan_lalu * 100);
		$data['6bulan'] = floor($data_6bulan_lalu % $data_dua6bulan_lalu / $data_dua6bulan_lalu * 100);
		$data['1tahun'] = floor($data_tahun_lalu % $data_dua_tahun_lalu / $data_dua_tahun_lalu * 100);


		// $data['ctm_minggu'] = $this->pesanan->getAllKategori(7);
		$data['all_pesanan'] = $this->pesanan->getAllByDate(4, 7);
		// $data['user'] = $this->user->getAllByLevel();

		// foreach ($this->user->getAllByLevel() as $row) {
		// 	if (!$this->pesanan->getAllByDate($row['id_tmuld'], 7)) {
		// 		$this->user->updateStatus([
		// 			'id' => $row['id_tmuld'],
		// 			'status' => 0
		// 		]);
		// 	}
		// }

		$data['carbon'] = new Carbon();

		$this->view('pages/coba/index', $data);
	}
	public function coba()
	{
		// echo json_encode($_POST);
		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		);
		$pusher = new Pusher(
			'2c347829e0890c4647df',
			'f6dc73a1e3f3614b20a8',
			'1728974',
			$options
		);
		$data['pesanan'] = $_POST['pesanan'];
		$data['prosess'] = $_POST['prosess'];
		$pusher->trigger('notifikasi', 'my-event', $data);
		if ($pusher) {
			$response = [
				'status' => 200,
				'message' => 'berhasil mengirim data',
				'data' => $data
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$response = [
				'status' => 400,
				'message' => 'gagal mengirim data',
				'data' => $data
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		}
	}
	public function notifikasi()
	{
		$data = [
			'title' => 'Notifikasi',
			'owner' => 'Syifa Laundry',
		];
		$this->view('pages/coba/notifikasi', $data);
	}
}
