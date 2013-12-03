<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\User;

class UserRepository implements \FI\Storage\Interfaces\UserRepositoryInterface {

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return User
	 */
	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return User::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return User
	 */
	public function find($id)
	{
		return User::find($id);
	}
	
	/**
	 * Create a record
	 * @param  string $email
	 * @param  string $password
	 * @param  string $name
	 * @param  string $company
	 * @param  string $address1
	 * @param  string $address2
	 * @param  string $city
	 * @param  string $state
	 * @param  string $zip
	 * @param  string $country
	 * @param  string $phone
	 * @param  string $fax
	 * @param  string $mobile
	 * @param  string $web
	 * @return void
	 */
	public function create($email, $password, $name, $company = null, $address1 = null, $address2 = null, $city = null, $state = null, $zip = null, $country = null, $phone = null, $fax = null, $mobile = null, $web = null)
	{
		$user = new User;

		$user->fill(
			array(
				'email'     => $email,
				'name'      => $name,
				'company'   => $company,
				'address_1' => $address1,
				'address_2' => $address2,
				'city'      => $city,
				'state'     => $state,
				'zip'       => $zip,
				'country'   => $country,
				'phone'     => $phone,
				'fax'       => $fax,
				'mobile'    => $mobile,
				'web'       => $web
			)
		);

		$user->password = \Hash::make($password);

		$user->save();
	}
	
	/**
	 * Update a record
	 * @param  int $id
	 * @param  string $email
	 * @param  string $name
	 * @param  string $company
	 * @param  string $address1
	 * @param  string $address2
	 * @param  string $city
	 * @param  string $state
	 * @param  string $zip
	 * @param  string $country
	 * @param  string $phone
	 * @param  string $fax
	 * @param  string $mobile
	 * @param  string $web
	 * @return void
	 */
	public function update($id, $email, $name, $company = null, $address1 = null, $address2 = null, $city = null, $state = null, $zip = null, $country = null, $phone = null, $fax = null, $mobile = null, $web = null)
	{
		$user = User::find($id);

		$user->fill(
			array(
				'email'     => $email,
				'name'      => $name,
				'company'   => $company,
				'address_1' => $address1,
				'address_2' => $address2,
				'city'      => $city,
				'state'     => $state,
				'zip'       => $zip,
				'country'   => $country,
				'phone'     => $phone,
				'fax'       => $fax,
				'mobile'    => $mobile,
				'web'       => $web
			)
		);

		$user->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		User::destroy($id);
	}
	
}