<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectEmployeeMigration extends Migration
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
      'project_id' => [
        'type'       => 'BIGINT',
        'constraint' => 225
      ],
      'employee_id' => [
        'type'       => 'BIGINT',
        'constraint' => 225
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
    $this->forge->createTable('project_employees');
  }

  public function down()
  {
    $this->forge->dropTable('project_employees');
  }
}
