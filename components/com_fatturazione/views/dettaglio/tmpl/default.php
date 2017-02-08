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
var_dump($this->Fattura);

JLoader::register('FPDF', JPATH_LIBRARIES . '/fpdfmy/FPDF.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');

?>
<iframe src="http://docs.google.com/gview?url=http://example.com/mypdf.pdf&embedded=true" style="width:718px; height:700px;" frameborder="0">
<?php $pdf->Output();
?>
</iframe>
