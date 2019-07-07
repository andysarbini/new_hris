<?php
/**
 * status:experimental
 * createdate:9 Maret 2013
 * version:0.1
 * by:g3n1k@yahoo.com
 * desc: untuk menampilkan wswyg editor 
 */ 

if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @author g3n1k
 * tampilkan tinymce
 */
class tinymce
{

	static public function load()
    { return "
<!-- Load TinyMCE -->
<script type=\"text/javascript\" src=\"".base_url()."includes/js/tiny_mce/jquery.tinymce.js\"></script>
<script type=\"text/javascript\">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '".base_url()."includes/js/tiny_mce/tiny_mce.js',

			// General options
			theme : \"advanced\",
			plugins : \"autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist\",

			// Theme options
			

			// Example content CSS (should be your site CSS)
			content_css : \"".base_url()."includes/css/tinymce_content.css\",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : \"lists/template_list.js\",
			external_link_list_url : \"lists/link_list.js\",
			external_image_list_url : \"lists/image_list.js\",
			media_external_list_url : \"lists/media_list.js\",

			// Replace values for the template plugin
			template_replace_values : {
				username : \"Some User\",
				staffid : \"991234\"
			}
		});
	});
</script>
<!-- /TinyMCE -->";
	}

}
