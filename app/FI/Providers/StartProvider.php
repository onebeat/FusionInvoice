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

class StartProvider extends ServiceProvider {

    public function register() {

        // Register the individual module providers here instead of the framework config
        // @TODO - Figure out how to get alias registration here as well
        $this->app->register('FI\Providers\ConfigProvider');
        $this->app->register('FI\Modules\Clients\Providers\ModuleProvider');
        $this->app->register('FI\Modules\CustomFields\Providers\ModuleProvider');
        $this->app->register('FI\Modules\Dashboard\Providers\ModuleProvider');
        $this->app->register('FI\Modules\InvoiceGroups\Providers\ModuleProvider');
        $this->app->register('FI\Modules\Invoices\Providers\ModuleProvider');
        $this->app->register('FI\Modules\ItemLookups\Providers\ModuleProvider');
        $this->app->register('FI\Modules\PaymentMethods\Providers\ModuleProvider');
        $this->app->register('FI\Modules\Payments\Providers\ModuleProvider');
        $this->app->register('FI\Modules\Quotes\Providers\ModuleProvider');
        $this->app->register('FI\Modules\Reports\Providers\ModuleProvider');
        $this->app->register('FI\Modules\Sessions\Providers\ModuleProvider');
        $this->app->register('FI\Modules\Settings\Providers\ModuleProvider');
        $this->app->register('FI\Modules\TaxRates\Providers\ModuleProvider');
        $this->app->register('FI\Modules\Users\Providers\ModuleProvider');

        $this->app->register('Profiler\ProfilerServiceProvider');

    }

}