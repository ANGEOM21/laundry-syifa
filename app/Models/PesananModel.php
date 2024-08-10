<?php

namespace App\Laundry\Models;

use App\Laundry\Core\Database;
use PDO;

class PesananModel extends Database
{
	private $tabelName = 'tbl_pesanan_ld';
	private $column = [
		'id_pld',
		'id_tmuld',
		'id_kld',
		'jumlah_kld',
		'name_kld',
		'prosess',
		'bayar',
		'status_bayar_pld',
		'status_deactive_pld'
	];
	public function __construct()
	{
		parent::__construct();
		$this->setTableName($this->tabelName);
		$this->setColumn($this->column);
	}
	public function getAll()
	{
		return $this->get()->fetchAll(PDO::FETCH_ASSOC);
	}
	public function insert($data)
	{
		$table = [
			'id_tmuld' => $data['id_tmuld'],
			'id_kld' => $data['id_kld'],
			'jumlah_kld' => $data['jumlah_kld'],
			'name_kld' => $data['kategori'],
			'prosess' => $data['prosess'],
			'bayar' => $data['bayar'],
			'status_deactive_pld' => $data['status_deactive'],
		];
		return $this->insertData($table);
	}
	public function getById($id)
	{
		return $this->get(['id_pld' => $id])->fetch(PDO::FETCH_ASSOC);
	}

	// getby id tmuld
	public function getAllByDate($id, $datelimit)
	{
		$query = "SELECT u.name, p.*
		FROM tbl_pesanan_ld p 
		INNER JOIN tbl_m_user_ld u ON u.id_tmuld = p.id_tmuld 
		WHERE p.id_tmuld = $id 
		AND update_at_prosess >= DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -$datelimit DAY)
		AND update_at_prosess <= CURRENT_TIMESTAMP ORDER BY update_at_prosess ASC";
		return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
	}

	// getby id pemesanan
	public function getPesanananByid($id)
	{
		$query = "SELECT * FROM tbl_pesanan_ld INNER JOIN tbl_kategori_ld tbl_kld ON tbl_kld.id_kld = tbl_pesanan_ld.id_kld WHERE id_pld = $id";
		return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
	}
	// update prosess pesanan
	public function update_prosess($data)
	{
		date_default_timezone_set('Asia/Jakarta');
		$table = [
			'prosess' => $data['prosess'],
			'update_at_prosess' => date('Y-m-d H:i:s'),
		];
		$key = [
			'id_pld' => $data['id']
		];
		return $this->updateData($table, $key);
	}
	// update pemesanan 
	public function update_pemesanan($data)
	{
		$table = [
			'id_kld' => $data['id_kld'],
			'jumlah_kld' => $data['jumlah_kld'],
			'name_kld' => $data['kategori'],
			'bayar' => $data['bayar'],
			'status_deactive_pld' => $data['status_deactive'],
		];
		$key = [
			'id_pld' => $data['id']
		];
		return $this->updateData($table, $key);
	}
	// update status aktif
	public function updateStatus($data)
	{
		$table = [
			'status_deactive_tmuld' => $data['status'],
		];
		$key = [
			'id_tmuld' => $data['id']
		];
		return $this->updateData($table, $key);
	}
	public function updatePembayaran($data)
	{
		$table = [
			'status_bayar_pld' => $data['status_bayar'],
		];
		$key = [
			'id_pld' => $data['id']
		];
		return $this->updateData($table, $key);
	}
	public function delete($id)
	{
		// $query = "DELETE FROM barang WHERE barang_id = ?";
		// return $this->qry($query, [$id]);
		return $this->deleteData(['id_tmuld' => $id]);
	}
	// hitung total customer
	public function totalCustomer()
	{
		$query = "SELECT COUNT(*) as total FROM tbl_m_user_ld";
		return $this->qry($query)->fetch(PDO::FETCH_ASSOC);
	}
	public function data_pesanan()
	{
		$query = "SELECT * FROM tbl_pesanan_ld";
		return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getAllpesananan()
	{
		$query = "SELECT tpld.*, tmuld.name, tmuld.no_hp, tmuld.status_deactive_tmuld, tmuld.status_deleted_tmuld, tkld.* FROM tbl_pesanan_ld tpld INNER JOIN tbl_m_user_ld tmuld ON tpld.id_tmuld = tmuld.id_tmuld INNER JOIN tbl_kategori_ld tkld ON tpld.id_kld = tkld.id_kld";

		return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getViewpesananan()
	{
		$query = "SELECT * FROM customer";
		return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getViewTotalByTgl($tglawal, $tglakhir)
	{
		$query = "SELECT SUM(bayar) as total FROM customer WHERE created_at BETWEEN '$tglawal' AND '$tglakhir'";
		return $this->qry($query)->fetchObject()->total;
	}

	public function getViewByTgl($tglawal, $tglakhir){
		$query = "SELECT name, bayar, created_at FROM customer WHERE created_at BETWEEN '$tglawal' AND '$tglakhir'";
		return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
	}


	public function getByPesanan($id, $datelimit)
	{
		$query = "SELECT tpld.*, tmuld.name, tmuld.no_hp, tmuld.status_deactive_tmuld, tmuld.status_deleted_tmuld, tkld.* FROM tbl_pesanan_ld tpld INNER JOIN tbl_m_user_ld tmuld ON tpld.id_tmuld = tmuld.id_tmuld INNER JOIN tbl_kategori_ld tkld ON tpld.id_kld = tkld.id_kld WHERE tpld.id_tmuld = $id AND update_at_prosess >= NOW() - INTERVAL $datelimit DAY";
		return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
	}


	// GET ALL DATA KATEGORI PESANAN
	public function getAllKategori($datelimit = null)
	{
		$query = "SELECT * FROM customer WHERE created_at >= NOW() - INTERVAL $datelimit DAY ORDER BY created_at DESC";
		return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
	}

	// GET ALL DATA KATEGORI PESANAN BY NAME
	public function getAllKategoriByName($name = null, $datelimit = null)
	{
		$query = "SELECT * FROM customer WHERE id_kld = $name AND created_at >= NOW() - INTERVAL $datelimit DAY";
		return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
	}

	// TOTAL PNDAPATAN
	public function getTotalPendapatan($data = null)
	{
		$query = "SELECT SUM(bayar) as total FROM customer WHERE created_at >= NOW() - INTERVAL $data DAY ORDER BY created_at ASC";
		return $this->qry($query)->fetchObject();
	}
}
