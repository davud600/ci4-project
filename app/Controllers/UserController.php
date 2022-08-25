<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use App\Models\UserModel;

class UserController extends BaseController
{
  public function __construct()
  {
    $this->user_obj = new UserModel();
    $this->project_obj = new ProjectModel();
  }

  public function profile()
  {
    $logged_user_data = session()->get('logged_user');
    $customer_has_project = $this->project_obj->getProjectByCustomer($logged_user_data['id']) != null;

    return view('User/index', [
      'logged_user_data' => $logged_user_data,
      'customer_has_project' => $customer_has_project
    ]);
  }

  public function dashboard()
  {
    $logged_user_data = session()->get('logged_user');

    return view('Dashboard/index', [
      'logged_user_data' => $logged_user_data
    ]);
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

    if ($this->user_obj->login($user)) {
      $logged_user_data = $this->user_obj->findUserByEmail($user['email']);
      session()->set([
        'logged_user' => $logged_user_data
      ]);

      return redirect()->to('/profile');
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to log in!');
    return redirect()->to('/login'); // Failed to log in
  }

  public function signup()
  {
    if ($this->request->getMethod() == 'get') {
      return view('User/signup');
    }

    if ($this->request->getPost('password') != $this->request->getPost('confirmPassword')) {
      session()->setFlashdata('status', 'error');
      session()->setFlashdata('message', 'Your passwords do not match!');
      return redirect()->to('/signup');
    }

    $user = [
      'email' => $this->request->getPost('email'),
      'name' => $this->request->getPost('username'),
      'password' => $this->request->getPost('password'),
      'role' => 0, // Customer role
      'company' => $this->request->getPost('company')
    ];

    if ($this->user_obj->signup($user)) {
      return redirect()->to('/login');
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to create an account!');
    return redirect()->to('/signup'); // Failed to sign up
  }
}
