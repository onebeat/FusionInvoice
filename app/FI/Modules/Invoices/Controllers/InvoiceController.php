<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Controllers;

use App;
use Auth;
use Config;
use Event;
use Input;
use Mail;
use Redirect;
use View;

use FI\Classes\Date;
use FI\Classes\NumberFormatter;
use FI\Statuses\InvoiceStatuses;

class InvoiceController extends \BaseController {

	/**
	 * Invoice repository
	 * @var InvoiceRepository
	 */
	protected $invoice;

	/**
	 * Invoice group repository
	 * @var InvoiceGroupRepository
	 */
	protected $invoiceGroup;

	/**
	 * Invoice item repository
	 * @var InvoiceItemRepository
	 */
	protected $invoiceItem;

	/**
	 * Invoice tax rate repository
	 * @var InvoiceTaxRateRepository
	 */
	protected $invoiceTaxRate;

	/**
	 * Invoice validator
	 * @var InvoiceValidator
	 */
	protected $validator;
	
	/**
	 * Dependency injection
	 * @param InvoiceRepository $invoice
	 * @param InvoiceGroupRepository $invoiceGroup
	 * @param InvoiceItemRepository $invoiceItem
	 * @param InvoiceTaxRateRepository $invoiceTaxRate
	 * @param InvoiceValidator $validator
	 */
	public function __construct($invoice, $invoiceGroup, $invoiceItem, $invoiceTaxRate, $validator)
	{
		$this->invoice        = $invoice;
		$this->invoiceGroup   = $invoiceGroup;
		$this->invoiceItem    = $invoiceItem;
		$this->invoiceTaxRate = $invoiceTaxRate;
		$this->validator      = $validator;
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
	 * @return json
	 */
	public function store()
	{
		$client = App::make('ClientRepository');

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
			'client_id'         => $clientId,
			'created_at'        => Date::unformat(Input::get('created_at')),
			'due_at'            => Date::incrementDateByDays(Input::get('created_at'), Config::get('fi.invoicesDueAfter')),
			'invoice_group_id'  => Input::get('invoice_group_id'),
			'number'            => $this->invoiceGroup->generateNumber(Input::get('invoice_group_id')),
			'user_id'           => Auth::user()->id,
			'invoice_status_id' => 1,
			'url_key'           => str_random(32),
			'terms'             => Config::get('fi.invoiceTerms'),
			'footer'            => Config::get('fi.invoiceFooter')
		);

		$invoiceId = $this->invoice->create($input);

		return json_encode(array('success' => 1, 'id' => $invoiceId));
	}

	/**
	 * Accept post data to update invoice
	 * @param  int $id
	 * @return json
	 */
	public function update($id)
	{
		if (!$this->validator->validate(Input::all(), 'updateRules'))
		{
			return json_encode(array('success' => 0, 'message' => $this->validator->errors()->first()));
		}

		$itemValidator = App::make('InvoiceItemValidator');

		if (!$itemValidator->validateMulti(json_decode(Input::get('items'))))
		{
			return json_encode(array('success' => 0, 'message' => $itemValidator->errors()->first()));
		}

		$input  = Input::all();

		$custom = (array) json_decode($input['custom']);
		unset($input['custom']);

		$invoice = array(
			'number'            => $input['number'],
			'created_at'        => Date::unformat($input['created_at']),
			'due_at'            => Date::unformat($input['due_at']),
			'invoice_status_id' => $input['invoice_status_id'],
			'terms'             => $input['terms'],
			'footer'            => $input['footer']
		);

		$this->invoice->update($invoice, $id);

		App::make('InvoiceCustomRepository')->save($custom, $id);

		$items = json_decode(Input::get('items'));

		foreach ($items as $item)
		{
			if ($item->item_name)
			{
				$itemRecord = array(
					'invoice_id'    => $item->invoice_id,
					'name'          => $item->item_name,
					'description'   => $item->item_description,
					'quantity'      => NumberFormatter::unformat($item->item_quantity),
					'price'         => NumberFormatter::unformat($item->item_price),
					'tax_rate_id'   => $item->item_tax_rate_id,
					'display_order' => $item->item_order
				);

				if (!$item->item_id)
				{
					$this->invoiceItem->create($itemRecord);
				}
				else
				{
					$this->invoiceItem->update($itemRecord, $item->item_id);
				}

				if (isset($item->save_item_as_lookup) and $item->save_item_as_lookup)
				{
					$itemLookupRecord = array(
						'name'        => $item->item_name,
						'description' => $item->item_description,
						'price'       => $item->item_price
					);

					App::make('ItemLookupRepository')->create($itemLookupRecord);
				}
			}
		}

		Event::fire('invoice.modified', $id);

		return json_encode(array('success' => 1));
	}

