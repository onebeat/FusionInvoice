<?php namespace FI\Storage\Interfaces;

interface EmailTemplateRepositoryInterface {
	
	public function all();

	public function getPaged($page, $numPerPage);
	
	public function find($emailTemplateId);
	
	public function create($name, $subject, $body);
	
	public function update($emailTemplateId, $name, $subject, $body);
	
	public function delete($emailTemplateId);
	
}