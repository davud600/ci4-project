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
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'title',
    'description',
    'status',
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

  public function getProjectByTitle($title)
  {
    return $this->select('id')->where('title', $title)->first();
  }

  public function getProjectById($id)
  {
    return $this->select('id, title, description, status, customer_id')->where('id', $id)->first();
  }

  public function getAllProjects()
  {
    return $this->select('id, title, description, status')->findAll();
  }

  public function edit($project_id, $project_data)
  {
    $project = $project_data;
    $project['status'] = 0; // In Progress
    $project['created_date'] = date('l jS \of F Y h:i:s A');

    return $project;

    $this->update($project_id, $project);
    return true;
  }

  public function create($project_data)
  {
    $project = $project_data;
    $project['status'] = 0; // In Progress
    $project['created_date'] = date('l jS \of F Y h:i:s A');

    $this->insert($project);
    return true;
  }
}
