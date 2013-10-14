<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\ClientNote;

class ClientNoteRepository implements \FI\Storage\Interfaces\ClientNoteRepositoryInterface {
	
	public function find($id)
	{
		return ClientNote::find($id);
	}
	
	public function create($input)
	{
		ClientNote::create($input);
	}
	
	public function update($input, $id)
	{
		$clientNote = ClientNote::find($id);
		$clientNote->fill($input);
		$clientNote->save();
	}
	
	public function delete($id)
	{
		ClientNote::destroy($id);
	}
	
}