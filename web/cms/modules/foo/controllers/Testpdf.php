<?php

class Testpdf extends GW_Controller {

	function __construct()
	{
		parent::__construct();
		
	}

	function index()
	{
		$data['template_title'] = 'TestPDF';
		
		$this->masterpage->addContentPage('testpdf', 'contentmain', $data);
		
		$this->masterpage->show( );
	}
	
	function test(){
		// load library nya
		$this->load->library(array('topdf'));
		
		// normal load view -> cuma iseng buat ngebedain -> kalo ini di hapus bisa jadi service api topdf
		$this->load->view('template_print',array('html'=>'gw ganteng banget'));
		
		// set view to variable
		$html = $this->load->view('template_print',array('html'=>'gw ganteng bangeeet'), true);
		
		// begin to set config
		$this->topdf->set(array('html'=>$html));
		
		// out the file
		$this->topdf->out();
	}
	
	function help(){
		
		$this->load->helper('dompdf');
		
		// set view to variable
		$html = $this->load->view('template_print',array('html'=>'gw ganteng bangeeet'), true);
		
		
		pdf_create($html, $filename='your-file');
	}
	
	function path(){
		
		echo APPPATH."third_party/dompdf/dompdf_config.inc.php";
	}
/**/
}
?>
