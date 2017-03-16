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
<p><?php 
//r_dump($this->Fattura);
?>


<object data="<?php echo JURI::base(false).'components/com_fatturazione/fatture/temp/'.$this->Fattura['filename']?>" type="application/pdf" width="100%" height="500">
  </object>
<p><a href="<?php echo JURI::base(false).'components/com_fatturazione/fatture/'.$this->Fattura['filename']?>"">download</a></p>
<form action="index.php">
    <?php foreach ($this->Fattura as $key -> $value){?>
    <input type='hidden' name='<?php echo $key?>' value='<?php echo $value?>'>
    <?php }?>
    <input type='hidden' name='option' value='com_fatturazione'>
    <input type='hidden' name='task' value='save'>
    <input type='submit' name='send' value="salva">

    </form>
