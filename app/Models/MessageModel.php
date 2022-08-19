<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class MessageModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'messages';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'text',
    'attach',
    'request_id',
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

  public function getMessagesOfRequest($request_id)
  {
    return $this->where('request_id', $request_id)->findAll();
  }

  public function createMessage($message_data)
  {
    $message = [
      'text' => $message_data['text'],
      // 'attach' => $message_data['attach'],
      'request_id' => $message_data['request_id'],
      'created_date' => Time::parse('now', 'Europe/Bucharest'),
      'created_by' => $message_data['created_by']
    ];

    $this->insert($message);
    return true;
  }
}
