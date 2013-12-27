<?php

use FI\Classes\NumberFormatter;

class ItemLookupController extends \BaseController {

	protected $itemLookup;
	protected $validator;

	public function __construct($itemLookup, $validator)
	{
		$this->itemLookup = $itemLookup;
		$this->validator = $validator;
	}

	/**
	 * Display paginated list
	 * @return View
	 */
	public function index()
	{
		$itemLookups = $this->itemLookup->getPaged(Input::get('page'));

		return View::make('item_lookups.index')
		->with('itemLookups', $itemLookups);
	}

	/**
	 * Display form for new record
	 * @return View
	 */
	public function create()
	{
		return View::make('item_lookups.form')
		->with('editMode', false);
	}

	/**
	 * Validate and handle new record form submission
	 * @return RedirectResponse
	 */
	public function store()
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{
			return Redirect::route('itemLookups.create')
			->with('editMode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}
        
        $input['price'] = NumberFormatter::unformat($input['price']);

		$this->itemLookup->create($input);
		
		return Redirect::route('itemLookups.index')
		->with('alertSuccess', trans('fi.record_successfully_created'));
	}

	/**
	 * Display form for existing record
	 * @param  int $id
	 * @return View
	 */
	public function edit($id)
	{
		$itemLookup = $this->itemLookup->find($id);
		
		return View::make('item_lookups.form')
		->with(array('editMode' => true, 'itemLookup' => $itemLookup));
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $id
	 * @return RedirectResponse
	 */
	public function update($id)
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{
			return Redirect::route('itemLookups.edit', array($id))
			->with('editMode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}
        
        $input['price'] = NumberFormatter::unformat($input['price']);

		$this->itemLookup->update($input, $id);

		return Redirect::route('itemLookups.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return RedirectResponse
	 */
	public function delete($id)
	{
		$this->itemLookup->delete($id);

		return Redirect::route('itemLookups.index')
		->with('alert', trans('fi.record_successfully_deleted'));
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