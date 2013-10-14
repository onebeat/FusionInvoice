<?php namespace FI\Storage\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class StorageServiceProviders extends ServiceProvider {

    /**
     * Register Storage app bindings
     *
     * @return void
     */
    public function register()
    {
    	$app = $this->app;

        $app->bind('FI\Storage\ClientNoteRepositoryInterface', 'FI\Storage\Eloquent\Repositories\ClientNoteRepository');
    	$app->bind('FI\Storage\ClientRepositoryInterface', 'FI\Storage\Eloquent\Repositories\ClientRepository');
        $app->bind('FI\Storage\InvoiceAmountRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceAmountRepository');
        $app->bind('FI\Storage\InvoiceGroupRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceGroupRepository');
        $app->bind('FI\Storage\InvoiceItemAmountRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceItemAmountRepository');
        $app->bind('FI\Storage\InvoiceItemRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceItemRepository');
        $app->bind('FI\Storage\InvoiceRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceRepository');
        $app->bind('FI\Storage\InvoiceTaxRateRepositoryInterface', 'FI\Storage\Eloquent\Repositories\InvoiceTaxRateRepository');
        $app->bind('FI\Storage\ItemLookupRepositoryInterface', 'FI\Storage\Eloquent\Repositories\ItemLookupRepository');
        $app->bind('FI\Storage\PaymentMethodRepositoryInterface', 'FI\Storage\Eloquent\Repositories\PaymentMethodRepository');
        $app->bind('FI\Storage\PaymentRepositoryInterface', 'FI\Storage\Eloquent\Repositories\PaymentRepository');
        $app->bind('FI\Storage\QuoteAmountRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteAmountRepository');
        $app->bind('FI\Storage\QuoteItemAmountRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteItemAmountRepository');
        $app->bind('FI\Storage\QuoteItemRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteItemRepository');
        $app->bind('FI\Storage\QuoteRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteRepository');
        $app->bind('FI\Storage\QuoteTaxRateRepositoryInterface', 'FI\Storage\Eloquent\Repositories\QuoteTaxRateRepository');
        $app->bind('FI\Storage\SettingRepositoryInterface', 'FI\Storage\Eloquent\Repositories\SettingRepository');
        $app->bind('FI\Storage\TaxRateRepositoryInterface', 'FI\Storage\Eloquent\Repositories\TaxRateRepository');
        $app->bind('FI\Storage\UserRepositoryInterface', 'FI\Storage\Eloquent\Repositories\UserRepository');
    }

}