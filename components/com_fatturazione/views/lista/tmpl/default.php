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
<h1>testina</h1>
<p><a href="?option=com_fatturazione&task=listaFatture">lista fatture</a>

    <p>Scegli la fattura:</p>
    <form action="index.php">
    <input type="hidden" name="option" value="com_fatturazione">
    <select name="id"><?php

    foreach ($this->ListaFatture as $fattura){ ?>

<option  value="<?php echo $fattura['id']?>"><?php echo $fattura['mese']?> / <?php echo $fattura['anno']?></option>

<?php }?>
</select>
    <input type="submit" name="send" value="vai"/>
    <input type="hidden" name="task" value="dettaglioFattura"/>
    <?php echo JHtml::_( 'form.token' ); ?>
</form>

<p>crea una nuova fattura
    <form action="./index.php">
<p>Mese: <select name="mese">
        <option value="1">Gennaio</option>
        <option value="2">Febbraio</option>
        <option value="3">Marzo</option>
        <option value="4">Aprile</option>
        <option value="5">Maggio</option>
        <option value="6">Giugno</option>
        <option value="7">Luglio</option>
        <option value="8">Agosto</option>
        <option value="9">Settembre</option>
        <option value="10">Ottobre</option>
        <option value="11">Novembre</option>
        <option value="12">Dicembre</option>

    </select>
<p>Anno: <input type="text" name="anno" value="2018"/>
<p><input type="submit" name="send" value="gojhonny"/>
    <input type="hidden" name="option" value=com_fatturazione"/>
    <input type="hidden" name="task" value="createDoc"/>
    <?php echo JHtml::_( 'form.token' ); ?>
</form>
</p>