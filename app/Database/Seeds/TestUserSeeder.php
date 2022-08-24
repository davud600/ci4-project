<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestUserSeeder extends Seeder
{
  public function run()
  {
    $this->call('UserSeeder');
  }
}
