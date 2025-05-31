<?php

namespace App\Laundry\Controllers;

use App\Laundry\Core\BaseController;
use App\Laundry\Models\KategoriModel;
use App\Laundry\Models\PesananModel;
use App\Laundry\Models\UserModel;
use Carbon\Carbon;
use Pusher\Pusher;

class AdminController extends BaseController
{
	// Visiblity private customer
	private $customer;
	// Visiblity private pesanan
	private $pesanan;
	// Visiblity private harga satuan kategori
	public $harga_satuan;
	// Visiblity private password
	private $password_default = "20024";
	// Visiblity constanta message
	private const MESSAGE = [
		"nama" => [
			"required" => "Nama harus diisi!",
			"between" => "Nama harus diantara 3 sampai 25 karakter",
		],
		"no_hp" => [
			"required" => "No Hp harus diisi!",
			"numeric" => "No Hp harus angka!",
			"between" => "No Hp harus diantara 10 sampai 13 karakter",
		]
	];
	// Visiblity constanta message edit
	private const MESSAGE_EDIT_STATUS = [
		"status" => [
			"required" => "Status harus diisi!",
		],
		"status_bayar" => [
			"required" => "Status Bayar harus diisi!",
		]
	];
	// Visiblity constanta message add
	private const MESSAGE_ADD = [
		"kategori" => [
			"required" => "Kategori harus diisi!",
		]
	];
	private const MESSAGE_DLTD = [
		"id" => [
			"required" => "Tidak Ada ID!",
		]
	];
	//  Cunstructor Admin
	public function __construct()
	{
		// load model customer
		$this->customer = $this->model(UserModel::class);
		// load model pesanan
		$this->pesanan = $this->model(PesananModel::class);
		// load model kategori
		$this->harga_satuan = $this->model(KategoriModel::class)->getAll();

		// UPDATE JIKA CUSTOMER TIDAK PESAN DALAM 1 MINGGU
		foreach ($this->customer->getAllByLevel() as $row) {
			if (!$this->pesanan->getAllByDate($row['id_tmuld'], 7)) {
				$this->customer->updateStatus([
					'id' => $row['id_tmuld'],
					'status' => 0
				]);
			} else {
				$this->customer->updateStatus([
					'id' => $row['id_tmuld'],
					'status' => 1
				]);
			}
		}
	}
	// halaman dashboard view
	public function index()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'total_customer' => $this->customer->getAll(),
			'total_pesanan' => $this->pesanan->getViewpesananan(),
		];
		// filter data total customer
		$data['total_pelanggan'] = count(array_filter($data['total_customer'], function ($item) {
			if ($item['status_deleted_tmuld'] == 0) {
				return $item['id_tmru_ld'] == 2;
			}
		}));
		// filter data total pesanan
		$data['total_sudah_bayar'] = count(array_filter($data['total_pesanan'], function ($item) {
			if ($item['status_deleted'] == 0) {
				return $item['status_bayar'] == 1;
			}
		}));

		$data['total_pesanan_ctm'] = count(
			array_filter(
				$data['total_pesanan'],
				function ($item) {
					if ($item['status_deleted'] === 0) {
						return $item > 0;
					}
				}
			)
		);

		// filter data total pesanan
		$data['total_belum_bayar'] = count(array_filter($data['total_pesanan'], function ($item) {
			if ($item['status_deleted'] == 0) {
				return $item['status_bayar'] == 0;
			}
		}));
		// end filter data total customer

		// ambil data view customer
		$data['view_ctm'] = $this->pesanan->getAll();
		// end ambil data view customer

		// TOTAL PNDAPATAN
		// TOTAL PNDAPATAN 1 MINGGU
		$data['total_minggu'] = number_format($this->pesanan->getTotalPendapatan(7)->total ?? 0, 0, ",", ".");
		// TOTAL PNDAPATAN 1 BULAN
		$data['total_bulan'] = number_format($this->pesanan->getTotalPendapatan(30)->total ?? 0, 0, ",", ".");
		// TOTAL PNDAPATAN 1 BULAN
		$data['total_6bulan'] = number_format($this->pesanan->getTotalPendapatan(182)->total ?? 0, 0, ",", ".");
		// TOTAL PNDAPATAN 1 TAHUN
		$data['total_tahun'] = number_format($this->pesanan->getTotalPendapatan(366)->total ?? 0, 0, ",", ".");
		// END TOTAL PNDAPATAN


		// GRAFIK PENDAPATAN
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

		$data_minggu_lalu = $this->pesanan
			->getViewTotalByTgl($satu_minggu_lalu, $hari_ini) ?? 0;
		$data_dua_minggu_lalu = $this->pesanan
			->getViewTotalByTgl($dua_minggu_lalu, $satu_minggu_lalu) ?? $data_minggu_lalu;

		$data_bulan_lalu = $this->pesanan
			->getViewTotalByTgl($satu_bulan_lalu, $hari_ini) ?? 0;
		$data_dua_bulan_lalu = $this->pesanan
			->getViewTotalByTgl($dua_bulan_lalu, $satu_bulan_lalu) ?? $data_bulan_lalu;

		$data_6bulan_lalu = $this->pesanan
			->getViewTotalByTgl($satu_bulan_6, $hari_ini) ?? 0;
		$data_dua6bulan_lalu = $this->pesanan
			->getViewTotalByTgl($dua_bulan_6, $satu_bulan_6) ?? $data_6bulan_lalu;

		$data_tahun_lalu = $this->pesanan
			->getViewTotalByTgl($satu_tahun, $hari_ini) ?? 0;
		$data_dua_tahun_lalu = $this->pesanan
			->getViewTotalByTgl($dua_tahun, $satu_tahun) ?? $data_tahun_lalu;

		$data['1minggu'] = $data_minggu_lalu != 0 ? floor(($data_minggu_lalu % $data_dua_minggu_lalu) / $data_dua_minggu_lalu * 100) : 0;
		$data['1bulan'] = $data_bulan_lalu != 0 ? floor(($data_bulan_lalu % $data_dua_bulan_lalu) / $data_dua_bulan_lalu * 100) : 0;
		$data['6bulan'] = $data_6bulan_lalu != 0 ? floor(($data_6bulan_lalu % $data_dua6bulan_lalu) / $data_dua6bulan_lalu * 100) : 0;
		$data['1tahun'] = $data_tahun_lalu != 0 ? floor(($data_tahun_lalu % $data_dua_tahun_lalu) / $data_dua_tahun_lalu * 100) : 0;

		// view
		$this->view('pages/admin/index', $data);
	}

	// KATEGORI
	// semua kategori
	public function categories($datelimit = null)
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'date' => new Carbon(),
		];

		if ($datelimit === null) {
			$data['categories'] = $this->pesanan->getAllKategori(7);
		} else {
			$data['categories'] = $this->pesanan->getAllKategori(base64_decode($datelimit));
		}
		$this->view('pages/admin/categories/all_kategori', $data);
	}

	// kategori kiloan
	public function kategoriKiloan($datelimit = null)
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'date' => new Carbon(),
		];
		if ($datelimit === null) {
			$data['categories'] = $this->pesanan->getAllKategoriByName(1, 7);
		} else {
			$data['categories'] = $this->pesanan->getAllKategoriByName(1, base64_decode($datelimit));
		}
		$this->view('pages/admin/categories/kategori_kiloan', $data);
	}

	// kategori satuan
	public function kategoriSatuan($datelimit = null)
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'date' => new Carbon(),
		];
		if ($datelimit === null) {
			$data['categories'] = $this->pesanan->getAllKategoriByName(3, 7);
		} else {
			$data['categories'] = $this->pesanan->getAllKategoriByName(3, base64_decode($datelimit));
		}
		$this->view('pages/admin/categories/kategori_satuan', $data);
	}

	// kategori satuan
	public function kategoriExpress($datelimit = null)
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'date' => new Carbon(),
		];
		if ($datelimit === null) {
			$data['categories'] = $this->pesanan->getAllKategoriByName(2, 7);
		} else {
			$data['categories'] = $this->pesanan->getAllKategoriByName(2, base64_decode($datelimit));
		}
		$this->view('pages/admin/categories/kategori_express', $data);
	}

	// pdf data customer
	public function pdf_data_ctm()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'customer' => $this->customer->getAll(),
			'total_pesanan' => $this->pesanan->getAll(),
		];
		$this->view('pages/admin/pdf/pdf_customer', $data);
	}

	// pdf data pesanan belum bayar
	public function pdf_data_belum_bayar()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'pesanan' => $this->pesanan->getAllpesananan()
		];
		$this->view('pages/admin/pdf/pdf_ctm_belum_bayar', $data);
	}

	// pdf data pesanan sudah bayar
	public function pdf_data_sudah_bayar()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'pesanan' => $this->pesanan->getAllpesananan()
		];
		$this->view('pages/admin/pdf/pdf_ctm_sudah_bayar', $data);
	}

	// customer all view
	public function customer()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'customer' => $this->customer->getAll(),
		];
		$this->view('pages/admin/customers/customer', $data);
	}

	// customer aktif view
	public function customer_aktif()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'customer' => $this->customer->getAll()
		];
		$this->view('pages/admin/customers/customer_aktif', $data);
	}

	// customer no aktif view
	public function customer_no_aktif()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'customer' => $this->customer->getAll()
		];
		$this->view('pages/admin/customers/customer_no_aktif', $data);
	}

	// customer hapus data
	public function customer_hapus()
	{
		$fileds = [
			"id" => "string | required",
			"status_deleted" => "string",
			"update_by" => "string",
		];
		$data_masuk['id'] = $_POST['userId'];
		$data_masuk['status_deleted'] = 1;
		$data_masuk['update_by'] = 1;
		[$inputs, $errors] = $this->filter($data_masuk, $fileds, self::MESSAGE_DLTD);
		if ($errors) {
			$response = [
				'status' => 400,
				'message' => $errors,
				'data' => $errors
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$proc = $this->customer->updateDeleted($inputs);
			if ($proc) {
				$response = [
					'status' => 200,
					'message' => "Data Berhasil Di hapus",
					'data' => $proc
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			} else {
				$response = [
					'status' => 400,
					'message' => "Data Gagal Di hapus",
					'data' => $proc
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			}
		}
	}

	// insert data customer insert data
	public function insert()
	{
		$fields = [
			"nama" => "string | required | between: 3, 25 | unique: tbl_m_user_ld, name",
			"username" => "string | required |",
			"email" => "string | email",
			"no_hp" => "string | required",
			"password" => "string | required",
			"role" => "string",
			'created_by' => 'string',
			"status_deactive" => "string | required",
			"img_default" => "string",
		];
		$nama = $_POST['nama'];
		$nama = strtolower($nama);
		$nama = ucfirst($nama);
		$data_masuk['nama'] = $nama;
		$data_masuk['email'] = $_POST['email'];
		$data_masuk['no_hp'] = $_POST['no_hp'];
		$data_masuk['status_deactive'] = 1;
		$data_masuk['role'] = 2;
		$data_masuk['created_by'] = 1;
		$data_masuk['img_default'] = '2005e27a39fa5f6d97b2e0a95233b2be.jpg';
		// password default  nama + angka paling awal
		$data_masuk['password'] = password_hash(explode(" ", $nama)[0] . $this->password_default, PASSWORD_DEFAULT);
		// jika email tidak kosong
		if (!empty($_POST['email'])) {
			$data_masuk['username'] = explode("@", $_POST['email'][0]);
		}
		$username = explode(" ", $_POST['nama'])[0];
		$username2 = strlen($username);
		$data_masuk['username'] = strtolower($username . $username2);
		[$inputs, $errors] = $this->filter($data_masuk, $fields, self::MESSAGE);
		if ($errors) {
			$response = [
				'status' => 400,
				'message' => $errors,
				'data' => $errors
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$proc = $this->customer->insert($inputs);
			if ($proc->rowCount() > 0) {
				$response = [
					'status' => 200,
					'message' => 'Customer Berhasil ditambahkan ' . $proc->rowCount() . ' baris',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			} else {
				$response = [
					'status' => 400,
					'message' => 'Customer gagal ditambahkan',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			}
		}
	}

	// ambil data sesuai id it customer
	public function getEdit($id = null)
	{
		echo json_encode($this->customer->getById($id));
	}

	// update data customer
	public function edit()
	{
		$fields = [
			"id" => "string | required",
			"nama" => "string | required | between: 3, 25",
			"username" => "string | required |",
			"email" => "string | email",
			"no_hp" => "string | required",
			"status_deactive" => "string | required",
			'update_by' => 'string',
		];
		$nama = $_POST['nama'];
		$nama = strtolower($nama);
		$nama = ucfirst($nama);
		$data_masuk['id'] = $_POST['id'];
		$data_masuk['nama'] = $nama;
		$data_masuk['email'] = $_POST['email'];
		$data_masuk['no_hp'] = $_POST['no_hp'];
		$data_masuk['status_deactive'] = 1;
		$data_masuk['role'] = 2;
		$data_masuk['update_by'] = 1;
		if (!empty($_POST['email'])) {
			$data_masuk['username'] = explode("@", $_POST['email'][0]);
		}
		$username = explode(" ", $_POST['nama'])[0];
		$username2 = strlen($username);
		$data_masuk['username'] = strtolower($username . $username2);
		// echo json_encode($data_masuk['email']);
		[$inputs, $errors] = $this->filter($data_masuk, $fields, self::MESSAGE);
		if ($errors) {
			$response = [
				'status' => 400,
				'message' => $errors,
				'data' => $errors
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$proc = $this->customer->update($inputs);
			if ($proc->rowCount() > 0) {
				$response = [
					'status' => 200,
					'message' => 'Customer ' . $inputs["nama"] . ' Berhasil Di edit ' . $proc->rowCount() . ' baris',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			} else {
				$response = [
					'status' => 400,
					'message' => 'Customer ' . $inputs["nama"] . ' gagal di Edit atau tidak ada perubahan',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			}
		}
	}

	// customer semua kategori view
	public function pemesanan()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'pesanan' => $this->customer->getAll()
		];
		$this->view('pages/admin/pemesanan/data_pesanan', $data);
	}

	// customer detail pesanan view
	public function detail_pemesanan($id = null, $datelimit = null)
	{
		$id = base64_decode($id);
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'customer' => $this->customer->getById($id),
		];
		if ($datelimit == null) {
			$data['pesanan'] = $this->pesanan->getByPesanan($id, 7);
		} else {
			$data['pesanan'] = $this->pesanan->getByPesanan($id, base64_decode($datelimit));
		}
		$this->view('pages/admin/pemesanan/detail_pesanan', $data);
	}

	// tambah pemesanan customer data
	public function tambah_pemesanan()
	{
		$fields = [
			"id_tmuld" => "string",
			"id_kld" => "string ",
			"jumlah_kld" => "string",
			"kategori" => "string | required",
			"prosess" => "string ",
			"bayar" => "string ",
			"status_deactive" => "string ",
		];
		$data_masuk['id_tmuld'] = $_POST['id'];
		$data_masuk['status_deactive'] = 1;
		if ($_POST['kategori'] == 'kiloan') {
			$data_masuk['id_kld'] = 1;
			$data_masuk['jumlah_kld'] = $_POST['berat_kg'];
			$data_masuk['kategori'] = $_POST['kategori'] . ' - ' . $_POST['berat_kg'] . ' kg';
			$data_masuk['bayar'] = $this->harga_satuan[0]['harga_satuan'] * $_POST['berat_kg'];
		} elseif ($_POST['kategori'] == 'satuan') {
			$data_masuk['id_kld'] = 3;
			$data_masuk['jumlah_kld'] = 1;
			$data_masuk['kategori'] = $_POST['kategori'] . ' - ' . $_POST['inpt_satuan'];
			$data_masuk['bayar'] = $_POST['harga_satuan'];
		} elseif ($_POST['kategori'] == 'express') {
			if ($_POST['kategori_express'] == 'express_kiloan') {
				$data_masuk['id_kld'] = 2;
				$data_masuk['jumlah_kld'] = $_POST['berat_kg'];
				$data_masuk['kategori'] = str_replace('_', ' ', $_POST['kategori_express']) . ' - ' . $_POST['berat_kg'] . ' kg';
				$data_masuk['bayar'] = $this->harga_satuan[1]['harga_satuan'] * $_POST['berat_kg'];
			} elseif ($_POST['kategori_express'] == 'express_satuan') {
				$data_masuk['id_kld'] = 2;
				$data_masuk['jumlah_kld'] = 1;
				$data_masuk['kategori'] = str_replace('_', ' ', $_POST['kategori_express']) . ' - ' . $_POST['inpt_satuan'];
				$data_masuk['bayar'] = $_POST['harga_satuan'];
			}
		} else {
			$data_masuk['kategori'] = null;
		}
		$data_masuk['prosess'] = "di prosess";
		[$inputs, $errors] = $this->filter($data_masuk, $fields, self::MESSAGE_ADD);
			
		if ($errors) {
			$response = [
				'status' => 400,
				'message' => $errors,
				'data' => $errors
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$proc = $this->pesanan->insert($inputs);
			if ($proc->rowCount() > 0) {
				$response = [
					'status' => 200,
					'message' => 'Pesanan Berhasil ditambahkan ' . $proc->rowCount() . ' baris',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			} else {
				$response = [
					'status' => 400,
					'message' => 'Pesanan gagal ditambahkan',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			}
		}
	}

	// ambil data pemesanan edit
	public function getEditPesanan($id = null)
	{
		foreach ($this->pesanan->getPesanananByid($id) as $value) {
			echo json_encode($value);
		}
	}

	// edit pemesanan
	public function edit_pemesanan()
	{
		$fields = [
			"id" => "string",
			"id_kld" => "string ",
			"jumlah_kld" => "string",
			"kategori" => "string | required",
			"bayar" => "string ",
			"status_deactive" => "string ",
		];
		$data_masuk['id'] = $_POST['id'];
		$data_masuk['status_deactive'] = 1;
		if ($_POST['kategori-pesanan'] == 'kiloan') {
			$data_masuk['id_kld'] = 1;
			$data_masuk['jumlah_kld'] = $_POST['berat_kg'];
			$data_masuk['kategori'] = $_POST['kategori-pesanan'] . ' - ' . $_POST['berat_kg'] . ' kg';
			$data_masuk['bayar'] = $this->harga_satuan[0]['harga_satuan'] * $_POST['berat_kg'];
		} elseif ($_POST['kategori-pesanan'] == 'satuan') {
			$data_masuk['id_kld'] = 3;
			$data_masuk['jumlah_kld'] = 1;
			$data_masuk['kategori'] = $_POST['kategori-pesanan'] . ' - ' . $_POST['inpt_satuan'];
			$data_masuk['bayar'] = $_POST['harga_satuan'];
		} elseif ($_POST['kategori-pesanan'] == 'express') {
			if ($_POST['kategori_express'] == 'express_kiloan') {
				$data_masuk['id_kld'] = 2;
				$data_masuk['jumlah_kld'] = $_POST['berat_kg'];
				$data_masuk['kategori'] = str_replace('_', ' ', $_POST['kategori_express']) . ' - ' . $_POST['berat_kg'] . ' kg';
				$data_masuk['bayar'] = $this->harga_satuan[1]['harga_satuan'] * $_POST['berat_kg'];
			} elseif ($_POST['kategori_express'] == 'express_satuan') {
				$data_masuk['id_kld'] = 2;
				$data_masuk['jumlah_kld'] = 1;
				$data_masuk['kategori'] = str_replace('_', ' ', $_POST['kategori_express']) . ' - ' . $_POST['inpt_satuan'];
				$data_masuk['bayar'] = $_POST['harga_satuan'];
			}
		} else {
			$data_masuk['kategori'] = null;
		}
		[$inputs, $errors] = $this->filter($data_masuk, $fields, self::MESSAGE_ADD);
		if ($errors) {
			$response = [
				'status' => 400,
				'message' => $errors,
				'data' => $errors
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$proc = $this->pesanan->update_pemesanan($inputs);

			if ($proc->rowCount() > 0) {
				$response = [
					'status' => 200,
					'message' => 'Pesanan Berhasil diubah ' . $proc->rowCount() . ' baris',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			} else {
				$response = [
					'status' => 400,
					'message' => 'Pesanan gagal di ubah atau tidak ada data yang di ubah',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			}
		}
	}

	// edit pesanan customer
	public function edit_prosess_pemesanan()
	{
		$fields = [
			"id" => "string",
			"prosess" => "string | required",
			"pesanan" => "string | required",
		];
		$data_masuk['id'] = $_POST['id'];
		$data_masuk['pesanan'] = $_POST['pesanan'];
		$data_masuk['prosess'] = $_POST['prosess'];
		[$inputs, $errors] = $this->filter($data_masuk, $fields, self::MESSAGE_EDIT_STATUS);
		if ($errors) {
			$response = [
				'status' => 400,
				'message' => $errors,
				'data' => $errors
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$proc = $this->pesanan->update_prosess($inputs);
			if ($proc->rowCount() > 0) {
				// RESPONSE UPDATE PROSESS
				$response = [
					'status' => 200,
					'error' => null,
					'message' => 'Prosess Laundry Berhasil di Perbaharui ' . $proc->rowCount() . ' baris',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
				// Response Pusher 
				// PUSHER JS
				$options = array(
					'cluster' => 'ap1',
					'useTLS' => true
				);
				// OBJEK PUSJER
				$pusher = new Pusher(
					'2c347829e0890c4647df',
					'f6dc73a1e3f3614b20a8',
					'1728974',
					$options
				);
				// GENERATE MESSAGE PUSHER
				foreach ($this->pesanan->getPesanananByid($inputs['id']) as $value) {
					$data['id'] = $value['id_tmuld'];
				}
				$data['pesanan'] = $inputs['pesanan'];
				$data['prosess'] = $inputs['prosess'];
				$pusher->trigger('notifikasi', 'my-event', $data);
			} else {
				$response = [
					'status' => 400,
					'error' => 400,
					'message' => 'Prosess Laundry gagal di Perbaharui atau tidak ada perubahan',
					'data' => null
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			}
		}
	}

	// customer belum bayar view
	public function belum_bayar()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'pesanan' => $this->pesanan->getAllpesananan()
		];
		$this->view('pages/admin/pembayaran/belum_bayar', $data);
	}

	// customer sudah bayar view
	public function sudah_bayar()
	{
		$data = [
			'title' => 'Admin',
			'owner' => 'Syifa Laundry',
			'pesanan' => $this->pesanan->getAllpesananan()
		];
		$this->view('pages/admin/pembayaran/sudah_bayar', $data);
	}

	// edit pembayaran customer view
	public function edit_pembayaran()
	{
		$fields = [
			"id" => "string",
			"status_bayar" => "string | required",
		];
		$data_masuk['id'] = $_POST['id'];
		$data_masuk['status_bayar'] = $_POST['status_bayar'];
		[$inputs, $errors] = $this->filter($data_masuk, $fields, self::MESSAGE_EDIT_STATUS);
		if ($errors) {
			$response = [
				'status' => 400,
				'message' => $errors,
				'data' => $errors
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$proc = $this->pesanan->updatePembayaran($inputs);
			if ($proc->rowCount() > 0) {
				$response = [
					'status' => 200,
					'error' => null,
					'message' => 'Status Pembayaran Berhasil di Perbaharui ' . $proc->rowCount() . ' baris',
					'data' => $inputs
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			} else {
				$response = [
					'status' => 400,
					'error' => 400,
					'message' => 'Status Pembayaran gagal di Perbaharui atau tidak ada perubahan',
					'data' => null
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			}
		}
	}
}
