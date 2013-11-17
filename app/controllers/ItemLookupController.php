<?php

use FI\Storage\Interfaces\ItemLookupRepositoryInterface;
use FI\Validators\ItemLookupValidator;

class ItemLookupController extends \BaseController {

	protected $itemLookup;
	protected $validator;

	public function __construct(ItemLookupRepositoryInterface $itemLookup, ItemLookupValidator $validator)
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
		->with('edit_mode', false);
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
			->with('edit_mode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->itemLookup->create($input);
		
		return Redirect::route('itemLookups.index')
		->with('alert_success', trans('fi.record_successfully_created'));
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
		->with(array('edit_mode' => true, 'itemLookup' => $itemLookup));
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
			->with('edit_mode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->itemLookup->update($input, $id);

		return Redirect::route('itemLookups.index')
		->with('alert_info', trans('fi.record_successfully_updated'));
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