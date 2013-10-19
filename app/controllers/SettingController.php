<?php

use FI\Libraries\Languages;
use FI\Libraries\Date;
use FI\Libraries\Templates;
use FI\Storage\Interfaces\SettingRepositoryInterface as Settings;
use FI\Storage\Interfaces\EmailTemplateRepositoryInterface as EmailTemplates;
use FI\Storage\Interfaces\InvoiceGroupRepositoryInterface as InvoiceGroups;

class SettingController extends BaseController {

	protected $settings;
	protected $emailTemplates;
	protected $invoiceGroups;

	public function __construct(Settings $settings, EmailTemplates $emailTemplates, InvoiceGroups $invoiceGroups)
	{
		$this->settings       = $settings;
		$this->emailTemplates = $emailTemplates;
		$this->invoiceGroups  = $invoiceGroups;
	}
	
	/**
	 * Displays the settings
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$languages                = Languages::listLanguages();
		$currencySymbolPlacements = ['before' => trans('fi.before_amount'), 'after' => trans('fi.after_amount')];
		$taxRateDecimalPlaces     = ['2' => '2', '3' => '3'];
		$dateFormats              = Date::dropdownArray();
		$invoicePdfTemplates      = Templates::listInvoicePdfTemplates();
		$invoicePublicTemplates   = Templates::listInvoicePublicTemplates();
		$quotePdfTemplates        = Templates::listQuotePdfTemplates();
		$quotePublicTemplates     = Templates::listQuotePublicTemplates();
		$emailTemplates           = $this->emailTemplates->lists('name', 'id');
		$invoiceGroups            = $this->invoiceGroups->lists('name', 'id');

		return View::make('settings.index')
		->with([
			'languages'                => $languages,
			'currencySymbolPlacements' => $currencySymbolPlacements,
			'taxRateDecimalPlaces'     => $taxRateDecimalPlaces,
			'dateFormats'              => $dateFormats,
			'invoicePdfTemplates'      => $invoicePdfTemplates,
			'invoicePublicTemplates'   => $invoicePublicTemplates,
			'quotePdfTemplates'        => $quotePdfTemplates,
			'quotePublicTemplates'     => $quotePublicTemplates,
			'emailTemplates'           => $emailTemplates,
			'invoiceGroups'            => $invoiceGroups
		]);
	}

	/**
	 * Handle setting form submission
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update()
	{
		$this->settings->save(Input::all());

		return Redirect::route('settings.index')
		->with('alert_success', trans('fi.settings_successfully_saved'));
	}

}