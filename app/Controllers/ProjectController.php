<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeEstimatedTimeModel;
use App\Models\ProjectEmployeeModel;
use App\Models\ProjectModel;
use App\Models\RequestModel;
use App\Models\UserModel;

class ProjectController extends BaseController
{
  public function __construct()
  {
    $this->user_obj = new UserModel();
    $this->project_obj = new ProjectModel();
    $this->request_obj = new RequestModel();
    $this->project_employee_obj = new ProjectEmployeeModel();
    $this->employee_estimated_time_obj = new EmployeeEstimatedTimeModel();
  }

  public function project($id)
  {
    $logged_user_data = session()->get('logged_user');
    $project = $this->project_obj->getProjectById($id);
    $customer = $this->user_obj->getUserById($project['customer_id']);
    $employees_ids = $this->project_employee_obj->getEmployeesOfProject($id); // returns ids
    $employees = $this->user_obj->getUsersByIds($employees_ids);
    $requests_of_project = $this->request_obj->getRequestsOfProject($project['id']);
    $time_adds = $this->employee_estimated_time_obj->getProjectEmployeeTimeAdds($id);

    // Get employee names from employee_ids in time_adds
    $time_adds_new = [];
    foreach ($time_adds as $time_add) {
      $el = $time_add;

      $el['employee_id'] = $this->user_obj->getUserById($el['employee_id'])['name'];

      array_push($time_adds_new, $el);
    }

    return view('Project/index', [
      'project' => $project,
      'customer' => $customer,
      'employees' => $employees,
      'requests' => $requests_of_project,
      'time_adds' => $time_adds_new,
      'logged_user_data' => $logged_user_data
    ]);
  }

  public function projects()
  {
    $logged_user_data = session()->get('logged_user');
    $projects = $this->project_obj->getAllProjects();
    $time_adds_before = $this->employee_estimated_time_obj->getAllEmployeeTimeAdds();

    $time_adds = [];
    foreach ($time_adds_before as $time_add) {
      $project_title = $this->project_obj->getProjectById($time_add['project_id']) ?
        $this->project_obj->getProjectById($time_add['project_id'])['title'] :
        'deleted project';
      $employee_of_time_add = $this->user_obj->getUserById($time_add['employee_id']);

      $el = [
        'project_id' => $project_title,
        'employee_id' => $employee_of_time_add['name'],
        'description' => $time_add['description'],
        'time_added' => $time_add['time_added'],
        'created_at' => $time_add['created_at'],
        'created_by_admin' => $time_add['created_by_admin'],
      ];

      array_push($time_adds, $el);
    }

    return view('Project/projects', [
      'projects' => $projects,
      'time_adds' => $time_adds,
      'logged_user_data' => $logged_user_data
    ]);
  }

