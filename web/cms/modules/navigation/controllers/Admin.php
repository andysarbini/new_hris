<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author g3n1k
 * halaman untuk pengaturan navigasi website
 */
class admin extends GW_Admin {

	private $menus = array();

	function __construct(){
		parent::__construct();
		$this->load->model('navigation_m');
		$this->load->helper('navigation_h');

	}

	function index($_id=false){
		$data['title'] = 'Navigation';
		$data['include_script']  = inc_script(array('includes/js/adm_navigation.js'));
		$data['include_script'] = inc_script(array('includes/css/adm_navigation.css'));
		$this->masterpage->addContentPage('admin', 'contentmain', $data);
		$this->masterpage->show( );
	}

	/**
	 * view list or detail from group navigation
	 * @param number $_id
	 * 
	 */

	function view_nav($_id=false){
		$data['tables'] = $this->navigation_m->get_nav($_id);
		echo $this->load->view('table_nav', $data);
	}
	/**
	 * view edit or add for  group navigation
	 * @param unknown_type $_id
	 */
	function add_edit_nav($_id = false){

		if($_id) $data['nav'] = $this->navigation_m->get_nav($_id);

		$this->load->model('user/user_m');

		$data['groups'] = $this->user_m->get_group();

		echo $this->load->view('add_edit_nav', $data);
	}

	/**
	 * save navigation group to database
	 */
	function simpan_nav(){
		$data['NAV_GROUP_ID'] = $this->input->post('nav_id');
		$data['NAV_TITLE'] = $this->input->post('nav_title');
		$data['NAV_URI'] = $this->input->post('nav_uri');
		$data['NAV_OWNER'] = $this->input->post('group_id');

		foreach ($data as $a) if($a === '') die();

		$this->navigation_m->simpan($data);
	}

	/**
	 * delete group navigation
	 */
	function hapus_nav(){
		$_id = $this->input->post('id');
		$this->navigation_m->hapus_nav($_id);
	}
	/**
	 * view navigation list / detail menu
	 * @param post $_id
	 * @param post $_group
	 */
	function view_nav_list(){

		$_group_id = @if_empty($this->input->post('group_id'),false);

		$_owner_id = @if_empty($this->input->post('owner_id'),false);

		$data['tables'] = $this->generate_array_menu($_group_id);

		echo $this->load->view('table_nav_list', $data);

	}
	/**
	 * view form add edit 
	 * @param unknown_type $_id
	 */
	function add_edit_nav_list($_id = false){

		$_group= $this->input->post('group_id');
		$_id= $this->input->post('id');
		$_parent = $this->input->post('parent');

		$data['owner_group'] = $this->navigation_m->__select('mdl_navigation_group', 'NAV_OWNER id', array('NAV_GROUP_ID'=>$_group),false, false);


		#$data['parent'] = $this->generate_array_menu($_group);

		// debug ---
		$parents = $this->generate_array_menu($_group);
		$gg = array();
		foreach($parents as $var=>$val)	{

			$gg[] = array('id'=>$val['id'], 'title'=>gen_child_tree($val['level']).$val['title']);
		}
		$data['parent'] = $gg;
		// debug ---

		$data['nav'] = $this->navigation_m->get_nav_list($_id, $_group);
		$data['parent_selected'] = $_parent;
		echo $this->load->view('add_edit_nav_list', $data);
	}
	/**
	 * simpan navlist
	 */
	function simpan_nav_list(){

		$data['NAV_GROUP_ID'] = $this->input->post('group_id');

		if($data['NAV_GROUP_ID']){

			$data['NAV_LIST_ID'] = $this->input->post('id');

			$data['NAV_LIST_TITLE'] = $this->input->post('title');

			$data['NAV_TYPE_ID'] = $this->input->post('type');

			$data['NAV_LIST_URL'] = $this->input->post('url');

			$data['NAV_LIST_URI'] = $this->input->post('uri');

			$data['NAV_LIST_PARENT_ID'] = $this->input->post('id_parent');

			$data['NAV_LIST_TARGET'] = $this->input->post('target');

			$data['NAV_LIST_POSSITION'] = $this->input->post('poss');
			//die(var_dump($data));
			$this->navigation_m->simpan_list($data);
		}
	}

	/**
	 * dapatkan dan susun menu array
	 */
	public function generate_array_menu($_group, $_parent=0, $level=0){

		if(!$_parent) $this->menus = array(); // reset value if parent = 0

		$this->navigation_m->parent_option($_group);

		$menus = $this->navigation_m->get_nav_list(false, $_group, $_parent, 'array');

		if(count($menus)) {

			foreach($menus as $m){

				$m['level'] = $level;

				$this->menus[] = $m; //array('id'=>$m->id, 'title'=>$m->title, 'uri'=>$m->uri, 'url'=>$m->url); 

				$this->generate_array_menu($_group, $m['id'], $level+1);
			}
		}

		if($_parent === 0) return $this->menus; # return value if parent = 0
	}

	/*
	 * dapatkan id uri title autosugestion
	 */
	public function get_content_auto($input){
		echo $this->navigation_m->get_content_auto($input);
	}

	public function hapus_nav_list(){

		$_id = $this->input->post('id');
		//echo '_id '.$_id;
		echo $this->navigation_m->__delete('mdl_navigation_list', array('NAV_LIST_ID'=>$_id));
	}
}
