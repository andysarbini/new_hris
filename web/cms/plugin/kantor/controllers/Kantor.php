<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kantor extends GW_User {
	
	function __construct(){
	
		parent::__construct();
	
		$this->load->model("kantor_m");
		
		$this->usr_id = get_session("user_id");
		
		$this->breadcrumb = array();
	}
	
	function index(){

		$data['include_script'] = inc_script(
		
			array(
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
				
				"cms/plugin/kantor/js/info.js",
			)
		);

		
		$data['title']	= "Pusat Informasi Kantor";
		
		$_usr 	= $this->kantor_m->__select('mdl_user_data', '*', array('usr_id'=>get_session("user_id")), false);
		
		$_w 	= array(
					"company_id"=>@if_empty($_usr->company, ''),
					"jabatan_id"=>@if_empty($_usr->jabatan, '')
				);
		
		$data['kantor'] = $this->kantor_m->get_list_kantor($_w);
		
		$data['breadcrumb_active'] = $data['title'];
		
		$data['str_category']= json_decode(Modules::run("api/options", "bb_opt_category_informasi"), true);
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function view($info_id = 'no value') {
			
		$data['info'] = $this->kantor_m->get_single_info(array('i.info_id'=>$info_id));
		
		$data['breadcrumb_active'] = $data['info']->title;
		
		$_nav_list_id = $this->kantor_m->get_menu_info_id($info_id);
		
		$data['breadcrumb'] = $this->build_breadcrumb($_nav_list_id);
		
		$this->load->helper('navigation/navigation_h');
		
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_view', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function build_breadcrumb($nav_list_id) {
		
		$_nav = $this->kantor_m->get_menu($nav_list_id);
		
		if( $_nav->id) {
			
			$this->breadcrumb[] = $_nav;
			
			if($_nav->parent_id != 0) $this->build_breadcrumb($_nav->parent_id);
		}
		
		return array_reverse($this->breadcrumb);
	}
	function tambah($page = 1){

		$data['include_script']  = inc_script(array(
		
		));

		$data['title'] = 'Input Data Kantor';
	
		$this->load->library('form_validation');
		$data['include_script']  = inc_script(array(
		
		));
		$data['title'] = 'Input Data Kantor';			
		$data['provinsi'] = $this->kantor_m->getProvinsi();
		$data['per'] = $this->kantor_m->getPerusahaan();
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required');
		$this->form_validation->set_rules('nama_kantor', 'Nama Kantor', 'required');
		$this->form_validation->set_rules('alamat_kantor', 'Alamat', 'required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
		$this->form_validation->set_rules('kabupaten', 'Kab/Kota', 'required');
		$this->form_validation->set_rules('longitude', 'Longitud', 'required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required');
		$this->form_validation->set_rules('gmt', 'GMT', 'required');
		if ($this->form_validation->run() == false) {

            //$this->load->view('templates/header', $data);			
		$this->masterpage->addContentPage('form_kantor', 'contentmain', $data);
		$this->masterpage->show( );
		} else {
			/*$data = [
                'nip' => $this->input->post('nip_kantor'),
                'nama' => $this->input->post('nama_kantor')               
            ];
            $this->db->insert('hris_kantor', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					New kantor added!
					</div>');
			redirect('kantor/tambah');*/
			$this->load->model('kantor_m', 'kantor'); //load Menu_model dibuat alias menu
			$data['kantor'] = $this->kantor->tambahkantor();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					New kantor has been added!
					</div>');
			redirect('kantor');
		}	
	}

}

