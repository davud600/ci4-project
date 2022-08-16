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