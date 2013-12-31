<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Classes;

class Pager {

	public static function create($object)
	{
		$currentPage  = $object->getCurrentPage();
		$previousPage = $currentPage - 1;
		$nextPage     = $currentPage + 1;
		$lastPage     = $object->getLastPage();

		$pager = '<div class="btn-group">';
		
		if ($previousPage >= 1)
		{
			$pager .= '<a class="btn" href="' . $object->getUrl(1) . '" title="' . trans('fi.first') . '"><i class="icon-fast-backward"></i></a>';
			$pager .= '<a class="btn" href="' . $object->getUrl($previousPage) . '" title="' . trans('fi.prev') . '"><i class="icon-backward"></i></a>';
		}
		else
		{
			$pager .= '<a class="btn disabled" href="javascript:void(0)" title="' . trans('fi.first') . '"><i class="icon-fast-backward"></i></a>';
			$pager .= '<a class="btn disabled" href="javascript:void(0)" title="' . trans('fi.prev') . '"><i class="icon-backward"></i></a>';
		}

		if ($nextPage <= $lastPage)
		{
			$pager .= '<a class="btn" href="' . $object->getUrl($nextPage) . '" title="' . trans('fi.next') . '"><i class="icon-forward"></i></a>';
			$pager .= '<a class="btn" href="' . $object->getUrl($lastPage) . '" title="' . trans('fi.last') . '"><i class="icon-fast-forward"></i></a>';
		}
		else
		{
			$pager .= '<a class="btn disabled" href="javascript:void(0)" title="' . trans('fi.next') . '"><i class="icon-forward"></i></a>';
			$pager .= '<a class="btn disabled" href="javascript:void(0)" title="' . trans('fi.last') . '"><i class="icon-fast-forward"></i></a>';
		}

		$pager .= '</div>';

		return $pager;
	}

}