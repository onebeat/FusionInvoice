<?php namespace FI\Storage\Interfaces;

interface UserRepositoryInterface {

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return User
	 */	
	public function getPaged($page, $numPerPage);

	/**
	 * Get a single record
	 * @param  int $id
	 * @return User
	 */	
	public function find($id);
	
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
	public function create($email, $password, $name, $company = null, $address1 = null, $address2 = null, $city = null, $state = null, $zip = null, $country = null, $phone = null, $fax = null, $mobile = null, $web = null);
	
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
	public function update($id, $email, $name, $company = null, $address1 = null, $address2 = null, $city = null, $state = null, $zip = null, $country = null, $phone = null, $fax = null, $mobile = null, $web = null);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);
	
}