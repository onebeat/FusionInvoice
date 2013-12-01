<?php

use FI\Storage\Eloquent\Models\User;

/**
 * This file exists for development purposes and will
 * be removed when installer has been created
 */

class UserTableSeeder extends Seeder {
	
	public function run()
	{
		$email = 'admin@admin.com';
		$password = 'password';

		User::create(array(
			'name'    => 'Administrator',
			'email'   => $email,
			'password'=> Hash::make($password),
		));

		echo "Created a user with these credentials:\n";
		echo "\tEmail:\t\t$email\n";
		echo "\tPassword:\t$password\n\n";
	}

}
