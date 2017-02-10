<?php
/**
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');


/**
 * Fatturazione Component Controller
 *
 */
class FatturazioneController extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = false)
	{
		parent::display($cachable,$urlparams);
	}
	
	//backward compatibility
	public function lista($cachable = false, $urlparams = false){
		$this->listaFatture($cachable = false, $urlparams = false);
	}
	public function listaFatture($cachable = false, $urlparams = false){
		
		$model = $this->getModel('fatture');
		$view = $this->getView('lista','html');
		$view->setModel($model);
		$view->display();
			
	}
	public function dettaglioFattura($cachable = false, $urlparams = false){
		
		$model = $this->getModel('fatture');
		$view = $this->getView('dettaglio','html');
		$view->setModel($model);
		$view->display();
		
	}
	
	public function save($cachable = false, $urlparams = false){
		$input = JFactory::getApplication()->input;
		
		$fattura = array( 
				'id' => $input->getCmd('id'),
				'codice_fattura' => '143223423', //TODO: remove hardcoding here
				'progressivo' => 1, //TODO: remove hardcoding here
				'mese' => $input->getCmd('mese'),
				'anno' => $input->getCmd('anno'),
				'mail_inviata' =>  0, //TODO: remove hardcoding here
				'filename' => ''
		);
		
		$model = $this->getModel('fatture');
		$model->save($fattura);
		$view = $this->getView('dettaglio','html');
		$view->setModel($model);
		$view->display();
	}
	
}