<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @author g3n1k
 * to recover lost password
 * 
 */
class recovery extends GW_Controller {
	/**
	 * halaman yang dibuka dari email berisi url untuk recover password
	 * input berupa token yg digenerate system, dan ada batas expirednya
	 * halaman ini menampikan view untuk menerima password baru
	 * @param string $k = string
	 */
	function key($k){
		
	}
	/**
	 * halaman form input email untuk login
	 */
	function index(){
		
		$data['url_key'] = base_url().'user/recovery/sendkey';
		
		$this->masterpage->addContentPage('recovery/input_email', 'contentmain',$data);
		
		$this->masterpage->show( );
	}
	
	/**
	 * dari index, menerima alamat email dan mengirimkan email recovery
	 */
	function sendkey(){
		$email = $this->input->post('email');
		// generate key
		$key = $this->createkey($email);
		// send via mail
		
	}
	/**
	 * 
	 * @return string
	 */
	private function createkey($email=null){
		
		$this->load->model('user_m');
		if($email) {
			$data['USR_ID'] = $this->user_m->__select('mdl_user', 'USR_ID id', array('USR_EMAIL'=>$email), false)->id;
		} else die();
		
		$now = time();
		$data['REC_EXPIRED'] = $now+ ( 24 * 60 * 60); // expired 1x24 jam
		$data['REC_KEY'] = md5($now.$email);
		
		// simpan kedalam database
		$this->user_m->__insert('mdl_user_recovery', $data);
		return $key;
	}
}