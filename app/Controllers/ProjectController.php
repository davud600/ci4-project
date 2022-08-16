<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use App\Models\UserModel;

class ProjectController extends BaseController
{
  public function projects()
  {
    $project_obj = new ProjectModel();
    $projects = $project_obj->getAllProjects();
    return view('Project/projects', ['projects' => $projects]);
  }

  public function create()
  {
    if ($this->request->getMethod() == 'get') {
      $user_obj = new UserModel();
      $customers = $user_obj->getAllCustomers();

      return view('Project/create', ['customers' => $customers]);
    }

    $project = [
      'title' => $this->request->getPost('title'),
      'description' => $this->request->getPost('description'),
      'customer_id' => $this->request->getPost('customer'),
      'created_by' => session()->get('logged_user')['name']
    ];

    $project_obj = new ProjectModel();
    if ($project_obj->create($project)) {
      return redirect()->to('/projects');
    }

    return redirect()->to('/dashboard');
  }
}
