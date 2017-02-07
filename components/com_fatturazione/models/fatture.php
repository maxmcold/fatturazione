<?php
class FattureModelFatture extends JModelItem
{
	public function getListaFatture(){
		// Obtain a database connection
		$db = JFactory::getDbo();
		// Retrieve the shout
		$query = "SELECT * FROM #_fatturazione";
		// Prepare the query
		$db->setQuery($query);
		// Load the row.
		$result = $db->loadResult();
		// Return the Hello
		return $result;
	}
}