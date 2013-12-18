<?php namespace FI\Providers;

use Illuminate\Support\ServiceProvider;

class StartProvider extends ServiceProvider {

    public function boot()
    {
        \App::before(function($request)
        {
            $settings = \App::make('FI\Storage\Interfaces\SettingRepositoryInterface');
            $settings->setAll();

            $dateFormats = \FI\Classes\Date::formats();
            \Config::set('fi.datepickerFormat', $dateFormats[\Config::get('fi.dateFormat')]['datepicker']);
        });
    }

    /**
     * Register app bindings
     *
     * @return void
     */
    public function register()
    {
    	$app = $this->app;

        /**
         * Storage Bindings
         */
        $app->bind('FI\Storage\Interfaces\ClientNoteRepositoryInterface', 'FI\Storage\Eloquent\Repositories\ClientNoteRepository');
        $app->bind('FI\Storage\Interfaces\ClientRepositoryInterface', 'FI\Storage\Eloquent\Repositories\ClientRepository');
        $app->bind('FI\Storage\Interfaces\CustomFieldRepositoryInterface', 'FI\Storage\Eloquent\Repositories\CustomFieldRepository');
        $app->bind('FI\Storage\Interfaces\EmailTemplateRepositoryInterface', 'FI\Storage\Eloquent\Repositories\EmailTemplateRepository');
        $app->bind('FI\Storage\Interfaces\InvoiceAmountRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceAmountRepository');
        $app->bind('FI\Storage\Interfaces\InvoiceGroupRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceGroupRepository');
        $app->bind('FI\Storage\Interfaces\InvoiceItemAmountRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceItemAmountRepository');
        $app->bind('FI\Storage\Interfaces\InvoiceItemRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceItemRepository');
        $app->bind('FI\Storage\Interfaces\InvoiceRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceRepository');
        $app->bind('FI\Storage\Interfaces\InvoiceTaxRateRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceTaxRateRepository');
        $app->bind('FI\Storage\Interfaces\ItemLookupRepositoryInterface', 'FI\Storage\Eloquent\Repositories\ItemLookupRepository');
        $app->bind('FI\Storage\Interfaces\PaymentMethodRepositoryInterface', 'FI\Storage\Eloquent\Repositories\PaymentMethodRepository');
        $app->bind('FI\Storage\Interfaces\PaymentRepositoryInterface', 'FI\Storage\Eloquent\Repositories\PaymentRepository');
        $app->bind('FI\Storage\Interfaces\QuoteAmountRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteAmountRepository');
        $app->bind('FI\Storage\Interfaces\QuoteItemAmountRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteItemAmountRepository');
        $app->bind('FI\Storage\Interfaces\QuoteItemRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteItemRepository');
        $app->bind('FI\Storage\Interfaces\QuoteRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteRepository');
        $app->bind('FI\Storage\Interfaces\QuoteTaxRateRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteTaxRateRepository');
        $app->bind('FI\Storage\Interfaces\SettingRepositoryInterface', 'FI\Storage\Eloquent\Repositories\SettingRepository');
        $app->bind('FI\Storage\Interfaces\TaxRateRepositoryInterface', 'FI\Storage\Eloquent\Repositories\TaxRateRepository');
        $app->bind('FI\Storage\Interfaces\UserRepositoryInterface', 'FI\Storage\Eloquent\Repositories\UserRepository');
    }

}