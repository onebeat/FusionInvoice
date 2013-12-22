<?php namespace FI\Storage\Interfaces;

interface QuoteCustomRepositoryInterface {

	/**
	 * Saves input to the custom table
	 * @param  array $input
	 * @param  int $quoteId
	 * @return void
	 */
	public function save($input, $quoteId);
	
}