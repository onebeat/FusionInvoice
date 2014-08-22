<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Repositories;

use FI\Modules\Invoices\Models\InvoiceItemAmount;

class InvoiceItemAmountRepository {
	
	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceItemAmount
	 */
	public function find($id)
	{
		return InvoiceItemAmount::find($id);
	}

	/**
	 * Get a list of records by invoice id
	 * @param  int $invoiceId
	 * @return InvoiceItemAmount
	 */
	public function findByInvoiceId($invoiceId)
	{
		return \DB::table('invoice_item_amounts')
		->whereRaw('item_id IN (SELECT id FROM invoice_items WHERE invoice_id = ' . $invoiceId . ')')
		->get();
	}
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return InvoiceItemAmount::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $itemId
	 * @return void
	 */
	public function update($input, $itemId)
	{
		$invoiceItemAmount = InvoiceItemAmount::where('item_id', $itemId)->first();

		$invoiceItemAmount->fill($input);

		$invoiceItemAmount->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		InvoiceItemAmount::destroy($id);
	}

	/**
	 * Delete a record based on the item id
	 * @param  int $itemId
	 * @return void
	 */
	public function deleteByItemId($itemId)
	{
		InvoiceItemAmount::where('item_id', $itemId)->delete();
	}
	
}