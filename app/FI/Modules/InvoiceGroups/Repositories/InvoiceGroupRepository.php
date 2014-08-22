<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\InvoiceGroups\Repositories;

use FI\Modules\InvoiceGroups\Models\InvoiceGroup;

class InvoiceGroupRepository {
	
	/**
	 * Get all records
	 * @return InvoiceGroup
	 */
	public function all()
	{
		return InvoiceGroup::orderBy('name')->all();
	}

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return InvoiceGroup
	 */
	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return InvoiceGroup::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceGroup
	 */
	public function find($id)
	{
		return InvoiceGroup::find($id);
	}

	/**
	 * Generate an invoice number
	 * @param  int $id
	 * @return string
	 */
	public function generateNumber($id)
	{
		$group = InvoiceGroup::find($id);

		$number = $group->next_id;

		if ($group->prefix) $number        = $group->prefix . $number;
		if ($group->prefix_year) $number  .= date('Y');
		if ($group->prefix_month) $number .= date('m');
		if ($group->left_pad) $number      = str_pad($number, $group->left_pad, '0', STR_PAD_LEFT);

		return $number;
	}

	/**
	 * Increment the next id after an invoice is created
	 * @param  int $id
	 * @return void
	 */
	public function incrementNextId($id)
	{
		$group          = InvoiceGroup::find($id);
		$group->next_id = $group->next_id + 1;
		$group->save();
	}

	/**
	 * Get a list of records formatted for dropdown
	 * @return array
	 */
	public function lists()
	{
		return InvoiceGroup::orderBy('name')->lists('name', 'id');
	}
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return InvoiceGroup::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$invoiceGroup = InvoiceGroup::find($id);

		$invoiceGroup->fill($input);

		$invoiceGroup->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		InvoiceGroup::destroy($id);
	}
	
}