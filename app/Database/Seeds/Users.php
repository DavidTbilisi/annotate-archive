<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
	public function run()
	{
        $password = session()->getFlashdata('default_password');
		$this->db->table('users')->insert([
			'name' => 'Admin',
			'username' => 'admin',
			'activated' => 1,
			'email' => 'a@admin.com',
			'password' => password_hash("111", PASSWORD_DEFAULT),
			'groups_id ' => 1
		]);
	}
}
