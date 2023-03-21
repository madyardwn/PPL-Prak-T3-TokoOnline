<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Auth extends Model
{
  protected $table = 'admin';

  public function validateUser($username, $password)
  {
    $password = md5($password);
    $sql = "SELECT * FROM {$this->table} WHERE username = :username: AND password = :password:";
    return $this->db->query($sql, ['username' => $username, 'password' => $password])->getRow();
  }
}
