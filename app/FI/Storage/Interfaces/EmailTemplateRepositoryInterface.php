<?php namespace FI\Storage\Interfaces;

interface EmailTemplateRepositoryInterface {
	
	/**
	 * Get all records
	 * @return EmailTemplate
	 */
	public function all();

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int $numPerPage
	 * @return EmailTemplate
	 */
	public function getPaged($page, $numPerPage);

	/**
	 * Get a single record
	 * @param  int $id
	 * @return EmailTemplate
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
	 * Delete a record by id
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}