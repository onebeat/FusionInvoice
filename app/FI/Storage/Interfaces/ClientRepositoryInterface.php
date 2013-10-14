<?php namespace FI\Storage\Interfaces;

interface ClientRepositoryInterface {
	
	public function all();
	
	public function getPagedActive($page, $numPerPage);

	public function getPagedInactive($page, $numPerPage);

	public function getPagedAll($page, $numPerPage);
	
	public function find($id);
	
	public function create($input);
	
	public function update($input, $id);
	
	public function delete($id);
	
}