	/**
	 * Display the invoice
	 * @param  int $id
	 * @return View
	 */
	public function show($id)
	{
		return View::make('invoices.show')
		->with('invoice', $this->invoice->find($id))
		->with('statuses', InvoiceStatuses::lists())
		->with('taxRates', App::make('TaxRateRepository')->lists())
		->with('invoiceTaxRates', $this->invoiceTaxRate->findByInvoiceId($id))
		->with('customFields', App::make('CustomFieldRepository')->getByTable('invoices'));
	}

	/**
	 * Displays the invoice in preview format
	 * @param  int $id
	 * @return View
	 */
	public function preview($id)
	{
		return View::make('templates.invoices.' . str_replace('.blade.php', '', Config::get('fi.invoiceTemplate')))
		->with('invoice', $this->invoice->find($id));
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
		$taxRates = App::make('TaxRateRepository')->lists();

		unset($taxRates[0]);

		return View::make('invoices._modal_add_invoice_tax')
		->with('invoice_id', Input::get('invoice_id'))
		->with('taxRates', $taxRates);
	}

	/**
	 * Saves invoice tax from ajax request
	 */
	public function saveInvoiceTax()
	{
		$this->invoiceTaxRate->create(array(
			'invoice_id'       => Input::get('invoice_id'),
			'tax_rate_id'      => Input::get('tax_rate_id'),
			'include_item_tax' => Input::get('include_item_tax')
			)
		);
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

		return Redirect::route('invoices.show', array($invoiceId));
	}

	/**
	 * Deletes a invoice
	 * @param  int $id
	 * @return Redirect
	 */
	public function delete($id)
	{
		$this->invoice->delete($id);

		return Redirect::route('invoices.index');
	}

	/**
	 * Displays modal to copy invoice
	 * @return View
	 */
	public function modalCopyInvoice()
	{
		$invoice = $this->invoice->find(Input::get('invoice_id'));

		return View::make('invoices._modal_copy_invoice')
		->with('invoice', $invoice)
		->with('invoiceGroups', $this->invoiceGroup->lists())
		->with('created_at', Date::format())
		->with('user_id', Auth::user()->id);
	}

	/**
	 * Attempt to copy an invoice
	 * @return Redirect
	 */
	public function copyInvoice()
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

		$invoiceId = $this->invoice->create(
			array(
				'client_id'         => $clientId,
				'created_at'        => Date::unformat(Input::get('created_at')),
				'due_at'            => Date::incrementDateByDays(Input::get('created_at'), Config::get('fi.invoicesDueAfter')),
				'invoice_group_id'  => Input::get('invoice_group_id'),
				'number'            => $this->invoiceGroup->generateNumber(Input::get('invoice_group_id')),
				'user_id'           => Auth::user()->id,
				'invoice_status_id' => 1,
				'url_key'           => str_random(32)
			)
		);		

		$items = $this->invoiceItem->findByInvoiceId(Input::get('invoice_id'));

		foreach ($items as $item)
		{
			$this->invoiceItem->create(
				array(
					'invoice_id'    => $invoiceId,
					'name'          => $item->name,
					'description'   => $item->description,
					'quantity'      => $item->quantity,
					'price'         => $item->price,
					'tax_rate_id'   => $item->tax_rate_id,
					'display_order' => $item->display_order
				)
			);
		}

		$invoiceTaxRates = $this->invoiceTaxRate->findByInvoiceId(Input::get('invoice_id'));

		foreach ($invoiceTaxRates as $invoiceTaxRate)
		{
			$this->invoiceTaxRate->create(
				array(
					'invoice_id'       => $invoiceId,
					'tax_rate_id'      => $invoiceTaxRate->tax_rate_id,
					'include_item_tax' => $invoiceTaxRate->include_item_tax,
					'tax_total'        => $invoiceTaxRate->tax_total
				)
			);
		}

		Event::fire('invoice.modified', $invoiceId);

		return json_encode(array('success' => 1, 'id' => $invoiceId));
	}

	/**
	 * Display the modal to send mail
	 * @return View
	 */
	public function modalMailInvoice()
	{
		$invoice = $this->invoice->find(Input::get('invoice_id'));

		return View::make('invoices._modal_mail')
		->with('invoiceId', $invoice->id)
		->with('redirectTo', Input::get('redirectTo'))
		->with('to', $invoice->client->email)
		->with('cc', \Config::get('fi.mailCcDefault'))
		->with('subject', trans('fi.invoice') . ' #' . $invoice->number);
	}

	/**
	 * Attempt to send the mail
	 * @return json
	 */
	public function mailInvoice()
	{
		$invoice = $this->invoice->find(Input::get('invoice_id'));

		try
		{
			$template = ($invoice->is_overdue) ? 'templates.emails.invoice_overdue' : 'templates.emails.invoice';

			Mail::send($template, array('invoice' => $invoice), function($message) use ($invoice)
			{
				$message->from($invoice->user->email)
				->to(Input::get('to'), $invoice->client->name)
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