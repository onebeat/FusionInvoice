<?php namespace FI\Classes;

class QuoteAmounts {

	public static function calculateQuoteItemAmount($quantity, $price, $taxRatePercent)
	{
		$subtotal = $quantity * $price;

		if ($taxRatePercent)
		{
			$tax_total = $subtotal * ($taxRatePercent / 100);
		}
		else
		{
			$tax_total = 0;
		}
		
		$total = $subtotal + $tax_total;

		return array(
			'subtotal'  => $subtotal,
			'tax_total' => $tax_total,
			'total'     => $total
		);
	}

	public static function calculateQuoteAmount($quoteItemAmounts)
	{
		$item_subtotal  = 0;
		$item_tax_total = 0;
		$total          = 0;

		foreach ($quoteItemAmounts as $quoteItemAmount)
		{
			$item_subtotal  += $quoteItemAmount->subtotal;
			$item_tax_total += $quoteItemAmount->tax_total;
			$total          += $quoteItemAmount->total;
		}

		return array(
			'item_subtotal'  => $item_subtotal,
			'item_tax_total' => $item_tax_total,
			'total'          => $total
		);
	}

}