<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class EmployeeEstimatedTimeModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'employee_estimated_times';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'description',
    'time_added',
    'employee_id',
    'project_id',
    'created_by_admin'
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
  protected $beforeDelete   = [];
  protected $afterDelete    = [];

  public function getTimeAddsByEmployeeId($employee_id)
  {
    return $this->where('employee_id', $employee_id)
      ->findAll();
  }

  public function getAllEmployeeTimeAdds()
  {
    return $this->where('created_by_admin', 0)
      ->findAll();
  }

  public function getProjectEmployeeTimeAdds($project_id)
  {
    return $this->where('project_id', $project_id)
      ->findAll();
  }

  public function deleteTimeHistoryOfProject($project_id)
  {
    return $this->where('project_id', $project_id)
      ->delete();
  }

  public function initEstimatedTime($data)
  {
    $data['created_by_admin'] = 1;
    $timeChangeByAdmin = $this->where('project_id', $data['project_id'])
      ->where('created_by_admin', 1)
      ->first();

    if ($timeChangeByAdmin) {
      return $this->update($timeChangeByAdmin['id'], $data);
    }

    return $this->insert($data);
  }

  public function addEmployeeTime($data)
  {
    if ($data['time_added'] == 0) {
      return false;
    }

    return $this->insert($data);
  }
}
