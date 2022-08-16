<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMigration extends Migration
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
      'email' => [
        'type'       => 'VARCHAR',
        'constraint' => 225
      ],
      'name' => [
        'type' => 'TEXT',
        'constraint' => 50
      ],
      'password' => [
        'type' => 'VARCHAR',
        'constraint' => 225
      ],
      'role' => [
        'type' => 'INT',
        'constraint' => 1
      ],
      'company' => [
        'type' => 'VARCHAR',
        'constraint' => 225
      ],
      'created_date' => [
        'type' => 'DATETIME'
      ],
      'created_by' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
        'null' => true
      ],
      'updated_date' => [
        'type' => 'DATETIME',
        'null' => true
      ],
      'updated_by' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
        'null' => true
      ]
    ];

    $this->forge->addField($fields);
    $this->forge->addKey('id', true);
    $this->forge->createTable('users');
  }

  public function down()
  {
    $this->forge->dropTable('users');
  }
}
