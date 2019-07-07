<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * menggunakan 2 table
 * mdl_rating, berisi jumlah total dari log
 * mdl_rating_log, user yg mengakses
 * 
 */
 
class Rating extends GW_User {

	var $usr_id = 0;

	function __construct(){
	
		parent::__construct();
	
		$this->load->model("rating_m");
		
	}

	function index(){

	}
	
	function get($content_id= null){
		
		$_w['usr_id'] = @if_empty($this->input->post('user_id'), get_session("user_id"));
		
		$_w['content_id'] = @if_empty($this->input->post('content_id'), $content_id);
		
		//dump_exit($_w);
		
		if($this->rating_m->is_ever_view($_w)) $this->rating_m->update("view", $_w);
		
		$data['rating'] = $this->rating_m->get($_w['content_id']);
		
		$data['content_id'] = $_w['content_id'];
		
		$_isview = @if_empty($this->input->get('format'), false);
		
		if($_isview) echo json_encode($data);
		
		else $this->load->view("rating_html_read", $data);
	}
	
		
	/**
	 * update(love/view, 123)
	 */ 
	function update($column_view_or_love, $content_id = false){
		
		$_w = array("content_id"=>$content_id ? $content_id : $this->input->post("content_id"), "usr_id"=>@if_empty($this->input->post("user_id"), get_session('user_id')));
		
		$data["rating"] = $this->rating_m->update($column_view_or_love, $_w);
		
		$data['content_id'] = $_w['content_id'];
		
		$_isview = @if_empty($this->input->get('format'), false);
		
		if($_isview) echo json_encode($data);
		
		else $this->load->view("rating_html", $data);
	}

	/**
	 * clone update for love only (love/view, 123)
	 * return display love is rated
	 */ 
	function update_ver2($column_love, $content_id = false){
		$size = $this->input->post("size");
		$_w = array("content_id"=>$content_id ? $content_id : $this->input->post("content_id"), "usr_id"=>@if_empty($this->input->post("user_id"), get_session('user_id')));
		$result_row = $this->rating_m->update($column_love, $_w);
		if($size == "medium"){
			echo '<span class="far fa-heart text-danger fa-fw"></span> '.$result_row->love;
		}
		if($size == "large"){
			echo '<span class="far fa-heart text-danger fa-lg"></span> '.$result_row->love;
		}
	}

	/**
	 * clone update for love only for comment(love/view, 123)
	 * return display love is rated
	 */ 
	function update_ver3($column_love, $content_id = false){
		$size = $this->input->post("size");
		$_w = array("forum_id"=>$content_id ? $content_id : $this->input->post("forum_id"), "usr_id"=>@if_empty($this->input->post("user_id"), get_session('user_id')));
		$result_row = $this->rating_m->update_forum($column_love, $_w);
		if($size == "medium"){
			echo '<span class="far fa-heart text-danger fa-fw"></span> '.$result_row->love;
		}
		if($size == "large"){
			echo '<span class="far fa-heart text-danger fa-lg"></span> '.$result_row->love;
		}
	}

	/*
	 * show list comment 
	 */ 
	function comment($content_id, $page = 1){
		
		$data['content_id'] = $content_id;
		
		$_firt_char_id = substr($data['content_id'], 0, 1);
		
		switch($_firt_char_id){
			
			case 'f': // forum
					
					$data['comments'] = $this->rating_m->get_comment($content_id, $page);
		
					$view = "comment_single_html_forum";
				
				break;
			
			case 'g': // gallery
			
					$data['comments'] = $this->rating_m->get_comment_g($content_id, $page);
		
					$view = "comment_gallery";	
			
				break;
			
			default: // content
			
				$data['comments'] = $this->rating_m->get_comment($content_id, $page);
			
				$view = "comment_html";	
			
				break;
		}
		
		
		$this->load->view($view, $data);
	}
	
	function comment_save(){
		
		$_d['content_id'] = $this->input->post('content_id');
		
		if($_d['content_id']){
			if(substr($_d['content_id'], 0, 1) == 'f'){
				$id_forum = str_replace("f","",$_d['content_id']);
				$_d['forum_id'] = $id_forum;
			}
			if(substr($_d['content_id'], 0, 1) == 'g'){
				$id_gallery = str_replace("g","",$_d['content_id']);
				$_d['gallery_id'] = $id_gallery;
			}
		}
		if(@if_empty($this->input->post('value'))){
			$_d['value'] =  strip_tags($this->input->post('value'));
		}
		
		$_d['type']		= 'comment';
		
		$_d['usr_id']	= get_session('user_id');
		
		$this->rating_m->__insert('mdl_rating_log', $_d);
		
		$this->rating_m->update_number_comment($_d['content_id']);
		
		$data['comments'] = $this->rating_m->get_comment( $_d['content_id'] );
		
		if(substr($_d['content_id'], 0, 1) == 'f'){
			//Forum
			$this->load->view("comment_single_html_forum", $data);
		}elseif(substr($_d['content_id'], 0, 1) == 'g'){
			//Gallery
			$this->load->view("comment_single_html", $data);
		}else{
			$this->load->view("comment_single_html", $data);
		} 
	}
	
	function comment_page($content_id, $page=1){
		
		$data['comments'] = $this->rating_m->get_comment( $content_id, $page );
		
		$this->load->view("comment_single_html", $data);
	}
/**
 * comment untuk image berbasis ajax
 * maka di buat metode lain
 * / 
	function gallery_image_get_comment($img_id){
		
		$data['comments'] = $this->rating_m->gallery_image_get_comment($img_id);
		
		$data['img_id'] = $img_id;
		
		$this->load->view('comment_gallery', $data);
	}
	
	function gallery_image_comment_save(){
		
		$_d['gallery_id'] = $this->input->post('img_id');
		
		$_d['value']	= $this->input->post('value');
		
		$_d['type']		= 'comment';
		
		$_d['usr_id']	= get_session('user_id');
		
		$this->rating_m->__insert('mdl_rating_log', $_d);
		
		$this->rating_m->update_number_comment_gallery($_d['gallery_id']);
		
		$data['comments'] = $this->rating_m->gallery_image_get_last_comment( $_d['gallery_id'] );
		
		$this->load->view("comment_single_html", $data);
	}
	
	function gallery_image_update($column_view_or_love, $img_id){
		
		$_w = array("gallery_id"=>$img_id ? $img_id : $this->input->post("img_id"), "usr_id"=>@if_empty($this->input->post("user_id"), get_session('user_id')));
		
		$data["rating"] = $this->rating_m->update($column_view_or_love, $_w);
		
		$data['img_id'] = $_w['img_id'];
		
		$this->load->view("rating_html", $data);
	}
	*/
}
