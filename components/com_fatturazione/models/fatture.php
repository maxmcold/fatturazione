<?php

defined('_JEXEC') or die('Restricted access');

class FatturazioneModelFatture extends JModelItem
{
	public function getListaFatture(){
		// Obtain a database connection
		$db = JFactory::getDbo();
		// Retrieve the shout
		$query = "SELECT * FROM #__fatturazione";
		// Prepare the query
		$db->setQuery($query);
		// Load the row.
		$result = $db->loadAssocList();
		// Return the Hello
		return $result;
	}
	public function getFattura($id){
		
		if (!$id){
			JFactory::getApplication()->enqueueMessage(JText::_('Fattura richiesta non trovata'), 'error');
			return false;
		}
		// Obtain a database connection
		$db = JFactory::getDbo();
		// Retrieve the shout
		$query = "SELECT * FROM #__fatturazione WHERE id=".$id;
		// Prepare the query
		$db->setQuery($query);
		// Load the row.
		$result = $db->loadAssoc();
		if (!$result){
			JFactory::getApplication()->enqueueMessage(JText::_('Fattura richiesta non trovata'), 'error');
			return false;
		}
		return $result;
	}
	public function save($fattura){
		JLoader::register('FPDF', JPATH_LIBRARIES.'/fpdfmy/FPDF.php');
		$pdf = new FPDF();
		$pdf->Output('F',JPATH_COMPONENT .'/test.pdf');//.$this->Fattura->filename);
	}
	private function setPDFstream(&$fattura, &$document){
		
		if (!is_array($fattura) || !$document) return false;
		$document->AddPage();
		$document->SetFont('Arial','B',16);
		$document->Cell(40,10,'ciccio bacicchio!');
		$fattura['filename'] = uniqid($fattura['anno'].$fattura['mese']."_");
		return true;
		
	}
}