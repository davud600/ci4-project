<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RequestMigration extends Migration
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
      'project_id' => [
        'type' => 'INT',
        'constraint' => 225
      ],
      'status' => [
        'type' => 'TINYINT',
        'constraint' => 1
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
    $this->forge->createTable('requests');
  }

  public function down()
  {
    $this->forge->dropTable('requests');
  }
}
