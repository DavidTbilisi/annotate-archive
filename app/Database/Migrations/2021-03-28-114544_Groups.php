<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Groups extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'group_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'group_title' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'group_description' => [
                'type' => 'TEXT',
                'null' => true
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
        $this->forge->addKey('group_id', true);
        $this->forge->createTable('groups');
	}

	public function down()
	{
		$this->forge->dropTable('groups');
	}
}
