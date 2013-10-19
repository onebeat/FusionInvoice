<?php namespace FI\Storage\Interfaces;

interface EmailTemplateRepositoryInterface {
	
	public function all();

	public function getPaged($page, $numPerPage);
	
	public function find($id);

	public function lists($column, $key);
	
	public function create($input);
	
	public function update($input, $id);
	
	public function delete($id);
	
}