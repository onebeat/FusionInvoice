<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\Quote;

class QuoteRepository implements \FI\Storage\Interfaces\QuoteRepositoryInterface {

	public function all()
	{
		return Quote::all();
	}

	public function getPagedByStatus($page = 1, $numPerPage = null, $status = 'all')
	{
		\DB::getPaginator()->setCurrentPage($page);

		$quote = Quote::with(array('amount', 'client'));

		switch ($status)
		{
			case 'draft':
				return $quote->draft()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'sent':
				return $quote->sent()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
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
		return Quote::with('items.amount')->find($id);
	}

	public function findByUrlKey($urlKey)
	{
		return Quote::where('url_key', $urlKey)->first();
	}
	
	public function create($input)
	{
		return Quote::create($input)->id;
	}
	
	public function update($input, $id)
	{
		$quote = Quote::find($id);
		$quote->fill($input);
		$quote->save();
	}
	
	public function delete($id)
	{
		$quote = Quote::find($id);

		foreach ($quote->items as $item)
		{
			$item->amount->delete();
			$item->delete();
		}

		foreach ($quote->taxRates as $taxRate)
		{
			$taxRate->delete();
		}

		$quote->amount->delete();

		$quote->delete();
	}
	
}