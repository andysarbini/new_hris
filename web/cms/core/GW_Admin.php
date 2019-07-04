<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @name 		Main admin controller
 * @author 	g3n1k
 * @package 	cicms
 * @subpackage 	Controllers
 */
class GW_Admin extends MX_Controller
{
	/**
	 * Constructor method
	 * jika mengakses login
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		if( is_login('group_name') !== 'admin' ) redirect(base_url().'login'); // show_404(); 
		
		$this->masterpage->setMasterPage(get_option('admin_template') );
		
	}
	
	public function ping($_var=false){
		return 'answer from '. current_module().'/'.current_class(). '-&gt;'.current_function().'('.$_var.')';
	}
	
	public function index(){
		echo 'go home browser ...';
	}
	
}
