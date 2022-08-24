<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestProjectSeeder extends Seeder
{
  public function run()
  {
    $this->call('ProjectSeeder');
    $this->call('ProjectEmployeeSeeder');
    $this->call('RequestSeeder');
    $this->call('MessageSeeder');
  }
}
