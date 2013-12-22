<?php namespace FI\Storage\Interfaces;

interface ClientCustomRepositoryInterface {

	/**
	 * Saves input to the custom table
	 * @param  array $input
	 * @param  int $clientId
	 * @return void
	 */
	public function save($input, $clientId);
	
}