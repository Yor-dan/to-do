<?php

namespace App\Controllers;

class Auth extends BaseController
{
  public function signInForm()
  {
    $data['title'] = 'Sign In';
    return view('partials/header', $data) .
      view('sign_in') .
      view('partials/footer');
  }

  public function signUpForm()
  {
    $data['title'] = 'Sign Up';
    return view('partials/header', $data) .
      view('sign_up') .
      view('partials/footer');
  }

  public function signUserIn()
  {
    $requestData = [
      'email' => $this->request->getPost('email'),
      'password' => $this->request->getPost('password'),
    ];

    if (!$this->validation->run($requestData, 'signIn')) {
      return redirect()->back()->withInput();
    }

    $user = $this->User->getUser($requestData['email']);

    if (!$user) {
      $this->session->setFlashdata('message', 'Email is not registered!');
      return redirect()->back()->withInput();
    }

    if (!password_verify((string)$requestData['password'], $user['password'])) {
      $this->session->setFlashdata('message', 'Password is incorrect!');
      return redirect()->back()->withInput();
    }

    $this->session->set('email', $user['email']);
    return redirect()->to('/main');
  }

  public function signUserUp()
  {
    $requestData = [
      'email' => $this->request->getPost('email'),
      'password' => $this->request->getPost('password'),
      'password-confirmation' => $this->request->getPost('password-confirmation'),
    ];

    if (!$this->validation->run($requestData, 'signUp')) {
      return redirect()->back()->withInput();
    }

    $this->User->saveNewUser([
      'id' => uniqid(),
      'email' => $requestData['email'],
      'password' => password_hash((string)$requestData['password'], PASSWORD_DEFAULT),
    ]);

    $this->session->set('email', $requestData['email']);
    return redirect()->to('/');
  }

  public function signOut()
  {
    $this->session->remove('email');
    return redirect()->to('/');
  }
}
