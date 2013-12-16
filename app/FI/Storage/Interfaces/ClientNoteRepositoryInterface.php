<?php namespace FI\Storage\Interfaces;

interface ClientNoteRepositoryInterface {
	
	/**
	 * Get a single record
	 * @param  int $id
	 * @return ClientNote
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