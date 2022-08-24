<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MessageMigration extends Migration
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
      'text' => [
        'type'       => 'VARCHAR',
        'constraint' => 225
      ],
      'attach' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
        'null' => true
      ],
      'request_id' => [
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
    $this->forge->createTable('messages');
  }

  public function down()
  {
    $this->forge->dropTable('messages');
  }
}
