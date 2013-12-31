<?php

use FI\Classes\Date;
use FI\Classes\NumberFormatter;
use FI\Statuses\QuoteStatuses;

class QuoteController extends BaseController {

	protected $invoiceGroup;
	protected $quote;
	protected $quoteItem;
	protected $quoteTaxRate;
	protected $taxRate;
	protected $validator;
	
	public function __construct($customField, $invoiceGroup, $quoteCustom, $quoteItem, $quote, $quoteTaxRate, $taxRate, $validator)
	{
		$this->customField  = $customField;
		$this->invoiceGroup = $invoiceGroup;
		$this->quote        = $quote;
		$this->quoteCustom  = $quoteCustom;
		$this->quoteItem    = $quoteItem;
		$this->quoteTaxRate = $quoteTaxRate;
		$this->taxRate      = $taxRate;
		$this->validator    = $validator;
	}

	/**
	 * Display paginated list
	 * @param  string $status
	 * @return View
	 */
	public function index($status = 'all')
	{
		$quotes   = $this->quote->getPagedByStatus(Input::get('page'), null, $status);
		$statuses = QuoteStatuses::statuses();

		return View::make('quotes.index')
		->with(array('quotes' => $quotes, 'status' => $status, 'statuses' => $statuses));
	}

	/**
	 * Accept post data to create quote
	 * @return JSON array
	 */
	public function store()
	{
		$client = \App::make('ClientRepository');

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
			'created_at'       => Date::unformat(Input::get('created_at')),
			'expires_at'       => Date::incrementDateByDays(Input::get('created_at'), Config::get('fi.quotesExpireAfter')),
			'invoice_group_id' => Input::get('invoice_group_id'),
			'number'           => $this->invoiceGroup->generateNumber(Input::get('invoice_group_id')),
			'user_id'          => Auth::user()->id,
			'quote_status_id'  => 1,
			'url_key'          => str_random(32),
			'footer'           => Config::get('fi.quoteFooter')
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

		$custom = (array) json_decode($input['custom']);
		unset($input['custom']);

		$quote = array(
			'number'          => $input['number'],
			'created_at'      => Date::unformat($input['created_at']),
			'expires_at'      => Date::unformat($input['expires_at']),
			'quote_status_id' => $input['quote_status_id'],
			'footer'          => $input['footer']
			);

		$this->quote->update($quote, $id);
		$this->quoteCustom->save($custom, $id);

		$items = json_decode(Input::get('items'));

		foreach ($items as $item)
		{
			if ($item->item_name)
			{
				$itemRecord = array(
					'quote_id'      => $item->quote_id,
					'name'          => $item->item_name,
					'description'   => $item->item_description,
					'quantity'      => NumberFormatter::unformat($item->item_quantity),
					'price'         => NumberFormatter::unformat($item->item_price),
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
					$itemLookup = \App::make('ItemLookupRepository');

					$itemLookupRecord = array(
						'name'        => $item->item_name,
						'description' => $item->item_description,
						'price'       => NumberFormatter::unformat($item->item_price)
						);

					$itemLookup->create($itemLookupRecord);
				}
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
		$statuses      = QuoteStatuses::lists();
		$taxRates      = $this->taxRate->lists();
		$quoteTaxRates = $this->quoteTaxRate->findByQuoteId($id);

		return View::make('quotes.show')
		->with('quote', $quote)
		->with('statuses', $statuses)
		->with('taxRates', $taxRates)
		->with('quoteTaxRates', $quoteTaxRates)
		->with('customFields', $this->customField->getByTable('quotes'));
	}

	/**
	 * Displays the quote in preview format
	 * @param  int $id
	 * @return View
	 */
	public function preview($id)
	{
		$quote = $this->quote->find($id);

		return View::make('templates.quotes.' . str_replace('.blade.php', '', Config::get('fi.quoteTemplate')))
		->with('quote', $quote);
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
	 * Displays modal to convert quote to invoice
	 * @return view
	 */
	public function modalQuoteToInvoice()
	{
		return View::make('quotes._modal_quote_to_invoice')
		->with('quote_id', Input::get('quote_id'))
		->with('client_id', Input::get('client_id'))
		->with('invoiceGroups', $this->invoiceGroup->lists())
		->with('user_id', Auth::user()->id)
		->with('created_at', Date::format());
	}

	/**
	 * Displays modal to copy quote
	 * @return View
	 */
	public function modalCopyQuote()
	{
		$quote = $this->quote->find(Input::get('quote_id'));

		return View::make('quotes._modal_copy_quote')
		->with('quote', $quote)
		->with('invoiceGroups', $this->invoiceGroup->lists())
		->with('created_at', Date::format())
		->with('user_id', Auth::user()->id);
	}

	/**
	 * Attempt to copy a quote
	 * @return Redirect
	 */
	public function copyQuote()
	{
		if (!$this->validator->validate(Input::all(), 'createRules'))
		{
			return json_encode(array('success' => 0, 'message' => $this->validator->errors()->first()));
		}

		$client = App::make('ClientRepository');

		$clientId = $client->findIdByName(Input::get('client_name'));

		if (!$clientId)
		{
			$clientId = $client->create(array('name' => Input::get('client_name')));
		}

		$quoteId = $this->quote->create(
			array(
				'client_id'        => $clientId,
				'created_at'       => Date::unformat(Input::get('created_at')),
				'expires_at'       => Date::incrementDateByDays(Input::get('created_at'), Config::get('fi.quotesExpireAfter')),
				'invoice_group_id' => Input::get('invoice_group_id'),
				'number'           => $this->invoiceGroup->generateNumber(Input::get('invoice_group_id')),
				'user_id'          => Auth::user()->id,
				'quote_status_id'  => 1,
				'url_key'          => str_random(32)
				)
			);		

		\Event::fire('quote.created', array($quoteId, Input::get('invoice_group_id')));

		$items = $this->quoteItem->findByQuoteId(Input::get('quote_id'));

		foreach ($items as $item)
		{
			$itemId = $this->quoteItem->create(
				array(
					'quote_id'      => $quoteId,
					'name'          => $item->name,
					'description'   => $item->description,
					'quantity'      => $item->quantity,
					'price'         => $item->price,
					'tax_rate_id'   => $item->tax_rate_id,
					'display_order' => $item->display_order
					)
				);

			\Event::fire('quote.item.created', $itemId);
		}

		$quoteTaxRates = $this->quoteTaxRate->findByQuoteId(Input::get('quote_id'));

		foreach ($quoteTaxRates as $quoteTaxRate)
		{
			$this->quoteTaxRate->create(
				array(
					'quote_id'         => $quoteId,
					'tax_rate_id'      => $quoteTaxRate->tax_rate_id,
					'include_item_tax' => $quoteTaxRate->include_item_tax,
					'tax_total'        => $quoteTaxRate->tax_total
					)
				);
		}

		\Event::fire('quote.modified', $quoteId);

		return json_encode(array('success' => 1, 'id' => $quoteId));
	}

	/**
	 * Attempt to save quote to invoice
	 * @return view
	 */
	public function quoteToInvoice()
	{
		$input = Input::all();

		if (!$this->validator->validate($input, 'toInvoiceRules'))
		{
			return json_encode(array('success' => 0, 'message' => $this->validator->errors()->first()));
		}

		$invoice        = App::make('InvoiceRepository');
		$invoiceItem    = App::make('InvoiceItemRepository');
		$invoiceTaxRate = App::make('InvoiceTaxRateRepository');

		$record = array(
			'client_id'         => $input['client_id'],
			'created_at'        => Date::unformat($input['created_at']),
			'due_at'            => Date::incrementDateByDays($input['created_at'], Config::get('fi.invoicesDueAfter')),
			'invoice_group_id'  => $input['invoice_group_id'],
			'number'            => $this->invoiceGroup->generateNumber($input['invoice_group_id']),
			'user_id'           => Auth::user()->id,
			'invoice_status_id' => 1,
			'url_key'           => str_random(32)
			);

		$invoiceId = $invoice->create($record);

		\Event::fire('invoice.created', array($invoiceId, $input['invoice_group_id']));

		$items = $this->quoteItem->findByQuoteId($input['quote_id']);

		foreach ($items as $item)
		{
			$itemRecord = array(
				'invoice_id'    => $invoiceId,
				'name'          => $item->name,
				'description'   => $item->description,
				'quantity'      => $item->quantity,
				'price'         => $item->price,
				'tax_rate_id'   => $item->tax_rate_id,
				'display_order' => $item->display_order
				);

			$itemId = $invoiceItem->create($itemRecord);

			\Event::fire('invoice.item.created', $itemId);
		}

		$quoteTaxRates = $this->quoteTaxRate->findByQuoteId($input['quote_id']);

		foreach ($quoteTaxRates as $quoteTaxRate)
		{
			$invoiceTaxRate->create(
				array(
					'invoice_id'       => $invoiceId,
					'tax_rate_id'      => $quoteTaxRate->tax_rate_id,
					'include_item_tax' => $quoteTaxRate->include_item_tax,
					'tax_total'        => $quoteTaxRate->tax_total
					)
				);
		}

		\Event::fire('invoice.modified', $invoiceId);

		return json_encode(array('success' => 1, 'redirectTo' => route('invoices.show', array('invoice' => $invoiceId))));
	}

	/**
	 * Saves quote tax from ajax request
	 */
	public function saveQuoteTax()
	{
		$this->quoteTaxRate->create(
			array(
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

	/**
	 * Deletes a quote
	 * @param  int
	 * @return Redirect
	 */
	public function delete($quoteId)
	{
		$this->quote->delete($quoteId);

		return Redirect::route('quotes.index');
	}

	public function modalMailQuote()
	{
		$quote = $this->quote->find(Input::get('quote_id'));

		return View::make('quotes._modal_mail')
		->with('quoteId', $quote->id)
		->with('redirectTo', Input::get('redirectTo'))
		->with('to', $quote->client->email)
		->with('cc', \Config::get('fi.mailCcDefault'))
		->with('subject', trans('fi.quote') . ' #' . $quote->number);
	}

	public function mailQuote()
	{
		$quote = $this->quote->find(Input::get('quote_id'));

		try
		{
			Mail::send('templates.emails.quote', array('quote' => $quote), function($message) use ($quote)
			{
				$message->from($quote->user->email)
				->to(Input::get('to'), $quote->client->name)
				->subject(Input::get('subject'));
			});

			return json_encode(array('success' => 1));
		}
		catch (Exception $e)
		{
			return json_encode(array('success' => 0, 'message' => $e->getMessage()));
		}
	}
	
}