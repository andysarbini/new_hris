<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @author g3n1k
 * 
 */
class GW_Public extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	
		$this->masterpage->setMasterPage(get_option('template') );
	}
}
