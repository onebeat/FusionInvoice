<?php namespace FI\Invoices;

class InvoiceStatuses extends \FI\Classes\Statuses {

    public static function statuses()
    {
        $statuses = parent::statuses();

        return $statuses;
    }

    public static function lists()
    {
        $statuses = self::statuses();

        unset($statuses[0]);

        return parent::getList($statuses);
    }
	
}