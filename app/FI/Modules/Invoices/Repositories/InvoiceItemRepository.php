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

use FI\Modules\Invoices\Models\InvoiceItem;
use FI\Modules\Invoices\Models\InvoiceItemAmount;

class InvoiceItemRepository {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceItem
	 */
	public function find($id)
	{
		return InvoiceItem::find($id);
	}

	/**
	 * Get a list of records by invoice id
	 * @param  int $invoiceId
	 * @return InvoiceItem
	 */
	public function findByInvoiceId($invoiceId)
	{
		return InvoiceItem::orderBy('display_order')->where('invoice_id', '=', $invoiceId)->get();
	}

	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return InvoiceItem::create($input)->id;
	}

	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$invoiceItem = InvoiceItem::find($id);

		$invoiceItem->fill($input);
		
		$invoiceItem->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		$invoiceItem = InvoiceItem::find($id);

		$invoiceItem->amount->delete();
		$invoiceItem->delete();
	}
	
}