<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectEmployeeModel;
use App\Models\ProjectModel;
use App\Models\RequestModel;
use App\Models\UserModel;

class CustomerController extends BaseController
{
  public function __construct()
  {
    $this->user_obj = new UserModel();
    $this->project_obj = new ProjectModel();
    $this->request_obj = new RequestModel();
    $this->project_employee_obj = new ProjectEmployeeModel();
  }

  public function project()
  {
    $logged_user_data = session()->get('logged_user');
    $project = $this->project_obj->getProjectByCustomer($logged_user_data['id']);

    if (!$project) {
      session()->setFlashdata('status', 'error');
      session()->setFlashdata('message', 'You dont currently have a project assigned to you.');
      return redirect()->to('/profile');
    }

    $employees_ids = $this->project_employee_obj->getEmployeesOfProject($project['id']); // returns ids
    $employees = $this->user_obj->getUsersByIds($employees_ids);
    $requests_of_project = $this->request_obj->getRequestsOfProject($project['id']);

    return view('Customer/project', [
      'project' => $project,
      'logged_user_data' => $logged_user_data,
      'employees' => $employees,
      'requests' => $requests_of_project
    ]);
  }
}
