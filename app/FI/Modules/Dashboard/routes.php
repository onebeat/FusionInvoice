<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('/', 'DashboardController@index');
	Route::get('dashboard', array('uses' => 'DashboardController@index', 'as' => 'dashboard.index'));
});