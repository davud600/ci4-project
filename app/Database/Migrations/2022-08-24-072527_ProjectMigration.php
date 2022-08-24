<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectMigration extends Migration
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
      'title' => [
        'type'       => 'VARCHAR',
        'constraint' => 225
      ],
      'description' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
        'null' => true
      ],
      'status' => [
        'type' => 'INT',
        'constraint' => 1
      ],
      'estimated_time' => [
        'type' => 'DATETIME',
        'null' => true
      ],
      'customer_id' => [
        'type' => 'BIGINT',
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
    $this->forge->createTable('projects');
  }

  public function down()
  {
    $this->forge->dropTable('projects');
  }
}
