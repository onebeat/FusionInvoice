<?php

use FI\Storage\Interfaces\ClientRepositoryInterface;
use FI\Validators\ClientValidator;

class ClientController extends \BaseController {
	
	protected $client;
	protected $validator;
	
	public function __construct(ClientRepositoryInterface $client, ClientValidator $validator)
	{
		$this->client = $client;
		$this->validator = $validator;
	}

	/**
	 * Display paginated list
	 * @param  string $status
	 * @return \Illuminate\View\View
	 */
	public function index($status = 'active')
	{
		switch ($status)
		{
			case 'active':
				$clients = $this->client->getPagedActive(Input::get('page'));
			break;
			case 'inactive':
				$clients = $this->client->getPagedInactive(Input::get('page'));
			break;
			default:
				$clients = $this->client->getPagedAll(Input::get('page'));
		}
		
		return View::make('clients.index')
		->with(array('clients' => $clients, 'status' => $status));
	}

	/**
	 * Display form for new record
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return View::make('clients.form')
		->with('editMode', false);
	}

	/**
	 * Validate and handle new record form submission
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{
			return Redirect::route('clients.create')
			->with('editMode', false)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->client->create($input);
		
		return Redirect::route('clients.index')
		->with('alertSuccess', trans('fi.record_successfully_created'));
	}

	/**
	 * Display a single record
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function show($id)
	{
		return View::make('clients.view')
		->with('client', $this->client->find($id));
	}

	/**
	 * Display form for existing record
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$client = $this->client->find($id);
		
		return View::make('clients.form')
		->with(array('editMode' => true, 'client' => $client));
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{	
			return Redirect::route('clients.edit', array($id))
			->with('editMode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->client->update($input, $id);

		return Redirect::route('clients.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));;
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$this->client->delete($id);

		return Redirect::route('clients.index')
		->with('alert', trans('fi.record_successfully_deleted'));;
	}

	public function ajaxNameLookup()
	{
		return $this->client->lookupByName(Input::get('query'));
	}

}