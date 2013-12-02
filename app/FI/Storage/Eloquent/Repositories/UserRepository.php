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
	
	public function delete($id)
	{
		User::destroy($id);
	}
	
}