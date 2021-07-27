<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Institution extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' =>  date('Y-m-d H:i:s')
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('institution');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('institution');
    }
}
