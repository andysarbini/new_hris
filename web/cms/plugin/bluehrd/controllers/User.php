<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User extends GW_Admin
{
	function __construct(){

		parent::__construct();

		$this->load->model("bluehrd_user_m");
	}

	function index(){

		$data["title"] = "Administrator Page User BlueHRD";

		$data['include_script'] = inc_script(

			array(
			
				"templates/bluehrd/js/assets/jquery.lazyload.min.js",
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",

				"cms/plugin/bluehrd/js/admin_user.js",
			)
		);

		$page = isset($_GET["page"]) ? $this->input->get("page") : 0;
		
		$_w 					= null;
		
		if(isset($_GET['company']) && $_GET['company'] != '') $_w['company'] = $this->input->get('company');
		
		$data['company'] 		= $_w['company'];
		
		$data['slc_json_company']	= Modules::run("api/options", "bb_opt_company");
		
		$data['slc_company']	= json_decode($data['slc_json_company'], true);
		
		$data['slc_jabatan']	= json_decode(Modules::run("api/options", "bb_opt_jabatan"), true);
		
		$data['slc_tipe_karyawan']= json_decode(Modules::run("api/options", "bb_opt_tipe_karyawan"), true);
		
		$data['slc_grade']		= json_decode(Modules::run("api/options", "bb_opt_grade"), true);
		
		$data['slc_level']		= json_decode(Modules::run("api/options", "bb_opt_level"), true);
		
		$data['slc_pool']		= json_decode(Modules::run("api/options", "bb_opt_pool"), true);
		
		$data['slc_status_karyawan']= json_decode(Modules::run("api/options", "bb_opt_status_karyawan"), true);
		
		$this->load->helper("cuti/cuti");
	
		$data["users"]	= $this->bluehrd_user_m->user_list($page, $_w);

		$this->masterpage->addContentPage('admin_user', 'contentmain', $data);

		$this->masterpage->show( );
	}

	/**
	 * form add/edit user
	 */
	function form($id=null){
		
		$data['include_script'] = inc_script(

			array(
			
				"includes/datepicker/bootstrap-datepicker.js",
				
				"includes/datepicker/locales/bootstrap-datepicker.id.js",
			
				"cms/plugin/bluehrd/js/admin_form.js",
			)
		);

		$this->load->helper("bluehrd");

		$data['slc_company']	= Modules::run("api/options", "bb_opt_company");
		
		$data['slc_tipe_karyawan']= Modules::run("api/options", "bb_opt_tipe_karyawan");

		$data['slc_jabatan']	= Modules::run("api/options", "bb_opt_jabatan");

		$data['slc_grade']		= Modules::run("api/options", "bb_opt_grade");
		
		$data['slc_level']		= Modules::run("api/options", "bb_opt_level");
		
		$data['slc_cost_ctr']	= Modules::run("api/options", "bb_opt_cost_ctr");
		
		$data['slc_pool']		= Modules::run("api/options", "bb_opt_pool");
		
		$data['slc_status_karyawan']= Modules::run("api/options", "bb_opt_status_karyawan");

		$this->load->helper("cuti/cuti");

		$data["user"]	= $id ? $this->bluehrd_user_m->get_user($id) : false;

		$data["title"] 	= isset( $data["user"]->nama_lengkap) ? "Edit User " . $data["user"]->nama_lengkap : "Add User" ;

		$this->masterpage->addContentPage('form_user', 'contentmain', $data);

		$this->masterpage->show( );
	}
	/**
	 * simpan perubahan data user
	 * method post
	 */
	function save(){
		$this->load->model("bluehrd_user_m");
		// file upload
		$rule_upload['upload_path']   = 'uploads/profile/';
		$rule_upload['allowed_types'] = 'gif|jpg|png|jpeg';
		$rule_upload['encrypt_name']  = true;
		
		$this->load->library('upload',$rule_upload);
		
		$this->load->helper("cuti/cuti");
		
		if($this->upload->do_upload('picture')){
			$file_data = $this->upload->data();
			$mdl_user_data['profile_picture'] = $file_data['file_name'];
		} 
		// mdl_user_data
		$mdl_user_data["nip"] 			= $this->input->post("nip");
		$mdl_user_data["nama_lengkap"] 	= $this->input->post("nama_lengkap");
		$mdl_user_data["tgl_lahir"] 	= bbdate($this->input->post("tgl_lahir"));
		$mdl_user_data["posisi"] 		= $this->input->post("posisi");
		$mdl_user_data["atasan_nip"] 	= $this->input->post("atasan_nip");
		$mdl_user_data["tgl_masuk"] 	= bbdate($this->input->post("tgl_masuk"));
		$mdl_user_data["company"] 		= $this->input->post("company");
		$mdl_user_data["tipe_karyawan"] = $this->input->post("tipe_karyawan");
		$mdl_user_data["jabatan"] 		= $this->input->post("jabatan");
		$mdl_user_data["grade"] 		= $this->input->post("grade");
		$mdl_user_data["level"] 		= $this->input->post("level");
		$mdl_user_data["cost_ctr"] 		= $this->input->post("cost_ctr");
		$mdl_user_data["pool"] 			= $this->input->post("pool");
		$mdl_user_data["status_karyawan"]= $this->input->post("status_karyawan");		
		$mdl_user_data["email_corporate"]= $this->input->post("email_corporate");
		
		#if((int) $this->input->post("usr_id")) 	$this->bluehrd_user_m->__update("mdl_user_data", $mdl_user_data, array( "usr_id"=>(int) $this->input->post("usr_id")));
		
		#else $this->bluehrd_user_m->__update("mdl_user_data", $mdl_user_data);
		
		// mdl_user
		$mdl_user["USR_EMAIL"]	= $this->input->post("email_corporate");
		$mdl_user["USR_NAME"]	= $this->input->post("usr_name");
		$mdl_user["USR_ID"]		= (int) $this->input->post("usr_id");
		$mdl_user["USR_ACCESS"]	= $this->input->post("usr_access");
		$mdl_user["USR_GRP_ID"]	= 3;
		
		$_pass 		= $this->input->post("usr_pass");
		$_usr_id 	= (int) $this->input->post("usr_id");
		
		if( $_pass && $_usr_id != 0) {
			$this->load->helper("user/user");
			$mdl_user["USR_PASS"]	= gen_user_pass($_pass);
		}

		if($_usr_id) {
			
			$this->bluehrd_user_m->__update("mdl_user_data", $mdl_user_data, array( "usr_id"=>$_usr_id));
			$this->bluehrd_user_m->__update("mdl_user", $mdl_user, array( "USR_ID"=>$_usr_id));
		}	
		
		else {
			$mdl_user_data["usr_id"] = $this->bluehrd_user_m->__insert("mdl_user", $mdl_user);
			$_usr_id = $mdl_user_data["usr_id"];
			$this->bluehrd_user_m->__insert("mdl_user_data", $mdl_user_data);
		}
		
		redirect(base_url()."bluehrd/user/view/".$_usr_id);
	}

	/**
	 * 
	 */
	function view($id){

		if($id) {
			
			$data['slc_company']	= json_decode(Modules::run("api/options", "bb_opt_company"), true);
		
			$data['slc_tipe_karyawan']= json_decode(Modules::run("api/options", "bb_opt_tipe_karyawan"), true);

			$data['slc_jabatan']	= json_decode(Modules::run("api/options", "bb_opt_jabatan"), true);

			$data['slc_grade']		= json_decode(Modules::run("api/options", "bb_opt_grade"), true);
			
			$data['slc_level']		= json_decode(Modules::run("api/options", "bb_opt_level"), true);
			
			$data['slc_cost_ctr']	= json_decode(Modules::run("api/options", "bb_opt_cost_ctr"), true);
			
			$data['slc_pool']		= json_decode(Modules::run("api/options", "bb_opt_pool"), true);
			
			$data['slc_status_karyawan']= json_decode(Modules::run("api/options", "bb_opt_status_karyawan"), true);
			
			$data['slc_boolean']= json_decode(Modules::run("api/options", "opt_boolean"), true);

			$data["user"] = $this->bluehrd_user_m->get_user($id);

			$data["title"] = "Show User " . $data["user"]->nama_lengkap;
			
			$this->load->helper("cuti/cuti");

			$this->masterpage->addContentPage('view_user', 'contentmain', $data);
	
			$this->masterpage->show( );
		}
		else show_404();
	}

	function import_csv(){
		
		$config['upload_path']          = './uploads/csv/';
        
        $config['allowed_types']        = 'csv|txt';
		
		$this->load->library('upload', $config);
		
		if (  $this->upload->do_upload('document')){
			
			$_ud = $this->upload->data();
			
			$path_csv = $_ud['full_path'];
			
		} else {
			dump($_FILES);
			die($this->upload->display_errors());
		}
		
		// https://www.sitepoint.com/community/t/spliting-a-75mb-csv-into-managable-file-sizes/70486/15
		// https://www.codeigniter.com/userguide2/database/active_record.html#insert_batch
		
		$header_first_line = @if_empty($this->input->post('header'),true);
		
		$csv = new SplFileObject($path_csv);
		
		$csv->setFlags(SplFileObject::READ_CSV);
		
		$start = $header_first_line ? 1 : 0;
		
		$batch = 200; // maximal 200 data per insert 
		
		$counter = 1;
		
		$header_counter = array();
		
		$this->load->helper("cuti/cuti");
		
		while (!$csv->eof()) {
		
			$data = array();
			
			foreach(new LimitIterator($csv, $start, $batch) as $num =>$_l) {
				
				if(!is_array($_l) || $_l[0] == '') break;
				
/*

0 => nip
1 => nama_lengkap
2 => tgl_lahir
3 => posisi
4 => atasan_nip
5 => tgl_masuk
6 => company
7 => tipe_karyawan
8 => jabatan
9 => grade
10=> level
11=> cost_ctr
12=> pool
13=> status_karyawan
14=> email_corporate
15=> password
*/
				
				// ke table mdl_user
				$_user = array(
						'USR_NAME'	=> $_l[1],
						'USR_EMAIL'	=> strtolower($_l[14]),
						'USR_PASS'	=> $this->generate_md5($_l[15]),
						'USR_GRP_ID'=> 3, // group user
						'USR_INDATE'=> bbdate($_l[5]),
						'USR_ACCESS'=> 1, // 1 enable
					);
				
				
				$_usr_id = $this->bluehrd_user_m->__insert('mdl_user', $_user);
				
				$_data = array(
					"usr_id"		=> $_usr_id,
					"nip"			=> $_l[0],
					"nama_lengkap" 	=> $_l[1],
					"tgl_lahir"		=> bbdate($_l[2]), 
					"posisi"		=> $_l[3], 
					"atasan_nip"	=> $_l[4], 
					"tgl_masuk"		=> bbdate($_l[5]),
					"company"		=> $_l[6],
					"tipe_karyawan"	=> $_l[7],
					"jabatan"		=> $_l[8],
					"grade"			=> $_l[9],
					"level"			=> $_l[10],
					"cost_ctr"		=> $_l[11],
					"pool"			=> $_l[12],
					"status_karyawan"=> $_l[13],
					"email_corporate"=> strtolower($_l[14]),
				);
				
				$this->bluehrd_user_m->__insert('mdl_user_data', $_data);
			}
		}
		
		redirect(base_url()."bluehrd/user");
	}
	
	
	function generate_md5($pass){
		
		$this->config->load('user/user');
		
		return md5($pass. $this->config->item('hash'));
	}

	function hapus($_id = false){
		
		$this->bluehrd_user_m->__delete('mdl_user_data', array('usr_id'=>$_id)) ?
		
		redirect(base_url().'bluehrd/user/index') : die('error cannot delete user '.$_id);
	}
}
