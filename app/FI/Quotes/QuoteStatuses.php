<?php namespace FI\Quotes;

class QuoteStatuses extends \FI\Classes\Statuses {

    public static function statuses()
    {
        $statuses = parent::statuses();

        unset($statuses[3]);

        return $statuses;
    }

    public static function lists()
    {
        $statuses = self::statuses();

        unset($statuses[0]);

        return parent::getList($statuses);
    }
	
}