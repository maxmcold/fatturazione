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
class FatturazioneViewDettaglio extends JViewLegacy
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
		$input = JFactory::getApplication()->input;
		$id = $input->getCmd('id');
		if (!$id){
			JFactory::getApplication()->enqueueMessage(JText::_('Fattura richiesta non trovata'), 'error');
			return false;
		}
		// Assign data to the view
		$model = $this->getModel('fatture');
		if($model) $this->Fattura = $model->getFattura($id);
		if($this->Fattura){
			JLoader::register('FPDF', JPATH_LIBRARIES.'/fpdfmy/FPDF.php');
			$pdf = new FPDF();
			$pdf->Output('F',JPATH_COMPONENT .'/test.pdf');//.$this->Fattura->filename);
		}
		// Display the view
		parent::display($tpl);
	}
}