<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
  protected $table = 'user';

  public function saveNewUser($newUser) {
    $this->db->table($this->table)->insert($newUser);
  }

  public function getUser($email) {
    return $this->db->table($this->table)->getWhere(['email' => $email])->getRowArray();
  }
}
