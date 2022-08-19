<?php

namespace App\Filters;

use App\Models\RequestModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthCustomer implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Get request_id
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    if (count($uri_segments) > 2) {
      $request_obj = new RequestModel();
      $req = $request_obj->getRequestById($uri_segments[2]);

      // Check if customer is creator of request
      if (session()->get('logged_user')['role'] == 0) {
        if (session()->get('logged_user')['id'] != $req['created_by']) {
          return redirect()->to('/profile');
        }
      }
    }

    // If not a customer just give access
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
