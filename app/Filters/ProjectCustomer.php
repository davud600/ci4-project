<?php

namespace App\Filters;

use App\Models\ProjectModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ProjectCustomer implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // find project from db
    $project_obj = new ProjectModel();
    $project_customer_id = $project_obj->getProjectById($_GET['project_id'])['customer_id'];

    // Check if project's customer_id matches logged_user_id
    if (session()->get('logged_user')['id'] != $project_customer_id) {
      return redirect()->to('/profile');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
