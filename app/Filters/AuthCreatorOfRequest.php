<?php

namespace App\Filters;

use App\Models\RequestModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthCreatorOfRequest implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Check if logged user has premission or has created the request

    // Get request_id
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $request_id = $uri_segments[count($uri_segments) - 1];

    // Get request by id
    $request_obj = new RequestModel();
    $req = $request_obj->getRequestById($request_id);

    if (session()->get('logged_user')['role'] == 0) {
      if (session()->get('logged_user')['id'] != $req['created_by']) {
        return redirect()->to('/customer-project');
      }
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
