<?php namespace FI\Storage\Interfaces;

interface ItemLookupRepositoryInterface {
	
	public function all();

	public function getPaged($page, $numPerPage);

	public function getByIds($ids);
	
	public function find($id);
	
	public function create($name, $description, $price);
	
	public function update($itemLookupId, $name, $description, $price);
	
	public function delete($id);
	
}