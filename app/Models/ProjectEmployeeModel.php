<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectEmployeeModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'project_employees';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'project_id',
    'employee_id',
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

  public function getEmployeesOfProject($project_id)
  {
    return $this->select('employee_id')->where('project_id', $project_id)->findAll();
  }

  public function setEmployeeOfProject($project_id, $employee_ids)
  {
    // del all initial employees if thers any
    $this->deleteAllOfProject($project_id);

    $project_employees = [];
    foreach ($employee_ids as $employee_id) {
      array_push($project_employees, [
        'project_id' => $project_id,
        'employee_id' => $employee_id,
        'created_date' => date('l jS \of F Y h:i:s A')
      ]);
    }

    $this->insertBatch($project_employees);
    return true;
  }

  public function deleteAllOfProject($project_id)
  {
    $this->where('project_id', $project_id)->delete();
    return true;
  }
}
