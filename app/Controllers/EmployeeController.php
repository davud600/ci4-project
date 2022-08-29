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
    $customer = $this->user_obj->getUserById($project['customer_id']);
    $employees_ids = $this->project_employee_obj->getEmployeesOfProject($project_id); // returns ids
    $employees = $this->user_obj->getUsersByIds($employees_ids);
    $requests_of_project = $this->request_obj->getRequestsOfProject($project['id']);
    $time_adds = $this->employee_estimated_time_obj->getProjectEmployeeTimeAdds($project_id);

    return view('Employee/project', [
      'project' => $project,
      'customer' => $customer,
      'employees' => $employees,
      'requests' => $requests_of_project,
      'time_adds' => $time_adds,
      'logged_user_data' => $logged_user_data
    ]);
  }

  public function projects()
  {
    $logged_user_data = session()->get('logged_user');
    $projects = $this->getProjectsOfEmployee($logged_user_data['id']);
    $time_adds_before = $this->employee_estimated_time_obj->getTimeAddsByEmployeeId($logged_user_data['id']);

    $time_adds = [];
    foreach ($time_adds_before as $time_add) {
      $project_of_time_add = $this->project_obj->getProjectById($time_add['project_id']);

      if (!$project_of_time_add) {
        continue;
      }

      $el = [
        'project_id' => $project_of_time_add['title'],
        'description' => $time_add['description'],
        'time_added' => $time_add['time_added'],
        'created_date' => $time_add['created_date'],
        'created_by' => $time_add['created_by'],
      ];

      array_push($time_adds, $el);
    }

    if (empty($projects)) {
      session()->setFlashdata('status', 'error');
      session()->setFlashdata('message', 'You dont currently have any projects assigned to you.');
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

    $amount_to_add = $this->getTimeFromHoursAndMinutes(
      $this->request->getPost('hours'),
      $this->request->getPost('minutes')
    );

    $this->project_obj->increaseEstimatedTime($id, $amount_to_add); // In Minutes

    $description = $this->request->getPost('description') ?
      $this->request->getPost('description') :
      null;

    if ($this->employee_estimated_time_obj->addEmployeeTime(
      $id,
      $logged_user_data['id'],
      $amount_to_add,
      $logged_user_data['name'],
      $description
    )) {
      session()->setFlashdata('status', 'success');
      session()->setFlashdata('message', 'Successfully added time to project!');
      return redirect()->to('/employee-project/' . $id);
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to add time to project!');
    return redirect()->to('/employee-project/' . $id);
  }

  private function getProjectsOfEmployee($employee_id)
  {
    $projects_of_employee = [];
    $project_ids = $this->project_employee_obj->getProjectsOfEmployee($employee_id); // Returns ids of emplyee's projects

    foreach ($project_ids as $project_id) {
      $project = $this->project_obj->getProjectById($project_id);
      if ($project) {
        array_push($projects_of_employee, $project);
      }
    }

    return $projects_of_employee;
  }

  private function getTimeFromHoursAndMinutes()
  {
    $user_hours = $this->request->getPost('hours');
    $user_minutes = $this->request->getPost('minutes');
    $user_hours = $user_hours ? $user_hours : 0;
    $user_minutes = $user_minutes ? $user_minutes : 0;

    return ($user_hours * 60) + $user_minutes;
  }
}
