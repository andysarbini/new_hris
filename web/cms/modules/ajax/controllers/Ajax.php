<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @author harisal
 * 
 */
class ajax extends GW_Controller //MX_Controller
{
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){

	}
    
    public function ajax_pagination_newsfeed(){
        $this->load->model("ajax_m");
        $this->load->library("pagination");
        $config = array();
        $config["base_url"] = base_url();
        $config["total_rows"] = $this->ajax_m->count_all_newsfeed();
        $config["per_page"] = 3;
        $config["uri_segment"] = 2;
        $config["use_page_numbers"] = TRUE;
        $config["num_links"] = 5;
        $config["full_tag_open"] = '<ul class="pagination pagination-sm">';
        $config['first_url'] = base_url().'/1';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config["next_tag_open"] = '<li>';
        $config['next_link'] = '<span aria-hidden="true"><span class="fa fa-caret-right"></span></span>';
        $config["next_tag_close"] = '</li>';
        $config["prev_tag_open"] = "<li>";
        $config["prev_link"] = '<span aria-hidden="true"><span class="fa fa-caret-left"></span></span>';
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $page = $this->uri->segment(2);
        $start = ($page - 1) * $config["per_page"];
      
        $output = array(
         'pagination_link'  => $this->pagination->create_links(),
         'article_list'   => $this->ajax_m->fetch_data_newsfeed($config["per_page"], $start)
        );
        echo json_encode($output);
    }

    public function ajax_pagination_news(){
        $category_id = $this->uri->segment(2);
        $this->load->model("ajax_m");
        $this->load->library("pagination");
        if($category_id == "0"){
            //Default Berita Terkini dan Berita Perusahaan 
            $filter['array_category_id'] = array(24, 25); 
        }else{
            $filter['category_id'] = $category_id;
        }
        $config = array();
        $config["base_url"] = base_url().$category_id;
        $config["total_rows"] = $this->ajax_m->count_all_news($filter);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config["use_page_numbers"] = TRUE;
        $config["num_links"] = 5;
        $config["full_tag_open"] = '<ul class="pagination pagination-sm">';
        $config['first_url'] = base_url().$category_id.'/1';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config["next_tag_open"] = '<li>';
        $config['next_link'] = '<span aria-hidden="true"><span class="fa fa-caret-right"></span></span>';
        $config["next_tag_close"] = '</li>';
        $config["prev_tag_open"] = "<li>";
        $config["prev_link"] = '<span aria-hidden="true"><span class="fa fa-caret-left"></span></span>';
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $start = ($page - 1) * $config["per_page"];
      
        $output = array(
         'pagination_link'  => $this->pagination->create_links(),
         'article_list'   => $this->ajax_m->fetch_data_news($config["per_page"], $start, $filter)
        );
        echo json_encode($output);
    }
    
    public function ajax_pagination_files(){
        $category = $this->uri->segment(2);
        $keywords = $this->uri->segment(3);
        $this->load->model("ajax_m");
        $this->load->library("pagination");
        $filter = array();
        if($category != "all"){
            $filter['category'] = $category;
        }
        if($keywords != "undefined"){
            $filter['keywords'] = $keywords;
        }
        if(@if_empty(get_session('company'))){
            $filter['company'] = get_session('company');
        }
        if(@if_empty(get_session('jabatan'))){
            $filter['jabatan'] = get_session('jabatan');
        }
        if(@if_empty(get_session('grade'))){
            //$filter['grade'] = get_session('grade');
        }
        if(@if_empty(get_session('level'))){
            //$filter['level'] = get_session('level');
        }
        $config = array();
        $config["base_url"] = base_url().$category."/".$keywords;
        $config["total_rows"] = $this->ajax_m->count_all_files($filter);
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;
        $config["use_page_numbers"] = TRUE;
        $config["num_links"] = 5;
        $config["full_tag_open"] = '<ul class="pagination pagination-sm">';
        $config['first_url'] = base_url().$category."/".$keywords.'/1';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config["next_tag_open"] = '<li>';
        $config['next_link'] = '<span aria-hidden="true"><span class="fa fa-caret-right"></span></span>';
        $config["next_tag_close"] = '</li>';
        $config["prev_tag_open"] = "<li>";
        $config["prev_link"] = '<span aria-hidden="true"><span class="fa fa-caret-left"></span></span>';
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $page = $this->uri->segment(4);
        $start = ($page - 1) * $config["per_page"];
      
        $output = array(
         'pagination_link'  => $this->pagination->create_links(),
         'file_list'   => $this->ajax_m->fetch_data_files($config["per_page"], $start, $filter)
        );
        echo json_encode($output);
    }
    
    public function ajax_pagination_videos(){
        $category = $this->uri->segment(2);
        $keywords = $this->uri->segment(3);
        $this->load->model("ajax_m");
        $this->load->library("pagination");
        $filter = array();
        if($category != "all"){
            $filter['category'] = $category;
        }
        if($keywords != "undefined"){
            $filter['keywords'] = $keywords;
        }
        if(@if_empty(get_session('company'))){
            $filter['company'] = get_session('company');
        }
        if(@if_empty(get_session('jabatan'))){
            $filter['jabatan'] = get_session('jabatan');
        }
        if(@if_empty(get_session('grade'))){
            //$filter['grade'] = get_session('grade');
        }
        if(@if_empty(get_session('level'))){
            //$filter['level'] = get_session('level');
        }
        $config = array();
        $config["base_url"] = base_url().$category."/".$keywords;
        $config["total_rows"] = $this->ajax_m->count_all_videos($filter);
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;
        $config["use_page_numbers"] = TRUE;
        $config["num_links"] = 5;
        $config["full_tag_open"] = '<ul class="pagination pagination-sm">';
        $config['first_url'] = base_url().$category."/".$keywords.'/1';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config["next_tag_open"] = '<li>';
        $config['next_link'] = '<span aria-hidden="true"><span class="fa fa-caret-right"></span></span>';
        $config["next_tag_close"] = '</li>';
        $config["prev_tag_open"] = "<li>";
        $config["prev_link"] = '<span aria-hidden="true"><span class="fa fa-caret-left"></span></span>';
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $page = $this->uri->segment(4);
        $start = ($page - 1) * $config["per_page"];
      
        $output = array(
         'pagination_link'  => $this->pagination->create_links(),
         'video_list'   => $this->ajax_m->fetch_data_videos($config["per_page"], $start, $filter)
        );
        echo json_encode($output);
    }
    
    public function ajax_pagination_gallery(){
        $type = $this->uri->segment(2);
        $category = $this->uri->segment(3);
        $keywords = $this->uri->segment(4);
        $this->load->model("ajax_m");
        $this->load->library("pagination");
        $filter = array();
        $filter['type'] = $type;
        if($category != "all"){
            $filter['category'] = $category;
        }
        if($keywords != "undefined"){
            $filter['keywords'] = $keywords;
        }
        if(@if_empty(get_session('company'))){
            $filter['company'] = get_session('company');
        }
        $config = array();
        $config["base_url"] = base_url().$type."/".$category."/".$keywords;
        $config["total_rows"] = $this->ajax_m->count_all_gallery($filter);
        $config["per_page"] = 5;
        $config["uri_segment"] = 5;
        $config["use_page_numbers"] = TRUE;
        $config["num_links"] = 5;
        $config["full_tag_open"] = '<ul class="pagination pagination-sm">';
        $config['first_url'] = base_url().$type."/".$category.'/'.$keywords.'/1';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config["next_tag_open"] = '<li>';
        $config['next_link'] = '<span aria-hidden="true"><span class="fa fa-caret-right"></span></span>';
        $config["next_tag_close"] = '</li>';
        $config["prev_tag_open"] = "<li>";
        $config["prev_link"] = '<span aria-hidden="true"><span class="fa fa-caret-left"></span></span>';
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $page = $this->uri->segment(5);
        $start = ($page - 1) * $config["per_page"];
      
        $output = array(
         'pagination_link'  => $this->pagination->create_links(),
         'data_list'   => $this->ajax_m->fetch_data_gallery($config["per_page"], $start, $filter)
        );
        echo json_encode($output);
    }

    public function ajax_get_picture(){
        $output = array();
        $pic_id = $this->uri->segment(2);
        $this->load->model("ajax_m");
        $limit = 1;
        $start = 0;
        $picture_info = $this->ajax_m->get_picture_info($pic_id,$limit,$start);
        $picture_path = base_url().'templates/bluehrd/img/no-image.png';
        $total_pic = $total_love = 0; $pic_no = 1;
        $picture_id = $picture_desc = $picture_src = $short_info = $total_pic_info= "";
        if($picture_info){
            $total_pic = $this->ajax_m->count_pic_on_gallery($picture_info['GALL_ID']);
            $filter['GALL_ID'] = $picture_info['GALL_ID'];
            $gall_type_info = $this->ajax_m->get_gallery_info($filter);
            $gall_pic_list = $this->ajax_m->get_pics_of_gallery($filter);
            if($gall_pic_list){
                foreach($gall_pic_list as $key => $vpic){
                    if($vpic->GALL_PIC_ID == $pic_id){
                        $pic_no = $key + 1;
                    }
                }
            }
            $total_love_info = '<div class="text-center">'.$total_love.'</div><div><span class="far fa-heart fa-fw fa-2x" aria-hidden="true"></span></div>';
            $picture_path = base_url().'uploads/galleries/'.$picture_info['GALL_PIC_PATH'];
            $picture_src = '<img src="'.$picture_path.'" alt="" />';
            if(isset($gall_type_info->GALL_TYPE)){
                if($gall_type_info->GALL_TYPE == "videos"){
                    $total_pic_info = $pic_no.' dari '.$total_pic.' video'; 
                    $picture_src = '<div class="embed-responsive embed-responsive-16by9"><video class="embed-responsive-item" controls controlsList="nodownload"><source src="'.$picture_path.'"></video><div class="alert alert-warning">Browser Anda tidak mendukung HTML5 video, silakan update browser Anda terlebih dahulu</div></div>';
                    
                }else{
                    $total_pic_info = $pic_no.' dari '.$total_pic.' gambar'; 
                    
                    $picture_src = $picture_info['GALL_PIC_URL'] ? '<a href="'.$picture_info['GALL_PIC_URL'].'">' : '';
                    $picture_src .= '<img src="'.$picture_path.'" alt="" />';
                    $picture_src .= $picture_info['GALL_PIC_URL'] ? '</a>':'';
                }
            }
            
            $picture_id = $picture_info['GALL_PIC_ID'];
            $picture_desc = $picture_info['GALL_PIC_DESC'];
            $galeri_name = $picture_info['GALL_NAME'];
            $creator = $picture_info['USR_NAME_CREATE'];
            // $short_info = '<a href="#"><b>'.$creator.'</b></a> memposting dalam <a href="'.base_url().'gallery/'.$picture_info['GALL_URI'].'">'.$galeri_name.'</a>';
            $short_info = '<a href="'.base_url().'gallery/'.$picture_info['GALL_URI'].'">'.$galeri_name.'</a>';
            $temp_pic_no = $pic_no;
            $num_data = count($gall_pic_list);
            $button_next = $button_prev = "";
            $class_disabled_prev = $class_disabled_next = "disabled";
            if($num_data > 1){
                $button_next = '<a href="#"><span class="sr-only">Next</span> <span class="fa fa-chevron-right"></span></a>';
                $button_prev = '<a href="#"><span class="fa fa-chevron-left"></span> <span class="sr-only">Previous</span></a>';
                if($gall_pic_list){
                    $temp_pic_no = $temp_pic_no - 1;
                    $next_pic_no = $temp_pic_no + 1;
                    $prev_pic_no = $temp_pic_no - 1;
                    foreach($gall_pic_list as $key => $vpic){
                        if($next_pic_no == $key){
                            $button_next = '<a href="javascript:load_pic_info('.$vpic->GALL_PIC_ID.')"><span class="sr-only">Next</span> <span class="fa fa-chevron-right"></span></a>';
                            $class_disabled_prev = $class_disabled_next = "enabled";
                        }
                        if($prev_pic_no == $key){
                            $button_prev = '<a href="javascript:load_pic_info('.$vpic->GALL_PIC_ID.')"><span class="fa fa-chevron-left"></span> <span class="sr-only">Previous</span></a>';
                            $class_disabled_prev = $class_disabled_next = "enabled";
                        }
                        if($temp_pic_no == ($num_data-1)){
                            $class_disabled_prev = "enabled";
                            $class_disabled_next = "disabled";
                        }
                        if($temp_pic_no == 0){
                            $class_disabled_prev = "disabled";
                            $class_disabled_next = "enabled";
                        }
                    }
                }
            }        
        }
        $output = array(
            'total_pic'  => $total_pic,
            'total_pic_info'  => $total_pic_info,
            'total_love'  => $total_love,
            'total_love_info' => $total_love_info,
            'picture_src'   => $picture_src,
            'picture_id'  => $picture_id,
            'picture_desc'  => $picture_desc,
            'short_info'  => $short_info,
            'creator'  => $creator,
            'button_next'  => $button_next,
            'button_prev'  => $button_prev,
            'class_disabled_prev'  => $class_disabled_prev,
            'class_disabled_next'  => $class_disabled_next,
        );
        echo json_encode($output); 
    }

    public function ajax_pagination_forum_topic(){
        $category = $this->uri->segment(2);
        $keywords = $this->uri->segment(3);
        $this->load->model("ajax_m");
        $this->load->library("pagination");
        $filter = array();
        if($category != "0"){
            $filter['category'] = $category;
        }
        if($keywords != "undefined"){
            $keywords = str_replace("-"," ",$keywords);
            $filter['keywords'] = $keywords;
        }
        $filter['IS_ACTIVE'] = 1;
        $config = array();
        $config["base_url"] = base_url().$category."/".$keywords;
        $config["total_rows"] = $this->ajax_m->count_all_forum_topic($filter);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config["use_page_numbers"] = TRUE;
        $config["num_links"] = 5;
        $config["full_tag_open"] = '<ul class="pagination pagination-sm">';
        $config['first_url'] = base_url().$category."/".$keywords.'/1';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config["next_tag_open"] = '<li>';
        $config['next_link'] = '<span aria-hidden="true"><span class="fa fa-caret-right"></span></span>';
        $config["next_tag_close"] = '</li>';
        $config["prev_tag_open"] = "<li>";
        $config["prev_link"] = '<span aria-hidden="true"><span class="fa fa-caret-left"></span></span>';
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $page = $this->uri->segment(4);
        $start = ($page - 1) * $config["per_page"];

        $filter['order_by'] = "mdl_forum.POST_CREATED desc, mdl_forum.POST_MODIFIED desc";
        $output = array(
            'pagination_link'  => $this->pagination->create_links(),
            'data_list'   => $this->ajax_m->fetch_data_forum_topic($config["per_page"], $start, $filter)
           );
        echo json_encode($output);
    }

    public function ajax_pagination_mytopic(){
        $this->load->model("ajax_m");
        $this->load->library("pagination");
        $filter = array();
        $filter['posted_by'] = get_session('user_id');
        $config = array();
        $config["base_url"] = base_url();
        $config["total_rows"] = $this->ajax_m->count_all_forum_topic($filter);
        $config["per_page"] = 8;
        $config["uri_segment"] = 2;
        $config["use_page_numbers"] = TRUE;
        $config["num_links"] = 5;
        $config["full_tag_open"] = '<ul class="pagination pagination-sm">';
        $config['first_url'] = base_url().'/1';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config["next_tag_open"] = '<li>';
        $config['next_link'] = '<span aria-hidden="true"><span class="fa fa-caret-right"></span></span>';
        $config["next_tag_close"] = '</li>';
        $config["prev_tag_open"] = "<li>";
        $config["prev_link"] = '<span aria-hidden="true"><span class="fa fa-caret-left"></span></span>';
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $page = $this->uri->segment(2);
        $start = ($page - 1) * $config["per_page"];

        $filter['order_by'] = "mdl_forum.POST_CREATED desc, mdl_forum.POST_MODIFIED desc";
        $output = array(
            'pagination_link'  => $this->pagination->create_links(),
            'data_list'   => $this->ajax_m->fetch_data_forum_topic($config["per_page"], $start, $filter)
           );
        echo json_encode($output);
    }
}
