<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Statuses;

class InvoiceStatuses {

    /**
     * Returns the array of statuses
     * @return array
     */
    public static function statuses()
    {
        return array(
            '0' => array(
                'status' => 'all',
                'label'  => trans('fi.all')
            ),
            '1' => array(
                'status' => 'draft',
                'label'  => trans('fi.draft')
            ),
            '2' => array(
                'status' => 'sent',
                'label'  => trans('fi.sent')
            ),
            '3' => array(
                'status' => 'viewed',
                'label' => trans('fi.viewed')
            ),
            '4' => array(
                'status' => 'paid',
                'label'  => trans('fi.paid')
            ),
            '5' => array(
                'status' => 'canceled',
                'label'  => trans('fi.canceled')
            )
        );
    }

    /**
     * Return a flattened array of statuses
     * @param  array $statuses
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

    /**
     * Returns an array of statuses to populate dropdown list
     * @return array
     */
    public static function lists()
    {
        $statuses = self::statuses();

        unset($statuses[0]);

        return self::getList($statuses);
    }
	
}