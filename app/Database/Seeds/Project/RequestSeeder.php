<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RequestSeeder extends Seeder
{
  public function run()
  {
    $current_time = Time::parse('now', 'Europe/Bucharest');

    $data = [
      [
        'id' => 1,
        'title' => 'Request one',
        'description' => 'Description for request one',
        'status' => 1,
        'project_id' => 1,
        'created_date' => $current_time
      ],
      [
        'id' => 2,
        'title' => 'Second request',
        'description' => 'Description for the second request of this project',
        'status' => 0,
        'project_id' => 1,
        'created_date' => $current_time
      ],
      [
        'id' => 3,
        'title' => 'Request two',
        'description' => 'Description for request two',
        'status' => 1,
        'project_id' => 2,
        'created_date' => $current_time
      ],
      [
        'id' => 4,
        'title' => 'Request three',
        'description' => 'Description for request three',
        'status' => 0,
        'project_id' => 3,
        'created_date' => $current_time
      ]
    ];

    $this->db->table('requests')->insertBatch($data);
  }
}
