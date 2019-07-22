<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends GW_User {
	
	function __construct(){
	
		parent::__construct();
	
		$this->load->model("perusahaan_m");
		
		$this->usr_id = get_session("user_id");
		
		$this->breadcrumb = array();
	}
	
	function index(){

		$data['include_script'] = inc_script(
		
			array(
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
				
				"cms/plugin/perusahaan/js/perusahaan.js",
			)
		);

		
		$data['title']	= "Data Perusahaan";
		
		$_usr 	= $this->perusahaan_m->__select('mdl_user_data', '*', array('usr_id'=>get_session("user_id")), false);
		
		$_w 	= array(
					"company_id"=>@if_empty($_usr->company, ''),
					"jabatan_id"=>@if_empty($_usr->jabatan, '')
				);
		
		$data['perusahaan'] = $this->perusahaan_m->get_list_perusahaan();
		//$data['provinsi'] = $this->perusahaan_m->getProvinsi();
		$data['breadcrumb_active'] = $data['title'];
		
		$data['str_category']= json_decode(Modules::run("api/options", "bb_opt_category_perusahaan"), true);
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_list', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function view($company_id = 'no value') {
			
		$data['perusahaan'] = $this->perusahaan_m->get_single_perusahaan(array('i.company_id'=>$company_id));
		
		$data['breadcrumb_active'] = $data['perusahaan']->title;
		
		$_nav_list_id = $this->perusahaan_m->get_menu_company_id($company_id);
		
		$data['breadcrumb'] = $this->build_breadcrumb($_nav_list_id);
		
		$this->load->helper('navigation/navigation_h');
		
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage('user_view', 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function build_breadcrumb($nav_list_id) {
		
		$_nav = $this->perusahaan_m->get_menu($nav_list_id);
		
		if( $_nav->id) {
			
			$this->breadcrumb[] = $_nav;
			
			if($_nav->parent_id != 0) $this->build_breadcrumb($_nav->parent_id);
		}
		
		return array_reverse($this->breadcrumb);
	}

//Andy
	function tambah($page = 1){

		$data['include_script']  = inc_script(array(
		
		));

		$data['title'] = 'Profil perusahaan.';
	
		$this->load->library('form_validation');
		$data['include_script']  = inc_script(array(
		
		));
		$data['title'] = 'Input Data perusahaan';	
		$this->form_validation->set_rules('nama', 'Nama perusahaan', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required');
		$this->form_validation->set_rules('kodepos', 'Kodepos', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if ($this->form_validation->run() == false) {		

		redirect('perusahaan', $data);
		} else {
			$this->load->model('perusahaan_m', 'perusahaan'); //load Menu_model dibuat alias menu
			$data['perusahaan'] = $this->perusahaan->tambahperusahaan();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					New perusahaan has been added!
					</div>');
			redirect('perusahaan');
		}

	}

	function hapus($id)
    {
        $this->load->model('perusahaan_m', 'perusahaan'); //load Menu_model dibuat alias menu
		$data['perusahaan'] = $this->perusahaan->hapusperusahaan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Data has been deleted!
					</div>');
        redirect('perusahaan');
	}
	
	public function edit($id)
    {
        $data['include_script']  = inc_script(array(
		
		));

		$data['title'] = 'Data perusahaan.';
	
		$this->load->library('form_validation');
		$data['include_script']  = inc_script(array(
		
		));
		$data['title'] = 'Input Data perusahaan';
		$data['perusahaan'] = $this->perusahaan_m->getperusahaanById($id);	
		$this->form_validation->set_rules('nama', 'Nama perusahaan', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required');
		$this->form_validation->set_rules('kodepos', 'Kodepos', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == false) {		
		$this->masterpage->addContentPage('edit_perusahaan', 'contentmain', $data);
		$this->masterpage->show( ); 
        } else {
            $this->perusahaan_m->editperusahaan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Data perusahaan Updated!
					</div>');
            redirect('perusahaan');
        }       
    }
}
