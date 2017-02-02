<?php
/**
*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Fatturazione Model
 *
 * @since  0.0.1
 */
class FatturazioneModelFatturazione extends JModelItem
{
	/**
	 * @var string message
	 */
	protected $message;

	/**
	 * Get the message
	 *
	 * @return  string  The message to be displayed to the user
	 */
	public function getMsg()
	{
		if (!isset($this->message))
		{
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');
 
			switch ($id)
			{
				case 2:
					$this->message = 'Vafancule!';
					break;
				default:
				case 1:
					$this->message = 'Benvenuti a \'sti frocioni!';
					break;
			}
		}

		return $this->message;
	}
}