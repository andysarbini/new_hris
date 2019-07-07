<?php
/**
 * @author harisal
 */
class ajax_m extends GW_Model{

    function count_all_newsfeed(){
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
		$this->db->from("vw_mdl_content_user_group");
        $this->db->where("POST_ISACTIVE", 1);
		$this->db->where_in("POST_CATEGORY", array(24, 25));
		$this->db->order_by("POST_INPUT_DATE","desc");
		$query = $this->db->get();
		return $query->num_rows();
    }

    function fetch_data_newsfeed($limit, $start){
        $output = '';
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
		$this->db->from("vw_mdl_content_user_group");
		$this->db->where("POST_ISACTIVE", 1);
        $this->db->where_in("POST_CATEGORY", array(24, 25));
        $this->db->order_by("POST_INPUT_DATE","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result = $query->result();
        if($result){
            foreach($query->result() as $v){
                $is_already_rated = $this->_check_is_already_rated($v->post_id, get_session('user_id'), 'content', 'love');
                $is_already_comment = $this->_check_is_already_rated($v->post_id, get_session('user_id'), 'content', 'comment');
                $output .= '<div class="media">';
                $output .= '<div class="media-left" style="padding-top:10px;">';
                $output .= '<a href="'.base_url().'news/'.$v->cat_uri."/".$v->post_id.'">';
                $output .= '<img class="media-object thumbnail" src="'.base_url().'uploads/images/'.$v->post_feature_image.'" data-original="'.base_url().'uploads/images/'.$v->post_feature_image.'" alt="" style="width:325px;height:200px;"/>';
                $output .= '</a>';
                $output .= '</div>';
        
                $output .= '<div class="media-body">';
                $output .= '<div class="help-block" style="margin-bottom:5px;">'.$this->_bluehrd_tgl($v->post_input_date).'</div>';
                $output .= '<h4 class="media-heading"><a href="'.base_url().'news/'.$v->cat_uri."/".$v->post_id.'">'.$v->post_title.'</a></h4>';
                $output .= '<p>'.substr($v->post_description, 0, 120).' ... </p>';
                $output .= '<div class="row">';
                $output .= '<div class="col-md-8">';
                $output .= '<div class="help-block">Oleh <span><a href="#">'.$v->usr_name_input.'</a></span> dalam <span><a href="'.base_url().'news/'.$v->cat_uri.'">'.$v->cat_title.'</a></span></div>';
                $output .= '</div>';
                $output .= '<div class="col-md-4 text-right">';
                
                $output .= '<div class="help-block">';
                $output .= '<ul class="list-inline">';

                if($is_already_rated == TRUE){
                    $output .= '<li><span class="far fa-heart text-danger fa-fw"></span>&nbsp;'.$this->_contentstats_number($v->post_id,'love','content').'</li>';
                }else{
                    $output .= '<li><a class="rating_love" content_id="'.$v->post_id.'" user_id="'.get_session('user_id').'" size="medium"><span class="far fa-heart fa-fw"></span></a>&nbsp;'.$this->_contentstats_number($v->post_id,'love','content').'</li>';
                }

                if($is_already_rated == TRUE){
                    $output .= '<li><span class="far fa-comment text-info fa-fw"></span>&nbsp;'.$this->_contentstats_number($v->post_id,'comment','content').'</li>';
                }else{
                    $output .= '<li><a href="'.base_url().'news/'.$v->cat_uri."/".$v->post_id.'#form_comment"><span class="far fa-comment fa-fw"></span></a>&nbsp;'.$this->_contentstats_number($v->post_id,'comment','content').'</li>';
                }
                $output .= '<li><span class="far fa-eye fa-fw"></span>&nbsp;'.$this->_contentstats_number($v->post_id,'view','content').'</li>';
                $output .= '</ul>';
                $output .= '</div>';

                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }
        }  
        return $output;
    }

    function count_all_news($data=array()){
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
		$this->db->from("vw_mdl_content_user_group");
        $this->db->where("POST_ISACTIVE", 1);
        if(isset($data['category_id'])){
            $this->db->where("POST_CATEGORY", $data['category_id']);
        }
        if(isset($data['array_category_id'])){
            $this->db->where_in("POST_CATEGORY", $data['array_category_id']);
        }
		$query = $this->db->get();
		return $query->num_rows();
    }

    function fetch_data_news($limit, $start, $data=array()){
        $output = '';
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
		$this->db->from("vw_mdl_content_user_group");
		$this->db->where("POST_ISACTIVE", 1);
        if(isset($data['category_id'])){
            $this->db->where("POST_CATEGORY", $data['category_id']);
        }
        if(isset($data['array_category_id'])){
            $this->db->where_in("POST_CATEGORY", $data['array_category_id']);
        }
        $this->db->order_by("POST_INPUT_DATE","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result = $query->result();
        if($result){
            foreach($query->result() as $v){
                $is_already_rated = $this->_check_is_already_rated($v->post_id, get_session('user_id'), 'content', 'love');
                $is_already_comment = $this->_check_is_already_rated($v->post_id, get_session('user_id'), 'content', 'comment');
                $output .= '<div class="media">';
                $output .= '<div class="media-left">';
                $output .= '<a href="'.base_url().'news/'.$v->cat_uri."/".$v->post_id.'">';
                $output .= '<img class="media-object thumbnail lazy" src="'.base_url().'uploads/images/'.$v->post_feature_image.'" data-original="'.base_url().'uploads/images/'.$v->post_feature_image.'" alt="" width="275"/>';
                $output .= '</a>';
                $output .= '</div>';
        
                $output .= '<div class="media-body">';
                //$output .= '<div class="help-block" style="margin-bottom:5px;">'.$this->_bluehrd_tgl($v->post_input_date).'</div>';
                $output .= ' <p><a href="'.base_url().'news/'.$v->cat_uri.'"><span class="flag label label-info">'.$v->cat_title.'</span></a></p>';
                $output .= '<h4 class="media-heading"><a href="'.base_url().'news/'.$v->cat_uri."/".$v->post_id.'">'.$v->post_title.'</a></h4>';
                $output .= '<p>'.substr($v->post_description, 0, 120).' ... </p>';
                $output .= '<div class="row">';
                $output .= '<div class="col-md-8">';
                $output .= '<div class="help-block">Oleh <span><a href="#">'.$v->usr_name_input.'</a></span> pada '.$this->_bluehrd_tgl($v->post_input_date).'</div>';
                $output .= '</div>';
                $output .= '<div class="col-md-4 text-right rating" content_id="'.$v->post_id.'" user_id="'.get_session('user_id').'">';
                
                $output .= '<div class="help-block">';
                $output .= '<ul class="list-inline">';
                if($is_already_rated == TRUE){
                    $output .= '<li><span class="far fa-heart text-danger fa-fw"></span>&nbsp;'.$this->_contentstats_number($v->post_id,'love','content').'</li>';
                }else{
                    $output .= '<li><a class="rating_love" content_id="'.$v->post_id.'" user_id="'.get_session('user_id').'" size="medium"><span class="far fa-heart fa-fw"></span></a>&nbsp;'.$this->_contentstats_number($v->post_id,'love','content').'</li>';
                }

                if($is_already_comment == TRUE){
                    $output .= '<li><span class="far fa-comment text-info fa-fw"></span>&nbsp;'.$this->_contentstats_number($v->post_id,'comment','content').'</li>';
                }else{
                    $output .= '<li><a href="'.base_url().'news/'.$v->cat_uri."/".$v->post_id.'#form_comment"><span class="far fa-comment fa-fw"></span></a>&nbsp;'.$this->_contentstats_number($v->post_id,'comment','content').'</li>';
                }
                $output .= '<li><span class="far fa-eye fa-fw"></span>&nbsp;'.$this->_contentstats_number($v->post_id,'view','content').'</li>';
                $output .= '</ul>';
                $output .= '</div>';

                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }
        }  
        return $output;
    }

    function _contentstats_number($content_id, $param, $label){
        $num = 0;
        if($content_id){
            $this->db->select("*");
            $this->db->from("mdl_rating");
            if($label == "content"){
                $this->db->where("content_id", $content_id);
            }
            if($label == "gallery"){
                $this->db->where("gallery_id", $content_id);
            }
            if($label == "forum"){
                $this->db->where("forum_id", $content_id);
            }
            $query = $this->db->get();
            $result = $query->row();
            if($result){
                switch ($param) {
                    case 'love':
                        $num = $result->love;
                        break;
                    case 'view':
                        $num = $result->view;
                        break;
                    case 'comment':
                        $num = $result->comment;
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        return $num;
    }

    function _bluehrd_tgl($_tgl){
        /*$_  = explode(" ",$_tgl);
        $t  = explode("-",$_[0]);
        $_bln = array(
                "01"=>"January","02"=>"February", "03"=>"Maret","04"=>"April",
                "05"=>"Mei", "06"=>"Juni", "07"=>"July", "08"=>"Agustus",
                "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember"
            );
        return $t[2]." ".$_bln[$t[1]]." ".$t[0];*/
        return date("d-m-Y H:i",strtotime($_tgl));
    }

    function count_all_files($filter=array()){
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
        $this->db->from("vw_mdl_content_user_group");
        $this->db->join('mdl_bluehrd_bbl_role', 'vw_mdl_content_user_group.POST_ID = mdl_bluehrd_bbl_role.content_id', 'left');
        $this->db->where("POST_ISACTIVE", 1);
        $this->db->where("POST_CATEGORY", 26);
        $this->db->where("POST_FILE_TYPE", "file");
        $this->db->where("company IS NOT NULL");
        $this->db->where("jabatan IS NOT NULL");
        //$this->db->where("grade IS NOT NULL");
        //$this->db->where("level IS NOT NULL");

        $arr = array('0');
        if(isset($filter['company'])){
            $arr = array('0', $filter['company']);
            $this->db->where_in("company", $arr);
        }else{
            $this->db->where("company", 0);
        }

        $arr = array('0');
        if(isset($filter['jabatan'])){
            $arr = array('0', $filter['jabatan']);
            $this->db->where_in("jabatan", $arr);
        }else{
            $this->db->where("jabatan", 0);
        }

        if(isset($filter['category'])){
            $this->db->where("POST_CATEGORY_BBL", $filter['category']);
        }
        if(isset($filter['keywords'])){
            $this->db->like("POST_TITLE", $filter['keywords']);
            //$this->db->or_like("POST_TITLE_SHORT", $filter['keywords']);
        }

        /*if(isset($filter['grade'])){
            $this->db->where("grade", $filter['grade']);
            $this->db->or_where("grade", 0);
        }else{
            $this->db->where("grade", 0);
        }

        if(isset($filter['level'])){
            $this->db->where("level", $filter['level']);
            $this->db->or_where("level", 0);
        }else{
            $this->db->where("level", 0);
        }*/

		$this->db->order_by("POST_INPUT_DATE","desc");
		$query = $this->db->get();
        return $query->num_rows();
    }

    function count_all_videos($filter=array()){
        //print_r($filter); die;
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
		$this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
        $this->db->from("vw_mdl_content_user_group");
        $this->db->join('mdl_bluehrd_bbl_role', 'vw_mdl_content_user_group.POST_ID = mdl_bluehrd_bbl_role.content_id', 'left');
        $this->db->where("POST_ISACTIVE", 1);
        $this->db->where("POST_CATEGORY", 26);
        $this->db->where("POST_FILE_TYPE", "video");
        $this->db->where("company IS NOT NULL");
        $this->db->where("jabatan IS NOT NULL");
        //$this->db->where("grade IS NOT NULL");
        //$this->db->where("level IS NOT NULL");
        $arr = array('0');
        if(isset($filter['company'])){
            $arr = array('0', $filter['company']);
            $this->db->where_in("company", $arr);
        }else{
            $this->db->where("company", 0);
        }

        $arr = array('0');
        if(isset($filter['jabatan'])){
            $arr = array('0', $filter['jabatan']);
            $this->db->where_in("jabatan", $arr);
        }else{
            $this->db->where("jabatan", 0);
        }

        if(isset($filter['category'])){
            $this->db->where("POST_CATEGORY_BBL", $filter['category']);
        }
        if(isset($filter['keywords'])){
            $this->db->like("POST_TITLE", $filter['keywords']);
            //$this->db->or_like("POST_TITLE_SHORT", $filter['keywords']);
        }

        /*if(isset($filter['grade'])){
            $this->db->where("grade", $filter['grade']);
            $this->db->or_where("grade", 0);
        }else{
            $this->db->where("grade", 0);
        }

        if(isset($filter['level'])){
            $this->db->where("level", $filter['level']);
            $this->db->or_where("level", 0);
        }else{
            $this->db->where("level", 0);
        }*/

		$this->db->order_by("POST_INPUT_DATE","desc");
		$query = $this->db->get();
        return $query->num_rows();
    }

    function fetch_data_files($limit, $start, $filter){
        $output = '';
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
        $this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
        $this->db->select("POST_FILE_EXTENSION post_file_ext, POST_FILE_SIZE post_file_size");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
        $this->db->from("vw_mdl_content_user_group");
        $this->db->join('mdl_bluehrd_bbl_role', 'vw_mdl_content_user_group.POST_ID = mdl_bluehrd_bbl_role.content_id', 'left');
        $this->db->where("POST_ISACTIVE", 1);
        $this->db->where("POST_CATEGORY", 26);
        $this->db->where("POST_FILE_TYPE", "file");
        $this->db->where("company IS NOT NULL");
        $this->db->where("jabatan IS NOT NULL");
        //$this->db->where("grade IS NOT NULL");
        //$this->db->where("level IS NOT NULL");

        $arr = array('0');
        if(isset($filter['company'])){
            $arr = array('0', $filter['company']);
            $this->db->where_in("company", $arr);
        }else{
            $this->db->where("company", 0);
        }

        $arr = array('0');
        if(isset($filter['jabatan'])){
            $arr = array('0', $filter['jabatan']);
            $this->db->where_in("jabatan", $arr);
        }else{
            $this->db->where("jabatan", 0);
        }

        if(isset($filter['category'])){
            $this->db->where("POST_CATEGORY_BBL", $filter['category']);
        }
        if(isset($filter['keywords'])){
            $this->db->like("POST_TITLE", $filter['keywords']);
            //$this->db->or_like("POST_TITLE_SHORT", $filter['keywords']);
        }

        /*if(isset($filter['grade'])){
            $this->db->where("grade", $filter['grade']);
            $this->db->or_where("grade", 0);
        }else{
            $this->db->where("grade", 0);
        }

        if(isset($filter['level'])){
            $this->db->where("level", $filter['level']);
            $this->db->or_where("level", 0);
        }else{
            $this->db->where("level", 0);
        }*/
		$this->db->order_by("POST_INPUT_DATE","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result = $query->result();
        if($result){
            foreach($query->result() as $v){
                $size_bytes = floor($v->post_file_size * 1024);
                $output .= '<div class="col-md-3">';
                $output .= '<div class="panel panel-default">';
        
                $output .= '<div class="panel-body">';
        
                $output .= '<div class="form-group">';
                $output .= '<label class="control-label">Nama File</label>';
                $output .= '<p>'.$v->post_title.'</p>';
                $output .= '</div>';
                $output .= '<div class="form-group">';
                $output .= '<label class="control-label">Besar File</label>';
                $output .= '<p>'.$this->_formatSizeUnits($size_bytes).'</p>';
                $output .= '</div>';
                $output .= '<div class="form-group">';
                $output .= '<label class="control-label">Format</label>';
                $output .= '<p>'.strtoupper($v->post_file_ext).'</p>';
                $output .= '</div>';
        
                $output .= '</div>';
        
                $output .= '<div class="panel-footer text-center">';
                $output .= '<a class="btn btn-primary btn-block" href="'.base_url().'dashboard/bbl/'.$v->post_id.'" target="_blank">Lihat</a> ';
                $output .= '<a class="btn btn-default btn-block" href="'.base_url().'dashboard/download/'.$v->post_id.'" ><span class="fa fa-download fa-fw" aria-hidden="true"></span> Download</a> ';
                $output .= '</div>';
        
                $output .= '</div>';
                $output .= '</div>';
            }
        }
        return $output;
    }

    function fetch_data_videos($limit, $start, $filter){
        $output = '';
		$this->db->select("POST_ID post_id, POST_TITLE post_title, POST_URI post_uri, POST_TITLE_SHORT post_title_short");
        $this->db->select("POST_FEATURE_IMAGE post_feature_image, POST_DESCRIPTION post_description");
        $this->db->select("POST_FILE_EXTENSION post_file_ext, POST_FILE_SIZE post_file_size");
		$this->db->select("USR_NAME_INPUT usr_name_input, POST_INPUT_DATE post_input_date");
		$this->db->select("CAT_TITLE cat_title, CAT_URI cat_uri");
        $this->db->from("vw_mdl_content_user_group");
        $this->db->join('mdl_bluehrd_bbl_role', 'vw_mdl_content_user_group.POST_ID = mdl_bluehrd_bbl_role.content_id', 'left');
        $this->db->where("POST_ISACTIVE", 1);
        $this->db->where("POST_CATEGORY", 26);
        $this->db->where("POST_FILE_TYPE", "video");
        $this->db->where("company IS NOT NULL");
        $this->db->where("jabatan IS NOT NULL");
        //$this->db->where("grade IS NOT NULL");
        //$this->db->where("level IS NOT NULL");
        
        $arr = array('0');
        if(isset($filter['company'])){
            $arr = array('0', $filter['company']);
            $this->db->where_in("company", $arr);
        }else{
            $this->db->where("company", 0);
        }

        $arr = array('0');
        if(isset($filter['jabatan'])){
            $arr = array('0', $filter['jabatan']);
            $this->db->where_in("jabatan", $arr);
        }else{
            $this->db->where("jabatan", 0);
        }
        
        if(isset($filter['category'])){
            $this->db->where("POST_CATEGORY_BBL", $filter['category']);
        }
        if(isset($filter['keywords'])){
            $this->db->like("POST_TITLE", $filter['keywords']);
            //$this->db->or_like("POST_TITLE_SHORT", $filter['keywords']);
        }

        /*if(isset($filter['grade'])){
            $this->db->where("grade", $filter['grade']);
            $this->db->or_where("grade", 0);
        }else{
            $this->db->where("grade", 0);
        }

        if(isset($filter['level'])){
            $this->db->where("level", $filter['level']);
            $this->db->or_where("level", 0);
        }else{
            $this->db->where("level", 0);
        }*/
		$this->db->order_by("POST_INPUT_DATE","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result = $query->result();
        if($result){
            foreach($query->result() as $v){
                $size_bytes = floor($v->post_file_size * 1024);
                $output .= '<div class="col-md-3">';
                $output .= '<div class="panel panel-default">';

                $output .= '<div class="panel-body">';

                $output .= '<div class="form-group">';
                $output .= '<label class="control-label">Nama File</label>';
                $output .= '<p>'.$v->post_title.'</p>';
                $output .= '</div>';
                $output .= '<div class="form-group">';
                $output .= '<label class="control-label">Besar File</label>';
                $output .= '<p>'.$this->_formatSizeUnits($size_bytes).'</p>';
                $output .= '</div>';
                $output .= '<div class="form-group">';
                $output .= '<label class="control-label">Format</label>';
                $output .= '<p>'.strtoupper($v->post_file_ext).'</p>';
                $output .= '</div>';

                $output .= '</div>';

                $output .= '<div class="panel-footer text-center">';
                $output .= '<a class="btn btn-primary btn-block" href="'.base_url().'dashboard/bbl/'.$v->post_id.'" target="_blank">Lihat</a> ';
                $output .= '</div>';

                $output .= '</div>';
                $output .= '</div>';
            }
        }
        return $output;
    }

    function _formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    function count_all_gallery($filter=array()){
		$this->db->select("*");
		$this->db->from("mdl_gallery");
        if(isset($filter['type'])){
            $this->db->where("GALL_TYPE", $filter['type']);
        }
        if(isset($filter['category'])){
            $this->db->where("GALL_CATEGORY", $filter['category']);
        }
        if(isset($filter['keywords'])){
            $this->db->like("GALL_NAME", $filter['keywords']);
        }
		//$this->db->order_by("GALL_CREATE_DATE","desc");
		$query = $this->db->get();
        return $query->num_rows();
    }

    function fetch_data_gallery($limit, $start, $filter){
        $output = '';
		$this->db->select("*");
        $this->db->from("mdl_gallery");
        if(isset($filter['type'])){
            $this->db->where("GALL_TYPE", $filter['type']);
        }
        if(isset($filter['category'])){
            $this->db->where("GALL_CATEGORY", $filter['category']);
        }
        if(isset($filter['keywords'])){
            $this->db->like("GALL_NAME", $filter['keywords']);
        }
		$this->db->order_by("GALL_CREATE_DATE","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result = $query->result();
        if($result){
            foreach($query->result() as $v){
                $output .= '<div class="col-md-3">';
                if($filter['type'] == "videos"){
                    $img_default_video = $this->_get_image_pic($v->GALL_ID, "videos");
                    $output .= '<div class="panel panel-default lazy" data-original="'.$img_default_video.'" style="background:url('.$img_default_video.') 50% 50% no-repeat; background-size:cover;">';
                }
                if($filter['type'] == "files"){
                    $img_default_file = $this->_get_image_pic($v->GALL_ID, "files");
                    $output .= '<div class="panel panel-default lazy" data-original="'.$img_default_file.'"  style="background:url('.$img_default_file.') 50% 50% no-repeat; background-size:cover;">';
                }
                
                if($filter['type'] == "videos"){
                    $output .= '<img src="templates/bluehrd/img/play.png" style="position:absolute;z-index:100;left:65px;top:30px;" />'; 
                }
                $output .= '<div class="panel-body text-center">';
                $output .= '<div class="form-group sr-only">';
                $output .= '<p>'.$v->GALL_NAME.'</p>';
                $output .= '</div>';
                $output .= '</div>';
        
                $output .= '<div class="panel-footer text-center">';
                $output .= '<a class="btn btn-primary btn-block" href="'.base_url().'gallery/'.$v->GALL_URI.'">Lihat '.$v->GALL_NAME.'</a> ';
                $output .= '</div>';
        
                $output .= '</div>';
                $output .= '</div>';
            }
        }
        return $output;
    }

    function _get_image_pic($gall_id, $type){
        $img_default_video = 'templates/bluehrd/img/bbg.jpg';
        $img_default_file = 'templates/bluehrd/img/no-image.png';
        if($type == "videos"){
            $img_default_pic = $img_default_video;
        }
        if($type == "files"){
            $img_default_pic = $img_default_file;
        }
        if($gall_id){
            $this->db->select("*");
            $this->db->from("mdl_gallery_pic");
            $this->db->where("GALL_ID", $gall_id);
            $this->db->limit(1);
            $this->db->order_by("GALL_PIC_ID","desc");
            $query = $this->db->get();
            $result = $query->row_array();
            if(isset($result['GALL_PIC_THUMBNAIL'])){
                $img_default_pic = 'uploads/galleries/'.$result['GALL_PIC_THUMBNAIL'];
            }
            if($type == "files"){
                $img_default_pic = 'uploads/galleries/'.$result['GALL_PIC_PATH'];
            }
        }
        return $img_default_pic;
    }

    function get_picture_info($pic_id,$limit,$start){
        $result = array();
        if($pic_id){
            $this->db->select("*");
            $this->db->from("vw_mdl_gallery_pic_user_group");
            $this->db->where("GALL_PIC_ID", $pic_id);
            $this->db->limit($limit, $start);
            //$this->db->order_by("GALL_PIC_ID","asc");
            $this->db->order_by("GALL_UPDATE_DATE DESC, GALL_CREATE_DATE DESC, GALL_PIC_ID DESC");
            $query = $this->db->get();
            $result = $query->row_array();
        }
        return $result;
    }

    function count_pic_on_gallery($gall_id){
        $result = 0;
        if($gall_id){
            $this->db->select("*");
            $this->db->from("vw_mdl_gallery_pic_user_group");
            $this->db->where("GALL_ID", $gall_id);
            $query = $this->db->get();
            $result = $query->num_rows();
        }
        return $result;
    }

	function get_pics_of_gallery($filter=array()){
		$this->db->select("GALL_PIC_ID");
		$this->db->from("vw_mdl_gallery_pic_user_group");
		if(isset($filter['GALL_ID'])){
			$this->db->where("GALL_ID", $filter['GALL_ID']);
		}
		$this->db->order_by("GALL_UPDATE_DATE DESC, GALL_CREATE_DATE DESC, GALL_PIC_ID DESC");
		$query = $this->db->get();
		return $query->result();        
    }
    
	function get_gallery_info($filter=array()){
        $this->db->select("GALL_TYPE");
        $this->db->select("GALL_CATEGORY");
		$this->db->from("mdl_gallery");
		if(isset($filter['GALL_ID'])){
			$this->db->where("GALL_ID", $filter['GALL_ID']);
		}
		$query = $this->db->get();
		return $query->row();        
    }
    
    function count_all_forum_topic($filter=array()){
		$this->db->select("*");
        $this->db->from("mdl_forum");
        $this->db->join('mdl_forum_category', 'mdl_forum.POST_CATEGORY_ID = mdl_forum_category.CAT_ID', 'left');
        $this->db->join('mdl_user_data', 'mdl_forum.POSTED_BY = mdl_user_data.usr_id', 'left');
        $this->db->where("mdl_forum.IS_DELETE", 0);
        if(isset($filter['IS_ACTIVE'])){
            $this->db->where("mdl_forum.IS_ACTIVE", $filter['IS_ACTIVE']);
        }
        if(isset($filter['IS_MODERATION'])){
            $this->db->where("mdl_forum.IS_MODERATION", $filter['IS_MODERATION']);
        }
        if(isset($filter['category'])){
            $this->db->where("mdl_forum.POST_CATEGORY_ID", $filter['category']);
        }
        if(isset($filter['keywords'])){
            $this->db->like("mdl_forum.POST_TITLE", $filter['keywords']);
            $this->db->or_like("mdl_forum.POST_DESC", $filter['keywords']);
        }
        if(isset($filter['posted_by'])){
            $this->db->where("mdl_forum.POSTED_BY", $filter['posted_by']);
        }
		$query = $this->db->get();
		return $query->num_rows();
    }

    function fetch_data_forum_topic($limit,$start,$filter=array()){
        $output = "";
		$this->db->select("*");
        $this->db->from("mdl_forum");
        $this->db->join('mdl_forum_category', 'mdl_forum.POST_CATEGORY_ID = mdl_forum_category.CAT_ID', 'left');
        $this->db->join('mdl_user_data', 'mdl_forum.POSTED_BY = mdl_user_data.usr_id', 'left');
        $this->db->where("mdl_forum.IS_DELETE", 0);
        if(isset($filter['IS_ACTIVE'])){
            $this->db->where("mdl_forum.IS_ACTIVE", $filter['IS_ACTIVE']);
        }
        if(isset($filter['IS_MODERATION'])){
            $this->db->where("mdl_forum.IS_MODERATION", $filter['IS_MODERATION']);
        }
        if(isset($filter['category'])){
            $this->db->where("mdl_forum.POST_CATEGORY_ID", $filter['category']);
        }
        if(isset($filter['keywords'])){
            $this->db->like("mdl_forum.POST_TITLE", $filter['keywords']);
            $this->db->or_like("mdl_forum.POST_DESC", $filter['keywords']);
        }
        if(isset($filter['posted_by'])){
            $this->db->where("mdl_forum.POSTED_BY", $filter['posted_by']);
        }
        if(isset($filter['order_by'])){
            $this->db->order_by($filter['order_by']);
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result = $query->result();
        if($result){
            foreach($query->result() as $v){
                $is_already_rated = $this->_check_is_already_rated($v->POST_ID, get_session('user_id'),'forum','love');
                $is_already_comment = $this->_check_is_already_rated($v->POST_ID, get_session('user_id'),'forum','comment');
                $url_link = base_url()."birdbagi-forum/".$v->CAT_URI."/".$v->POST_URI."/".$v->POST_ID;
                $url_link_cat = base_url()."birdbagi-forum/".$v->CAT_URI;
                $id_column = "post_".$v->POST_ID;
                $post_date = "";
                if($v->POST_CREATED){
                    $post_date = date("d-m-Y H:i",strtotime($v->POST_CREATED));
                }
                $output .= '<div id="'.$id_column.'" class="panel panel-none">';
                $output .= '<h4><a href="'.$url_link.'">'.$v->POST_TITLE.'</a></h4>';
                if(isset($filter['posted_by'])){
                }else{
                    $output .= '<p>'.$v->POST_DESC.'<p>';
                }

                $output .= '<div class="row">';
                $output .= '<div class="col-md-8 col-sm-8">';
                $output .= '<div class="help-block">';
                if(isset($filter['posted_by'])){
                    $output .= '<ul class="list-inline">';
                    $output .= '<li><span class="far fa-heart fa-fw" aria-hidden="true"></span> '.$this->_contentstats_number($v->POST_ID,'love','forum').'</li>';
                    $output .= '<li><span class="far fa-comment fa-fw" aria-hidden="true"></span> '.$this->_contentstats_number($v->POST_ID,'comment','forum').'</li>';
                    $output .= '<li><span class="far fa-eye fa-fw" aria-hidden="true"></span> '.$this->_contentstats_number($v->POST_ID,'view','forum').'</li>';
                }
                $output .= '</ul>';
                if(isset($filter['posted_by'])){
                    $output .= '<span class="far fa-calendar-alt fa-fw" aria-hidden="true"></span> '.$post_date.' | ';
                    $output .= '<b>'.$v->CAT_TITLE.'</b>';
                }else{
                    $url_view_user = base_url().'profile/view/'.$v->usr_id;
                    $output .= 'Ditulis oleh <a href='.$url_view_user.'><b>'.$v->nama_lengkap.'</b></a> pada '.$post_date.' dalam ';
                    $output .= '<a href="'.$url_link_cat.'"><b>'.$v->CAT_TITLE.'</b></a>';
                }
                $output .= '</div>';
                $output .= '</div>';
                $output .= '<div class="col-md-4 col-sm-4 text-right">';
                $output .= '<div class="help-block">';
                $output .= '<ul class="list-inline">';
                if(isset($filter['posted_by'])){ 
                    if($v->IS_ACTIVE == 1){
                        $output .= '<li><span class="label label-success">AKTIF</span></li>';
                    }else{
                        $output .= '<li><span class="label label-danger">NONAKTIF</span></li>';
                    }
                    $output .= '<li><a data-toggle="modal" data-id="'.$v->POST_ID.'" class="open-DeleteDialog" title="Hapus"><span class="far fa-trash-alt text-danger " aria-hidden="true"></span><span class="sr-only">Hapus</span></a></li>';

                }else{
                    if($is_already_rated == TRUE){
                        $output .= '<li><span class="far fa-heart text-danger fa-fw"></span>&nbsp;'.$this->_contentstats_number($v->POST_ID,'love','forum').'</li>';
                    }else{
                        $output .= '<li><a class="rating_love_forum" forum_id="'.$v->POST_ID.'" user_id="'.get_session('user_id').'" size="medium"><span class="far fa-heart fa-fw"></span></a>&nbsp;'.$this->_contentstats_number($v->POST_ID,'love','forum').'</li>';
                    }
    
                    if($is_already_comment == TRUE){
                        $output .= '<li><span class="far fa-comment text-info fa-fw"></span>&nbsp;'.$this->_contentstats_number($v->POST_ID,'comment','forum').'</li>';
                    }else{
                        $output .= '<li><a href="'.$url_link.'#form_comment"><span class="far fa-comment fa-fw"></span></a>&nbsp;'.$this->_contentstats_number($v->POST_ID,'comment','forum').'</li>';
                    }

                    $output .= '<li><span class="far fa-eye fa-fw" aria-hidden="true"></span>&nbsp;'.$this->_contentstats_number($v->POST_ID,'view','forum').'</li>';
                }
                $output .= '</ul>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '<hr>';
            }
        }else{
            $output .= 'Tidak ada konten';
        }
	    return $output;
    }

    /** Fungsi untuk mengecek bahwa user telah melakukan rating **/
    function _check_is_already_rated($post_id, $user_id, $label, $type){
        $this->db->select("*");
        $this->db->from("mdl_rating_log");
        $this->db->where("mdl_rating_log.type", $type);
        $this->db->where("mdl_rating_log.usr_id", $user_id);
        if($label == "content"){
            $this->db->where("mdl_rating_log.content_id", $post_id);
        }
        if($label == "forum"){
            $this->db->where("mdl_rating_log.forum_id", $post_id);
        }
        if($label == "gallery"){
            $this->db->where("mdl_rating_log.gallery_id", $post_id);
        }
        $query = $this->db->get();
        $result = $query->row();
        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}