<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: navigation
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="page-header">
	<h1>Menu Navigasi </h1>
</div>

<div class="row">
	<div class="col-sm-8">
		<div id='nav-table'><?php echo html_loader();?></div>
	</div>
	<div class="col-sm-4">
		<div id='nav-form'><?php echo html_loader();?></div>
	</div>
</div>

<input type='hidden' id='no_group_id' value='0'/>

<div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Menu Details <small>&mdash; Navigation Module</small></h4>
      </div>
      <div class="modal-body">
        <input type='hidden' id='group_id' value='0' />
				<div id='nav-list-form'></div>
				<div id='nav-list-table'><?php echo html_loader();?></div>
      </div>
      <div class="modal-footer">
        <button id='btn-show-list' class="btn btn-default btn-sm" onclick="view_nav_list();"><i class="fa fa-arrow-left"></i>  All List</button>
				<button id='btn-add-list' class="btn btn-success btn-sm" onclick="load_form_nav_list('0');"><i class="fa fa-plus"></i> Add New Item</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type='text/javascript'>
/**
navigation to admin, ajax style
1. load input navigation
2. load table list navigation
3. load input navigation list
4. load table list navigation-list

[WARNING]
this just method for small amount data,
if you plan for huge data, you must cut the data with pagination (limit query) 

*/

$(document).ready(function(){
	load_form_nav(0);
	load_nav();

	//$('#nav_list_title').on('blur', function(){  console.log('on event');});


	//$('#nav_list_title').on('click', function(){ console.log('flat wat');});
});

function load_form_nav(_id){
	$.post( 
		'<?php echo base_url().'navigation/admin/';?>add_edit_nav/'+_id,	
		{ }, 
		function (data){ $('#nav-form').html(data); }	
	);
}

function load_nav(){
	$.post( 
		'<?php echo base_url().'navigation/admin/';?>view_nav',	
		{ }, 
		function (data){ $('#nav-table').html(data); } 
	);
}

function simpan_nav(){
	var nav_id		= $('#nav_id').val();
	var nav_title	= $('#nav_title').val();
	var nav_uri		= $('#nav_uri').val();
	var group_id	= $('#group_id').val();

	$.post( '<?php echo base_url().'navigation/admin/';?>simpan_nav',	{ 
		'nav_id':nav_id,
		'nav_title':nav_title,
		'nav_uri':nav_uri,
		'group_id':group_id
	}, function (data){ load_nav(); load_form_nav(0); } );
}

function hapus_nav(_id){

	if(confirm('Are you sure you want to delete this item?')){
		$.post( '<?php echo base_url().'navigation/admin/';?>hapus_nav',	{'id':_id}, function (data){ $('#nav'+_id).hide(); });
	}
}

/**
 * play with modals
 **/

function navlist(group_id, owner_id){ 

	console.log('group_id:'+group_id+'  -- owner_id:'+owner_id);
	$('#no_group_id').val(group_id);
	load_nav_list(group_id, owner_id);
	$('#myModal').modal();
}

//view form nav list
function load_form_nav_list(_id, _parent){

	$('#nav-list-table').hide('fade'); $('#btn-show-list').show();

	$('#nav-list-form').show('fade'); $('#btn-add-list').hide();

	var _group_id = $('#no_group_id').val();

	$.post( 
		'<?php echo base_url().'navigation/admin/';?>add_edit_nav_list', 

		{'id':_id, 'group_id':_group_id, 'parent':_parent }, 

		function (data){ $('#nav-list-form').html(data); } 
	);
}

//view table nav list
function load_nav_list(group_id, owner_id){

	$('#nav-list-table').show('fade'); $('#btn-show-list').hide();

	$('#nav-list-form').hide('fade'); $('#btn-add-list').show();

	//$('#group_id').val(group_id);

	$('#group_id').val(owner_id);

	$.post( 
		'<?php echo base_url().'navigation/admin/';?>view_nav_list', 

		{ 'group_id': group_id,'owner_id': owner_id}, 

		function (data){ $('#nav-list-table').html(data); } 
	);
}

function view_nav_list(){
	// g3n1k
	load_nav_list($('#no_group_id').val(), $('#group_id').val());
}

// simpan nav list
function simpan_nav_list(){

	var group_id = $('#no_group_id').val(); // g3n1k patch

	var id 		= $('#nav_list_id').val();

	var title 	= $('#nav_list_title').val();

	var type	= $('#nav_list_type').val();

	var url 	= (type == 1) ? $('#nav_list_url').val() : $('#nav_list_urm').val() ;

	var uri 	= $('#nav_list_uri').val();

	var id_parent = $('#nav_list_id_parent').val();

	var target 	= $('#nav_list_target').val();

	var poss	= $('#nav_list_poss').val();

	$.post( '<?php echo base_url().'navigation/admin/';?>simpan_nav_list', 
			{ 
				'group_id': group_id, 
				'id':id, 
				'title':title,
				'type':type,
				'url':url,
				'uri':uri,
				'id_parent':id_parent,
				'target':target,
				'poss':poss
			}, 
			function (data){ 
				load_nav_list(group_id); 
			} 
		);
}


function hapus_nav_list(){

	$.post( '<?php echo base_url().'navigation/admin/';?>hapus_nav_list', {'id':$('#nav_list_id').val()}, function(data){ view_nav_list(); }); 
}
</script>
