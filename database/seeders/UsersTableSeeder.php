<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = [
			[
				'name' => 'Автор не известен',
				'email' => 'unknown_author@mail.ru',
				'password' => bcrypt(Str::random(16)),
			],
			[
				'name' => 'Автор',
				'email' => 'author@mail.ru',
				'password' => bcrypt('123123'),
			],
		];

		DB::table('users')->insert($data);
	}
}
