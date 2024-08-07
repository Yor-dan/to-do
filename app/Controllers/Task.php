<?php

namespace App\Controllers;

class Task extends BaseController
{
  public function main()
  {
    $data['title'] = 'To-do';

    return view('partials/header', $data) .
      view('partials/sidebar') .
      view('task') .
      view('partials/footer');
  }

  public function getTasks()
  {
    $tasks = $this->Task->getTasks($this->session->get('email'));
    foreach ($tasks as &$task) {
      if (!$task['deadline']) {
        $task['deadline'] = '';
      } else {
        $task['deadline'] = date('j F Y', strtotime($task['deadline']));
      }
    }
    return $this->response->setJSON($tasks);
  }

  public function insertTask()
  {
    $task = [
      'id' => uniqid(),
      'task' => $this->request->getVar('task'),
      'is_done' => 0,
      'user_email' => $this->session->get('email'),
    ];

    if ($this->request->getVar('deadline')) {
      $task['deadline'] = date('Y-m-d', strtotime($this->request->getVar('deadline')));
    } else {
      $task['deadline'] = null;
    }

    $this->Task->insertTask($task);
    return $this->response->setJSON($task);
  }

  public function deleteTask($id)
  {
    $this->Task->deleteTask($id);
  }

  public function doneTask($id)
  {
    $isDone = $this->request->getVar('isDone');
    $isDone = ($isDone == true) ? 1 : 0;
    $this->Task->doneTask($id, $isDone);
  }

  public function updateTask($id)
  {
    $task = $this->request->getVar('task');
    $this->Task->updateTask($id, $task);
  }

  public function getIsDoneTasks($isDone)
  {
    $tasks = $this->Task->getIsDoneTasks($this->session->get('email'), $isDone);
    foreach ($tasks as &$task) {
      if (!$task['deadline']) {
        $task['deadline'] = '';
      } else {
        $task['deadline'] = date('j F Y', strtotime($task['deadline']));
      }
    }
    return $this->response->setJSON($tasks);
  }
}
