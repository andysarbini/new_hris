<table class="table table-condensed table-striped table-hover" width='100%' cellspacing='0' cellpadding='0'>
	<thead>
		<tr>
			<th>Title</th>
			<th>URI</th>
			<th>Status</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	
	<tbody id='tbody-list-widget'>
		<?php 
		if (count($tables)) {
			foreach ($tables as $t) { ?><tr id='tr_<?php echo $t->id;?>'>
				<td><a class='btn-link' onclick="show_modal(<?php echo $t->id;?>);"><?php echo $t->title;?></a></td>
				<td><?php echo $t->uri;?></td>
				<td><?php echo Modules::run('api/_active/title',$t->active);?></td>
				<td>
					<div class='btn-group pull-right'>
						<a class="btn btn-primary btn-xs" onclick="show_modal(<?php echo $t->id;?>);"><span class='glyphicon glyphicon-edit'></span></a>
						<a class="btn btn-primary btn-xs" onclick="hapus(<?php echo $t->id;?>);"><span class='glyphicon glyphicon-trash'></span></a>
					</div>
				</td>
		</tr>
			<?php };
		}
		?>
	</tbody>
</table>
<!--
<select multiple id='debug'></select>
-->
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
	//console.log(opt_ary);	
	if( $.isArray(slc) ){ // array sta
		
		for(var i in opt_ary){
			if(opt_ary.hasOwnProperty(i)){
			//	str += '<option value="'+i+'"'+ ($.inArray(i, slc) >= 0 ? ' selected':'') +'>'+opt_ary[i]+'</option>';
				str += '<option value="'+opt_ary[i][0]+'"'+ ($.inArray(opt_ary[i][0], slc) >= 0 ? ' selected':'') +'>'+opt_ary[i][1]+'</option>';
				
				//console.log(opt_ary[i]);
			}
		}
	} else { // single value
		if(slc == 'all')
		for(var i in opt_ary){
			if(opt_ary.hasOwnProperty(i)){
				str += '<option value="'+opt_ary[i][0]+'" selected>'+opt_ary[i][1]+'</option>';
			}
		}
		else
		for(var i in opt_ary){
			if(opt_ary.hasOwnProperty(i)){
				str += '<option value="'+i+'"'+ (slc == i ? ' selected':'') +'>'+opt_ary[i]+'</option>';
			}
		}
		
	}
	return str;
}


function show_modal(_id){
	
	var slc_isactive = {1:"Enabled", 0:"Disabled"};
	
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
					
					// radio show title
					if(data.title_show == 1) var _radio = "<input type='radio' name='title_show' value='0'> Hide <input type='radio' name='title_show' value='1' checked> Show";
					else var _radio = "<input type='radio' name='title_show' value='0' checked> Hide <input type='radio' name='title_show' value='1' > Show";
					//console.log(data.title_show);
					$('#radio_show_title').html(_radio);
					
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
	
    $('#modals').modal();
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
					var c = 0;
					//data_pages_obj['all'] = 'All Pages';
					data_pages_obj[c] = ['all','All Pages'];
					
					if(data.length){
						// save to variable
						data_pages = data;
						
						for ( var i in data ) {
							
							if(data[i].isgroup) { 
								
								data[i].id = 'group_'+data[i].id;
								
								data[i].title = '- '+ data[i].title ;
							} else {
								
								data[i].title = '-- '+data[i].title ;
							}
							
							
							strbody += '<option value="'+data[i].id+'">';
							strbody += data[i].title;
							strbody += '</option>';
							
							//console.log(data[i].title);
							
							data_pages_obj[++c] = [ data[i].id ,data[i].title ];
							
						}
					
					} else {
						
						strbody += "<option value=''>No Page</option>";
					}
					
					$('#select-pages').html(strbody);
					
					// debug
			//		$('#debug').html(strbody);
					
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
	console.log($('#title_show').val());

	var id = $('#wid_id').val();
	$.post( '<?php echo base_url().'admin/widget/';?>simpan',	
			{
				'id':$('#wid_id').val(),
				'title':$('#wid_title').val(),
				'title_show':$('input:radio[name=title_show]:checked').val(),
				'uri':$('#wid_uri').val(),
				'code':$('#wid_code').val(),
				'pages':$('#select-pages').val(),
				'active':$('#isactive').val()
			}, 
			function(data) {
				
				var active = $('#isactive').val()==1 ? '<span class="label label-success">Enabled</span>':'<span class="label label-danger">Disabled</span>';
				
				var strbody = '';
				strbody += "<td><a class='btn-link' onclick='show_modal("+id+");'>"+$('#wid_title').val()+'</td>';						
				strbody += '<td>'+$('#wid_uri').val()+'</td>';						
				strbody += '<td>'+active+'</td>';						
				strbody += '<td><div class="btn-group pull-right"><a class="btn btn-primary btn-xs" onclick="show_modal('+id+');"><span class="glyphicon glyphicon-edit"></span></a>';
				strbody += '<a class="btn btn-primary btn-xs" onclick="hapus('+id+');"><span class="glyphicon glyphicon-trash"></span></a></div></td>';
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

	$('#modals').modal('hide');
}


</script>
