<?php

use FI\Storage\Interfaces\ClientRepositoryInterface;
use FI\Validators\ClientNoteValidator;
use FI\Validators\ClientValidator;

class ClientController extends \BaseController {
	
	protected $client;
	protected $validator;
	
	public function __construct(ClientRepositoryInterface $client, ClientValidator $validator)
	{
		$this->client    = $client;
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
	 * @param  int $clientId
	 * @return \Illuminate\View\View
	 */
	public function show($clientId)
	{
		$client      = $this->client->find($clientId);
		$clientNotes = $client->notes;

		return View::make('clients.view')
		->with('client', $client)
		->with('clientNotes', $clientNotes);
	}

	/**
	 * Display form for existing record
	 * @param  int $clientId
	 * @return \Illuminate\View\View
	 */
	public function edit($clientId)
	{
		$client = $this->client->find($clientId);
		
		return View::make('clients.form')
		->with(array('editMode' => true, 'client' => $client));
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $clientId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($clientId)
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{	
			return Redirect::route('clients.edit', array($clientId))
			->with('editMode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$this->client->update($input, $clientId);

		return Redirect::route('clients.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));;
	}

	/**
	 * Delete a record
	 * @param  int $clientId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($clientId)
	{
		$this->client->delete($clientId);

		return Redirect::route('clients.index')
		->with('alert', trans('fi.record_successfully_deleted'));;
	}

	public function ajaxNameLookup()
	{
		return $this->client->lookupByName(Input::get('query'));
	}

	public function ajaxSaveNote()
	{
		$clientNote = App::make('FI\Storage\Interfaces\ClientNoteRepositoryInterface');
		$input      = Input::all();
		$validator  = new ClientNoteValidator;

		if (!$validator->validate($input))
		{
			return json_encode(array('success' => 0, 'message' => $validator->errors()->first()));
		}

		$clientNote->create($input);

		return json_encode(array('success', 1));
	}

	public function ajaxLoadNotes()
	{
		$clientNote = App::make('FI\Storage\Interfaces\ClientNoteRepositoryInterface');

		$clientNotes = $clientNote->getForClient(Input::get('client_id'));

		return View::make('clients._notes')
		->with('clientNotes', $clientNotes);
	}

}