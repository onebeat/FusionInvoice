<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use FI\Storage\Eloquent\Models\User;

/**
 * This file exists for development purposes and will
 * be removed when installer has been created
 */

class UserTableSeeder extends Seeder {
	
	public function run()
	{
		$user = App::make('UserRepository');

		$email    = 'admin@admin.com';
		$password = 'password';

		$user->create(
			array(
				'email'     => $email,
				'password'  => Hash::make($password),
				'name'      => 'Administrator',
				'company'   => 'ACME, LLC',
				'address_1' => '1234 Acme Drive',
				'city'      => 'Acme',
				'state'     => 'TX',
				'zip'       => '12345'
			)
		);

		echo "Created a user with these credentials:\n";
		echo "\tEmail:\t\t$email\n";
		echo "\tPassword:\t$password\n\n";
	}

}
