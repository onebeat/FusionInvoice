<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\Quote;
use FI\Classes\Date;

class QuoteRepository implements \FI\Storage\Interfaces\QuoteRepositoryInterface {

	/**
	 * Get a list of all records
	 * @return Quote
	 */
	public function all()
	{
		return Quote::all();
	}

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @param  string $status
	 * @return Quote
	 */
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

	/**
	 * Get a limited list of all records
	 * @param  int $limit
	 * @return Quote
	 */
	public function getRecent($limit)
	{
		return Quote::with(array('amount', 'client'))->limit($limit)->get();
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return Quote
	 */
	public function find($id)
	{
		return Quote::with('items.amount')->find($id);
	}

	/**
	 * Get a record by url key
	 * @param  string $urlKey
	 * @return Quote
	 */
	public function findByUrlKey($urlKey)
	{
		return Quote::where('url_key', $urlKey)->first();
	}

	/**
	 * Create a record
	 * @param  int $clientId
	 * @param  string $createdAt
	 * @param  int $invoiceGroupId
	 * @param  int $userId
	 * @param  int $quoteStatusId
	 * @return int
	 */
	public function create($clientId, $createdAt, $invoiceGroupId, $userId, $quoteStatusId)
	{
		$invoiceGroup = \App::make('FI\Storage\Interfaces\InvoiceGroupRepositoryInterface');
		
		return Quote::create(
			array(
				'client_id'        => $clientId,
				'created_at'       => Date::unformat($createdAt),
				'expires_at'       => Date::incrementDateByDays($createdAt, \Config::get('fi.quotesExpireAfter')),
				'invoice_group_id' => $invoiceGroupId,
				'number'           => $invoiceGroup->generateNumber($invoiceGroupId),
				'user_id'          => $userId,
				'quote_status_id'  => $quoteStatusId,
				'url_key'          => str_random(32)
				)
			)->id;
	}
	
	/**
	 * Update a record
	 * @param  int $quoteId
	 * @param  string $createdAt
	 * @param  string $expiresAt
	 * @param  string $number
	 * @param  int $quoteStatusId
	 * @return void
	 */
	public function update($quoteId, $createdAt, $expiresAt, $number, $quoteStatusId)
	{
		$quote = Quote::find($quoteId);

		$quote->fill(
			array(
				'number'          => $number,
				'created_at'      => Date::unformat($createdAt),
				'expires_at'      => Date::unformat($expiresAt),
				'quote_status_id' => $quoteStatusId
			)
		);

		$quote->save();
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
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