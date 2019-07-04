<?php

/**
 * 
 * @author g3n1k
 * class ini untuk meringkas penulisan code pagging yang cukup panjang
 * 
 */

class paging {
	
	private $_paging_cfg = array();
	
	function __construct(){
		
		$this->_paging_cfg = array( 
				
				'full_tag_open' => '<ul class="pagination pagination-sm">',
				
				'full_tag_close' => '</ul>',
				
				'next_link'	=> '&rsaquo;',
				
				'prev_link'	=> '&lsaquo;',
		
				'per_page' => Modules::run('api/options','cfg_thumb_per_page'),
		
				'base_url' => base_url().current_module().'/'.current_class().'/'.current_function().'/',
				
				'use_page_numbers' => TRUE,
				
				'num_tag_open' => '<li>',
				
				'num_tag_close' => '</li>',
				
				'prev_tag_open' => '<li>',
				
				'prev_tag_close' => '</li>',
				
				'next_tag_open' => '<li>',
				
				'next_tag_close' => '</li>',
				
				'first_tag_open' => '<li>',
				
				'first_tag_close' => '</li>',
				
				'last_tag_open' => '<li>',
				
				'last_tag_close' => '</li>',
				
				'cur_tag_open' => '<li class="active"><a href="#">',
				
				'cur_tag_close' => '</a></li>',
				
				'uri_segment' => 4,
				
				'first_url' => 1
				
		);
	}
	/**
	 * 
	 * @param number $_rows
	 * @param unknown $_cfg
	 * @return string
	 */
	function create( $_rows = 0, $_cfg = array()){
		
		if(!$_rows) return "You Must Input Number Row";
		
		else $this->_paging_cfg['total_rows'] = $_rows;
		
		if(count($_cfg)) $this->_paging_cfg = array_merge($this->_paging_cfg, $_cfg);
		
		$ci = &get_instance();
		
		$ci->load->library('pagination');
		
		$ci->pagination->initialize($this->_paging_cfg);
	
		return $ci->pagination->create_links();
	}
}
