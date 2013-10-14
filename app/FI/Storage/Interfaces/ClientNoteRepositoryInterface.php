<?php namespace FI\Storage\Interfaces;

interface ClientNoteRepositoryInterface {
	
	public function find($id);
	
	public function create($input);
	
	public function update($input, $id);
	
	public function delete($id);
	
}