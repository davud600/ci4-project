<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'projects';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'title',
    'description',
    'status',
    'estimated_time',
    'customer_id'
  ];

  // Dates
  protected $useTimestamps = true;
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
  protected $beforeDelete   = ['callBeforeDelete'];
  protected $afterDelete    = [];

  public function getProjectsOfCustomer($customer_id)
  {
    return $this->where('customer_id', $customer_id)
      ->findAll();
  }

  public function getProjectByCustomer($customer_id)
  {
    return $this->where('customer_id', $customer_id)
      ->first();
  }

  public function getProjectByTitle($title)
  {
    return $this->select('id')
      ->where('title', $title)
      ->first();
  }

  public function getProjectById($id)
  {
    return $this->where('id', $id)
      ->first();
  }

  public function getAllProjects()
  {
    return $this->where('status !=', 2)
      ->findAll();
  }

  public function getArchivedProjects()
  {
    return $this->where('status', 2)
      ->findAll();
  }

  public function increaseEstimatedTime($project_id, $amount_to_add)
  {
    $project_to_update = $this->where('id', $project_id)
      ->first();

    $current_estimated_time = $project_to_update['estimated_time'];
    $new_estimated_time = $current_estimated_time + $amount_to_add;

    return $this->update($project_id, [
      'estimated_time' => $new_estimated_time
    ]);
  }

  private function deleteRequests(array $data)
  {
    $request_obj = new RequestModel();

    return $request_obj->where('project_id', $data['id'])
      ->delete();
  }

  private function deleteProjectEmployees(array $data)
  {
    $project_employee_obj = new ProjectEmployeeModel();

    return $project_employee_obj->where('project_id', $data['id'])
      ->delete();
  }

  private function deleteTimeAdds(array $data)
  {
    $employee_estimated_time_obj = new EmployeeEstimatedTimeModel();

    return $employee_estimated_time_obj->where('project_id', $data['id'])
      ->delete();
  }

  public function callBeforeDelete(array $data)
  {
    $this->deleteRequests($data);
    $this->deleteProjectEmployees($data);
    $this->deleteTimeAdds($data);
  }
}
