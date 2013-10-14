<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\Invoice;

class InvoiceRepository implements \FI\Storage\Interfaces\InvoiceRepositoryInterface {
	
	public function all()
	{
		return Invoice::all();
	}

	public function getPaged($page = 1, $numPerPage = 15)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Invoice::paginate($numPerPage);
	}

	public function find($id)
	{
		return Invoice::find($id);
	}
	
	public function create($input)
	{
		Invoice::create($input);
	}
	
	public function update($input, $id)
	{
		$invoice = Invoice::find($id);
		$invoice->fill($input);
		$invoice->save();
	}
	
	public function delete($id)
	{
		Invoice::destroy($id);
	}
	
}