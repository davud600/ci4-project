<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ProjectSeeder extends Seeder
{
  public function run()
  {
    $current_time = Time::parse('now', 'Europe/Bucharest');

    $data = [
      [
        'id' => 1,
        'title' => 'Project one',
        'description' => 'Description for project one',
        'status' => 0,
        'estimated_time' => 30,
        'customer_id' => 5,
        'created_date' => $current_time
      ],
      [
        'id' => 2,
        'title' => 'Project two',
        'description' => 'Description for project two',
        'status' => 1,
        'estimated_time' => 20,
        'customer_id' => 6,
        'created_date' => $current_time
      ],
      [
        'id' => 3,
        'title' => 'Project three',
        'description' => 'Description for project three',
        'status' => 2,
        'estimated_time' => 40,
        'customer_id' => 7,
        'created_date' => $current_time
      ],
    ];

    $this->db->table('projects')->insertBatch($data);
  }
}
