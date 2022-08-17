<?php

namespace App\Models;

use App\Libraries\Hash;
use CodeIgniter\Model;

class UserModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'users';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'email',
    'name',
    'password',
    'role',
    'company',
    'created_date',
    'created_by',
    'updated_date',
    'updated_by'
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

  public function getUsersByIds($user_ids)
  {
    $users = [];
    foreach ($user_ids as $user_id) {
      $user = $this->select('id, name')->where('id', $user_id)->first();
      array_push($users, $user);
    }

    return $users;
  }

  public function getAllCustomers()
  {
    return $this->select('id, name')->where('role', 0)->findAll();
  }

  public function getAllEmployees()
  {
    return $this->select('id, name')->where('role', 1)->findAll();
  }

  public function getUserById($id)
  {
    return $this->select('id, name')->where('id', $id)->first();
  }

  public function findUserByEmail($user_email)
  {
    $db_user = $this->where('email', $user_email)->first();
    $user_data = [
      'id' => $db_user['id'],
      'email' => $db_user['email'],
      'name' => $db_user['name'],
      'role' => $db_user['role'],
      'company' => $db_user['company']
    ];

    return $user_data;
  }

  public function login($user_data)
  {
    // Find user in db
    $user = $this->where('email', $user_data['email'])->first();
    if (!$user) {
      return false; // Incorrect email
    }

    // Check passwords
    return Hash::check($user_data['password'], $user['password']);
  }

  public function signup($user_data)
  {
    $user = $user_data;
    $user['password'] = Hash::make($user_data['password']);
    $user['created_date'] = date('l jS \of F Y h:i:s A');

    $this->insert($user);
    return true;
  }
}
