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
		
		$_ = array('status'=>'error', 'message'=>'Nyalakan GPS Perangkat Anda!!!');

		$this->load->helper('attendance');

		
		$_lat = $this->input->post('lat');
		$_lon = $this->input->post('lon');
		$_off = $this->input->post('office_id');
		$_id  = $this->input->post('att_id');

		$_ofc = $this->att_m->__select('mdl_office', 'gmt', array('office_id'=>$_off), false);
		
		$_dt = get_now_time((int) $_ofc->gmt);


		// hanya yg ada lat dan lon yg di proses
		if(isset($_lat) && isset($_lon)) {
		
			// keluar
			if($_id) {
				
				$_w['att_id'] = $_id;
				
				if($this->validate_kepemilikan()) {

					if($this->validate_lat_lon($_off, $_lat, $_lon)){

					
						$_data = array(
							'lat_out'=>$_lat,
							'lon_out'=>$_lon,
							'date_out'=>$_dt[0],
							'time_out'=>$_dt[1],
						);

						$this->att_m->__update('mdl_attendance', $_data, $_w);

						$_ = array('status'=>'success', 'message'=>'absensi keluar');
					}

#					else $_ = array('status'=>'error', 'message'=>'posisi anda tidak dekat kantor');
					else $_ = array('status'=>'error', 'message'=>'lat:'.$_lat.'\n\r'.'lon:'.$_lon.'\n\r');
				} 
				
				else $_ = array('status'=>'error', 'message'=>'tidak sesuai');
			} 
			
			// masuk
			else {
				
				if($this->validate_lat_lon($_off, $_lat, $_lon)){

					$_tmp = $this->att_m->__select('mdl_user_data', 'nip', array('usr_id'=>$this->usr_id), false);	

					$_data = array(
						'usr_id'=>$this->usr_id,
						'nip' => $_tmp->nip,
						'lat_in'=>$_lat,
						'lon_in'=>$_lon,
						'date_in'=>$_dt[0],
						'time_in'=>$_dt[1],
					);
				
					$this->att_m->__insert('mdl_attendance', $_data);

					$_ = array('status'=>'success', 'message'=>'absensi masuk');				
				}

				else $_ = array('status'=>'error', 'message'=>'posisi anda tidak dekat kantor');
			}
		}
		
		echo json_encode($_);
	}

	/** validasi didalam area koordinat yg di di perbolehkan
	*/ 
	private function validate_lat_lon($_off_id = false, $_lat = false, $_lon = false){
		
		// validate long lat

		if(!$_lat) $_lat = $this->input->post('lat');

		if(!$_lon) $_lon = $this->input->post('lon');

		if(!$_off_id) $_off_id = $this->input->post('office_id');

		$this->load->config('attendance');

		$_r	= $this->config->item('lon_lat_r');

		$this->load->helper('attendance');

		$_ = $this->att_m->__select('mdl_office', 'lon,lat', array('office_id'=>$_off_id), false);
		
		if(!accept_lat_lon($_lon, $_->lon, $_r)) return false;

		if(!accept_lat_lon($_lat, $_->lat, $_r)) return false;

		return true;
	} 
	/**validasi user hanya boleh mengubah absensi milik nya
	 */
	private function validate_kepemilikan(){
		// validate kepemilikan
		$_w = array(
			'usr_id' 	=> $this->usr_id,
			'att_id'	=> $this->input->post('att_id')
		);

		$this->load->model('att_m');

		$_q = $this->att_m->__select('mdl_attendance', '*', $_w, false);
		
		if(!count((array)$_q)) return false;
		
		return true;
	}


}
