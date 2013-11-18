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

		$quote = Invoice::with(array('amount', 'client'));

		switch ($status)
		{
			case 'draft':
				return $quote->draft()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'sent':
				return $quote->sent()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'paid':
				return $quote->paid()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'canceled':
				return $quote->canceled()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			default:
				return $quote->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
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
		$quote = Invoice::find($id);
		$quote->fill($input);
		$quote->save();
	}
	
	public function delete($id)
	{
		$quote = Invoice::find($id);

		foreach ($quote->items as $item)
		{
			$item->amount->delete();
			$item->delete();
		}

		$quote->amount->delete();

		$quote->delete();
	}
	
}