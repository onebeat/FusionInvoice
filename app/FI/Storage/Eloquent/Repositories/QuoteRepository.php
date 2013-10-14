<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\Quote;

class QuoteRepository implements \FI\Storage\Interfaces\QuoteRepositoryInterface {
	
	public function all()
	{
		return Quote::all();
	}

	public function getPaged($page = 1, $numPerPage = 15)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Quote::paginate($numPerPage);
	}

	public function find($id)
	{
		return Quote::find($id);
	}
	
	public function create($input)
	{
		Quote::create($input);
	}
	
	public function update($input, $id)
	{
		$quote = Quote::find($id);
		$quote->fill($input);
		$quote->save();
	}
	
	public function delete($id)
	{
		Quote::destroy($id);
	}
	
}