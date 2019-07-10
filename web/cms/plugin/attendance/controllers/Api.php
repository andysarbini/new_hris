<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("att_m");

		$this->usr_id = get_session("user_id");
		
	}

	// tampilan untuk user
	function index(){
		
	}
	
	function get_single_attendance(){
		
		$_p = array();
		
		foreach($_POST as $var=>$val) $_p[$var] = $this->input->post($var);
		
		$_p["date_in"] = $_p["year"]."-".$_p["month"]."-".$_p["date"];
		
		$data["att"] = $this->att_m->get_single_attendance($_p["usr_id"], $_p["date_in"]);
		
		$this->load->view("single_attendance", $data);
	}
	/**
	 * input => untuk absen masuk
	 * update => untuk absen keluar
	 */
	function absen($_id = false){
		
		$_ = array('status'=>'', 'message'=>'');

		$this->load->helper('attendance');

		$_dt = get_now_time();
		
		// keluar
		if($_id) {
			
			$_w['att_id'] = $_id;
			
			if($this->validate_kepemilikan()) {

				if($this->validate_lat_lon()){

					$_data = array(
						'lat_out'=>$this->input->post('lat'),
						'lon_out'=>$this->input->post('lon'),
						'date_out'=>$_dt[0],
						'time_out'=>$_dt[1],
					);

					$this->att_m->__update('mdl_attendance', $_data, $_w);

					$_ = array('status'=>'success', 'message'=>'absensi keluar');
				}

				else $_ = array('status'=>'error', 'message'=>'posisi anda tidak dekat kantor');
			} 
			
			else $_ = array('status'=>'error', 'message'=>'tidak sesuai');
		} 
		
		// masuk
		else {
			
			if($this->validate_lat_lon()){
				
				$_data = array(
					'lat_in'=>$this->input->post('lat'),
					'lon_in'=>$this->input->post('lon'),
					'date_in'=>$_dt[0],
					'time_in'=>$_dt[1],
				);
			
				$this->att_m->__insert('mdl_attendance', $_data);

				$_ = array('status'=>'success', 'message'=>'absensi masuk');
			
			}
		}

		echo json_encode($_);
	}

	/** validasi didalam area koordinat yg di di perbolehkan
	*/ 
	private function validate_lat_lon($_lat = false, $_lon = false){
		
		// validate long lat

		if(!$_lat) $_lat = $this->input->post('lat');

		if(!$_lon) $_lon = $this->input->post('lon');

		$this->load->config('attendance');

		$_r	= $this->config->item('lon_lat_r');

		$this->load->helper('attendance');

		$_a = $this->att_m->__select('mdl_user_office', 'office_id', array('usr_id'=>$this->usr_id), false);
		
		$_off_id = jsond_decode($_a->office_id, true);

		foreach($_off_id as $_id){

			$_ = $this->att_m->__select('mdl_office', 'lon,lat', ['office_id'=>$_id], false);

			if(!accept_lat_lon($_lon, $_->lon, $_r)) return false;

			if(!accept_lat_lon($_lat, $_->lat, $_r)) return false;
		}

		return true;
	} 
	/**validasi user hanya boleh mengubah absensi milik nya
	 */
	private function validate_kepemilikan(){
		// validate kepemilikan
		$_w = array(
			'usr_id' 	=> $this->usr_id,
			'date_out'	=> '',
			'time_out'	=> '',
			'lat_out'	=> '',
			'lon_out'	=> ''  
		);

		$this->load->model('att_m');

		$_q = $this->att_m->__select('mdl_attendance', '*', $_w, false);

		if(!count($_q)) return false;
		
		return true;
	}


}
