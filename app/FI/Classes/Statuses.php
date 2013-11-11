<?php namespace FI\Classes;

abstract class Statuses {

    /**
     * Returns the array of statuses
     * @return array
     */
    public static function statuses()
    {
        return array(
            '0' => array(
                'label' => trans('fi.all'),
                'class' => 'all',
                'href'  => route('quotes.index', array('all'))
            ),
            '1' => array(
                'label' => trans('fi.draft'),
                'class' => 'draft',
                'href'  => route('quotes.index', array('draft'))
            ),
            '2' => array(
                'label' => trans('fi.sent'),
                'class' => 'sent',
                'href'  => route('quotes.index', array('sent'))
            ),
            '3' => array(
                'label' => trans('fi.paid'),
                'class' => 'paid',
                'href'  => route('quotes.index', array('paid'))
            ),
            '4' => array(
                'label' => trans('fi.canceled'),
                'class' => 'canceled',
                'href'  => route('quotes.index', array('canceled'))
            )
        );
    }

    /**
     * Return a flattened array of statuses
     * @return array
     */
    public static function getList($statuses)
    {
    	$return = array();

        foreach ($statuses as $key => $status)
        {
            $return[$key] = $status['label'];
        }

        return $return;
    }

}