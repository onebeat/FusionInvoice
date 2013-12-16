<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\ClientNote;

class ClientNoteRepository implements \FI\Storage\Interfaces\ClientNoteRepositoryInterface {
	
	/**
	 * Get a single record
	 * @param  int $id
	 * @return ClientNote
	 */	
	public function find($id)
	{
		return ClientNote::find($id);
	}
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return ClientNote::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$clientNote = ClientNote::find($id);
		$clientNote->fill($input);
		$clientNote->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id)
	{
		ClientNote::destroy($id);
	}
	
}