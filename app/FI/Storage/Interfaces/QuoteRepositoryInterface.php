<?php namespace FI\Storage\Interfaces;

interface QuoteRepositoryInterface {
	
	public function all();

	public function getPagedByStatus($page, $numPerPage, $status);
	
	public function find($id);
	
	public function create($clientId, $createdAt, $invoiceGroupId, $userId, $quoteStatusId);
	
	public function update($quoteId, $createdAt, $expiresAt, $number, $quoteStatusId);
	
	public function delete($id);
	
}