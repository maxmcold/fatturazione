<?php

defined('_JEXEC') or die('Restricted access');

class FatturazioneModelFatture extends JModelItem
{
    public $id = 0;
    public $fattura = array();
    public $fileAbsPath;
    private $finalFilePath = JPATH_COMPONENT .'/fatture/';
    private $tempFilePath =  JPATH_COMPONENT ."/fatture/temp/";

    private $months = array(
            1 => 'Gennaio',
            2 => 'Febbraio',
            3 => 'Marzo',
            4 => 'Aprile',
            5 => 'Maggio',
            6 => 'Giugno',
            7 => 'Luglio',
            8 => 'Agosto',
            9 => 'Settembre',
            10 => 'Ottobre',
            11 => 'Novembre',
            12 => 'Dicembre'
        );
    private $pdf = null;

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
    public function getTmpFattura(){}

    public function getCodiceFattura(){
        return 1;
    }
    private function getFatturaFromDB($id){
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
        return $result;
    }
    public function getFattura($id = 0){

		if (!$id) return $this->fattura;
		return $this->getFatturaFromDB($id);



	}



	public function save($fattura,$commit = false){



        $filepath = ($commit) ? $this->finalFilePath : $this->tempFilePath;

        //Store file
        JLoader::register('FPDF', JPATH_LIBRARIES.'/fpdfmy/FPDF.php');
        $this->pdf = new FPDF();
        $this->setPDFstream($fattura,$this->pdf);
        $this->pdf->Output('F',$filepath.$fattura['filename']);
        $fattura['id']  = 1+$this->getLastId();
        $fattura['codice_fattura'] = $fattura['anno'].$fattura['mese'].$fattura['progressivo'];
        $fattura['progressivo'] = 1+$this->getLastIncremental($fattura['anno']);
        $this->id = $fattura['id'];
        $this->fattura = $fattura;
        if (!$commit) return $fattura;

        //store db entry
        $db = JFactory::getDbo();
        $query = "INSERT INTO #__fatturazione(id,codice_fattura,progressivo,mese,anno,mail_inviata,filename) VALUES (".
            "".$fattura['id'].",".
            "'".$fattura['codice_fattura']."',".
            "'".$fattura['progressivo']."',".
            "".$fattura['mese'].",".
            "".$fattura['anno'].",".
            "".$fattura['mail_inviata'].",".
            "'".$fattura['filename']."'".
            ")";
        $db->setQuery($query);
        $db->execute();

        //if commit then move from temporary folder to store folder
        copy($this->tempFilePath.$fattura['filename'],$this->finalFilePath.$fattura['filename']);
        unlink($this->tempFilePath.$fattura['filename']);
        return $fattura;


	}
    public function getLastIncremental($year){

        //store db entry
        $db = JFactory::getDbo();
        $query = "SELECT MAX(progressivo) from #__fatturazione WHERE anno=".$year;
        $db->setQuery($query);
        return $db->loadResult();

    }
	private function getLastId(){

        //store db entry
        $db = JFactory::getDbo();
        $query = "SELECT MAX(id) from #__fatturazione";
        $db->setQuery($query);
        return $db->loadResult();
    }

	private function setPDFstream($fattura, $pdf ){

        $pdf = (!$pdf) ? new FPDF() : $pdf;
        //TODO: real document here
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial','B',14);

        $pdf->text(10,10,"Dott.sa Emilena Polito");
        $pdf->text(10,20,"Via Santa Caterina 1");
        $pdf->text(10,30,"03049 Sant'Elia Fiumerapido (FR)");
        $pdf->text(10,40,"C.F. PLT MLN 75H60 B963I");
        $pdf->text(10,50,"P.I. 02778170601");
        $pdf->text(130,60,"Spett.le Fondazione Exodus");
        $pdf->text(130,70,"Viale Marotta18/20");
        $pdf->text(130,80,"20134 Milano");
        $pdf->text(130,90,"C.F. 12066380150");
        $pdf->text(130,100,"P.I. 97181590155");

        //shape the borders
        //cornice emittente
        $pdf->rect(8,2,82,52);
        //cornice destinatario
        $pdf->rect(128,52,72,52);
        //cornici tabella costo
        $pdf->rect(2,122,204,130);
        $pdf->rect(2,122,204,10);

        //cornici tabella imponibili e totali
        $pdf->rect(2,160,204,10);
        $pdf->rect(2,170,204,10);
        $pdf->rect(2,180,204,10);
        $pdf->rect(2,190,204,10);
        $pdf->rect(2,200,204,10);
        $pdf->rect(2,210,204,10);
        $pdf->rect(2,220,204,10);

        $line1 = 'Parcella n. '.$fattura['progressivo'].' relativa al mese di '.$this->months[$fattura['mese']]." ".$fattura['anno'];

        $pdf->Cell(10,210,$line1);
        $this->pdf->SetFont('Arial','B',13);

        $Capt1 = "Descrizione";
        $Capt2 = "Onorario";
        $Capt3 = "Non Sogg.";
        $Capt4 = "Rimb. Spese";

        $pdf->text(5,130,$Capt1);
        $pdf->text(80,130,$Capt2);
        $pdf->text(120,130,$Capt3);
        $pdf->text(170,130,$Capt4);

        $this->pdf->SetFont('Arial','B',10);

        $descL1 = "Psicoterapia individuale e familiare ";
        $descL1_1 = "ad utenti ospiti presso";

        $descL2 = "vostra struttura";
        $descL2_1 = "mese di ".$this->months[$fattura['mese']]." ".$fattura['anno'];
        $pdf->text(5,140,$descL1);
        $pdf->text(5,145,$descL1_1);
        $pdf->text(5,150,$descL2);
        $pdf->text(5,155,$descL2_1);
        $this->pdf->SetFont('Arial','B',12);

        $onorario = "980.39";
        $pdf->text(80,140,$onorario);

        $lineItem1 = "Imponibile Soggetto IVA (euro):";
        $lineItem2 = "Maggiorazione 2%";
        $lineItem3 = "Totale Imponibile (euro)";
        $lineItem4 = "Iva 21% (euro)";
        $lineItem5 = "Imponibile non soggetto Iva ex art. 15 DPR 633/72 (euro):";
        $lineItem6 = "Totale Parcella (euro):";
        $lineItem7 = "Totale netto parcella (euro):";
        $lineItem8 = "IBAN:IT54M0760114800001012199046";
        $lineItem9 = "Operazione senza addebito IVA ai sensi del c.100, art.1, L.244/2007 integrato dal Art 27 comma 1/2 DL 06/07/2011 N.98";

        //captions
        $pdf->text(5,165,$lineItem1);
        $pdf->text(5,175,$lineItem2);
        $pdf->text(5,185,$lineItem3);
        $pdf->text(5,195,$lineItem4);
        $pdf->text(5,205,$lineItem5);
        $pdf->text(5,215,$lineItem6);
        $pdf->text(5,225,$lineItem7);

        $iva = "19.61";
        $totaleImp = "1000";
        //values
        $pdf->text(185,165,$onorario);
        $pdf->text(185,175,$iva);
        $pdf->text(185,205,$totaleImp);
        $pdf->text(185,215,$totaleImp);
        $pdf->text(185,225,$totaleImp);

        $this->pdf->SetFont('Arial','I',10);
        $pdf->text(60,235,$lineItem8);
        $pdf->text(5,245,$lineItem9);



        return true;

	}

	public function getMonths(){

	    return $this->months;
    }
    public function setEmailStatus($status = false){

	    if ($status) return true; //TODO: real action here
    }


}