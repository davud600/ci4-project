<?php

namespace App\Filters;

use App\Models\ProjectEmployeeModel;
use App\Models\ProjectModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthProjectEmployee implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Get project_id
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $project_id = $uri_segments[count($uri_segments) - 1];

    // Get employees of project
    $project_employee_obj = new ProjectEmployeeModel();
    $employee_ids = $project_employee_obj->getEmployeesOfProject($project_id);

    // Check if employee_ids includes loggeduserid
    if (!in_array(session()->get('logged_user')['id'], array_column($employee_ids, 'employee_id'))) {
      return redirect()->to('/profile');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
