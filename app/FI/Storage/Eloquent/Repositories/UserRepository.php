<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\User;

class UserRepository implements \FI\Storage\Interfaces\UserRepositoryInterface {

	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return User::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function find($id)
	{
		return User::find($id);
	}
	
	public function create($email, $password, $name, $company, $address1, $address2, $city, $state, $zip, $country, $phone, $fax, $mobile, $web)
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
	
	public function update($id, $email, $name, $company, $address1, $address2, $city, $state, $zip, $country, $phone, $fax, $mobile, $web)
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
	
	public function delete($id)
	{
		User::destroy($id);
	}
	
}