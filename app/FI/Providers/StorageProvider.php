<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Providers;

use Illuminate\Support\ServiceProvider;

class StorageProvider extends ServiceProvider {

    /**
     * Register the service provider
     * @return void
     */
    public function register()
    {
    	$app = $this->app;

        $app->bind('ClientNoteRepository', 'FI\Storage\Eloquent\Repositories\ClientNoteRepository');
        $app->bind('ClientRepository', 'FI\Storage\Eloquent\Repositories\ClientRepository');
        $app->bind('ClientCustomRepository', 'FI\Storage\Eloquent\Repositories\ClientCustomRepository');
        $app->bind('CustomFieldRepository', 'FI\Storage\Eloquent\Repositories\CustomFieldRepository');
        $app->bind('InvoiceAmountRepository', 'FI\Storage\Eloquent\Repositories\InvoiceAmountRepository');
        $app->bind('InvoiceCustomRepository', 'FI\Storage\Eloquent\Repositories\InvoiceCustomRepository');
        $app->bind('InvoiceGroupRepository', 'FI\Storage\Eloquent\Repositories\InvoiceGroupRepository');
        $app->bind('InvoiceItemAmountRepository', 'FI\Storage\Eloquent\Repositories\InvoiceItemAmountRepository');
        $app->bind('InvoiceItemRepository', 'FI\Storage\Eloquent\Repositories\InvoiceItemRepository');
        $app->bind('InvoiceRepository', 'FI\Storage\Eloquent\Repositories\InvoiceRepository');
        $app->bind('InvoiceTaxRateRepository', 'FI\Storage\Eloquent\Repositories\InvoiceTaxRateRepository');
        $app->bind('ItemLookupRepository', 'FI\Storage\Eloquent\Repositories\ItemLookupRepository');
        $app->bind('ItemSalesReportRepository', 'FI\Storage\Eloquent\Repositories\ItemSalesReportRepository');
        $app->bind('PaymentCustomRepository', 'FI\Storage\Eloquent\Repositories\PaymentCustomRepository');
        $app->bind('PaymentMethodRepository', 'FI\Storage\Eloquent\Repositories\PaymentMethodRepository');
        $app->bind('PaymentRepository', 'FI\Storage\Eloquent\Repositories\PaymentRepository');
        $app->bind('PaymentsCollectedReportRepository', 'FI\Storage\Eloquent\Repositories\PaymentsCollectedReportRepository');
        $app->bind('QuoteAmountRepository', 'FI\Storage\Eloquent\Repositories\QuoteAmountRepository');
        $app->bind('QuoteCustomRepository', 'FI\Storage\Eloquent\Repositories\QuoteCustomRepository');
        $app->bind('QuoteItemAmountRepository', 'FI\Storage\Eloquent\Repositories\QuoteItemAmountRepository');
        $app->bind('QuoteItemRepository', 'FI\Storage\Eloquent\Repositories\QuoteItemRepository');
        $app->bind('QuoteRepository', 'FI\Storage\Eloquent\Repositories\QuoteRepository');
        $app->bind('QuoteTaxRateRepository', 'FI\Storage\Eloquent\Repositories\QuoteTaxRateRepository');
        $app->bind('RevenueByClientReportRepository', 'FI\Storage\Eloquent\Repositories\RevenueByClientReportRepository');
        $app->bind('SettingRepository', 'FI\Storage\Eloquent\Repositories\SettingRepository');
        $app->bind('TaxRateRepository', 'FI\Storage\Eloquent\Repositories\TaxRateRepository');
        $app->bind('TaxSummaryReportRepository', 'FI\Storage\Eloquent\Repositories\TaxSummaryReportRepository');
        $app->bind('UserRepository', 'FI\Storage\Eloquent\Repositories\UserRepository');
    }

}