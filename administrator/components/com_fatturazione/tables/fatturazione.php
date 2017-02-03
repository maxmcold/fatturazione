<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 *
 * @since  0.0.1
 */
class FatturazioneTableFatturazione extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__fatturazione', 'id', $db);
	}
}