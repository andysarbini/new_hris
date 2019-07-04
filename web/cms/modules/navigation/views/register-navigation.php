<ul class="nav nav-tabs">
<?php 
if(count($menus)){
/*
["group_id"]=> string(1) "4" 
["id"]=> string(2) "36" 
["title"]=> string(5) "Notif" 
["type_id"]=> string(1) "2" 
["uri"]=> string(5) "notif" 
["url"]=> string(14) "register/notif" 
["content"]=> NULL 
["parent_id"]=> string(1) "0" 
["target"]=> string(1) "0" 
["poss"]=> string(1) "0" 
["home"]=> string(1) "0" 
["level"]=> int(0)  
 */
	$out = '';
	
	foreach($menus as $m){
		//$out .= "<li ".  (preg_match('#'.addslashes($m['url']).'#', current_url() ) ? " class='active'":"") . ">";
		$out .= "<li class='".  are_this_current_menu($m['url']) . "'>";
		
		$out .= "<a href='".gen_url_by_type($m['url'], $m['type_id'])."' title='".$m['uri']."'>".$m['title']."</a> ";
		
		$out .= "</li>";
	}
	
	echo $out;

} ?>
</ul>
