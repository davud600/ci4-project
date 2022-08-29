<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmployeeEstimatedTimeMigration extends Migration
{
  public function up()
  {
    $fields = [
      'id' => [
        'type' => 'INT',
        'constraint' => 225,
        'unsigned' => true,
        'auto_increment' => true
      ],
      'description' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
        'null' => true
      ],
      'employee_id' => [
        'type'       => 'INT',
        'constraint' => 225
      ],
      'project_id' => [
        'type'       => 'INT',
        'constraint' => 225
      ],
      'time_added' => [
        'type' => 'INT',
        'constraint' => 10
      ],
      'created_by_admin' => [
        'type' => 'TINYINT',
        'constraint' => 1,
        'default' => 0
      ],
      'created_at' => [
        'type' => 'DATETIME'
      ],
      'updated_at' => [
        'type' => 'DATETIME',
        'null' => true
      ],
      'deleted_at' => [
        'type' => 'DATETIME',
        'null' => true
      ]
    ];

    $this->forge->addField($fields);
    $this->forge->addKey('id', true);
    $this->forge->createTable('employee_estimated_times');
  }

  public function down()
  {
    $this->forge->dropTable('employee_estimated_times');
  }
}
