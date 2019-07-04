<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author g3n1k
 * 30.05.2015 09:10:21
 * untuk yg harus login
 */
class GW_User extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	
		if( !is_login()) redirect(base_url().'login'); 
		#dump(is_login(), 'is_login');
		else $this->masterpage->setMasterPage(get_option('template') );
	}
	
	public function class_id(){
		return array(
				'modules'=>$this->router->fetch_module(),
				'class'=>$this->router->fetch_class(), // class = controller
				'method'=>$this->router->fetch_method()
		);
	}
	
	public function check_acl($param = null){
		
		# set default value
		$p = array('acl'=>'v','modules'=>null, 'group_id'=>null, 'user_id'=> null);
		
		if(is_array($param)) $p = array_merge($p, $param);
		
		else if($param) $p['acl'] = $param;
		
		# fill the null value
		if(!$p['modules']){
			$a = $this->class_id();
			$p['modules'] = $a['modules'];
		}
		
		$group_id 	= $p['group_id'] ? $p['group_id'] : $this->session->userdata('group_id');
		
		$user_id 	= $p['user_id']  ? $p['user_id']  : $this->session->userdata('user_id');
		
		# check acl in database
		
		$this->load->model('acl/acl_m');
		
		$acl = $this->acl_m->acl($group_id, $p['modules']);
		
		return $acl->{$p['acl']};
	}
}
