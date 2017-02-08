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

<p><a href="?option=com_fatturazione&task=list">lista fatture</a>
<p><a href="?option=com_fatturazione&task=new">nuova fattura</a>
<p>Scegli la fattura:</p>
<?php 

foreach ($this->ListaFatture as $fattura){ ?>
<a href="index.php?option=com_fatturazione&task=dettaglioFattura&id=<?php echo $fattura['id']?>"><?php echo $fattura['mese']?> / <?php echo $fattura['anno']?></a><br/>
	
<?php }?>