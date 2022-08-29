<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'requests';
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
    'project_id'
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

  public function getRequestById($id)
  {
    return $this->where('id', $id)
      ->first();
  }

  public function getRequestsOfProject($project_id)
  {
    return $this->where('project_id', $project_id)
      ->findAll();
  }

  public function approveRequest($id)
  {
    return $this->update(
      $id,
      ['status' => 1]
    );
  }

  public function cancelRequest($id)
  {
    return $this->update(
      $id,
      ['status' => 0]
    );
  }

  private function deleteMessages(array $data)
  {
    $message_obj = new MessageModel();

    return $message_obj->where('request_id', $data['id'])
      ->delete();
  }

  public function callBeforeDelete(array $data)
  {
    $this->deleteMessages($data);
  }
}
