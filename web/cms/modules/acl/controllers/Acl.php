<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class acl extends GW_Admin {

	 public function __construct(){

		parent::__construct();

		$this->load->model('acl_m');
	 }

	 public function index($id_group = null){

        $data['include_script']  = inc_script(array(
        
			'includes/datatables/jquery.dataTables.min.js',
			'includes/datatables/jquery.dataTables.min.css',
            'cms/modules/acl/js/admin_acl.js'
        ));

         $data['title'] = 'Access Controll Page';

         $data['select_group'] 	= $this->getAllGroup();

         $data['id_group']		= @if_empty($id_group, 0);

         $data['list_module']	= $this->acl_m->getListModule();

         $data['table_module']	= $id_group ? $this->getAcl($data['id_group']) : null;
		//dump($this->acl_m->__last_query());

         $data['module_select']	= $this->getModule();

         $this->masterpage->addContentPage('acl_page', 'contentmain', $data);

         $this->masterpage->show( );
	 }

	 public function acl_crud(){

	 	$acl_id = $this->input->post('acl_id');

	 	switch ($this->input->post('viud')) {

	 		case 'v': $column = 'ACL_VIEW'; break;

	 		case 'i': $column = 'ACL_INSERT'; break;

	 		case 'u': $column = 'ACL_UPDATE'; break;

	 		case 'd': $column = 'ACL_DELETE'; break;

	 		default: die(); break;
	 	}

	 	$data[$column] = $this->input->post('checked') === "true" ? 1 : 0;

	 	$data['USR_GRP_ID'] = $this->input->post('id_group');

	 	$data['MDL_ID'] = $this->input->post('id_module');

	 	return $acl_id ? $this->acl_m->__update('mdl_acl', $data, array('ACL_ID'=>$acl_id)) : $this->acl_m->__insert('mdl_acl', $data);
	 }

	 public function module(){

		 $data['include_script']  = inc_script(array(

	        'cms/modules/acl/js/admin_module.js'
		 ));


         $data['title'] = 'Module Page';

         $data['table_module']	= @$this->getModule($data['id_group']);

         $data['id_module']		= @if_empty($this->input->post('id_module'), null);

         $this->masterpage->addContentPage('module_page', 'contentmain', $data);

		 $this->masterpage->show( );
	 }

	 public function save($target='module'){

	 	foreach($_POST as $var=>$val){
	 		$data[$var] = $this->input->post($var);
	 	}

	 	switch($target) {
	 		case 'module' :
	 			if($data['MDL_ID']){
	 				$operation = 'update';
	 				$where	= array('MDL_ID'=>$data['MDL_ID']);
	 			}
	 			else {
	 				unset($data['MDL_ID']);
	 				$operation = 'insert';
	 			}
	 			break;
	 		default:
	 			if($data['ACL_ID']) {
	 				$operation = 'update';
	 				$where	= array('ACL_ID'=>$data['ACL_ID']);
	 			}
	 			else {
	 				unset($data['ACL_ID']);
	 				$operation = 'insert';
	 			}
	 			break;
	 	}

	 	if($operation == 'insert') echo $this->acl_m->__insert('mdl_'.$target, $data);

	 	else echo $this->acl_m->__update('mdl_'.$target, $data, $where);
	 }

	public function delete($target='module'){

		switch($target) {
			case 'module' :
				$where = array('MDL_ID'=>$this->input->post('MDL_ID'));
			break;
			default:
				$where = array('ACL_ID'=>$this->input->post('ACL_ID'));
			break;
		}
		echo $this->acl_m->__delete('mdl_'.$target, $where);
	} 

	 /*
	  * ambil data acl berdasarkan idgroup
	  * 
	  */
	 public function getAcl($idgroup=null, $id_acl=null,$format='return'){

	 	$a = $this->acl_m->getAcl($idgroup, $id_acl);

	 	// jika data a tidak ada dan idgroup != null buat list baru
	 	if(!count($a) && $idgroup){

			$this->create_list_acl_for_group($idgroup);

			$a = $this->acl_m->getAcl($idgroup, $id_acl);
		}

	 	if($format == 'json' ) echo json_encode($a);

	 	else return $a;
	 }

	 // insert acl baru untuk group 
	 private function create_list_acl_for_group($id_group){

		// dapatkan seluruh modules (id)
		$modules = $this->acl_m->getListModule();

		foreach($modules as $var=>$d){

			$data = array('MDL_ID'=>$d->id, 'USR_GRP_ID'=>$id_group);

			// insert ke table acl
			$this->acl_m->__insert('mdl_acl', $data);
		}

		return true;
	 }

	 /**
	  * dapatkan seluruh group
	  */
	private function getAllGroup(){
		return $this->acl_m->getAllGroup();
	}

	public function getModule($id_module = null, $format='return'){

		$a = $this->acl_m->getModule($id_module);

		if($format == 'json' ) echo json_encode( $a);

		else return $a;

	}
 }
