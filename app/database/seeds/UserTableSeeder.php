<?php

/**
 * This file exists for development purposes and will
 * be removed when installer has been created
 */

class UserTableSeeder extends Seeder {
	
	public function run()
	{
		$user = [
			'name' => 'Administrator',
			'email' => 'admin@admin.com',
			'password' => Hash::make('password')
		];

		DB::table('fi_users')->insert($user);
	}

}