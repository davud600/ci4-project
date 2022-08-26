<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class ProjectModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'projects';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'title',
    'description',
    'status',
    'estimated_time',
    'customer_id',
    'created_date',
    'created_by'
  ];

  // Dates
  protected $useTimestamps = false;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  // Validation
  protected $validationRules      = [];
  protected $validationMessages   = [];
  protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert   = [];
  protected $afterInsert    = [];
  protected $beforeUpdate   = [];
  protected $afterUpdate    = [];
  protected $beforeFind     = [];
  protected $afterFind      = [];
  protected $beforeDelete   = [];
  protected $afterDelete    = [];

  public function getProjectsOfCustomer($customer_id)
  {
    return $this->where('customer_id', $customer_id)->findAll();
  }

  public function getProjectByCustomer($customer_id)
  {
    return $this->where('customer_id', $customer_id)->first();
  }

  public function getProjectByTitle($title)
  {
    return $this->select('id')->where('title', $title)->first();
  }

  public function getProjectById($id)
  {
    return $this->where('id', $id)->first();
  }

  public function getAllProjects()
  {
    return $this->where('status !=', 2)->findAll();
  }

  public function getArchivedProjects()
  {
    return $this->where('status', 2)->findAll();
  }

  public function edit($project_id, $project_data)
  {
    $this->update($project_id, $project_data);
    return true;
  }

  public function create($project_data)
  {
    $project = $project_data;
    $project['status'] = 0; // In Progress
    $project['created_date'] = Time::parse('now', 'Europe/Bucharest');

    $this->insert($project);
    return true;
  }

  public function increaseEstimatedTime($project_id, $amount_to_add)
  {
    $project_to_update = $this->where('id', $project_id)->first();
    $current_estimated_time = $project_to_update['estimated_time'];
    $new_estimated_time = $current_estimated_time + $amount_to_add;

    $this->update($project_id, ['estimated_time' => $new_estimated_time]);
  }

  public function deleteProject($id)
  {
    $employee_estimated_time_obj = new EmployeeEstimatedTimeModel();
    $project_employee_obj = new ProjectEmployeeModel();
    $request_obj = new RequestModel();

    if ($this->delete($id)) {
      if ($employee_estimated_time_obj->deleteTimeHistoryOfProject($id)) {
        if ($project_employee_obj->deleteAllOfProject($id)) {
          if ($request_obj->deleteAllOfProject($id)) {
            return true;
          }
        }
      }
    }

    return false;
  }
}
