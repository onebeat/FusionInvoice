<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get('login', array('uses' => 'SessionController@login', 'as' => 'session.login'));
Route::post('login', array('uses' => 'SessionController@attempt', 'as' => 'session.attempt'));
Route::get('logout', array('uses' => 'SessionController@logout', 'as' => 'session.logout'));