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
	public $previewMode = false;

	function display($tpl = null)
	{
        if($this->previewMode)
            $this->previewDoc($tpl);
        else{
            $this->viewDoc($tpl);
        }
		// Display the view
		parent::display($tpl);
	}
	function previewDoc($tpl = null){
	    $this->previewMode = true;
        $input = JFactory::getApplication()->input;
        $model = $this->getModel('fatture');
        $this->Fattura = $model->getFattura();
        //parent::display($tpl);
    }
    function viewDoc($tpl = null){
        $this->previewMode = false;
        $input = JFactory::getApplication()->input;
        $model = $this->getModel('fatture');
        $id = ($input->getCmd('id')) ? $input->getCmd('id') : $model->id;


        if (!$id){
            JFactory::getApplication()->enqueueMessage(JText::_('Fattura richiesta non trovata'), 'error');
            return false;
        }

        $this->Fattura = $model->getFattura($id);
        //parent::display($tpl);
    }
}