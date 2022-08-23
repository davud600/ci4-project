<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Admin implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Admin auth
    if (session()->get('logged_user')['role'] < 2) {
      return redirect()->to('/profile');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
