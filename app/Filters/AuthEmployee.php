<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthEmployee implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Employee auth
    if (session()->get('logged_user')['role'] != 1) {
      return redirect()->to('/profile');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
