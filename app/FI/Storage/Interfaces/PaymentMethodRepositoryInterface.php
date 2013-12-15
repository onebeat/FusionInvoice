<?php namespace FI\Storage\Interfaces;

interface PaymentMethodRepositoryInterface {

	/**
	 * Get a list of all records
	 * @return PaymentMethod
	 */	
	public function all();

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return PaymentMethod
	 */
	public function getPaged($page, $numPerPage);

	/**
	 * Get a single record
	 * @param  int $id
	 * @return PaymentMethod
	 */	
	public function find($id);
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input);

	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id);
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);
	
}