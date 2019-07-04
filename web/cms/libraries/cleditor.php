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
class cleditor
{

	static public function load()
    { return "
<link rel='stylesheet' type='text/css' href='".base_url()."includes/js/cleditor/jquery.cleditor.css' />
<script type='text/javascript' src='".base_url()."includes/js/cleditor/jquery.cleditor.min.js'></script>
    <script type='text/javascript'>
      $(document).ready(function() {
        editor = $('#cleditor').cleditor({width:'100%', height:'100%'})[0].focus();
        $(window).resize();
      });
      $(window).resize(function() {
        var \$win = $(window);
        $('#container').width(\$win.width() - 32).height(\$win.height() - 33).offset({left:15, top:15});
        editor.refresh();
      });
    </script>";
	}

}
