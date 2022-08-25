<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeEstimatedTimeModel;
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

    $project_obj = new ProjectModel();
    $employee_estimated_time_obj = new EmployeeEstimatedTimeModel();

    $projects = $this->getProjectsOfEmployee($logged_user_data['id']);
    $time_adds_before = $employee_estimated_time_obj->getTimeAddsByEmployeeId($logged_user_data['id']);
    $time_adds = [];

    foreach ($time_adds_before as $time_add) {
      $el = [
        'project_id' => $project_obj->getProjectById($time_add['project_id'])['title'],
        'time_added' => $time_add['time_added'],
        'created_date' => $time_add['created_date'],
        'created_by' => $time_add['created_by'],
      ];

      array_push($time_adds, $el);
    }

    if (!$projects) {
      return redirect()->to('/profile');
    }

    return view('Employee/projects', [
      'logged_user_data' => $logged_user_data,
      'projects' => $projects,
      'time_adds' => $time_adds
    ]);
  }

  public function changeEstimatedTime($id)
  {
    $logged_user_data = session()->get('logged_user');

    $project_obj = new ProjectModel();
    $employee_estimated_time_obj = new EmployeeEstimatedTimeModel();

    $user_hours = $this->request->getPost('hours');
    $user_minutes = $this->request->getPost('minutes');

    $user_hours = $user_hours ? $user_hours : 0;
    $user_minutes = $user_minutes ? $user_minutes : 0;

    $amount_to_add = ($user_hours * 60) + $user_minutes;

    $project_obj->increaseEstimatedTime($id, $amount_to_add); // In Minutes
    $employee_estimated_time_obj->addEmployeeTime($id, $logged_user_data['id'], $amount_to_add, $logged_user_data['name']);

    return redirect()->to('/employee-project/' . $id);
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
