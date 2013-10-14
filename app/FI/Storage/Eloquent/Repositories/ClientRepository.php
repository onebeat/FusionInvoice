<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\Client;

class ClientRepository implements \FI\Storage\Interfaces\ClientRepositoryInterface {
	
	public function all()
	{
		return Client::all();
	}

	public function getPagedActive($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Client::orderBy('name')->where('active', 1)->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function getPagedInactive($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Client::orderBy('name')->where('active', 0)->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function getPagedAll($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Client::orderBy('name')->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function find($id)
	{
		return Client::find($id);
	}
	
	public function create($input)
	{
		Client::create($input);
	}
	
	public function update($input, $id)
	{
		$client = Client::find($id);
		$client->fill($input);
		$client->save();
	}
	
	public function delete($id)
	{
		Client::destroy($id);
	}
	
}