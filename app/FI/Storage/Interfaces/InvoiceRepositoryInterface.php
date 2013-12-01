<?php namespace FI\Storage\Interfaces;

interface InvoiceRepositoryInterface {
	
	public function all();

	public function getPagedByStatus($page, $numPerPage, $status);
	
	public function find($id);
	
	public function create($clientId, $createdAt, $invoiceGroupId, $userId, $invoiceStatusId);
	
	public function update($invoiceId, $createdAt, $expiresAt, $number, $invoiceStatusId);
	
	public function delete($id);
	
}