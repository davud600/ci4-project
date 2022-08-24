<?php

namespace App\Database\Seeds;

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
        'id' => 1,
        'email' => 'admin@gmail.com',
        'name' => 'admin',
        'password' => Hash::make('chkdsk34'),
        'role' => 2,
        'company' => 'company',
        'created_date' => $current_time
      ],
      [
        'id' => 2,
        'email' => 'employee@gmail.com',
        'name' => 'employee 1 1',
        'password' => Hash::make('chkdsk34'),
        'role' => 1,
        'company' => 'company',
        'created_date' => $current_time
      ],
      [
        'id' => 3,
        'email' => 'employee@gmail.com',
        'name' => 'employee 1 2',
        'password' => Hash::make('chkdsk34'),
        'role' => 1,
        'company' => 'company',
        'created_date' => $current_time
      ],
      [
        'id' => 4,
        'email' => 'employee2@gmail.com',
        'name' => 'employee 2 1',
        'password' => Hash::make('chkdsk34'),
        'role' => 1,
        'company' => 'company',
        'created_date' => $current_time
      ],
      [
        'id' => 5,
        'email' => 'employee3@gmail.com',
        'name' => 'employee 3 1',
        'password' => Hash::make('chkdsk34'),
        'role' => 1,
        'company' => 'company',
        'created_date' => $current_time
      ],
      [
        'id' => 6,
        'email' => 'customer@gmail.com',
        'name' => 'customer 1',
        'password' => Hash::make('chkdsk34'),
        'role' => 0,
        'company' => 'company 1',
        'created_date' => $current_time
      ],
      [
        'id' => 7,
        'email' => 'customer2@gmail.com',
        'name' => 'customer 2',
        'password' => Hash::make('chkdsk34'),
        'role' => 0,
        'company' => 'company 2',
        'created_date' => $current_time
      ],
      [
        'id' => 8,
        'email' => 'customer3@gmail.com',
        'name' => 'customer 3',
        'password' => Hash::make('chkdsk34'),
        'role' => 0,
        'company' => 'company 3',
        'created_date' => $current_time
      ]
    ];

    $this->db->table('users')->insertBatch($data);
  }
}
