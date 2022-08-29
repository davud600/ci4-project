<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectEmployeeMigration extends Migration
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
      'project_id' => [
        'type'       => 'INT',
        'constraint' => 225
      ],
      'employee_id' => [
        'type'       => 'INT',
        'constraint' => 225
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
    $this->forge->createTable('project_employees');
  }

  public function down()
  {
    $this->forge->dropTable('project_employees');
  }
}
