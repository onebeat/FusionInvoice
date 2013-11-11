<?php

use FI\Classes\Languages;
use FI\Classes\Date;
use FI\Classes\Email;
use FI\Quotes\QuoteTemplates;
use FI\Invoices\InvoiceTemplates;
use FI\Storage\Interfaces\SettingRepositoryInterface as Settings;
use FI\Storage\Interfaces\EmailTemplateRepositoryInterface as EmailTemplates;
use FI\Storage\Interfaces\InvoiceGroupRepositoryInterface as InvoiceGroups;
use FI\Storage\Interfaces\TaxRateRepositoryInterface as TaxRates;

class SettingController extends BaseController {

	protected $settings;
	protected $emailTemplates;
	protected $invoiceGroups;
	protected $taxRates;

	public function __construct(
		Settings $settings, 
		EmailTemplates $emailTemplates, 
		InvoiceGroups $invoiceGroups,
		TaxRates $taxRates)
	{
		$this->settings       = $settings;
		$this->emailTemplates = $emailTemplates;
		$this->invoiceGroups  = $invoiceGroups;
		$this->taxRates       = $taxRates;
	}
	
	/**
	 * Displays the settings
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$languages                = Languages::listLanguages();
		$currencySymbolPlacements = array('before' => trans('fi.before_amount'), 'after' => trans('fi.after_amount'));
		$taxRateDecimalPlaces     = array('2' => '2', '3' => '3');
		$dateFormats              = Date::dropdownArray();
		$invoiceTemplates         = InvoiceTemplates::lists();
		$quoteTemplates           = QuoteTemplates::lists();
		$emailTemplates           = $this->emailTemplates->lists();
		$invoiceGroups            = $this->invoiceGroups->lists();
		$taxRates                 = $this->taxRates->lists();
		$emailSendMethods         = Email::listSendMethods();
		$emailEncryptions         = Email::listEncryptions();
		$yesNoArray               = array('0' => trans('fi.no'), '1' => trans('fi.yes'));



		return View::make('settings.index')
		->with(array(
			'languages'                => $languages,
			'currencySymbolPlacements' => $currencySymbolPlacements,
			'taxRateDecimalPlaces'     => $taxRateDecimalPlaces,
			'dateFormats'              => $dateFormats,
			'invoiceTemplates'         => $invoiceTemplates,
			'quoteTemplates'           => $quoteTemplates,
			'emailTemplates'           => $emailTemplates,
			'invoiceGroups'            => $invoiceGroups,
			'taxRates'                 => $taxRates,
			'emailSendMethods'         => $emailSendMethods,
			'emailEncryptions'         => $emailEncryptions,
			'yesNoArray'               => $yesNoArray
		));
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