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
	 * @param  array $input
	 * @return void
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