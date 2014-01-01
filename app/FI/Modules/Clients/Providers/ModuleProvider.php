<?php namespace FI\Modules\Clients\Providers;

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
        $this->app->bind('ClientRepository', 'FI\Modules\Clients\Repositories\ClientRepository');
        $this->app->bind('ClientNoteRepository', 'FI\Modules\Clients\Repositories\ClientNoteRepository');

        $this->app->bind('ClientController', function($app)
        {
            return new \FI\Modules\Clients\Controllers\ClientController(
                $app->make('ClientRepository'),
                $app->make('ClientCustomRepository'),
                $app->make('CustomFieldRepository'),
                new \FI\Validators\ClientValidator
            );
        });
	}

}