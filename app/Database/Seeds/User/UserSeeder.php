<?php

namespace App\Database\Seeds\User;

use App\Libraries\Hash;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
  public function run()
  {
    $current_time = Time::parse('now', 'Europe/Bucharest');

    $data = [
      [
        'email' => 'admin@gmail.com',
        'name' => 'admin',
        'password' => Hash::make('chkdsk34'),
        'role' => 2,
        'company' => 'company',
        'created_at' => $current_time,
        'updated_at' => $current_time
      ],
      [
        'email' => 'employee@gmail.com',
        'name' => 'employee 1 1',
        'password' => Hash::make('chkdsk34'),
        'role' => 1,
        'company' => 'company',
        'created_at' => $current_time,
        'updated_at' => $current_time
      ],
      [
        'email' => 'employee@gmail.com',
        'name' => 'employee 1 2',
        'password' => Hash::make('chkdsk34'),
        'role' => 1,
        'company' => 'company',
        'created_at' => $current_time,
        'updated_at' => $current_time
      ],
      [
        'email' => 'employee2@gmail.com',
        'name' => 'employee 2 1',
        'password' => Hash::make('chkdsk34'),
        'role' => 1,
        'company' => 'company',
        'created_at' => $current_time,
        'updated_at' => $current_time
      ],
      [
        'email' => 'employee3@gmail.com',
        'name' => 'employee 3 1',
        'password' => Hash::make('chkdsk34'),
        'role' => 1,
        'company' => 'company',
        'created_at' => $current_time,
        'updated_at' => $current_time
      ],
      [
        'email' => 'customer@gmail.com',
        'name' => 'customer 1',
        'password' => Hash::make('chkdsk34'),
        'role' => 0,
        'company' => 'company 1',
        'created_at' => $current_time,
        'updated_at' => $current_time
      ],
      [
        'email' => 'customer2@gmail.com',
        'name' => 'customer 2',
        'password' => Hash::make('chkdsk34'),
        'role' => 0,
        'company' => 'company 2',
        'created_at' => $current_time,
        'updated_at' => $current_time
      ],
      [
        'email' => 'customer3@gmail.com',
        'name' => 'customer 3',
        'password' => Hash::make('chkdsk34'),
        'role' => 0,
        'company' => 'company 3',
        'created_at' => $current_time,
        'updated_at' => $current_time
      ],
      [
        'email' => 'd@gmail.com',
        'name' => 'd',
        'password' => Hash::make('chkdsk34'),
        'role' => 2,
        'company' => 'company',
        'created_at' => $current_time,
        'updated_at' => $current_time
      ]
    ];

    $this->db->table('users')->insertBatch($data);
  }
}
