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
//var_dump($this->Fattura);

echo JURI::base(true);
?>

<iframe style="width:718px; height:700px;" frameborder="0">
<object data="<?php echo JPATH_COMPONENT.'/test.pdf'?>" type="application/pdf" width="100%" height="100%">
  <p>Alternative text - include a link <a href="myfile.pdf">to the PDF!</a></p>
</object>
</iframe>
