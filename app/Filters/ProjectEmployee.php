<?php

namespace App\Filters;

use App\Models\ProjectEmployeeModel;
use App\Models\RequestModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ProjectEmployee implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $project_id = 0;

    if ($arguments) {
      // Get request from id in url
      $request_obj = new RequestModel();
      $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $uri_segments = explode('/', $uri_path);
      $request_id = $uri_segments[count($uri_segments) - 1];
      $request = $request_obj->getRequestById($request_id);
      $project_id = $request['project_id'];
    } else {
      // Get project_id from url
      $request_obj = new RequestModel();
      $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $uri_segments = explode('/', $uri_path);
      $project_id = $uri_segments[count($uri_segments) - 1];
    }

    // Get employees of project from requests project_id
    $project_employee_obj = new ProjectEmployeeModel();
    $employee_ids = $project_employee_obj->getEmployeesOfProject($project_id);

    // Check if employee_ids includes loggeduserid
    if (session()->get('logged_user')['role'] != 2) {
      if (!in_array(session()->get('logged_user')['id'], array_column($employee_ids, 'employee_id'))) {
        return redirect()->to('/profile');
      }
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
