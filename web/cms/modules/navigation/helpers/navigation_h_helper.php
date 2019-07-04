<?php
/**
 * 
 */
if ( ! function_exists('gen_child_tree'))
{
	function gen_child_tree($_level=0, $_horizontal = '__&nbsp;', $_vertical='|'){
		if($_level){
			//$tree = $_vertical; 
			$tree = ''; 
			$_stop = $_level - 1;
			for($i=0; $i<$_level; $i++) {
				$tree = $tree . ($_stop == $i ? $_vertical.$_horizontal :'&nbsp;&nbsp;&nbsp;') ;
			}
		} else 
				$tree = '';
		return $tree;
	}
}

/**
 * return url by type
 * @param unknown $url
 * @param number $type_id
 * @return string|unknown
 */
function gen_url_by_type($url, $type_id = 1){
	if($type_id == 1) // content
		return base_url().'pages/'.$url;

	elseif($type_id == 2) // modules
	return base_url().$url;

	else {// url
		//$ary = explode('http://', $url);
		//return 'http://' . count($ary) <= 1 ? $ary[0] : $ary[1];
		return $url;
	}
}
/**
 * 
 * @param unknown $url
 * @param number $type_id
 * @return string|unknown
 */
function gen_url_by_type_nav($aray, $type_id = 1){
	if($type_id == 1) // content
		return base_url().'pages/'.$aray['uri'];

	elseif($type_id == 2) // modules
	return base_url().$aray['url'];

	else {// url
		//$ary = explode('http://', $url);
		//return 'http://' . count($ary) <= 1 ? $ary[0] : $ary[1];
		return $aray['url'];
	}
}

if ( ! function_exists('are_this_current_menu'))
{
	function are_this_current_menu($_url = '', $_class= 'active'){
		return preg_match('#'.addslashes($_url).'#', current_url() ) ? "{$_class}":"";
	}
}

/**
 * draw menu from array to list html
 */ 
if ( ! function_exists('draw_menu'))
{ 
	function draw_menu(&$aray_menu, $_level = 0, $option = array()){
		@session_start();
		$_SESSION['counter']=0;
		return draw_menu_write($aray_menu, $_level, $option);
		$_SESSION['counter']=0;
	}
}
if ( ! function_exists('draw_menu_write'))
{ 
	function draw_menu_write(&$aray_menu, $_level = 0, $option = array()){
		
		$full_url = full_url();
		
		$opt_default = array(
			'ul' => '<ul>', # ul first
			'ul_2'=>'<ul class="dropdown-menu">', # ul other
			'li_dropdown'=>' class=""', 
			'a_dropdown'=>' class="dropdown-toggle" data-toggle="dropdown"'
		);
		
		$option = array_merge($opt_default, $option);
		
		$html = '';
		
		$html .= "\r".( $_level ? $option['ul_2'] : $option['ul'])."\r";
		
		//$CI =& get_instance();
		
		//echo 's2:'.$CI->uri->segment(2);
		
		foreach($aray_menu as $m) {
			
			$_level = $m['level']; 
			
			$_level_next = isset($aray_menu[++$_SESSION['counter']]['level']) ? $aray_menu[$_SESSION['counter']]['level'] : $_level-1;
			
			#$link_url = gen_url_by_type($m['uri'], $m['type_id']);
			$link_url = gen_url_by_type_nav($m, $m['type_id']);
			
			$a =  "<a".( $_level < $_level_next ? ' '.$option['a_dropdown'] : '')." href='".$link_url."' title='". $m['title']."'>".$m['title'];
			
			$html .= '<li'. ($full_url == $link_url ? ' class="active"':'').' >' . $a;
			
				
			$html .= "</a>";
			
			unset($aray_menu[$_SESSION['counter']-1]);
			
			//$html .= '[l:'.$_level.'][n:'.$_level_next.'][c:'.$_SESSION['counter'].']';//[cl'.$aray_menu[$counter]['level'].']';
			
			if( $_level < $_level_next ) $html .= draw_menu_write($aray_menu, $_level_next, $option);
			
			$html .= '</li>'."\r";
			
			if($_level > $_level_next) break;
			
		}
		
		$html .= "</ul>"."\r";
		
		return $html;
	}
}

