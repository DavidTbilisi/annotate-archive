<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
		$this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'activated' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
            'email' => [
                'type' => 'TEXT'
            ],
            'avatar' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'password' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'groups_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 3,
                'unsigned' => true
            ],
            'activation_key' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('groups_id','groups','group_id','CASCADE','CASCADE');
        $this->forge->createTable('users');
        $this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
