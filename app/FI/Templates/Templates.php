<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Templates;

abstract class Templates {

	/**
	 * Returns an array of templates
	 * @param  string $path
	 * @return array
	 */
	public static function listTemplates($path)
	{
		$templates = \FI\Classes\Directory::listContents($path);

		return array_combine($templates, $templates);
	}
}