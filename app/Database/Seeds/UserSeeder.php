<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'nama' 		=> 'Dart Vader',
			'alamat'    => 'Jl. Abc no.99',
			'created_at' => Time::now(),
			'updated_at' => Time::now()
		];

		// Using Query Builder
		$this->db->table('user')->insert($data);
	}
}
