<?php namespace FI\Modules\Reports\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider {

	public function boot()
	{
		// Bring in the routes
		require __DIR__ . '/../routes.php';

		// Register the view path
		$viewPaths = \Config::get('view.paths');
		$viewPaths[] = __DIR__ . '/../Views';
		\Config::set('view.paths', $viewPaths);
	}

	public function register()
	{
        $this->app->bind('ItemSalesReportRepository', 'FI\Modules\Reports\Repositories\ItemSalesReportRepository');
        $this->app->bind('PaymentsCollectedReportRepository', 'FI\Modules\Reports\Repositories\PaymentsCollectedReportRepository');
        $this->app->bind('RevenueByClientReportRepository', 'FI\Modules\Reports\Repositories\RevenueByClientReportRepository');
        $this->app->bind('TaxSummaryReportRepository', 'FI\Modules\Reports\Repositories\TaxSummaryReportRepository');

        $this->app->bind('ItemSalesReportController', function($app)
        {
            return new \FI\Modules\Reports\Controllers\ItemSalesReportController(
                $app->make('ItemSalesReportRepository')
            );
        });

        $this->app->bind('PaymentsCollectedReportController', function($app)
        {
            return new \FI\Modules\Reports\Controllers\PaymentsCollectedReportController(
                $app->make('PaymentsCollectedReportRepository')
            );
        });

        $this->app->bind('RevenueByClientReportController', function($app)
        {
            return new \FI\Modules\Reports\Controllers\RevenueByClientReportController(
                $app->make('RevenueByClientReportRepository')
            );
        });

        $this->app->bind('TaxSummaryReportController', function($app)
        {
            return new \FI\Modules\Reports\Controllers\TaxSummaryReportController(
                $app->make('TaxSummaryReportRepository')
            );
        });
	}

}