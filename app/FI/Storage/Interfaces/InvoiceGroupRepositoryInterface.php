<?php namespace FI\Storage\Interfaces;

interface InvoiceGroupRepositoryInterface {
	
	public function all();

	public function getPaged($page, $numPerPage);
	
	public function find($id);

	public function generateNumber($id);

	public function incrementNextId($id);
	
	public function create($input);
	
	public function update($input, $id);
	
	public function delete($id);
	
}