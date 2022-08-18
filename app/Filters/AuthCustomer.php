<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthCustomer implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Customer auth
    if (session()->get('logged_user')['role'] > 0) {
      return redirect()->to('/profile');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
