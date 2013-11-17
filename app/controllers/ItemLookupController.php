<?php

use FI\Storage\Interfaces\ItemLookupRepositoryInterface;

class ItemLookupController extends \BaseController {

	protected $itemLookup;

	public function __construct(ItemLookupRepositoryInterface $itemLookup)
	{
		$this->itemLookup = $itemLookup;
	}
    
	public function modalAddLookupItem()
	{
		return View::make('item_lookups._modal_item_lookups')
		->with('items', $this->itemLookup->all());
	}

    public function process()
    {
    	$items = $this->itemLookup->getByIds(Input::get('item_lookup_ids'));

    	return $items;
    }

}