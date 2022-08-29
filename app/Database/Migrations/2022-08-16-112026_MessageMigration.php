<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MessageMigration extends Migration
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
      'text' => [
        'type' => 'TEXT',
        'constraint' => 550,
        'null' => true
      ],
      'attach' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
        'null' => true
      ],
      'request_id' => [
        'type' => 'INT',
        'constraint' => 225
      ],
      'created_by' => [
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
    $this->forge->createTable('messages');
  }

  public function down()
  {
    $this->forge->dropTable('messages');
  }
}
