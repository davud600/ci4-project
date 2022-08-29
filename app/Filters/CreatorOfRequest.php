<?php

namespace App\Filters;

use App\Models\ProjectModel;
use App\Models\RequestModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CreatorOfRequest implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Check if logged user has premission or has created the request

    // Get request_id
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $request_id = $uri_segments[count($uri_segments) - 1];

    if (session()->get('logged_user')['role'] == 0) {
      $project_obj = new ProjectModel();
      $request_obj = new RequestModel();

      $req = $request_obj->getRequestById($request_id);
      $creator_of_request_id = $project_obj->getProjectById($req['project_id'])['customer_id'];
      if (session()->get('logged_user')['id'] != $creator_of_request_id) {
        return redirect()->to('/profile');
      }
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
