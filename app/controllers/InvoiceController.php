<?php

use FI\Storage\Interfaces\InvoiceRepositoryInterface;
use FI\Storage\Interfaces\InvoiceItemRepositoryInterface;
use FI\Storage\Interfaces\InvoiceTaxRateRepositoryInterface;
use FI\Storage\Interfaces\InvoiceGroupRepositoryInterface;
use FI\Storage\Interfaces\TaxRateRepositoryInterface;
use FI\Validators\InvoiceValidator;
use FI\Invoices\InvoiceStatuses;
use FI\Classes\Date;

class InvoiceController extends BaseController {

	protected $invoice;
	protected $invoiceItem;
	protected $invoiceTaxRate;
	protected $validator;
	protected $invoiceGroup;
	protected $client;
	protected $taxRate;
	
	public function __construct(
		InvoiceRepositoryInterface $invoice,
		InvoiceItemRepositoryInterface $invoiceItem,
		InvoiceTaxRateRepositoryInterface $invoiceTaxRate,
		InvoiceValidator $validator,
		InvoiceGroupRepositoryInterface $invoiceGroup,
		TaxRateRepositoryInterface $taxRate)
	{
		$this->invoice        = $invoice;
		$this->invoiceItem    = $invoiceItem;
		$this->invoiceTaxRate = $invoiceTaxRate;
		$this->validator      = $validator;
		$this->invoiceGroup   = $invoiceGroup;
		$this->taxRate        = $taxRate;
	}

	/**
	 * Display paginated list
	 * @param  string $status
	 * @return View
	 */
	public function index($status = 'all')
	{
		$invoices   = $this->invoice->getPagedByStatus(Input::get('page'), null, $status);
		$statuses = InvoiceStatuses::statuses();

		return View::make('invoices.index')
		->with(array('invoices' => $invoices, 'status' => $status, 'statuses' => $statuses));
	}

	/**
	 * Accept post data to create invoice
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

		$invoiceId = $this->invoice->create($clientId, Input::get('created_at'), Input::get('invoice_group_id'), Auth::user()->id, 1);

		\Event::fire('invoice.created', array($invoiceId, Input::get('invoice_group_id')));

		return json_encode(array('success' => 1, 'id' => $invoiceId));
	}

	/**
	 * Accept post data to update invoice
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

		$this->invoice->update($id, $input['created_at'], $input['due_at'], $input['number'], $input['invoice_status_id']);

		$items = json_decode(Input::get('items'));

		foreach ($items as $item)
		{
			if ($item->item_name)
			{
				if (!$item->item_id)
				{
					$itemId = $this->invoiceItem->create($item->invoice_id, $item->item_name, $item->item_description, $item->item_quantity, $item->item_price, $item->item_tax_rate_id, $item->item_order);

					\Event::fire('invoice.item.created', $itemId);
				}
				else
				{
					$this->invoiceItem->update($item->item_id, $item->item_name, $item->item_description, $item->item_quantity, $item->item_price, $item->item_tax_rate_id, $item->item_order);
				}

				if (isset($item->save_item_as_lookup) and $item->save_item_as_lookup)
				{
					$itemLookup = \App::make('FI\Storage\Interfaces\ItemLookupRepositoryInterface');

					$itemLookup->create($item->item_name, $item->item_description, $item->item_price);
				}
			}
		}

		\Event::fire('invoice.modified', $id);

		return json_encode(array('success' => 1));
	}

	/**
	 * Display the invoice
	 * @param  int $id [description]
	 * @return View
	 */
	public function show($id)
	{
		$invoice         = $this->invoice->find($id);
		$statuses        = InvoiceStatuses::lists();
		$taxRates        = $this->taxRate->lists();
		$invoiceTaxRates = $this->invoiceTaxRate->findByInvoiceId($id);

		return View::make('invoices.show')
		->with('invoice', $invoice)
		->with('statuses', $statuses)
		->with('taxRates', $taxRates)
		->with('invoiceTaxRates', $invoiceTaxRates);
	}

	/**
	 * Displays the invoice in preview format
	 * @param  int $id
	 * @return View
	 */
	public function preview($id)
	{
		$invoice = $this->invoice->find($id);

		return View::make('templates.invoices.' . str_replace('.blade.php', '', Config::get('fi.invoiceTemplate')))
		->with('invoice', $invoice);
	}

	/**
	 * Delete an item from a invoice
	 * @param  int $invoiceId
	 * @param  int $itemId
	 * @return Redirect
	 */
	public function deleteItem($invoiceId, $itemId)
	{
		$this->invoiceItem->delete($itemId);

		\Event::fire('invoice.modified', $invoiceId);

		return Redirect::route('invoices.show', array($invoiceId));
	}

	/**
	 * Displays create invoice modal from ajax request
	 * @return View
	 */
	public function modalCreate()
	{
		return View::make('invoices._modal_create')
		->with('invoiceGroups', $this->invoiceGroup->lists());
	}

	/**
	 * Displays modal to add invoice taxes from ajax request
	 * @return View
	 */
	public function modalAddInvoiceTax()
	{
		return View::make('invoices._modal_add_invoice_tax')
		->with('invoice_id', Input::get('invoice_id'))
		->with('taxRates', $this->taxRate->lists());
	}

	/**
	 * Saves invoice tax from ajax request
	 */
	public function saveInvoiceTax()
	{
		$this->invoiceTaxRate->create(Input::get('invoice_id'), Input::get('tax_rate_id'), Input::get('include_item_tax'), 0);

		\Event::fire('invoice.modified', Input::get('invoice_id'));
	}

	/**
	 * Deletes invoice tax
	 * @param  int $invoiceId
	 * @param  int $invoiceTaxRateId
	 * @return Redirect
	 */
	public function deleteInvoiceTax($invoiceId, $invoiceTaxRateId)
	{
		$this->invoiceTaxRate->delete($invoiceTaxRateId);

		\Event::fire('invoice.modified', $invoiceId);

		return Redirect::route('invoices.show', array($invoiceId));
	}

	/**
	 * Deletes a invoice
	 * @param  int
	 * @return Redirect
	 */
	public function delete($invoiceId)
	{
		$this->invoice->delete($invoiceId);

		return Redirect::route('invoices.index');
	}
	
}