<table class="table table-striped table-hover" width='100%' cellspacing='0' cellpadding='0'>
	<thead>
		<tr>
			<th width='33%'>Title</th>
			<th>URI</th>
			<th width='10%' style='text-align:center'>Status</th>
			<th style='text-align:center'>Action</th>
		</tr>
	</thead>
	<tbody id='tbody-list-widget'>
<?php 
if (count($tables)) {
	foreach ($tables as $t) { ?><tr id='tr_<?php echo $t->id;?>'>
	<td><a class='f116 btn-link' onclick="show_modal(<?php echo $t->id;?>);"><?php echo $t->title;?></a></td>
	<td><?php echo $t->uri;?></td>
	<td style='text-align:center'><?php echo $t->acc;?></td>
	<td class='span2'><a class="btn btn-mini" onclick="show_modal(<?php echo $t->id;?>);"><i class="icon-edit"></i> Edit</a>
	<a class="btn btn-mini" onclick="hapus(<?php echo $t->id;?>);"><i class="icon-trash"></i> Delete</a></td>
</tr>
	<?php };
}
?>
	</tbody>
</table>

<div id='debug'></div>

<script type='text/javascript'>
$(document).ready(function(){
	
	load_list_page();
	
	$('#btn-add-widget').click(function() { show_modal(0); }); 
	
	$('#btn_simpan').click(function() { simpan_widget(); }); 
	
	$('#btn_cancel').click(function() { hide_modal(); }); 
	
});

/* optimize: hold var pages option */
var data_pages = new Array();
var data_pages_obj = {};

/*generate option select*/
function generate_option(opt_ary, slc){
	//var slc_active = { 1:"a", 2:"b", 3:"c" };
	var str = '';
		
	if( $.isArray(slc) ){ // array sta
		
		for(var i in opt_ary){
			if(opt_ary.hasOwnProperty(i)){
				str += '<option value="'+i+'"'+ ($.inArray(i, slc) >= 0 ? ' selected':'') +'>'+opt_ary[i]+'</option>';
				
				//console.log(opt_ary[i]);
			}
		}
	} else { // single value
		for(var i in opt_ary){
			if(opt_ary.hasOwnProperty(i)){
				str += '<option value="'+i+'"'+ (slc == i ? ' selected':'') +'>'+opt_ary[i]+'</option>';
			}
		}
	}
	return str;
}


function show_modal(_id){
	
	var slc_isactive = {1:"yes", 0:"no"};
	
	if(_id){ 
		$.post( '<?php echo base_url().'admin/widget/';?>load_list_widget',	{'id': _id}, 
				function (data){ 
					$('#wid_id').val(data.id);
					$('#wid_title').val(data.title);
					$('#wid_uri').val(data.uri);
					$('#wid_code').val(data.script);
					$('#isactive').html(generate_option(slc_isactive, data.active));
					
					if(data.nav == 1) {
						$('#select-pages').html(generate_option(data_pages_obj, 'all'));
					}
					else {
						load_nav_group_list(_id);
					}
					
				}, 
				"json"
		);
	} 
	
	else {
		$('#wid_id').val(0);
		$('#wid_title').val('');
		$('#wid_uri').val('');
		$('#select-pages').html(generate_option(data_pages_obj, 'all'));
		
		$('#wid_code').val('');
		$('#isactive').val('');
	}
	
    $('#formModal').modal();
}

function load_list_page(){
	/* jika ada data hasil pemanggilan*/
	if(data_pages.length){
		
		console.log('ada data get var local');
	}
	/* tidak ada, lakukan pemanggilan  */
	else {
		$.post( '<?php echo base_url().'admin/widget/';?>load_list_page',	{ }, 
				function (data){ 
					
					var strbody = '<option value="all">All Pages</option>';
					
					data_pages_obj['all'] = 'All Pages';
					
					if(data.length){
						// save to variable
						data_pages = data;
						
						for ( var i in data ) {
							
							if(data[i].isgroup) { 
								
								data[i].id = 'group_'+data[i].id;
								
								data_pages_obj[data[i].id] = '<span style="color:red;">'+data[i].title +'</span>';
							}
							
							else {
								
								strbody += '<option value="'+data[i].id+'">';
							
								data_pages_obj[data[i].id] = data[i].title;
							}
							
							strbody += data[i].title;
							strbody += '</option>';
							
							console.log(data[i]);
						}
					
					} else {
						
						strbody += "<option value=''>No Page</option>";
					}
					
					$('#select-pages').html(strbody);
					
					// debug
					$('#debug').html(strbody);
					
				}, 
				"json"
		);
		
		//console.log('tidak ada data, ekskusi request');
	}
}

/* delete widget */
function hapus(id){
	$.post(
		'<?php echo base_url().'admin/widget/';?>hapus',
		{'id':id},
		function(data){
			$('#tr_'+id).hide();
		}
	);
}



/* simpan widget */
function simpan_widget(){
	var id = $('#wid_id').val();
	$.post( '<?php echo base_url().'admin/widget/';?>simpan',	
			{
				'id':$('#wid_id').val(),
				'title':$('#wid_title').val(),
				'uri':$('#wid_uri').val(),
				'code':$('#wid_code').val(),
				'pages':$('#select-pages').val(),
				'active':$('#isactive').val()
			}, 
			function(data) {
				var active = $('#isactive').val() ? 'Enabled':'Disabled';
				
				var strbody = '';
				strbody += '<td>'+$('#wid_title').val()+'</td>';						
				strbody += '<td>'+$('#wid_uri').val()+'</td>';						
				strbody += '<td style="text-align:center;">'+active+'</td>';						
				strbody += '<td><a class="btn btn-mini" onclick="show_modal('+id+');"><i class="icon-edit"></i> Edit</a>';
				strbody += '<a class="btn btn-mini" onclick="hapus('+id+');"><i class="icon-trash"></i> Delete</a></td>';
				// update
				if(id != 0) $('#tr_'+id).html(strbody);
				// insert
				else {
					
					var tbody = $('#tbody-list-widget').html();
				
					$('#tbody-list-widget').html(tbody+'<tr id="'+data+'">'+strbody+'</tr>');
				}
				
				hide_modal();
				
			}//,"json"
		);
}


function load_nav_group_list(_id){
	
	var varay = [];
	$.post( '<?php echo base_url().'admin/widget/';?>get_nav_group_list', {'id': _id},
			function (data){
			
				$('#select-pages').html(generate_option(data_pages_obj, data));
			},
			"json"
		);
}

function hide_modal(){

	$('#formModal').modal('hide');
}


</script>
