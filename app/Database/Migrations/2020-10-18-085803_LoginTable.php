<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoginTable extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 255,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'password' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'created_at' => [
				'type' 			 => 'DATETIME',
				'null'			 => true
			],
			'updated_at' => [
				'type' 			 => 'DATETIME',
				'null'			 => true
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('login');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('login');
	}
}
