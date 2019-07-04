<?php

class Upload extends GW_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$data['template_title'] = 'Upload';
		
		$this->masterpage->addContentPage('form_upload', 'contentmain', $data);
		
		$this->masterpage->show( );
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/files';
		#$config['allowed_types'] = 'gif|jpg|png|jpeg|html|ppt|doc|xls|mp4|3gp';
		$config['allowed_types'] = '*';
			
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()) dump( $this->upload->display_errors());

		$this->index();
	}
}
?>
