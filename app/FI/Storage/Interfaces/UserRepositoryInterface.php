<?php namespace FI\Storage\Interfaces;

interface UserRepositoryInterface {
	
	public function getPaged($page, $numPerPage);
	
	public function find($id);
	
	public function create($email, $password, $name, $company, $address1, $address2, $city, $state, $zip, $country, $phone, $fax, $mobile, $web);
	
	public function update($id, $email, $name, $company, $address1, $address2, $city, $state, $zip, $country, $phone, $fax, $mobile, $web);
	
	public function delete($id);
	
}