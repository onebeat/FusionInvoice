<?php namespace FI\Classes;

class QuoteAmounts {

	protected $quoteId;
	protected $quoteItems = array();
	protected $quoteTaxRates = array();
	
	protected $calculatedItemAmounts = array();
	protected $calculatedQuoteTaxRates = array();
	protected $calculatedQuoteAmount = array();

	public function __construct()
	{
		$this->calculatedQuoteAmount = array(
			'item_subtotal'  => 0,
			'item_tax_total' => 0,
			'tax_total'      => 0,
			'total'          => 0
			);
	}

	/**
	 * Sets the quote id
	 * @param int $quoteId
	 */
	public function setQuoteId($quoteId)
	{
		$this->quoteId = $quoteId;
	}

	/**
	 * Adds a quote item for calculation
	 * @param int $itemId
	 * @param float $quantity       [description]
	 * @param float $price          [description]
	 * @param float $taxRatePercent [description]
	 */
	public function addQuoteItem($itemId, $quantity, $price, $taxRatePercent)
	{
		$this->quoteItems[] = array(
			'itemId'         => $itemId,
			'quantity'       => $quantity,
			'price'          => $price,
			'taxRatePercent' => $taxRatePercent
		);
	}

	/**
	 * Adds a quote tax rate for calculation
	 * @param int $taxRateId
	 * @param float $taxRatePercent
	 * @param int $includeItemTax
	 */
	public function addQuoteTaxRate($taxRateId, $taxRatePercent, $includeItemTax)
	{
		$this->quoteTaxRates[] = array(
			'taxRateId'      => $taxRateId,
			'taxRatePercent' => $taxRatePercent,
			'includeItemTax' => $includeItemTax
		);
	}

	/**
	 * Call the calculation methods
	 */
	public function calculate()
	{
		$this->calculateQuoteItems();
		$this->calculateQuoteTaxRates();
	}

	/**
	 * Returns calculated item amounts
	 * @return array
	 */
	public function getCalculatedItemAmounts()
	{
		return $this->calculatedItemAmounts;
	}

	/**
	 * Returns calculated quote tax rates
	 * @return array
	 */
	public function getCalculatedQuoteTaxRates()
	{
		return $this->calculatedQuoteTaxRates;
	}

	/**
	 * Returns overall calculated quote amount
	 * @return array
	 */
	public function getCalculatedQuoteAmount()
	{
		return $this->calculatedQuoteAmount;
	}

	/**
	 * Calculates the quote items
	 */
	protected function calculateQuoteItems()
	{
		foreach ($this->quoteItems as $quoteItem)
		{
			$subtotal = $quoteItem['quantity'] * $quoteItem['price'];

			if ($quoteItem['taxRatePercent'])
			{
				$taxTotal = $subtotal  * ($quoteItem['taxRatePercent'] / 100);
			}
			else
			{
				$taxTotal = 0;
			}

			$total = $subtotal + $taxTotal;

			$this->calculatedItemAmounts[] = array(
				'item_id'   => $quoteItem['itemId'],
				'subtotal'  => $subtotal,
				'tax_total' => $taxTotal,
				'total'     => $total
			);

			$this->calculatedQuoteAmount['item_subtotal']  += $subtotal;
			$this->calculatedQuoteAmount['item_tax_total'] += $taxTotal;
			$this->calculatedQuoteAmount['total']          += $total;
		}
	}

	/**
	 * Calculates the quote tax rates
	 */
	protected function calculateQuoteTaxRates()
	{
		foreach ($this->quoteTaxRates as $quoteTaxRate)
		{
			if (!$quoteTaxRate['includeItemTax'])
			{
				$taxTotal = $this->calculatedQuoteAmount['item_subtotal'] * ($quoteTaxRate['taxRatePercent'] / 100);

			}
			else
			{
				$taxTotal = $this->calculatedQuoteAmount['total'] * ($quoteTaxRate['taxRatePercent'] / 100);
			}

			$this->calculatedQuoteTaxRates[] = array(
				'quote_id'         => $this->quoteId,
				'tax_rate_id'      => $quoteTaxRate['taxRateId'],
				'include_item_tax' => $quoteTaxRate['includeItemTax'],
				'tax_total'        => $taxTotal
			);

			$this->calculatedQuoteAmount['tax_total'] += $taxTotal;
			$this->calculatedQuoteAmount['total']     += $taxTotal;
		}
	}

}