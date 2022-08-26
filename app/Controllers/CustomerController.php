<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeEstimatedTimeModel;
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
    $this->employee_estimated_time_obj = new EmployeeEstimatedTimeModel();
  }

  public function project($project_id)
  {
    $logged_user_data = session()->get('logged_user');
    $project = $this->project_obj->getProjectById($project_id);

    if (!$project) {
      session()->setFlashdata('status', 'error');
      session()->setFlashdata('message', 'You dont currently have a project assigned to you.');
      return redirect()->to('/profile');
    }

    $employees_ids = $this->project_employee_obj->getEmployeesOfProject($project_id); // returns ids
    $employees = $this->user_obj->getUsersByIds($employees_ids);
    $requests_of_project = $this->request_obj->getRequestsOfProject($project_id);
    $time_adds = $this->employee_estimated_time_obj->getProjectEmployeeTimeAdds($project_id);

    return view('Customer/project', [
      'project' => $project,
      'logged_user_data' => $logged_user_data,
      'employees' => $employees,
      'time_adds' => $time_adds,
      'requests' => $requests_of_project
    ]);
  }

  public function projects()
  {
    $logged_user_data = session()->get('logged_user');
    $projects = $this->project_obj->getProjectsOfCustomer($logged_user_data['id']);

    if (!$projects) {
      session()->setFlashdata('status', 'error');
      session()->setFlashdata('message', 'You dont currently have any projects assigned to you.');
      return redirect()->to('/profile');
    }

    return view('Customer/projects', [
      'logged_user_data' => $logged_user_data,
      'projects' => $projects
    ]);
  }
}
