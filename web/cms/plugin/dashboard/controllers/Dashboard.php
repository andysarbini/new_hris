<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends GW_User
{
	function __construct(){
		parent::__construct();
		$this->load->model("dashboard_m");
		$this->load->model("bluehrd/bluehrd_user_m");
		$this->load->helper("dashboard");
		$this->load->library('pagination');	
	}

	function index($start=1){

		$data["title"] = "Dashboard";
		$data['include_script'] = inc_script(
			array(
		
				"cms/plugin/dashboard/js/dashboard.js",
				"cms/plugin/rating/js/rating_live.js",
			)
		);
		
		$data["user"]		= $this->bluehrd_user_m->get_user(get_session('user_id'));
		$data["articles"] 	= $this->dashboard_m->dashboard_news($start);
		$data["featured"] 	= $this->dashboard_m->featured_articles();
		//echo "<pre>"; print_r($data["featured"]); die;
		//$data["popular"]  = $this->dashboard_m->popular_news();
		$data_gallery 	= $this->dashboard_m->latest_gallery();
		shuffle($data_gallery);
		$data["gallery"] = $data_gallery;

		$filter['IS_DELETE'] = 0;
		$filter['IS_ACTIVE'] = 1;
		$filter['limit'] = 3;
		$filter['offset'] = 0;
		$filter['order_by'] = "mdl_rating.comment desc, mdl_rating.view desc, mdl_rating.love desc, mdl_forum.POST_CREATED desc";
		$data['toptri_forum_post_list'] = $this->dashboard_m->get_post_forum_list($filter);
		//echo "<pre>"; print_r($data['toptri_forum_post_list']); die;

		/*$filter['IS_DELETE'] = 0;
		$filter['IS_ACTIVE'] = 1;
		//$filter['not_in_id'] = $data_id_toptri;
		$filter['limit'] = 6;
		$filter['offset'] = 0;
		$filter['order_by'] = "mdl_rating.view desc, mdl_rating.love desc, mdl_rating.comment desc, mdl_forum.POST_CREATED desc";
		$data['topten_forum_post_list'] = $this->dashboard_m->get_post_forum_list($filter);*/

		$filter['IS_ACTIVE'] = 1;
		$data['forum_categories'] = $this->dashboard_m->get_forum_categories($filter);

		$data["paging"]   = $this->paging();
		
		// get max 10 birthday user
		// Render per hari di panel box DAY d
		// Render per month di panel box MONTH m
		$data['birthdays'] = $this->dashboard_m->get_birthday_month( array("DAY(tgl_lahir)"=>date("d")),10);
		
		$this->load->view("dashboard", $data);
	}

	function news(){
		$param_cat_uri = $this->uri->segment(2);
		$id_news = $this->uri->segment(3); 
		if($id_news){
			$this->view($id_news);
		}else{
			$data['include_script'] = inc_script(
				array(
					"cms/plugin/dashboard/js/berita.js",
					"cms/plugin/rating/js/rating_live.js",
				)
			);
			$data["category_id"] = 0;
			if($param_cat_uri){
				$filter['CAT_URI'] = $param_cat_uri;
				$cat_info = $this->dashboard_m->get_category_content_info($filter);
				if($cat_info){
					$data["category_id"] = $cat_info->CAT_ID;
				}
				if($data["category_id"] == 12){ //Artikel
					$category_filter_sidebar = array(24,25); //Default News
					$filter2['array_category_id'] = $category_filter_sidebar;
					$filter2['limit'] = 8;
				}else{
					$category_filter_sidebar = 12; //Default Artikel
					$filter2['category_id'] = $category_filter_sidebar;
					$filter2['limit'] = 8;
				}
				$data['data_list_artikel'] = $this->dashboard_m->get_content_list($filter2);
				$data["title"] = "Artikel & Berita";
				$data['breadcrumb_parent'] = "Artikel & Berita";
				$data['breadcrumb_parent_uri'] = "news";
				$data['breadcrumb_active'] = $cat_info->CAT_TITLE;
			}else{
				$category_filter_sidebar = 12; //Default Artikel
				$filter2['category_id'] = $category_filter_sidebar;
				$filter2['limit'] = 8;
				$data['data_list_artikel'] = $this->dashboard_m->get_content_list($filter2);
				$data["title"] = "Artikel & Berita";
				$data['breadcrumb_active'] = "Artikel & Berita";
			}
			$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
			$this->masterpage->addContentPage("news_list", 'contentmain', $data);
			$this->masterpage->show();
		}
	}

	function bbl($id_post){
		$this->view($id_post,"single_content_bbl");
	}
	
	function bblearning($_uri = false){
		$data['include_script'] = inc_script(
			array(
				"cms/plugin/dashboard/js/bblearning.js",
			)
		);
		$keywords = $this->input->get('keywords', TRUE);
		$data['original_keywords'] = $keywords;
		if(empty($keywords) ){
			$keywords = "";
		}else{
			$keywords = str_replace(" ", "-",$this->db->escape($keywords));
			$keywords = str_replace("'", "",$keywords);
		}

		$categories = array();
		$filter['OPT'] =  'bb_opt_category';
		$obj_options = $this->dashboard_m->get_options($filter);
		if(@if_empty($obj_options->OPT_VAL)){
			$categories = json_decode($obj_options->OPT_VAL, true);
			foreach($categories as $v){
				$uri = $this->_generate_uri($v);
				$obj_category[] = (object) array('id' => $uri, 'title' => $v); 
			}
		}
		$data['obj_category'] = $obj_category;
		$data["title"] = "Limitless Learning";
		$data["label"] = "BBLearning";
		$data['breadcrumb_active'] = "Limitless Learning";
		$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
		$this->masterpage->addContentPage("bblearning", 'contentmain', $data);
		$this->masterpage->show();
	}

	function gallery($_uri = false){
		$data['include_script'] = inc_script(
			array(
				"cms/plugin/dashboard/js/gallery.js",
			)
		);
		$keywords = $this->input->get('keywords', TRUE);
		$data['original_keywords'] = $keywords;
		if(empty($keywords) ){
			$keywords = "";
		}else{
			$keywords = str_replace(" ", "-",$this->db->escape($keywords));
			$keywords = str_replace("'", "",$keywords);
		}

		$categories = array();
		$filter['OPT'] =  'bluehrd_cfg_company';
		$obj_options = $this->dashboard_m->get_options($filter);
		if(@if_empty($obj_options->OPT_VAL)){
			$categories = json_decode($obj_options->OPT_VAL, true);
			foreach($categories as $v){
				$uri = $this->_generate_uri($v);
				$obj_category[] = (object) array('id' => $uri, 'title' => $v); 
			}
		}
		$data['obj_category'] = $obj_category;
		$data["title"] = "Galeri Foto & Video";
		$data['breadcrumb_active'] = "Galeri Foto & Video";
		$data["label"] = "Gallery";
		$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
		$this->masterpage->addContentPage("gallery", 'contentmain', $data);
		$this->masterpage->show();
	}

	function gallery_detail($uri_gallery){
		// Get Data Gallery Info 
		// $uri_gallery = $this->db->escape($uri_gallery);
		$filter['GALL_URI'] = $uri_gallery;
		$gall_info = $this->dashboard_m->get_gallery_info($filter);
		$data['gall_info_result'] = $gall_info;
		$data["title"] = $gall_info->GALL_NAME;
		$data["description"] = $gall_info->GALL_DESC;
		$data['breadcrumb_parent_uri'] = "gallery";
		$data['breadcrumb_parent'] = "Galeri";
		$data['breadcrumb_active'] = $gall_info->GALL_NAME;
		// Get Data Gallery Foto / Video 
		$filter2['GALL_ID'] = $gall_info->GALL_ID;
		$gall_pic_list = $this->dashboard_m->get_pics_of_gallery($filter2);
		$data['result'] = $gall_pic_list;
		// Get Data Sidebar
		$filter3['GALL_ID'] = $gall_info->GALL_ID;
		$gall_list = $this->dashboard_m->get_galleries($filter3);
		shuffle($gall_list);
		$data['sidebar_result'] = $gall_list;
		$data['include_script'] = inc_script(
			array(
				"cms/plugin/dashboard/js/gallery_modal.js",
				"cms/plugin/rating/js/rating_update_g.js",
			)
		);

		$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
		$this->masterpage->addContentPage("gallery_detail", 'contentmain', $data);
		$this->masterpage->show();
	}
	
	function forum(){
		$label = "Birdbagi Forum";
		$title = $description = "";
		$uri = $this->uri->segment(1);
		$page = $this->uri->segment(2);
		if($uri){
			$filter['NAV_LIST_URI'] = $uri;
			$page_info = $this->dashboard_m->get_nav_info($filter);
			if($page_info){
				$label = $page_info->NAV_LIST_TITLE;
				$title = $page_info->NAV_LIST_TITLE;
			}
		}
		$data['uri'] = $uri;
		$data['page'] = $page;
		if(!empty($page) && ($page == "posting-diskusi-baru")){
			//Go to Form Posting
			$cat_param_form = $this->uri->segment(3);
			$data['cat_param'] = $cat_param_form;
			$data["title"] = $title;
			$data['breadcrumb_parent'] = $label;
			$data['breadcrumb_parent_uri'] = $uri;
			$data['description'] = $description;
			$filter2['CAT_URI'] = $cat_param_form;
			$data['category_info'] = $this->dashboard_m->get_forum_category_info($filter2);
			if($data['category_info']['IS_CONTENT_TEXT'] == 1){
				$data['include_script'] = inc_script(
					array(
						"includes/ckeditor/ckeditor.js",
						"cms/plugin/dashboard/js/forum_ckeditor.js",
					)
				);				
			}else{
				$data['include_script'] = inc_script(
					array(
						"includes/ckeditor/ckeditor.js",
					)
				);	
			}
			$data['forum_info'] = array();
			$data['title'] = "Posting Diskusi Baru";
			$data['breadcrumb_active'] = "Posting Diskusi Baru";
			$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
			$this->masterpage->addContentPage("forum_posting_form", 'contentmain', $data);
		}if(!empty($page) && ($page == "mypost")){
			// Go to Postingan Saya
			$data['include_script'] = inc_script(
				array(
					"cms/plugin/dashboard/js/forum_form.js",
				)
			);	
			$data['breadcrumb_parent'] = $label;
			$data['breadcrumb_parent_uri'] = $uri;
			$data['description'] = $description;
			$data['title'] = "Postingan Saya";
			$data['breadcrumb_active'] = "Postingan Saya";
			$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
			$this->masterpage->addContentPage("forum_my_posting", 'contentmain', $data);
		}else{
			if(empty($page)){
				//Set Default as ALL Category
				$page = "all";
			}
			if(!empty($page) && ($page != "posting-diskusi-baru")){
				$param_post_uri = $this->uri->segment(3);
				$param_post_id = $this->uri->segment(4);	
				if(!empty($param_post_uri)){
					//Go to detail post view
					$data['include_script'] = inc_script(
						array(
							"cms/plugin/rating/js/rating_update_g.js",
							"cms/plugin/rating/js/rating_live.js"
						)
					);	
					$data["title"] = $title;
					$data['breadcrumb_parent'] = $label;
					$data['breadcrumb_parent_uri'] = $uri;
					$data['description'] = $description;

					$filter3['CAT_URI'] = $page; 
					$filter3['POST_URI'] = $param_post_uri; 
					$filter3['POST_ID'] = $param_post_id;
					$data['forum_detail'] = $this->dashboard_m->get_post_forum_info($filter3);
					//echo "<pre>"; print_r($data['forum_detail']); die;
					if(empty($data['forum_detail'])){
						redirect('birdbagi-forum');
					}
					//Update COUNT VIEW
					$this->_counter_view_forum($data['forum_detail']);
				
					//Get Sidebar Info
					$filter4['IS_DELETE'] = 0;
					$filter4['IS_ACTIVE'] = 1;
					if(isset($data['forum_detail']->POST_URI)){
						$filter4['EXCEPT_URI'] = $data['forum_detail']->POST_URI;
					}
					$filter4['POST_CATEGORY_ID'] = $data['forum_detail']->POST_CATEGORY_ID;
					$filter4['limit'] = 6;
					$filter4['offset'] = 0;
					$filter4['order_by'] = "mdl_rating.view desc, mdl_rating.love desc, mdl_rating.comment desc, mdl_forum.POST_CREATED desc";
					$data['sidebar_post_list'] = $this->dashboard_m->get_post_forum_list($filter4);
	
					if($data['forum_detail']){
						$data['breadcrumb_parent_cat'] = $data['forum_detail']->CAT_TITLE;
						$data['breadcrumb_parent_cat_uri'] = $page;
						$data['breadcrumb_active'] = $data['forum_detail']->POST_TITLE;
					}
					$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
					$this->masterpage->addContentPage("forum_board", 'contentmain', $data);
				}else{
					//Go to forum list page
					$data['include_script'] = inc_script(
						array(
							"cms/plugin/dashboard/js/forum.js",
							"cms/plugin/rating/js/rating_live.js"
						)
					);	
					$keywords = $this->input->get('keywords', TRUE);
					$data['original_keywords'] = $keywords;
					$category_uri = $this->uri->segment(2);
					if(empty($keywords) ){
						$keywords = "";
					}else{
						$keywords = str_replace(" ", "-",$this->db->escape($keywords));
						$keywords = str_replace("'", "",$keywords);
					}
					$data['keywords'] = $keywords;
					if(empty($category_uri) ){
						$category_id = "0";
					}else{
						$filter2['CAT_URI'] = $category_uri;
						$category_info = $this->dashboard_m->get_forum_category_info($filter2);
						if($category_info){
							$category_id = $category_info['CAT_ID'];
						}
					}
					$data['category_id'] = $category_id;

					$filter4['IS_DELETE'] = 0;
					$filter4['IS_ACTIVE'] = 1;
					$filter4['order_by'] = "mdl_rating.view desc, mdl_rating.love desc, mdl_rating.comment desc, mdl_forum.POST_CREATED desc";
					$data['forum_detail'] = $this->dashboard_m->get_post_forum_info($filter4);
					$filter5['IS_ACTIVE'] = 1;
					$data['categories'] = $this->dashboard_m->get_forum_categories($filter5);
					$data['label'] = "Forum";
					$data["title"] = $title;

					if($page == "all"){
						$data['breadcrumb_active'] = $label;
						$data['description'] = $description;
					}else{
						$data['breadcrumb_parent'] = $label;
						$data['breadcrumb_parent_uri'] = $uri;
						$data['breadcrumb_active'] = $page;
						$data['description'] = $description;
					}
					$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
					$this->masterpage->addContentPage("forum", 'contentmain', $data);
				}
			}
		}
		$this->masterpage->show();
	}

	function _counter_view_forum($data_info){
		//Get Session User
		$user_id = get_session('user_id');
		//Check Already View
		$filter['usr_id'] = $user_id;
		$filter['content_id'] = "f".$data_info->POST_ID;
		$filter['forum_id'] = $data_info->POST_ID;
		$filter['type'] = "view";
		$result_log = $this->dashboard_m->get_info_rating_log($filter);
		//echo "<pre>"; print_r($result_log); die;
		if(!empty($result_log)){
			// Do Nothing
		}else{
			//Save Log
			$data['content_id'] = "f".$data_info->POST_ID;
			$data['forum_id'] = $data_info->POST_ID;
			$data['usr_id'] = $user_id;
			$data['type'] = "view";
			$this->dashboard_m->insert_info_rating_log($data);

			// Check Row Rating Info
			$filter2['content_id'] = "f".$data_info->POST_ID;
			$filter2['forum_id'] = $data_info->POST_ID;
			$result_rating = $this->dashboard_m->get_info_rating($filter2);
			if(empty($result_rating)){
				$data2['content_id'] = "f".$data_info->POST_ID;
				$data2['forum_id'] = $data_info->POST_ID;
				$data2['view'] = 1;
				$this->dashboard_m->insert_info_rating($data2);
			}else{
				$no_view = $result_rating->view;
				if($no_view == ""){
					$no_view = 0;
				}
				$data2['content_id'] = "f".$data_info->POST_ID;
				$data2['rating_id'] = $result_rating->rating_id;
				$data2['forum_id'] = $data_info->POST_ID;
				$data2['view'] = $no_view + 1;
				$this->dashboard_m->update_info_rating($data2);
			}
		}

		return true;
	}

	function submit_posting_topic_forum(){
		$uri = $this->input->post('uri', TRUE);
		$page = $this->input->post('page', TRUE);
		$cat_param = $this->input->post('cat_param', TRUE);
		$url_redirect_fail = $uri."/".$page."/".$cat_param;
		$url_redirect_success = $uri."/mypost";

		$data['POST_ID'] = $this->input->post('POST_ID', TRUE);
		$data['POST_CATEGORY_ID'] = $this->input->post('POST_CATEGORY_ID', TRUE);
		$this->form_validation->set_rules('POST_CATEGORY_ID', 'Kategori', 'trim|required');
		$data['POST_TITLE'] = $this->input->post('POST_TITLE', TRUE);
		$this->form_validation->set_rules('POST_TITLE', 'Judul', 'trim|required');
		$data['POST_DESC'] = $this->input->post('POST_DESC', TRUE);
		$this->form_validation->set_rules('POST_DESC', 'Keterangan', 'trim|required');
		$data['POST_CONTENT'] = $this->input->post('POST_CONTENT', TRUE);
		$IS_CONTENT_IMAGE = $this->input->post('IS_CONTENT_IMAGE', TRUE);
		$IS_CONTENT_AUDIO = $this->input->post('IS_CONTENT_AUDIO', TRUE);
		$IS_CONTENT_VIDEO = $this->input->post('IS_CONTENT_VIDEO', TRUE);

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errmsg', 'Kolom bertanda (*) harus diisi!');
			redirect($url_redirect);		
		}

		$config['upload_path']   = 'uploads/forum/';
		$allowed_types = "mp4";
		if($IS_CONTENT_IMAGE == 1){
			$allowed_types .= '|gif|jpg|png|jpeg';
		}
		if($IS_CONTENT_AUDIO == 1){
			$allowed_types .= '|mp3|wav';
		}
		if($IS_CONTENT_VIDEO == 1){
			$allowed_types .= '|mpg|mpeg|avi|mov';
		}
		//print_r($allowed_types); die;
		$config['allowed_types'] = $allowed_types;
		$config['encrypt_name']  = true;
		$config['max_size']      = '30024';

		$this->load->library('upload', $config);
		if($this->upload->do_upload('POST_UPLOAD_FILE')){
			$file_data = $this->upload->data();
			$data['POST_UPLOAD_FILE'] = $file_data['file_name'];
			$data['POST_FILE_TYPE'] = $file_data['file_type'];
		}else{
			//print_r($this->upload->display_errors()); die; 
			$error_msg = "Posting gagal. Silahkan cek ukuran atau file ekstensi file yang Anda akan upload!".
			$this->session->set_flashdata('errmsg', $error_msg);
			redirect($url_redirect_fail);
		}
		$data["POST_URI"] = $this->_generate_uri($data['POST_TITLE']);
		$data["POSTED_BY"] = get_session('user_id');
		$data["IS_MODERATION"] = 1;
		$data["IS_ACTIVE"] = 1;
		$result = $this->dashboard_m->save_post_forum($data);
		if($result){
			$this->session->set_flashdata('msg', 'Topik diskusi baru telah berhasil di posting.');
			redirect($url_redirect_success);
		}else{
			$this->session->set_flashdata('errmsg', 'Topik diskusi baru gagal di posting.Silahkan reload halaman ini!');
			redirect($url_redirect_fail);
		}
	}

	function _generate_uri($text=NULL){
		$uri = "n-a";
		if($text){
			// replace non letter or digits by -
			$text = preg_replace('~[^\pL\d]+~u', '-', $text);
			// transliterate
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
			// remove unwanted characters
			$text = preg_replace('~[^-\w]+~', '', $text);
			// trim
			$text = trim($text, '-');
			// remove duplicate -
			$text = preg_replace('~-+~', '-', $text);
			// lowercase
			$uri = strtolower($text);
		}
		return $uri;
	}

	function delete_topic_forum($id_post){
		$uri = "";
		if($id_post){
			$filter['POST_ID'] = $id_post;
			$data_info = $this->dashboard_m->get_post_forum_info($filter);
			$uri = $data_info->CAT_URI;
			$data['POST_ID'] = $id_post;
			$data['IS_DELETE'] = 1;
			$result = $this->dashboard_m->edit_post_forum($data);
		}
		$this->load->library('user_agent');
		redirect($this->agent->referrer());
	}
	
	function category($id_category, $view_file="category"){
		
		$_w = is_numeric($id_category) ? array("CAT_ID"=>$id_category) : array("CAT_URI"=>$id_category);	
		$category = $this->dashboard_m->__select("mdl_content_category", "CAT_ID, CAT_TITLE, CAT_URI", $_w, false);
		$data["categories"]	= $this->dashboard_m->category_content($category->CAT_ID); // 26 is bb learning category
		$data["title"] 		= $category->CAT_TITLE;
		
		$this->masterpage->addContentPage($view_file, 'contentmain', $data);
	
		$this->masterpage->show( );
	}

	function download($id_post){
		$this->load->helper('download');
		$detail_info = $this->dashboard_m->single_content($id_post);
		$url_file = base_url().'/uploads/images/'.$detail_info->POST_FEATURE_IMAGE;
		$data = file_get_contents($url_file);
		force_download($detail_info->POST_FEATURE_IMAGE, $data);
	}
	
	function view($id_content, $view_file = 'single_content'){
		
		$data['include_script'] = inc_script(
		
			array(
				"cms/plugin/rating/js/rating_update.js",
				//"cms/plugin/dashboard/js/bblearningpreview.js"
				"cms/plugin/rating/js/rating_live.js"
			)
		);
		if($view_file != 'single_content_bbl'){
			//Update COUNT VIEW
			$this->_counter_view_content($id_content);
		}

		$content = $this->dashboard_m->single_content($id_content);

		if($content){
			$data["content"]		= $content;
			$data["title"] 			= $content->POST_TITLE;
			$data["description"] 	= $content->POST_DESCRIPTION;
			
			if($view_file == 'single_content_bbl'){
				$data['breadcrumb_parent_uri'] = "bblearning";
				$data['breadcrumb_parent'] = "BB Learning";
				$data['breadcrumb_active'] = $data["content"]->POST_TITLE;
				$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
			}else{
				$filter['post_id'] = $content->POST_ID;
				$filter['category_id'] = $content->POST_CATEGORY;
				$filter['limit'] = 8;
				$data['data_list_artikel'] = $this->dashboard_m->get_content_list($filter);
				$data['breadcrumb_parent_uri'] = "news";
				$data['breadcrumb_parent'] = "Artikel & Berita";
				$data['breadcrumb_parent_cat_uri'] = $content->CAT_URI;
				$data['breadcrumb_parent_cat'] = $content->CAT_TITLE;
				$data['breadcrumb_active'] = $data["content"]->POST_TITLE;
				$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
			}
		}
		$this->masterpage->addContentPage($view_file, 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function author(){}
	
	function paging(){
		
		$config['base_url'] 	= base_url().'dashboard/index/';
		$config['per_page'] 	= 4;
		$config["uri_segment"] 	= 3;
		$config["total_rows"] 	= $this->dashboard_m->dashboard_news_paging();
		$config['suffix'] 			= '#newsfeed';
		
		
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] 	= '<ul class="pagination  pagination-sm">';
        $config['full_tag_close'] 	= '</ul>';
        $config['first_link'] 		= '<span aria-hidden="true"><span class="fas fa-caret-left">';
        $config['last_link'] 		= '</span></span>';
        $config['first_tag_open'] 	= '<li>';
        $config['first_tag_close'] 	= '</li>';
        $config['prev_link'] 		= '<span aria-hidden="true"><span class="fas fa-caret-left"></span></span>';
        $config['prev_tag_open'] 	= '<li class="prev">';
        $config['prev_tag_close'] 	= '</li>';
        $config['next_link'] 		= '<span aria-hidden="true"><span class="fas fa-caret-right"></span></span>';
        $config['next_tag_open'] 	= '<li>';
        $config['next_tag_close'] 	= '</li>';
        $config['last_tag_open'] 	= '<li>';
        $config['last_tag_close'] 	= '</li>';
        $config['cur_tag_open'] 	= '<li class="active"><a href="#" onclick="return false">';
        $config['cur_tag_close'] 	= '</a></li>';
        $config['num_tag_open'] 	= '<li>';
        $config['num_tag_close'] 	= '</li>';
        
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	 	
	 	
	}
	
	function birthday(){
		
		$_w["month(tgl_lahir)"] = date("m");
		
		$data['include_script'] = inc_script(
		
			array(
			
				// "includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
			
				"cms/plugin/dashboard/js/birthday.js",
			)
		);
		
		$data['title']		= "Ulang Tahun";
		
		$data['description'] = "Yang Berulang Tahun Bulan Ini";
		
		$data['birthdays'] 	= $this->dashboard_m->get_birthday_month($_w);
		
		$data['breadcrumb_active'] = $data['title'];
		
		$data['slc_jabatan'] = json_decode(Modules::run("api/options", "bb_opt_jabatan"), true);

		$data['slc_company'] = json_decode(Modules::run("api/options", "bb_opt_company"), true);
		
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage("birtday_list", 'contentmain', $data);

		$this->masterpage->show( );
	}

	function _counter_view_content($POST_ID){
		//Get Session User
		$user_id = get_session('user_id');
		//Check Already View
		$filter['usr_id'] = $user_id;
		$filter['content_id'] = $POST_ID;
		$filter['type'] = "view";
		$result_log = $this->dashboard_m->get_info_rating_log($filter);
		//echo "<pre>"; print_r($result_log); die;
		if(!empty($result_log)){
			// Do Nothing
		}else{
			//Save Log
			$data['content_id'] = $POST_ID;
			$data['usr_id'] = $user_id;
			$data['type'] = "view";
			$this->dashboard_m->insert_info_rating_log($data);

			// Check Row Rating Info
			$filter2['content_id'] = $POST_ID;
			$result_rating = $this->dashboard_m->get_info_rating($filter2);
			if(empty($result_rating)){
				$data2['content_id'] = $POST_ID;
				$data2['view'] = 1;
				$this->dashboard_m->insert_info_rating($data2);
			}else{
				$no_view = $result_rating->view;
				if($no_view == ""){
					$no_view = 0;
				}
				$data2['content_id'] = $POST_ID;
				$data2['rating_id'] = $result_rating->rating_id;
				$data2['view'] = $no_view + 1;
				$this->dashboard_m->update_info_rating($data2);
			}
		}

		return true;
	}
}
