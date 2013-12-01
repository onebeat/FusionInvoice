<?php namespace FI\Storage\Interfaces;

interface ClientRepositoryInterface {
	
	public function all();
	
	public function getPagedActive($page, $numPerPage);

	public function getPagedInactive($page, $numPerPage);

	public function getPagedAll($page, $numPerPage);
	
	public function find($id);
	
	public function create($name, $address1, $address2, $city, $state, $zip, $country, $phone, $fax, $mobile, $email, $web, $active);

	public function update($clientId, $name, $address1, $address2, $city, $state, $zip, $country, $phone, $fax, $mobile, $email, $web, $active);
	
	public function delete($id);
	
}