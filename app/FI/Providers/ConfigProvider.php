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

class ConfigProvider extends ServiceProvider {

    /**
     * Register the service provider
     * @return void
     */
    public function register() {}

    /**
     * Bootstrap the application events
     * @return void
     */
    public function boot()
    {
        \App::before(function($request)
        {
            // Set the application specific settings under fi. prefix (fi.settingName)
            $settings = \App::make('SettingRepository');
            $settings->setAll();

            // This one needs a little special attention
            $dateFormats = \FI\Classes\Date::formats();
            \Config::set('fi.datepickerFormat', $dateFormats[\Config::get('fi.dateFormat')]['datepicker']);

            // Set the environment timezone to the application specific timezone, if available, otherwise UTC
            date_default_timezone_set((\Config::get('fi.timezone') ?: \Config::get('app.timezone')));

            // Override the framework mail configuration with the values provided by the application
            \Config::set('mail', array(
                'driver'     => \Config::get('fi.mailDriver'),
                'host'       => \Config::get('fi.mailHost'),
                'port'       => \Config::get('fi.mailPort'),
                'encryption' => \Config::get('fi.mailEncryption'),
                'username'   => \Config::get('fi.mailUsername'),
                'password'   => (\Config::get('fi.mailPassword')) ? \Crypt::decrypt(\Config::get('fi.mailPassword')) : '',
                'sendmail'   => \Config::get('fi.mailSendmail')
                )
            );
        });
    }

}