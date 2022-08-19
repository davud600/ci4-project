<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectEmployeeModel;
use App\Models\ProjectModel;
use App\Models\RequestModel;
use App\Models\UserModel;

class ProjectController extends BaseController
{
  public function project($id)
  {
    $project_obj = new ProjectModel();
    $user_obj = new UserModel();
    $project_employee_obj = new ProjectEmployeeModel();
    $request_obj = new RequestModel();

    $project = $project_obj->getProjectById($id);
    $customer = $user_obj->getUserById($project['customer_id']);
    $employees_ids = $project_employee_obj->getEmployeesOfProject($id); // returns ids
    $employees = $user_obj->getUsersByIds($employees_ids);
    $requests_of_project = $request_obj->getRequestsOfProject($project['id']);

    return view('Project/index', [
      'project' => $project,
      'customer' => $customer,
      'employees' => $employees,
      'requests' => $requests_of_project
    ]);
  }

  public function projects()
  {
    $project_obj = new ProjectModel();
    $projects = $project_obj->getAllProjects();
    return view('Project/projects', ['projects' => $projects]);
  }

  public function edit($id)
  {
    $project_obj = new ProjectModel();
    $user_obj = new UserModel();
    $project_employee_obj = new ProjectEmployeeModel();
    $project = $project_obj->getProjectById($id);
    $customer = $user_obj->getUserById($project['customer_id']);
    $customers = $user_obj->getAllCustomers();
    $employees_ids = $project_employee_obj->getEmployeesOfProject($id); // returns ids
    $employees = $user_obj->getUsersByIds($employees_ids);
    $all_employees = $user_obj->getAllEmployees();

    if ($this->request->getMethod() == 'get') {
      return view('Project/edit', [
        'project' => $project,
        'customer' => $customer,
        'customers' => $customers,
        'employees' => $employees,
        'all_employees' => $all_employees
      ]);
    }

    $project = [
      'title' => $this->request->getPost('title'),
      'description' => $this->request->getPost('description'),
      'customer_id' => $this->request->getPost('customer'),
      'status' => $this->request->getPost('status') != null ? 1 : 0
    ];

    $MAX_EMPLOYEES = 100;
    $inputedEmployees = [];

    for ($i = 0; $i < $MAX_EMPLOYEES; $i++) {
      if ($this->request->getPost('employee' . $i) == null) {
        continue;
      }

      array_push($inputedEmployees, $this->request->getPost('employee' . $i));
    }

    $project_obj = new ProjectModel();
    if ($project_obj->edit($id, $project)) {
      $project_employee_obj = new ProjectEmployeeModel();
      if ($project_employee_obj->setEmployeeOfProject($id, $inputedEmployees)) {
        return redirect()->to('/project/' . $id);
      }
    }

    return redirect()->to('/dashboard');
  }

  public function create()
  {
    if ($this->request->getMethod() == 'get') {
      $user_obj = new UserModel();
      $customers = $user_obj->getAllCustomers();
      $employees = $user_obj->getAllEmployees();

      return view('Project/create', [
        'customers' => $customers,
        'employees' => $employees
      ]);
    }

    $project = [
      'title' => $this->request->getPost('title'),
      'description' => $this->request->getPost('description'),
      'customer_id' => $this->request->getPost('customer'),
      'created_by' => session()->get('logged_user')['name']
    ];

    $MAX_EMPLOYEES = 100;
    $inputedEmployees = [];

    for ($i = 0; $i < $MAX_EMPLOYEES; $i++) {
      if ($this->request->getPost('employee' . $i) == null) {
        continue;
      }

      array_push($inputedEmployees, $this->request->getPost('employee' . $i));
    }

    $project_obj = new ProjectModel();
    if ($project_obj->create($project)) {
      $project_id = $project_obj->getProjectByTitle($project['title'])['id'];

      $project_employee_obj = new ProjectEmployeeModel();
      if ($project_employee_obj->setEmployeeOfProject($project_id, $inputedEmployees)) {
        return redirect()->to('/projects');
      }
    }

    return redirect()->to('/dashboard');
  }

  public function delete($id)
  {
    $project_obj = new ProjectModel();
    $project_employee_obj = new ProjectEmployeeModel();
    if ($project_obj->delete($id)) {
      if ($project_employee_obj->deleteAllOfProject($id)) {
        return redirect()->to('/projects');
      }
    }

    return redirect()->to('/projects');
  }
}
