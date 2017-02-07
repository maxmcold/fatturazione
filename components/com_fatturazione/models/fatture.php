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
	public function getFattura($id =0){
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
		// Return the Hello
		return $result;
	}
}