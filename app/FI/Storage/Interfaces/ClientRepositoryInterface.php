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
	 * Retrieve a single record
	 * @param  int $id
	 * @return Client
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
	 */	
	public function delete($id);

}