<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectEmployeeModel;
use App\Models\ProjectModel;
use App\Models\UserModel;

class ProjectController extends BaseController
{
  public function project($id)
  {
    $project_obj = new ProjectModel();
    $project = $project_obj->getProjectById($id);
    $user_obj = new UserModel();
    $customer = $user_obj->getUserById($project['customer_id']);
    $project_employee_obj = new ProjectEmployeeModel();
    $employees_ids = $project_employee_obj->getEmployeesOfProject($id); // returns ids
    $employees = $user_obj->getUsersByIds($employees_ids);

    return view('Project/index', [
      'project' => $project,
      'customer' => $customer,
      'employees' => $employees
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
    $project = $project_obj->getProjectById($id);
    $user_obj = new UserModel();
    $customer = $user_obj->getUserById($project['customer_id']);
    $customers = $user_obj->getAllCustomers();
    $project_employee_obj = new ProjectEmployeeModel();
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
      'customer_id' => $this->request->getPost('customer')
    ];

    // $MAX_EMPLOYEES = 10;
    // $inputedEmployees = [];

    // for ($i = 1; $i < $MAX_EMPLOYEES; $i++) {
    //   if ($this->request->getPost('employee' . $i) == null) {
    //     break;
    //   }

    //   array_push($inputedEmployees, $this->request->getPost('employee' . $i));
    // }

    $project_obj = new ProjectModel();
    if ($project_obj->edit($id, $project)) {
      // $project_employee_obj = new ProjectEmployeeModel();
      // if ($project_employee_obj->setEmployeeOfProject($id, $inputedEmployees)) {
      return redirect()->to('/project/' . $id);
      // }
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

    $MAX_EMPLOYEES = 5;
    $inputedEmployees = [];

    for ($i = 1; $i < $MAX_EMPLOYEES; $i++) {
      if ($this->request->getPost('employee' . $i) == null) {
        break;
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
}
