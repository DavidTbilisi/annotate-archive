<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usergroups extends Seeder
{
	public function run()
	{
		$this->db->table('groups')->insert([
			'group_title' => 'Super user',
			'group_description' => 'With all privilegies'
		]);
		$this->db->table('groups')->insert([
			'group_title' => 'Manager',
			'group_description' => 'Limited administrator privilegies'
		]);
		$this->db->table('groups')->insert([
			'group_title' => 'Registered user',
			'group_description' => 'Can see user defined content'
		]);
		$this->db->table('groups')->insert([
			'group_title' => 'Guest',
			'group_description' => 'Only for unregistered users'
		]);
	}
}
