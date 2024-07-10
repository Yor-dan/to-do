<?php

namespace App\Models;

use CodeIgniter\Model;

class Task extends Model
{
  protected $table = 'task';

  public function insertTask($task)
  {
    $this->db->table($this->table)->insert($task);
  }

  public function getTasks($email)
  {
    return $this->db->table($this->table)
      ->where('user_email', $email)
      ->orderBy('is_done', 'des')
      ->orderBy('deadline', 'asc')
      ->get()
      ->getResultArray();
  }

  public function deleteTask($id)
  {
    $this->db->table($this->table)->delete(['id' => $id]);
  }

  public function doneTask($id, $isDone)
  {
    $this->db->table($this->table)
      ->where('id', $id)
      ->set(['is_done' => $isDone])
      ->update();
  }

  public function updateTask($id, $task)
  {
    $this->db->table($this->table)
      ->where('id', $id)
      ->set(['task' => $task])
      ->update();
  }

  public function getIsDoneTasks($email, $isDone)
  {
    return $this->db->table($this->table)
      ->where('user_email', $email)
      ->where('is_done', $isDone)
      ->orderBy('deadline', 'asc')
      ->get()
      ->getResultArray();
  }
}
