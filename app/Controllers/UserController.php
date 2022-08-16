<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
  public function profile()
  {
    $logged_user_data = session()->get('logged_user');
    return view('User/index', ['logged_user_data' => $logged_user_data]);
  }

  public function dashboard()
  {
    $logged_user_data = session()->get('logged_user');
    return view('Dashboard/index', ['logged_user_data' => $logged_user_data]);
  }

  public function login()
  {
    session()->remove('logged_user');

    if ($this->request->getMethod() == 'get') {
      return view('User/login');
    }

    $user = [
      'email' => $this->request->getPost('email'),
      'password' => $this->request->getPost('password')
    ];

    $user_obj = new UserModel();
    if ($user_obj->login($user)) {
      $logged_user_data = $user_obj->findUserByEmail($user['email']);
      session()->set([
        'logged_user' => $logged_user_data
      ]);
      return redirect()->to('/profile');
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
