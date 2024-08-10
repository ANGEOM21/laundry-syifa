<?php

namespace App\Laundry\Models;

use App\Laundry\Core\Database;

class UniqueModel extends Database
{
  public function __construct()
  {
    parent::__construct();
  }
  // CHECK TABEL UNIQUE 
  public function check($table, $column, $value)
  {
    $sql = "SELECT $column FROM $table WHERE $column = ? ";
    return $this->qry($sql, [$value]);
  }
}
