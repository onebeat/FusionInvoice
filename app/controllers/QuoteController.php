<?php

use FI\Storage\Interfaces\QuoteRepositoryInterface;
use FI\Storage\Interfaces\InvoiceGroupRepositoryInterface;
use FI\Storage\Interfaces\ClientRepositoryInterface;
use FI\Validators\QuoteValidator;
use FI\Libraries\Quotes;
use FI\Libraries\Date;

class QuoteController extends BaseController {

	protected $quote;
	protected $validator;
	protected $invoiceGroup;
	protected $client;
	
	public function __construct(
		QuoteRepositoryInterface $quote, 
		QuoteValidator $validator,
		InvoiceGroupRepositoryInterface $invoiceGroup,
		ClientRepositoryInterface $client)
	{
		$this->quote        = $quote;
		$this->validator    = $validator;
		$this->invoiceGroup = $invoiceGroup;
		$this->client       = $client;
	}

	/**
	 * Display paginated list
	 * @param  string $status
	 * @return \Illuminate\View\View
	 */
	public function index($status = 'all')
	{
		$quotes   = $this->quote->getPagedByStatus(Input::get('page'), null, $status);
		$statuses = Quotes::statuses();

		return View::make('quotes.index')
		->with(array('quotes' => $quotes, 'status' => $status, 'statuses' => $statuses));
	}

	public function store()
	{
		if (!$this->validator->validate(Input::all(), 'createRules'))
		{
			return json_encode(array('success' => '0'));
		}

		$clientId = $this->client->findIdByName(Input::get('client_name'));

		if (!$clientId)
		{
			$clientId = $this->client->create(array('name' => Input::get('client_name')));
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

		$id = $this->quote->create($input);

		$this->invoiceGroup->incrementNextId(Input::get('invoice_group_id'));

		return json_encode(array('success' => 1, 'id' => $id));
	}

	/**
	 * Displays modal from ajax request
	 * @return \Illuminate\View\View
	 */
	public function modalCreate()
	{
		return View::make('quotes._modal_create')
		->with('invoiceGroups', $this->invoiceGroup->lists());
	}
	
}