<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\Invoice;

class InvoiceRepository implements \FI\Storage\Interfaces\InvoiceRepositoryInterface {

	public function all()
	{
		return Invoice::all();
	}

	public function getPagedByStatus($page = 1, $numPerPage = null, $status = 'all')
	{
		\DB::getPaginator()->setCurrentPage($page);

		$invoice = Invoice::with(array('amount', 'client'));

		switch ($status)
		{
			case 'draft':
				return $invoice->draft()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'sent':
				return $invoice->sent()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'paid':
				return $invoice->paid()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'canceled':
				return $invoice->canceled()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			default:
				return $invoice->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
		}
	}

	public function find($id)
	{
		return Invoice::with('items.amount')->find($id);
	}

	public function findByUrlKey($urlKey)
	{
		return Invoice::where('url_key', $urlKey)->first();
	}
	
	public function create($input)
	{
		return Invoice::create($input)->id;
	}
	
	public function update($input, $id)
	{
		$invoice = Invoice::find($id);
		$invoice->fill($input);
		$invoice->save();
	}
	
	public function delete($id)
	{
		$invoice = Invoice::find($id);

		foreach ($invoice->items as $item)
		{
			$item->amount->delete();
			$item->delete();
		}

		$invoice->amount->delete();

		$invoice->delete();
	}
	
}