<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_fatturazione
 *
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 *
 * @since  0.0.1
 */
class FatturazioneViewLista extends JViewLegacy
{

	/**
	 * Display the Fatturazione view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		$this->msg = $this->get('Msg');
		$model = $this->getModel('fatture');
		if($model){
			$this->ListaFatture = $model->getListaFatture();
		} else {
			$this->ListaFatture = array();
		}
		// Display the view
		parent::display($tpl);
	}
}