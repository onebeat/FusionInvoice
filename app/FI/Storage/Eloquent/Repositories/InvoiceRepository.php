<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\Invoice;

class InvoiceRepository implements \FI\Storage\Interfaces\InvoiceRepositoryInterface {

	/**
	 * Get all records
	 * @return Invoice
	 */
	public function all()
	{
		return Invoice::all();
	}

	/**
	 * Get a list of records by status
	 * @param  int $page
	 * @param  int $numPerPage
	 * @param  string  $status
	 * @return Invoice
	 */
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
			case 'viewed':
				return $invoice->viewed()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
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

	/**
	 * Get a limited list of all invoices
	 * @param  int $limit
	 * @return Invoice
	 */
	public function getRecent($limit)
	{
		return Invoice::with(array('amount', 'client'))->limit($limit)->get();
	}

	/**
	 * Get a limited list of overdue records
	 * @param  int $limit
	 * @return Invoice
	 */
	public function getRecentOverdue($limit)
	{
		return Invoice::overdue()->with(array('amount', 'client'))->orderBy('due_at')->limit($limit)->get();
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return Invoice
	 */
	public function find($id)
	{
		return Invoice::with(array('items.amount', 'custom'))->find($id);
	}

	/**
	 * Get a record by url key
	 * @param  string $urlKey
	 * @return Invoice
	 */
	public function findByUrlKey($urlKey)
	{
		return Invoice::where('url_key', $urlKey)->first();
	}
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return Invoice::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$invoice = Invoice::find($id);

		$invoice->fill($input);

		$invoice->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		$invoice = Invoice::find($id);

		foreach ($invoice->items as $item)
		{
			$item->amount->delete();
			$item->delete();
		}

		foreach ($invoice->taxRates as $taxRate)
		{
			$taxRate->delete();
		}

		$invoice->amount->delete();

		$invoice->delete();
	}
	
}