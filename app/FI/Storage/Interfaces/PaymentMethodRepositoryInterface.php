<?php namespace FI\Storage\Interfaces;

interface PaymentMethodRepositoryInterface {
	
	public function all();

	public function getPaged($page, $numPerPage);
	
	public function find($id);
	
	public function create($name);
	
	public function update($id, $name);
	
	public function delete($id);
	
}