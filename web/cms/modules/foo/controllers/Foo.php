<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class foo extends GW_Controller {
	
	public function __construct(){
	
		parent::__construct();
	}
	
	public function index($page = 1){
		
		$param = array(
				'order_by'=>array('tgl'=>'desc'),
				//'limit'=>",3",
				'limit'=>"3,".(3*($page-1)),
				'where'=>array('cat_uri'=>'news-article')
		);
		
		$data['news'] = Modules::run('content/api/getListContent', $param);
		
		echo Modules::run('content/api');
		
		dump($data['news'] ,'data content');
		
		$this->masterpage->addContentPage('by_pages', 'contentmain', $data);
	
		$this->masterpage->show( );
	}
	
	
	
}
