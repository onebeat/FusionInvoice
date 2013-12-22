<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\InvoiceCustom;

class InvoiceCustomRepository implements \FI\Storage\Interfaces\InvoiceCustomRepositoryInterface {

	public function save($input, $invoiceId)
	{
		$record = (InvoiceCustom::find($invoiceId)) ?: new InvoiceCustom;

		$record->invoice_id = $invoiceId;
		
		$record->fill($input);

		$record->save();
	}

}