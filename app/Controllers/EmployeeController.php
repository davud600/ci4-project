<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectEmployeeModel;
use App\Models\ProjectModel;
use App\Models\RequestModel;
use App\Models\UserModel;

class EmployeeController extends BaseController
{
  public function project($project_id)
  {
    $logged_user_data = session()->get('logged_user');

    $project_obj = new ProjectModel();
    $user_obj = new UserModel();
    $project_employee_obj = new ProjectEmployeeModel();
    $request_obj = new RequestModel();

    $project = $project_obj->getProjectById($project_id);
    $customer = $user_obj->getUserById($project['customer_id']);
    $employees_ids = $project_employee_obj->getEmployeesOfProject($project_id); // returns ids
    $employees = $user_obj->getUsersByIds($employees_ids);
    $requests_of_project = $request_obj->getRequestsOfProject($project['id']);

    return view('Employee/project', [
      'project' => $project,
      'customer' => $customer,
      'employees' => $employees,
      'requests' => $requests_of_project,
      'logged_user_data' => $logged_user_data
    ]);
  }

  public function projects()
  {
    $logged_user_data = session()->get('logged_user');
    $projects = $this->getProjectsOfEmployee($logged_user_data['id']);

    return view('Employee/projects', [
      'logged_user_data' => $logged_user_data,
      'projects' => $projects
    ]);
  }

  private function getProjectsOfEmployee($employee_id)
  {
    $project_obj = new ProjectModel();
    $project_employee_obj = new ProjectEmployeeModel();
    $projects_of_employee = [];

    $project_ids = $project_employee_obj->getProjectsOfEmployee($employee_id); // Returns ids of emplyee's projects
    foreach ($project_ids as $project_id) {
      $project = $project_obj->getProjectById($project_id);
      array_push($projects_of_employee, $project);
    }

    return $projects_of_employee;
  }
}
