<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<h1><?php echo $this->msg; ?></h1>

cic
Mese:<br/>
<Form action="">
<input type="text" name="month"/>
<input type="hidden" name="option" value="com_fatturazione">
<input type="submit" value="crea PDF">
</Form>

<p><a href="?option=com_fatturazione&task=listaFatture">lista fatture</a>
<p><a href="?option=com_fatturazione&task=new">nuova fattura</a>

<?php 

echo $this->ListaFatture;
?>