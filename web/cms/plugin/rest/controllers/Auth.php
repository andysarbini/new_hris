<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * kode ini sebagai jembatan untuk masuk kedalam system
 * user melakukan post ke fungsi ini dan mendapatkan return token
 * 
 */

require_once APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class auth extends REST_Controller
{
	function __construct(){

		parent::__construct();
	}

	function token_post(){

		$p 		= $this->input->post();
		$user 	= $this->auth_m->login($p['username'], $p['password']);
		if($user != null){
			$tokenData = Array();
			$tokenData['id'] 	= $user->id;
			$response['token']	= Authorization::generateToken($tokenData);
			$this->set_response($response, REST_Controller::HTTP_OK);
			return;
		}
		
		$response = [
			'status'	=> REST_Controller::HTTP_UNAUTHORIZED,
			'message'	=> 'Unauthorized',
		];

		$this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);

	}
/**/	
}
