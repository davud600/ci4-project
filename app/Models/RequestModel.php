<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class RequestModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'requests';
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
    'project_id',
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

  public function approveRequest($id)
  {
    $this->update($id, ['status' => 1]);
    return true;
  }

  public function getRequestById($id)
  {
    return $this->where('id', $id)->first();
  }

  public function getRequestsOfProject($project_id)
  {
    return $this->where('project_id', $project_id)->findAll();
  }

  public function createRequest($request_data)
  {
    $request = [
      'title' => $request_data['title'],
      'description' => $request_data['description'],
      'status' => $request_data['status'],
      'project_id' => $request_data['project_id'],
      'created_date' => Time::parse('now', 'Europe/Bucharest'),
      'created_by' => $request_data['created_by']
    ];

    $this->insert($request);
    return true;
  }
}
