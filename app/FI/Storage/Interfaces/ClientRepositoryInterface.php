<?php namespace FI\Storage\Interfaces;

interface ClientRepositoryInterface {
	
	/**
	 * Get a list of all clients
	 * @return Clients
	 */
	public function all();
	
	/**
	 * @TODO Refactor to single getPagedByStatus method
	 */
	public function getPagedActive($page, $numPerPage);

	/**
	 * @TODO Refactor to single getPagedByStatus method
	 */
	public function getPagedInactive($page, $numPerPage);

	/**
	 * @TODO Refactor to single getPagedByStatus method
	 */
	public function getPagedAll($page, $numPerPage);

	/**
	 * Retrieve a single client record
	 * @param  int $id
	 * @return Client
	 */	
	public function find($id);
	
	/**
	 * Create a new client record
	 * @param  string  $name
	 * @param  integer $active
	 * @param  string  $address1
	 * @param  string  $address2
	 * @param  string  $city
	 * @param  string  $state
	 * @param  string  $zip
	 * @param  string  $country
	 * @param  string  $phone
	 * @param  string  $fax
	 * @param  string  $mobile
	 * @param  string  $email
	 * @param  string  $web
	 * @return int
	 */
	public function create($name, $active = 1, $address1 = null, $address2 = null, $city = null, $state = null, $zip = null, $country = null, $phone = null, $fax = null, $mobile = null, $email = null, $web = null);

	/**
	 * Update an existing client record
	 * @param  integer $clientId
	 * @param  string  $name
	 * @param  integer $active
	 * @param  string  $address1
	 * @param  string  $address2
	 * @param  string  $city
	 * @param  string  $state
	 * @param  string  $zip
	 * @param  string  $country
	 * @param  string  $phone
	 * @param  string  $fax
	 * @param  string  $mobile
	 * @param  string  $email
	 * @param  string  $web
	 * @return void
	 */
	public function update($clientId, $name, $active, $address1 = null, $address2 = null, $city = null, $state = null, $zip = null, $country = null, $phone = null, $fax = null, $mobile = null, $email = null, $web = null);

	/**
	 * Delete a client record
	 * @param  int $id
	 */	
	public function delete($id);

}