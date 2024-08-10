<?php

namespace App\Laundry\Models;

use App\Laundry\Core\Database;
use PDO;
// MODEL KATEGORI
class KategoriModel extends Database
{
	// DEKLARASI VARIABEL VISIBILTY TABEL KATEGORI
	private $tabelKategori = 'tbl_kategori_ld';
	// DEKLARASI VARIABEL COLUMN TABEL KATEGORI
	private $column = [
		'id_kld',
		'kode_kategori',
		'nama_kategori',
		'harga_satuan',
	];
	// CONSTRUCTOR MODELS KATEGORI
	public function __construct()
	{
		// TURUNANA CONSTRUCTOR DATABASE
		parent::__construct();
		// SETTER TABLE KATEGORI AND COLUMN
		$this->setTableName($this->tabelKategori);
		$this->setColumn($this->column);
	}
	// GET ALL DATA KATEGORI MODELS
	public function getAll()
	{
		return $this->get()->fetchAll(PDO::FETCH_ASSOC);
	}
}
