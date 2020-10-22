<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class LoginSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'email' 	 => "login@mail.com",
			'password'   => "1234",
			'created_at' => Time::now(),
			'updated_at' => Time::now()
		];

		// Using Query Builder
		$this->db->table('login')->insert($data);
	}
}