  public function edit($id)
  {
    $logged_user_data = session()->get('logged_user');
    $project = $this->project_obj->getProjectById($id);
    $customer = $this->user_obj->getUserById($project['customer_id']);
    $customers = $this->user_obj->getAllCustomers();
    $employees_ids = $this->project_employee_obj->getEmployeesOfProject($id); // returns ids
    $employees = $this->user_obj->getUsersByIds($employees_ids);
    $all_employees = $this->user_obj->getAllEmployees();
    $estimated_time = $project['estimated_time'];

    if ($this->request->getMethod() == 'get') {
      return view('Project/edit', [
        'project' => $project,
        'customer' => $customer,
        'customers' => $customers,
        'employees' => $employees,
        'all_employees' => $all_employees,
        'estimated_hours' => floor($estimated_time / 60),
        'estimated_minutes' => $estimated_time % 60,
        'logged_user_data' => $logged_user_data
      ]);
    }

    $estimated_time = $this->getTimeFromHoursAndMinutes(
      $this->request->getPost('hours'),
      $this->request->getPost('minutes')
    );
    $inputedEmployees = $this->getInputtedEmployees(
      $this->request
    );
    $project = [
      'title' => $this->request->getPost('title'),
      'description' => $this->request->getPost('description'),
      'customer_id' => $this->request->getPost('customer'),
      'estimated_time' => $estimated_time,
      'status' => $this->request->getPost('status') != 0 ? 1 : 0
    ];

    if ($this->project_obj->update($id, $project)) {
      if ($this->employee_estimated_time_obj->initEstimatedTime([
        'project_id' => $id,
        'employee_id' => $logged_user_data['id'],
        'time_added' => $estimated_time
      ])) {
        if ($this->project_employee_obj->setEmployeeOfProject($id, $inputedEmployees)) {
          session()->setFlashdata('status', 'success');
          session()->setFlashdata('message', 'Successfully updated project data!');
          return redirect()->to('/project/' . $id);
        }
      }
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to update project data!');
    return redirect()->to('/project/' . $id);
  }

  public function create()
  {
    $logged_user_data = session()->get('logged_user');
    if ($this->request->getMethod() == 'get') {
      $customers = $this->user_obj->getAllCustomers();
      $employees = $this->user_obj->getAllEmployees();

      return view('Project/create', [
        'customers' => $customers,
        'employees' => $employees,
        'logged_user_data' => $logged_user_data
      ]);
    }

    $estimated_time = $this->getTimeFromHoursAndMinutes(
      $this->request->getPost('hours'),
      $this->request->getPost('minutes')
    );
    $inputedEmployees = $this->getInputtedEmployees(
      $this->request
    );
    $project = [
      'title' => $this->request->getPost('title'),
      'description' => $this->request->getPost('description'),
      'customer_id' => $this->request->getPost('customer'),
      'estimated_time' => $estimated_time,
      // 'status' => 0
    ];

    if ($this->project_obj->insert($project)) {
      $project_id = $this->project_obj->getProjectByTitle($project['title'])['id'];

      if ($this->employee_estimated_time_obj->initEstimatedTime([
        'project_id' => $project_id,
        'employee_id' => $logged_user_data['id'],
        'time_added' => $estimated_time
      ])) {
        if ($this->project_employee_obj->setEmployeeOfProject($project_id, $inputedEmployees)) {
          session()->setFlashdata('status', 'success');
          session()->setFlashdata('message', 'Successfully created project!');
          return redirect()->to('/projects');
        }
      }
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to create project!');
    return redirect()->to('/projects');
  }

  public function delete($id)
  {
    if ($this->project_obj->delete($id)) {
      session()->setFlashdata('status', 'success');
      session()->setFlashdata('message', 'Successfully deleted project!');
      return redirect()->to('/projects');
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to delete project!');
    return redirect()->to('/projects');
  }

  public function archive($id)
  {
    if ($this->project_obj->update($id, [
      'status' => 2
    ])) {
      session()->setFlashdata('status', 'success');
      session()->setFlashdata('message', 'Successfully archived project!');
      return redirect()->to('/projects');
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to archive project!');
    return redirect()->to('/projects');
  }

  public function unArchive($id)
  {
    if ($this->project_obj->update($id, [
      'status' => 1
    ])) {
      session()->setFlashdata('status', 'success');
      session()->setFlashdata('message', 'Successfully unarchived project!');
      return redirect()->to('/archived-projects');
    }

    session()->setFlashdata('status', 'error');
    session()->setFlashdata('message', 'Error trying to unarchive project!');
    return redirect()->to('/archived-projects');
  }

  public function archivedProjects()
  {
    $logged_user_data = session()->get('logged_user');
    $projects = $this->project_obj->getArchivedProjects();

    return view('Project/archived', [
      'logged_user_data' => $logged_user_data,
      'projects' => $projects
    ]);
  }

  private function getTimeFromHoursAndMinutes()
  {
    $user_hours = $this->request->getPost('hours');
    $user_minutes = $this->request->getPost('minutes');
    $user_hours = $user_hours ? $user_hours : 0;
    $user_minutes = $user_minutes ? $user_minutes : 0;
    return ($user_hours * 60) + $user_minutes;
  }

  private function getInputtedEmployees($request)
  {
    $MAX_EMPLOYEES = 100;
    $inputedEmployees = [];
    for ($i = 0; $i < $MAX_EMPLOYEES; $i++) {
      if ($request->getPost('employee' . $i) == null) {
        continue;
      }

      if (in_array($request->getPost('employee' . $i), $inputedEmployees)) {
        continue;
      }

      array_push($inputedEmployees, $request->getPost('employee' . $i));
    }

    return $inputedEmployees;
  }
}
