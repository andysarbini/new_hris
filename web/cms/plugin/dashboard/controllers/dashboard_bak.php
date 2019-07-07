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
				"cms/plugin/rating/js/rating_view.js",
			)
		);
		
		$data["user"]		= $this->bluehrd_user_m->get_user(get_session('user_id'));
		$data["articles"] 	= $this->dashboard_m->dashboard_news($start);
		$data["featured"] 	= $this->dashboard_m->featured_articles();
		//$data["popular"]  = $this->dashboard_m->popular_news();
		$data_gallery 	= $this->dashboard_m->latest_gallery();
		shuffle($data_gallery);
		$data["gallery"] = $data_gallery;
		$data["paging"]   = $this->paging();
		
		
		$this->load->view("dashboard", $data);
	}

	function news($id_news){
		
		$this->view($id_news);
	}

	function bbl($id_post){
		$this->view($id_post,"single_content_bbl");
	}
	
	// Load content category bblearning
	function bblearning($_uri = false){
		//if(!$id_learning) 	$this->category(26, "bblearning");		
		//else $this->view($id_learning);
		//$this->view("dashboard", $data)
		$data['include_script'] = inc_script(
			array(
				"cms/plugin/dashboard/js/bblearning.js",
			)
		);
		$data["title"] = "Limitless Learning";
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
		$data["title"] = "Galeri Foto & Video";
		$data['breadcrumb_active'] = "Galeri Foto & Video";
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
		$cat_param = $this->uri->segment(3);
		if($uri){
			$filter['NAV_LIST_URI'] = $uri;
			$page_info = $this->dashboard_m->get_nav_info($filter);
			if($page_info){
				$label = $page_info->NAV_LIST_TITLE;
				$title = $page_info->NAV_LIST_TITLE;
			}
		}
		$data['uri'] = $uri;
		if(!empty($page)){
			$data["title"] = $title;
			$data['breadcrumb_parent'] = $label;
			$data['breadcrumb_parent_uri'] = $uri;
			$data['description'] = $description;
			if($page == "posting-diskusi-baru"){
				$data['include_script'] = inc_script(
					array(
						"includes/ckeditor/ckeditor.js",
						"cms/plugin/dashboard/js/forum_form.js",
					)
				);
				$filter2['CAT_URI'] = $cat_param;
				$data['category_info'] = $this->dashboard_m->get_forum_category_info($filter2);
				$data['forum_info'] = array();
				$data['title'] = "Posting Diskusi Baru";
				$data['breadcrumb_active'] = "Posting Diskusi Baru";
				$this->masterpage->addContentPage("forum_posting_form", 'contentmain', $data);
			}else{
				$data['breadcrumb_active'] = $page;
				$this->masterpage->addContentPage("forum_board", 'contentmain', $data);
			}
		}else{
			$filter3['IS_ACTIVE'] = 1;
			$data['categories'] = $this->dashboard_m->get_forum_categories($filter3);
			$data['label'] = "Forum";
			$data["title"] = $title;
			$data['breadcrumb_active'] = $label;
			$data['description'] = $description;
			$this->masterpage->addContentPage("forum", 'contentmain', $data);
		}
		$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
		$this->masterpage->show();
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
				"cms/plugin/dashboard/js/bblearningpreview.js"
			)
		);
		$data["content"]		= $this->dashboard_m->single_content($id_content);
		$data["title"] 			= $data["content"]->POST_TITLE;
		$data["description"] 	= $data["content"]->POST_DESCRIPTION;
		
		if($view_file == 'single_content_bbl'){
			$data['breadcrumb_parent_uri'] = "bblearning";
			$data['breadcrumb_parent'] = "BB Learning";
			$data['breadcrumb_active'] = $data["content"]->POST_TITLE;
			$this->masterpage->addContentPage('breadcrumb', 'breadcrumb', $data);
		}
		$this->masterpage->addContentPage($view_file, 'contentmain', $data);

		$this->masterpage->show( );
	}
	
	function author(){
		
		
	}
	
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
			
				"includes/datatables/jquery.dataTables.min.css",
			
				"includes/datatables/jquery.dataTables.min.js",
			
				"cms/plugin/dashboard/js/birthday.js",
			)
		);
		
		$data['title']		= "Ulang Tahun";
		
		$data['description']= "Yang Berulang Tahun Bulan Ini";
		
		$data['birthdays'] = $this->dashboard_m->get_birthday_month($_w);
		
		$data['breadcrumb_active'] = $data['title'];
	
		$this->masterpage->addContentPage('dashboard/breadcrumb', 'breadcrumb', $data);
		
		$this->masterpage->addContentPage("birtday_list", 'contentmain', $data);

		$this->masterpage->show( );
	}
}
