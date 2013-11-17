<?php namespace FI\Storage\Interfaces;

interface UserRepositoryInterface {
	
	public function getPaged($page, $numPerPage);
	
	public function find($id);
	
	public function create($input);
	
	public function update($input, $id);
	
	public function delete($id);
	
}