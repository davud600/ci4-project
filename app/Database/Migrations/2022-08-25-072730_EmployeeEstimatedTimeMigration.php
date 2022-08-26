<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmployeeEstimatedTimeMigration extends Migration
{
  public function up()
  {
    $fields = [
      'id' => [
        'type'           => 'BIGINT',
        'constraint'     => 225,
        'unsigned'       => true,
        'auto_increment' => true,
      ],
      'description' => [
        'type' => 'text',
        'null' => true
      ],
      'employee_id' => [
        'type'       => 'BIGINT',
        'constraint' => 225
      ],
      'project_id' => [
        'type'       => 'BIGINT',
        'constraint' => 225
      ],
      'time_added' => [
        'type' => 'INT',
        'constraint' => 7
      ],
      'created_date' => [
        'type' => 'DATETIME'
      ],
      'created_by' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
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
