<?php namespace FI\Storage\Interfaces;

interface QuoteRepositoryInterface {
	
	public function all();

	public function getPagedByStatus($page, $numPerPage, $status);
	
	public function find($id);
	
	public function create($input);
	
	public function update($input, $id);
	
	public function delete($id);
	
}