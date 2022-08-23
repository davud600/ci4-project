<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectEmployeeModel;
use App\Models\ProjectModel;
use App\Models\RequestModel;
use App\Models\UserModel;

class CustomerController extends BaseController
{
  public function project()
  {
    $logged_user_data = session()->get('logged_user');

    $project_obj = new ProjectModel();
    $user_obj = new UserModel();
    $project_employee_obj = new ProjectEmployeeModel();
    $request_obj = new RequestModel();

    $project = $project_obj->getProjectByCustomer($logged_user_data['id']);

    if (!$project) {
      return redirect()->to('/profile');
    }

    $employees_ids = $project_employee_obj->getEmployeesOfProject($project['id']); // returns ids
    $employees = $user_obj->getUsersByIds($employees_ids);
    $requests_of_project = $request_obj->getRequestsOfProject($project['id']);

    return view('Customer/project', [
      'project' => $project,
      'logged_user_data' => $logged_user_data,
      'employees' => $employees,
      'requests' => $requests_of_project
    ]);
  }
}
