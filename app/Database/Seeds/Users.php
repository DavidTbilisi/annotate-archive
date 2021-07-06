<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
	public function run()
	{
		$this->db->table('users')->insert([
			'name' => 'Alter',
			'username' => 'alter-180',
			'activated' => 1,
			'email' => 'alter@mail.com',
			'password' => password_hash('alter1349', PASSWORD_DEFAULT),
			'groups_id ' => 1
		]);
	}
}
