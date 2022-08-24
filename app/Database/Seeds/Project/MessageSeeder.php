<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class MessageSeeder extends Seeder
{
  public function run()
  {
    $current_time = Time::parse('now', 'Europe/Bucharest');

    $data = [
      [
        'id' => 1,
        'text' => 'Hello!',
        'request_id' => 1,
        'created_date' => $current_time,
        'created_by' => 6
      ],
      [
        'id' => 1,
        'text' => 'Hii!',
        'request_id' => 1,
        'created_date' => $current_time,
        'created_by' => 2
      ],
      [
        'id' => 1,
        'text' => 'We completed your request!',
        'request_id' => 1,
        'created_date' => $current_time,
        'created_by' => 3
      ],
      [
        'id' => 1,
        'text' => 'Yes, Thank You!',
        'request_id' => 1,
        'created_date' => $current_time,
        'created_by' => 6
      ],
      [
        'id' => 1,
        'text' => 'We will start working on this request!',
        'request_id' => 2,
        'created_date' => $current_time,
        'created_by' => 2
      ],
    ];

    $this->db->table('messages')->insertBatch($data);
  }
}
