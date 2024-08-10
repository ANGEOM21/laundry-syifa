<?php

namespace App\Laundry\Models;

date_default_timezone_set('Asia/Jakarta');

use App\Laundry\Core\Database;
use PDO; // MODELS USER MODEL 
class UserModel extends Database
{
	// VISIBILTY MODEL PRIVATE TABEL 
	private $tabelName = 'tbl_m_user_ld';

	// VISIBILTY MODEL PRIVATE COLUMN 
	private $column = ['id_tmuld', 'name', 'username', 'email', 'no_hp', 'password', 'id_tmru_ld', 'img_tmuld', 'status_deleted_tmuld', 'status_deactive_tmuld'];

	// CONSTRUCTOR MODEL USER
	public function __construct()
	{
		// TURUNUNAN CUNSTRUCTOR DATABASE
		parent::__construct();
		// SETTER TABEL DAN COLUMN 
		$this->setTableName($this->tabelName);
		$this->setColumn($this->column);
	}

	// GET ALL DATA USER MODEL 
	public function getAll()
	{
		return $this->get()->fetchAll(PDO::FETCH_ASSOC);
	}

	// GET ALL DATA USER MODEL BY LEVEL
	public function getAllByLevel()
	{
		return $this->get(['id_tmru_ld' => 2, 'status_deleted_tmuld' => 0])->fetchAll(PDO::FETCH_ASSOC);
	}

	// INSERT DATA USER MODELS 
	public function insert($data)
	{
		$table = ['name' => $data['nama'], 'username' => $data['username'], 'email' => $data['email'], 'no_hp' => $data['no_hp'], 'password' => $data['password'], 'id_tmru_ld' => $data['role'], 'status_deactive_tmuld' => $data['status_deactive'], 'created_by_tmuld' => $data['created_by'], 'img_tmuld' => $data['img_default'],];
		return $this->insertData($table);
	} 
	
	// GET DATA BY ID USER MODEL 
	public function getById($id)
	{
		return $this->get(['id_tmuld' => $id])->fetch(PDO::FETCH_ASSOC);
	} 
	
	// UPDATE DATA USER MODELS +  ADMIN 
	public function update($data)
	{
		$table = ['name' => $data['nama'], 'email' => $data['email'], 'no_hp' => $data['no_hp'], 'status_deactive_tmuld' => $data['status_deactive'], 'update_date_tmuld' => date('Y-m-d H:i:s'), 'update_by_tmuld' => $data['update_by'],];
		$key = ['id_tmuld' => $data['id']];
		return $this->updateData($table, $key);
	}

	// UPDATE STATUS USER MODELS + ADMIN 
	public function updateStatus($data)
	{
		$table = [
			'status_deactive_tmuld' => $data['status'],
			'update_date_tmuld' => date('Y-m-d H:i:s'),
		];
		$key = ['id_tmuld' => $data['id']];
		return $this->updateData($table, $key);
	} 
	
	// UPDATE PASSWORD USER MODELS 
	public function updatePassword($data)
	{
		$table = ['password' => $data['password'],];
		$key = ['id_tmuld' => $data['id']];
		return $this->updateData($table, $key);
	} 
	
	// UPDATE DATA USER MODELS + USER 
	public function updateUser($data)
	{

		$table = ['name' => $data['name'], 'username' => $data['username'], 'email' => $data['email'], 'no_hp' => $data['no_hp'], 'password' => $data['new-password'], 'update_date_tmuld' => date('Y-m-d H:i:s'), 'update_by_tmuld' => $data['update_by'],];
		$key = ['id_tmuld' => $data['id']];
		return $this->updateData($table, $key);
	} 
	
	// UPDATE IMAGE USER 
	public function updateImage($data)
	{
		$table = ['img_tmuld' => $data['img'], 'update_by_tmuld' => $data['update_by'], 'update_date_tmuld' => date('Y-m-d H:i:s'),];
		$key = ['id_tmuld' => $data['id']];
		return $this->updateData($table, $key);
	} 
	
	// UPDATE deleted User 
	public function updateDeleted($data)
	{
		$table = ['status_deleted_tmuld' => $data['status_deleted'], 'update_by_tmuld' => $data['update_by'], 'update_date_tmuld' => date('Y-m-d H:i:s'),];
		$key = ['id_tmuld' => $data['id']];
		return $this->updateData($table, $key);
	} 
	
	// DELETE DATA USER MODELS (JIKA DI PAKAI UNTUK ADMIN) 
	public function delete($id)
	{
		// $query = "DELETE FROM barang WHERE barang_id = ?"; // return $this->qry($query, [$id]); return $this->deleteData(['id_tmuld' => $id]); 
	}

	// TOTAL DATA USER ROLE CUSTOMER 
	public function totalCustomer()
	{
		$query = "SELECT COUNT(*) as total FROM tbl_m_user_ld";
		return $this->qry($query)->fetch(PDO::FETCH_ASSOC);
	}
	
	// GET DATA BY EMAIL OR USERNAME 
	public function getByEmailUsername($emailusername)
	{
		$query = "SELECT * FROM tbl_m_user_ld WHERE email = ? OR username = ?";
		return $this->qry($query, [$emailusername, $emailusername])->fetch(PDO::FETCH_ASSOC); // return $this->get(['email' => $email])->fetch(PDO::FETCH_ASSOC); 
	}
}
