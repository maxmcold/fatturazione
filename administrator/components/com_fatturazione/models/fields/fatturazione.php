<?php
/**

 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * Fatturazione Form Field class for the Fatturazione component
 *
 * @since  0.0.1
 */
class JFormFieldFatturazione extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'Fatturazione';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,codice_fattura,progressivo,mese,anno,mail_inviata');
		$query->from('#__fatturazione');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();

		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->codice_fattura);
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}