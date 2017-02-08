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
	
}