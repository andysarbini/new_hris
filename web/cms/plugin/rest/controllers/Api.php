<?php defined('BASEPATH') OR exit('No direct script access allowed');


class api extends GW_Controller
{
	function __construct(){

		parent::__construct();
	}

	function index(){
		echo "index in api";
	}
	
}
