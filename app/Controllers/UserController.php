<?php

namespace App\Laundry\Controllers;

use App\Laundry\Core\BaseController;
use App\Laundry\Models\PesananModel;
use App\Laundry\Models\UserModel;
// CONTROLLER USER
class UserController extends BaseController
{
	// VISISBILTY PRIVATE PROSES
	private $proses;
	// VISISBILTY PRIVATE PESANAN
	private $pesanan;
	// VISISBILTY PRIVATE UPDATE USER
	private $updateUser;
	// VISISBILTY PRIVATE CONSTAN MESSAGE
	private const MESSAGE = [
		"username" => [
			"required" => "Username harus diisi!",
			"between" => "Username harus diantara 3 sampai 25 karakter",
		],
		"password" => [
			"required" => "Password harus diisi!",
			"between" => "Password harus diantara 5 sampai 25 karakter",
		],
		"email" => [
			"required" => "Email harus diisi!",
			"secure" => "Email harus valid!",
		],
		"no_hp" => [
			"required" => "No Hp harus diisi!",
			"numeric" => "No Hp harus angka!",
			"between" => "No Hp harus diantara 11 sampai 12 karakter",
		],
		"name" => [
			"required" => "Nama harus diisi!",
			"between" => "Nama harus diantara 3 sampai 25 karakter",
		]
	];
	// MESSAGE IMAGE 
	private const MESSAGE_IMG = [
		"img" => [
			"required" => "Gambar harus diisi!"
		]
	];
	// CUNSTRUCTOR USER CONTROLLER
	public function __construct()
	{
		$this->proses = $this->model(UserModel::class)->getById($_SESSION['login']);
		$this->pesanan = $this->model(PesananModel::class);
		$this->updateUser = $this->model(UserModel::class);
	}
	// HALAMAN PROFILE VIEW
	public function index()
	{
		$data = [
			'title' => 'profile',
			'owner' => 'Syifa Laundry',
			'user' => $this->proses,
			'pesanan' => $this->pesanan
		];
		$this->view('pages/user/index', $data);
	}
	// HALAMAN PROSES VIEW USER CONTROLLER
	public function proses($datelimit = null)
	{
		$datelimit = base64_decode($datelimit);
		$data = [
			'title' => 'prosess',
			'user' => $this->proses,
			'owner' => 'Syifa Laundry',
		];
		if ($datelimit == null) {
			$data['pesanan'] = $this->pesanan->getByPesanan($_SESSION['login'], 7);
		} else {
			$data['pesanan'] = $this->pesanan->getByPesanan($_SESSION['login'], $datelimit);
		}
		$this->view('pages/user/proses', $data);
	}
	// HALAMAN LOGOUT VIEW USER CONTROLLER
	public function logout()
	{
		$data = [
			'title' => 'logout',
			'owner' => 'Syifa Laundry',
			'user' => $this->proses,
			'pesanan' => $this->pesanan
		];
		$this->view('pages/user/logout', $data);
	}
	// HALAMAN HELP VIEW USER CONTROLLER
	public function help()
	{
		$data = [
			'title' => 'help',
			'owner' => 'Syifa Laundry',
			'user' => $this->proses,
			'pesanan' => $this->pesanan
		];
		$this->view('pages/user/help', $data);
	}
	// HALAMAN FAQ VIEW USER CONTROLLER
	public function faq()
	{
		$data = [
			'title' => 'faq',
			'owner' => 'Syifa Laundry',
			'user' => $this->proses,
			'pesanan' => $this->pesanan
		];
		$this->view('pages/user/faq', $data);
	}
	// CONF EDIT  USER CONTROLLER
	public function edit()
	{
		$fields = [
			'id' => 'string | required',
			'name' => 'string | required | between:3,100',
			'username' => 'string | required',
			'email' => 'string | required',
			'no_hp' => 'string | required',
			'old-password' => 'string',
			'new-passowrd' => 'string',
			'conf-password' => 'string',
			'update_by' => 'string'
		];
		$data_masuk['id'] = $_POST['id_edit_user'];
		$data_masuk['name'] = $_POST['name_edit_user'];
		$data_masuk['username'] = $_POST['username_edit_user'];
		$data_masuk['email'] = $_POST['email_edit_user'];
		$data_masuk['no_hp'] = $_POST['no_hp_edit_user'];
		$data_masuk['old-password'] = $_POST['old_password_edit_user'];
		$data_masuk['new-passowrd'] = $_POST['new-passowrd_edit_user'];
		$data_masuk['conf-password'] = $_POST['conf-password_edit_user'];
		$data_masuk['update_by'] = $_SESSION['login'];
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
			if (empty($inputs['old-password']) && empty($inputs['new-passowrd']) && empty($inputs['conf-password'])) {
				$inputs['new-password'] = $this->proses['password'];
				$proc = $this->updateUser->updateUser($inputs);
				if ($proc) {
					$response = [
						'status' => 200,
						'message' => 'Data ' . $this->proses['name'] . ' berhasil Di Ubah',
						'data' => $proc
					];
					header('Content-Type: application/json');
					echo json_encode($response);
				} else {
					$response = [
						'status' => 400,
						'message' => 'Data ' . $this->proses['name'] . ' ' . $this->proses['username'] . ' ' . $this->proses['email'] . ' ' . $this->proses['no_hp'] . ' gagal Di Ubah atau tidak ada perubahan',
						'data' => $proc
					];
					header('Content-Type: application/json');
					echo json_encode($response);
				}
			} else {
				if (password_verify($inputs['old-password'], $this->proses['password']) == true) {
					if ($inputs['new-passowrd'] == $inputs['conf-password']) {
						$inputs['new-password'] = password_hash($inputs['new-passowrd'], PASSWORD_DEFAULT);
						$proc = $this->updateUser->updateUser($inputs);
						if ($proc) {
							$response = [
								'status' => 200,
								'message' => 'Data ' . $this->proses['name'] . ', ' . $this->proses['username'] . ', ' . $this->proses['email'] . ', ' . $this->proses['no_hp'] . ' dan Password berhasil Di Ubah',
								'data' => $proc
							];
							header('Content-Type: application/json');
							echo json_encode($response);
						} else {
							$response = [
								'status' => 400,
								'message' => 'Data ' . $this->proses['name'] . ', ' . $this->proses['username'] . ', ' . $this->proses['email'] . ', ' . $this->proses['no_hp'] . ' dan Password gagal Di Ubah',
								'data' => $proc
							];
							header('Content-Type: application/json');
							echo json_encode($response);
						}
					} else {
						$response = [
							'status' => 400,
							'message' => 'Password Tidak Sama',
							'data' => $errors
						];
						header('Content-Type: application/json');
						echo json_encode($response);
					}
				} else {
					$response = [
						'status' => 400,
						'message' => 'Password Lama Tidak Sesuai',
						'data' => $errors
					];
					header('Content-Type: application/json');
					echo json_encode($response);
				}
			}
		}
	}
	// CONF EDIT PHOTO USER CONTROLLER
	public function edit_img()
	{
		$fields = [
			'id' => 'string | required',
			'img' => 'string | required',
			'update_by' => 'string | required',
		];
		$data_masuk['id'] = $_POST['id'];
		$size_img = $_FILES["fileImg"]["size"];
		$size_type = $_FILES["fileImg"]["type"];
		$name_img = $_FILES["fileImg"]["name"];
		$extension = pathinfo($name_img, PATHINFO_EXTENSION);
		$name_img = uniqid() . '.' . $extension;
		$data_masuk['img'] = $name_img;
		$data_masuk['update_by'] = $_SESSION['login'];
		[$inputs, $errors] = $this->filter($data_masuk, $fields, self::MESSAGE_IMG);
		if ($errors) {
			$response = [
				'status' => 400,
				'message' => $errors,
				'data' => $errors
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			if ($size_img > 2097152) {
				$response = [
					'status' => 400,
					'message' => 'Ukuran File Terlalu Besar minimal 2mb',
					'data' => $errors
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			} else {
				$proc = $this->updateUser->updateImage($inputs);
				$target = "img/users/profile/" . $inputs['img'];
				if ($proc) {
					move_uploaded_file($_FILES["fileImg"]["tmp_name"], $target);
					$response = [
						'status' => 200,
						'message' => 'Gambar Berhasil Di Update',
						'data' => $proc
					];
					header('Content-Type: application/json');
					echo json_encode($response);
				} else {
					$response = [
						'status' => 400,
						'message' => 'Gambar Gagal Di Update',
					];
					header('Content-Type: application/json');
					echo json_encode($response);
				}
			}
		}
	}
	// CONF HAPUS PHOTO USER CONTROLLER
	public function hapus_img()
	{
		$fields = [
			'id' => 'string | required',
			'img' => 'string',
			'update_by' => 'string'
		];
		$gambar_default = '2005e27a39fa5f6d97b2e0a95233b2be.jpg';
		$data_masuk['id'] = $_POST['userId'];
		$data_masuk['img'] = $gambar_default;
		$data_masuk['update_by'] = $_SESSION['login'];
		[$inputs, $errors] = $this->filter($data_masuk, $fields, [
			"id" => [
				'required' => "harang diisi"
			]
		]);
		if ($errors) {
			$response = [
				'status' => 400,
				'message' => $errors,
				'data' => $errors
			];
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$proc = $this->updateUser->updateImage($inputs);
			if ($proc) {
				$response = [
					'status' => 200,
					'message' => 'Gambar Berhasil Di Hapus',
					'data' => $proc
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			} else {
				$response = [
					'status' => 400,
					'message' => 'Gambar Gagal Di Hapus',
					'data' => $proc
				];
				header('Content-Type: application/json');
				echo json_encode($response);
			}
		}
	}
}
