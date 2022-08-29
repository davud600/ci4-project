<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectMigration extends Migration
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
      'title' => [
        'type' => 'VARCHAR',
        'constraint' => 225
      ],
      'description' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
        'null' => true
      ],
      'status' => [
        'type' => 'TINYINT',
        'constraint' => 1,
        'default' => 0
      ],
      'estimated_time' => [
        'type' => 'INT',
        'constraint' => 10
      ],
      'customer_id' => [
        'type' => 'INT',
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
    $this->forge->createTable('projects');
  }

  public function down()
  {
    $this->forge->dropTable('projects');
  }
}
