<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMigration extends Migration
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
      'email' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
      ],
      'name' => [
        'type' => 'VARCHAR',
        'constraint' => 225,
      ],
      'password' => [
        'type' => 'VARCHAR',
        'constraint' => 225
      ],
      'role' => [
        'type' => 'TINYINT',
        'constraint' => 1,
      ],
      'company' => [
        'type' => 'TEXT',
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
    $this->forge->createTable('users');
  }

  public function down()
  {
    $this->forge->dropTable('users');
  }
}
