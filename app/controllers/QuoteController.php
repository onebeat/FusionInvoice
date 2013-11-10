<?php

use FI\Storage\Interfaces\QuoteRepositoryInterface;
use FI\Storage\Interfaces\QuoteItemRepositoryInterface;
use FI\Storage\Interfaces\QuoteTaxRateRepositoryInterface;
use FI\Storage\Interfaces\InvoiceGroupRepositoryInterface;
use FI\Storage\Interfaces\TaxRateRepositoryInterface;
use FI\Validators\QuoteValidator;
use FI\Classes\Quotes;
use FI\Classes\Date;

class QuoteController extends BaseController {

	protected $quote;
	protected $quoteItem;
	protected $quoteTaxRate;
	protected $validator;
	protected $invoiceGroup;
	protected $client;
	protected $taxRate;
	
	public function __construct(
		QuoteRepositoryInterface $quote,
		QuoteItemRepositoryInterface $quoteItem,
		QuoteTaxRateRepositoryInterface $quoteTaxRate,
		QuoteValidator $validator,
		InvoiceGroupRepositoryInterface $invoiceGroup,
		TaxRateRepositoryInterface $taxRate)
	{
		$this->quote        = $quote;
		$this->quoteItem    = $quoteItem;
		$this->quoteTaxRate = $quoteTaxRate;
		$this->validator    = $validator;
		$this->invoiceGroup = $invoiceGroup;
		$this->taxRate      = $taxRate;
	}

	/**
	 * Display paginated list
	 * @param  string $status
	 * @return View
	 */
	public function index($status = 'all')
	{
		$quotes   = $this->quote->getPagedByStatus(Input::get('page'), null, $status);
		$statuses = Quotes::statuses();

		return View::make('quotes.index')
		->with(array('quotes' => $quotes, 'status' => $status, 'statuses' => $statuses));
	}

	/**
	 * Accept post data to create quote
	 * @return JSON array
	 */
	public function store()
	{
		$client = \App::make('FI\Storage\Interfaces\ClientRepositoryInterface');

		if (!$this->validator->validate(Input::all(), 'createRules'))
		{
			return json_encode(array('success' => 0, 'message' => $this->validator->errors()->first()));
		}

		$clientId = $client->findIdByName(Input::get('client_name'));

		if (!$clientId)
		{
			$clientId = $client->create(array('name' => Input::get('client_name')));
		}

		$input = array(
			'client_id'        => $clientId,
			'created_at'       => Date::standardizeDate(Input::get('created_at')),
			'expires_at'       => Date::incrementDateByDays(Input::get('created_at'), Config::get('fi.quotesExpireAfter')),
			'invoice_group_id' => Input::get('invoice_group_id'),
			'number'           => $this->invoiceGroup->generateNumber(Input::get('invoice_group_id')),
			'user_id'          => Auth::user()->id,
			'quote_status_id'  => 1,
			'url_key'          => str_random(32)
			);

		$quoteId = $this->quote->create($input);

		\Event::fire('quote.created', array($quoteId, Input::get('invoice_group_id')));

		return json_encode(array('success' => 1, 'id' => $quoteId));
	}

