<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(array('before' => 'auth'), function()
{
	Route::get('item_lookups', array('uses' => 'ItemLookupController@index', 'as' => 'itemLookups.index'));
	Route::get('item_lookups/create', array('uses' => 'ItemLookupController@create', 'as' => 'itemLookups.create'));
	Route::get('item_lookups/{itemLookup}/edit', array('uses' => 'ItemLookupController@edit', 'as' => 'itemLookups.edit'));
	Route::get('item_lookups/{itemLookup}/delete', array('uses' => 'ItemLookupController@delete', 'as' => 'itemLookups.delete'));
	Route::get('item_lookups/modal/add_lookup_item', array('uses' => 'ItemLookupController@modalAddLookupItem', 'as' => 'itemLookups.ajax.modalAddLookupItem'));

	Route::post('item_lookups', array('uses' => 'ItemLookupController@store', 'as' => 'itemLookups.store'));
	Route::post('item_lookups/{itemLookup}', array('uses' => 'ItemLookupController@update', 'as' => 'itemLookups.update'));
	Route::post('item_lookups/ajax/process', array('uses' => 'ItemLookupController@process', 'as' => 'itemLookups.ajax.process'));
});