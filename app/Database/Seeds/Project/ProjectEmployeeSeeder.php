<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ProjectEmployeeSeeder extends Seeder
{
  public function run()
  {
    $current_time = Time::parse('now', 'Europe/Bucharest');

    $data = [
      [
        'id' => 1,
        'project_id' => 1,
        'employee_id' => 2,
        'created_date' => $current_time
      ],
      [
        'id' => 2,
        'project_id' => 1,
        'employee_id' => 3,
        'created_date' => $current_time
      ],
      [
        'id' => 3,
        'project_id' => 2,
        'employee_id' => 4,
        'created_date' => $current_time
      ],
      [
        'id' => 4,
        'project_id' => 3,
        'employee_id' => 5,
        'created_date' => $current_time
      ],
    ];

    $this->db->table('project_employees')->insertBatch($data);
  }
}
