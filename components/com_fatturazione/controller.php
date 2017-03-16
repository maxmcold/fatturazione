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
        $this->listaFatture($cachable = false, $urlparams = false);
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
        JSession::checkToken('request') or jexit('Invalid token:custom msg'); //JText::_('JINVALID_TOKEN')

        $input = JFactory::getApplication()->input;
        $model = $this->getModel('fatture');

        $fattura = array(
				'id' => $input->getCmd('id'),
				'codice_fattura' => $input->getCmd('codice_fattura'),
				'progressivo' => $input->getCmd('progressivo'),
				'mese' => $input->getCmd('mese'),
				'anno' => $input->getCmd('anno'),
				'mail_inviata' =>  0,
				'filename' => $input->getCmd('filename')
		);
		
		$model->save($fattura,true);
		$view = $this->getView('completato','html');
		$view->setModel($model);
		$this->sendEmail('maxmcold@gmail.com','body text','subject','C:\test.pdf');
		$model->setEmailStatus(true);
		$view->display();
	}

    public function createDoc(){
        JSession::checkToken('request') or jexit('Invalid token:custom msg'); //JText::_('JINVALID_TOKEN')
        $input = JFactory::getApplication()->input;
        $model = $this->getModel('fatture');
        $anno = $input->getCmd('anno');
        $currentInvNum = $model->getLastIncremental($anno)+1;
        $codiceFattura = $input->getCmd('mese').$input->getCmd('anno').$currentInvNum;


        $fattura = array(
            'id' => $input->getCmd('id'),
            'codice_fattura' => $codiceFattura,
            'progressivo' => $currentInvNum,
            'mese' => $input->getCmd('mese'),
            'anno' => $input->getCmd('anno'),
            'mail_inviata' =>  0, //to be updated after email is sent by model
            'filename' => uniqid().'.pdf'
        );
        $model->fattura = $fattura;
        $model->save($fattura,false);

        $view = $this->getView('dettaglio','html');
        $view->setModel($model);
        $view->display();


    }
	private function sendEmail($recipient,$body,$subject,$attachAbs){

	    if(!$recipient || !$body || !$subject || !$attachAbs) return false;
        $mailer = JFactory::getMailer();
        $mailer->addRecipient($recipient);
        $mailer->setSubject($subject);
        $mailer->setBody($body);
        // Optional file attached
        $mailer->addAttachment($attachAbs);
        if($mailer->Send()) return true;
        JFactory::getApplication()->enqueueMessage(JText::_('Impossibile inviare mail ai destinatari'), 'warning');
        return false;

    }
	
}