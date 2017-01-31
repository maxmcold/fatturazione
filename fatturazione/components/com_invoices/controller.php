<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_invoices
 *
 * @copyright   Copyright (C) 2016 Massimo del Vecchio, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Invoices Component Controller
 *
 * @since  3.2
 */
class InvoicesController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   bool  $cachable   If true, the view output will be cached
	 * @param   bool  $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JControllerLegacy This object to support chaining.
	 *
	 * @since   3.2
	 */
	public function display($cachable = false, $urlparams = false)
	{
		
		return parent::display($cachable, $urlparams);
	}

	
}
