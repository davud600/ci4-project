<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
  public function login()
  {
    if ($this->request->getMethod() == 'get') {
      return view('User/login');
    }

    $user = [
      'email' => $this->request->getPost('email'),
      'password' => $this->request->getPost('password')
    ];

    $user_obj = new UserModel();
    if ($user_obj->login($user)) {
      return redirect()->to('/dashboard');
    }

    return redirect()->to('/login'); // Failed to log in
  }

  public function signup()
  {
    if ($this->request->getMethod() == 'get') {
      return view('User/signup');
    }

    if ($this->request->getPost('password') != $this->request->getPost('confirmPassword')) {
      return redirect()->to('/signup');
    }

    $user = [
      'email' => $this->request->getPost('email'),
      'name' => $this->request->getPost('username'),
      'password' => $this->request->getPost('password'),
      'role' => 0, // Customer role
      'company' => $this->request->getPost('company')
    ];

    $user_obj = new UserModel();
    if ($user_obj->signup($user)) {
      return redirect()->to('/login');
    }

    return redirect()->to('/signup'); // Failed to sign up
  }
}