	/**
	 * Accept post data to update quote
	 * @return JSON array
	 */
	public function update($id)
	{
		if (!$this->validator->validate(Input::all(), 'updateRules'))
		{
			return json_encode(array('success' => 0, 'message' => $this->validator->errors()->first()));
		}

		$itemValidator = App::make('FI\Validators\ItemValidator');

		if (!$itemValidator->validateMulti(json_decode(Input::get('items'))))
		{
			return json_encode(array('success' => 0, 'message' => $itemValidator->errors()->first()));
		}

		$input = Input::all();

		$quote = array(
			'number'          => $input['number'],
			'created_at'      => Date::standardizeDate($input['created_at']),
			'expires_at'      => Date::standardizeDate($input['expires_at']),
			'quote_status_id' => $input['quote_status_id']
			);

		$this->quote->update($quote, $id);

		$items = json_decode(Input::get('items'));

		foreach ($items as $item)
		{
			$itemRecord = array(
				'quote_id'      => $item->quote_id,
				'name'          => $item->item_name,
				'description'   => $item->item_description,
				'quantity'      => $item->item_quantity,
				'price'         => $item->item_price,
				'tax_rate_id'   => $item->item_tax_rate_id,
				'display_order' => $item->item_order
				);

			if (!$item->item_id)
			{
				$itemId = $this->quoteItem->create($itemRecord);

				\Event::fire('quote.item.created', $itemId);
			}
			else
			{
				$this->quoteItem->update($itemRecord, $item->item_id);
			}

			if (isset($item->save_item_as_lookup) and $item->save_item_as_lookup)
			{
				$itemLookup = \App::make('FI\Storage\Interfaces\ItemLookupRepositoryInterface');

				$itemLookupRecord = array(
					'name'        => $item->item_name,
					'description' => $item->item_description,
					'price'       => $item->item_price
					);

				$itemLookup->create($itemLookupRecord);
			}
		}

		\Event::fire('quote.modified', $id);

		return json_encode(array('success' => 1));
	}

	/**
	 * Display the quote
	 * @param  int $id [description]
	 * @return View
	 */
	public function show($id)
	{
		$quote         = $this->quote->find($id);
		$statuses      = Quotes::listsStatuses();
		$taxRates      = $this->taxRate->lists();
		$quoteTaxRates = $this->quoteTaxRate->findByQuoteId($id);

		return View::make('quotes.show')
		->with('quote', $quote)
		->with('statuses', $statuses)
		->with('taxRates', $taxRates)
		->with('quoteTaxRates', $quoteTaxRates);
	}

	/**
	 * Delete an item from a quote
	 * @param  int $quoteId
	 * @param  int $itemId
	 * @return Redirect
	 */
	public function deleteItem($quoteId, $itemId)
	{
		$this->quoteItem->delete($itemId);

		\Event::fire('quote.modified', $quoteId);

		return Redirect::route('quotes.show', array($quoteId));
	}

	/**
	 * Displays create quote modal from ajax request
	 * @return View
	 */
	public function modalCreate()
	{
		return View::make('quotes._modal_create')
		->with('invoiceGroups', $this->invoiceGroup->lists());
	}

	/**
	 * Displays add lookup item modal from ajax request
	 * @return View
	 */
	public function modalAddLookupItem()
	{
		return View::make('quotes._modal_add_lookup_item');
	}

	/**
	 * Displays modal to add quote taxes from ajax request
	 * @return View
	 */
	public function modalAddQuoteTax()
	{
		return View::make('quotes._modal_add_quote_tax')
		->with('quote_id', Input::get('quote_id'))
		->with('taxRates', $this->taxRate->lists());
	}

	/**
	 * Saves quote tax from ajax request
	 */
	public function saveQuoteTax()
	{
		$this->quoteTaxRate->create(array(
			'quote_id'         => Input::get('quote_id'),
			'tax_rate_id'      => Input::get('tax_rate_id'),
			'include_item_tax' => Input::get('include_item_tax')
			)
		);

		\Event::fire('quote.modified', Input::get('quote_id'));
	}

	/**
	 * Deletes quote tax
	 * @param  int $quoteId
	 * @param  int $quoteTaxRateId
	 * @return Redirect
	 */
	public function deleteQuoteTax($quoteId, $quoteTaxRateId)
	{
		$this->quoteTaxRate->delete($quoteTaxRateId);

		\Event::fire('quote.modified', $quoteId);

		return Redirect::route('quotes.show', array($quoteId));
	}

	public function delete($quoteId)
	{
		$this->quoteTaxRate->delete($quoteId);

		return Redirect::route('quotes.index');
	}
	
}