<?php namespace FI\Libraries;

class Quotes {

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
                'label' => trans('fi.viewed'),
                'class' => 'viewed',
                'href'  => route('quotes.index', array('viewed'))
            ),
            '4' => array(
                'label' => trans('fi.approved'),
                'class' => 'approved',
                'href'  => route('quotes.index', array('approved'))
            ),
            '5' => array(
                'label' => trans('fi.rejected'),
                'class' => 'rejected',
                'href'  => route('quotes.index', array('rejected'))
            ),
            '6' => array(
                'label' => trans('fi.canceled'),
                'class' => 'canceled',
                'href'  => route('quotes.index', array('canceled'))
            )
        );
    }
	
}