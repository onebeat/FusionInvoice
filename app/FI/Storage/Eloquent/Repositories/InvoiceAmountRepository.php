<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\InvoiceAmount;

class InvoiceAmountRepository implements \FI\Storage\Interfaces\InvoiceAmountRepositoryInterface {
	
	public function find($id)
	{
		return InvoiceAmount::find($id);
	}

	public function create($invoiceId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total, $paid, $balance)
	{
		InvoiceAmount::create(
			array(
				'invoice_id'     => $invoiceId,
				'item_subtotal'  => $itemSubtotal,
				'item_tax_total' => $itemTaxTotal,
				'tax_total'      => $taxTotal,
				'total'          => $total,
				'paid'           => $paid,
				'balance'        => $balance
			)
		);
	}
	
	public function update($id, $itemSubtotal, $itemTaxTotal, $taxTotal, $total, $paid, $balance)
	{
		$invoiceAmount = InvoiceAmount::find($id);

		$invoiceAmount->fill(
			array(
				'invoice_id'     => $invoiceId,
				'item_subtotal'  => $itemSubtotal,
				'item_tax_total' => $itemTaxTotal,
				'tax_total'      => $taxTotal,
				'total'          => $total,
				'paid'           => $paid,
				'balance'        => $balance
			)
		);

		$invoiceAmount->save();
	}

	public function updateByInvoiceId($invoiceId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total, $paid, $balance)
	{
		$invoiceAmount = InvoiceAmount::where('invoice_id', $invoiceId)->first();

		$invoiceAmount->fill(
			array(
				'item_subtotal'  => $itemSubtotal,
				'item_tax_total' => $itemTaxTotal,
				'tax_total'      => $taxTotal,
				'total'          => $total,
				'paid'           => $paid,
				'balance'        => $balance
			)
		);
		
		$invoiceAmount->save();
	}

	public function delete($id)
	{
		InvoiceAmount::destroy($id);
	}
}