<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteAmount;

class QuoteAmountRepository implements \FI\Storage\Interfaces\QuoteAmountRepositoryInterface {
	
	public function find($id)
	{
		return QuoteAmount::find($id);
	}
	
	public function create($input)
	{
		QuoteAmount::create($input);
	}
	
	public function update($input, $id)
	{
		$quoteAmount = QuoteAmount::find($id);
		$quoteAmount->fill($input);
		$quoteAmount->save();
	}
	
	public function delete($id)
	{
		QuoteAmount::destroy($id);
	}
	
}