<?php namespace FI\Providers;

use Illuminate\Support\ServiceProvider;

class SettingProvider extends ServiceProvider {

    /**
     * Do nothing...
     * @return void
     */
    public function register() {}

    /**
     * Register the system settings
     * @return void
     */
    public function boot()
    {
        \App::before(function($request)
        {
            $settings = \App::make('SettingRepository');
            $settings->setAll();

            $dateFormats = \FI\Classes\Date::formats();
            \Config::set('fi.datepickerFormat', $dateFormats[\Config::get('fi.dateFormat')]['datepicker']);

            date_default_timezone_set((\Config::get('fi.timezone') ?: \Config::get('app.timezone')));
        });
    }

}