<?php namespace FI\Storage\Interfaces;

interface TaxRateRepositoryInterface {
	
	public function all();

	public function getPaged($page, $numPerPage);
	
	public function find($id);
	
	public function create($name, $percent);
	
	public function update($id, $name, $percent);
	
	public function delete($id);
	
}