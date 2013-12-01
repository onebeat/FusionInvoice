<?php namespace FI\Storage\Interfaces;

interface InvoiceGroupRepositoryInterface {
	
	public function all();

	public function getPaged($page, $numPerPage);
	
	public function find($id);

	public function generateNumber($id);

	public function incrementNextId($id);
	
	public function create($name, $nextId, $leftPad, $prefix, $prefixYear, $prefixMonth);
	
	public function update($id, $name, $nextId, $leftPad, $prefix, $prefixYear, $prefixMonth);
	
	public function delete($id);
	
}