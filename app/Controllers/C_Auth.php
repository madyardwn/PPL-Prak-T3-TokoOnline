<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Auth extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Login',
    ];
    return view('auth/v_index', $data);
  }

  public function login()
  {
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    if ($username == null || $password == null) {
      session()->setFlashdata('pesan', 'username atau password tidak boleh kosong');
      return redirect()->to('/login');
    }

    $auth = new \App\Models\M_Auth();
    $user = $auth->validateUser($username, $password);

    if ($user) {
      $this->setUserSession($user);
      return redirect()->to('/barang');
    } else {
      session()->setFlashdata('pesan', 'username atau password salah');
      return redirect()->to('/login');
    }
  }

  private function setUserSession($user)
  {
    $data = [
      'username' => $user->username,
      'loggedIn' => true,
    ];
    session()->set($data);
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to('/login');
  }
}
