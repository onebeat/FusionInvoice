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

class ControllerProvider extends ServiceProvider {

    /**
     * Register the service provider
     * @return void
     */
    public function register()
    {
    	$app = $this->app;

        $app->bind('ClientController', function($app)
        {
            return new \ClientController(
                $app->make('ClientRepository'),
                $app->make('ClientCustomRepository'),
                $app->make('CustomFieldRepository'),
                new \FI\Validators\ClientValidator
            );
        });

        $app->bind('CustomFieldController', function($app)
        {
            return new \CustomFieldController(
                $app->make('CustomFieldRepository'),
                new \FI\Validators\CustomFieldValidator
            );
        });

        $app->bind('DashboardController', function($app)
        {
            return new \DashboardController(
                $app->make('InvoiceRepository'),
                $app->make('QuoteRepository'),
                $app->make('InvoiceAmountRepository'),
                $app->make('QuoteAmountRepository')
            );
        });

        $app->bind('EmailTemplateController', function($app)
        {
            return new \EmailTemplateController(
                $app->make('EmailTemplateRepository'),
                new \FI\Validators\EmailTemplateValidator
            );
        });

        $app->bind('InvoiceController', function($app)
        {
            return new \InvoiceController(
                $app->make('CustomFieldRepository'),
                $app->make('InvoiceRepository'),
                $app->make('InvoiceCustomRepository'),
                $app->make('InvoiceGroupRepository'),
                $app->make('InvoiceItemRepository'),
                $app->make('InvoiceTaxRateRepository'),
                $app->make('TaxRateRepository'),
                new \FI\Validators\InvoiceValidator
            );
        });

        $app->bind('InvoiceGroupController', function($app)
        {
            return new \InvoiceGroupController(
                $app->make('InvoiceGroupRepository'),
                new \FI\Validators\InvoiceGroupValidator
            );
        });

        $app->bind('ItemLookupController', function($app)
        {
            return new \ItemLookupController(
                $app->make('ItemLookupRepository'),
                new \FI\Validators\ItemLookupValidator
            );
        });

        $app->bind('ItemSalesReportController', function($app)
        {
            return new \ItemSalesReportController(
                $app->make('ItemSalesReportRepository')
            );
        });

        $app->bind('PaymentController', function($app)
        {
            return new \PaymentController(
                $app->make('CustomFieldRepository'),
                $app->make('PaymentCustomRepository'),
                $app->make('PaymentMethodRepository'),
                $app->make('PaymentRepository'),
                new \FI\Validators\PaymentValidator
            );
        });

        $app->bind('PaymentMethodController', function($app)
        {
            return new \PaymentMethodController(
                $app->make('PaymentMethodRepository'),
                new \FI\Validators\PaymentMethodValidator
            );
        });

        $app->bind('PaymentsCollectedReportController', function($app)
        {
            return new \PaymentsCollectedReportController(
                $app->make('PaymentsCollectedReportRepository')
            );
        });

        $app->bind('PublicInvoiceController', function($app)
        {
            return new \PublicInvoiceController(
                $app->make('InvoiceRepository')
            );
        });

        $app->bind('PublicQuoteController', function($app)
        {
            return new \PublicQuoteController(
                $app->make('QuoteRepository')
            );
        });

        $app->bind('QuoteController', function($app)
        {
            return new \QuoteController(
                $app->make('CustomFieldRepository'),
                $app->make('InvoiceGroupRepository'),
                $app->make('QuoteCustomRepository'),
                $app->make('QuoteItemRepository'),
                $app->make('QuoteRepository'),
                $app->make('QuoteTaxRateRepository'),
                $app->make('TaxRateRepository'),
                new \FI\Validators\QuoteValidator
            );
        });

        $app->bind('RevenueByClientReportController', function($app)
        {
            return new \RevenueByClientReportController(
                $app->make('RevenueByClientReportRepository')
            );
        });

        $app->bind('SessionController', function($app)
        {
            return new \SessionController(
                new \FI\Validators\SessionValidator
            );
        });

        $app->bind('SettingController', function($app)
        {
            return new \SettingController(
                $app->make('SettingRepository'),
                $app->make('EmailTemplateRepository'),
                $app->make('InvoiceGroupRepository'),
                $app->make('TaxRateRepository')
            );
        });

        $app->bind('TaxRateController', function($app)
        {
            return new \TaxRateController(
                $app->make('TaxRateRepository'),
                new \FI\Validators\TaxRateValidator
            );
        });

        $app->bind('TaxSummaryReportController', function($app)
        {
            return new \TaxSummaryReportController(
                $app->make('TaxSummaryReportRepository')
            );
        });

        $app->bind('UserController', function($app)
        {
            return new \UserController(
                $app->make('UserRepository'),
                new \FI\Validators\UserValidator
            );
        });

    }

}