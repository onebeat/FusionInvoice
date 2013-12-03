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
	 * @param  string $name
	 * @param  string $subject
	 * @param  string $body
	 * @return void
	 */	
	public function create($name, $subject, $body);

	/**
	 * Update a record
	 * @param  int $id
	 * @param  string $name
	 * @param  string $subject
	 * @param  string $body
	 * @return void
	 */	
	public function update($id, $name, $subject, $body);

	/**
	 * Delete a record by id
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}