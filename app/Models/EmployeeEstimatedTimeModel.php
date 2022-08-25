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
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'employee_id',
    'project_id',
    'time_added',
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

  public function deleteTimeHistoryOfProject($project_id)
  {
    $this->where('project_id', $project_id)->delete();
    return true;
  }

  public function initEstimatedTime($project_id, $admin_id, $time_added)
  {
    $timeChangeByAdmin = $this->where('project_id', $project_id)->where('created_by', 'admin');
    if ($timeChangeByAdmin) {
      $timeChangeByAdmin->delete();
    }

    $data = [
      'employee_id' => $admin_id,
      'project_id' => $project_id,
      'time_added' => $time_added,
      'created_date' => Time::parse('now', 'Europe/Bucharest'),
      'created_by' => 'admin'
    ];

    $this->insert($data);
    return true;
  }

  public function addEmployeeTime($project_id, $employee_id, $time_added)
  {
    $data = [
      'employee_id' => $employee_id,
      'project_id' => $project_id,
      'time_added' => $time_added,
      'created_date' => Time::parse('now', 'Europe/Bucharest')
    ];

    $this->insert($data);
    return true;
  }
}
