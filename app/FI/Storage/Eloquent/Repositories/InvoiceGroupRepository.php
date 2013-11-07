<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\InvoiceGroup;

class InvoiceGroupRepository implements \FI\Storage\Interfaces\InvoiceGroupRepositoryInterface {
	
	public function all()
	{
		return InvoiceGroup::orderBy('name')->all();
	}

	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return InvoiceGroup::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function find($id)
	{
		return InvoiceGroup::find($id);
	}

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

	public function incrementNextId($id)
	{
		$group          = InvoiceGroup::find($id);
		$group->next_id = $group->next_id + 1;
		$group->save();
	}

	public function lists()
	{
		return InvoiceGroup::orderBy('name')->lists('name', 'id');
	}
	
	public function create($input)
	{
		InvoiceGroup::create($input);
	}
	
	public function update($input, $id)
	{
		$invoiceGroup = InvoiceGroup::find($id);
		$invoiceGroup->fill($input);
		$invoiceGroup->save();
	}
	
	public function delete($id)
	{
		InvoiceGroup::destroy($id);
	}
	
}