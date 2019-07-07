<h3 class='heading'>
	Gallery <strong>(Edit)</strong>
</h3>
<p class='description'>Upload gambar baru ke dalam gallery.</p>

<div class='clearfix margin-bottom-20'></div>

<form class='form-horizontal' role='form' action='<?php echo base_url().'admin/gallery/simpan_img';?>' method='post' enctype="multipart/form-data" >

	<input type='hidden' name='gall_id' value='<?php echo $gall_id;?>' />
	
	<input type='hidden' name='pic_id' value='<?php echo @if_empty($mdl->pic_id, 0);?>' />
	
	<div class='form-group'>
		<div class='col-lg-offset-2 col-lg-10'>
			<div class='btn-group'>
				<?php if(isset($mdl->gall_id) && isset($mdl->pic_id)){ ?>
					<a class='btn btn-primary btn-sm' href='<?php echo base_url().'admin/gallery/delete/'.$mdl->gall_id.'/'.$mdl->pic_id;?>'><span class='glyphicon glyphicon-trash'></span></a>
				<?php	} ?>
				<a href='<?php echo base_url().'admin/gallery/detail/'.$gall_id.'/';?>' class='btn btn-primary btn-sm'>Cancel</a>
				<input type='submit' name='submit' id='submit' value='Save' class='btn btn-primary btn-sm'/>
			</div>
		</div>
	</div><!-- top form button group-->
	
	<div class='form-group'>
		<label class='col-lg-2 control-label' for='desc'>Image Name</label>
		<div class='col-lg-10'>
			<input class='form-control' type='text' name='name' id='name' value='<?php echo @if_empty($mdl->name,'');?>'/>
		</div>
	</div>

	<div class='form-group'>
		<label class='col-lg-2 control-label' for='image'>File</label>
		<div class='col-lg-10'>
			<input class='form-control' type='file' id='image' name='image'  />
			<em><small><?php echo @if_empty($mdl->path,'').'<br />';?></small></em>
		</div>
	
	</div>
	
	<div class='form-group'>
		<label class='col-lg-2 control-label' for='main'>Default for Gallery</label>
		<div class='col-lg-10'>
			<select name='main' id='main' class='select2 form-control'>
				<?php
					$boolean = Modules::run('api/options','opt_boolean');
					
					echo gen_option_html($boolean, @if_empty($mdl->main, 0) );
				?>
			</select>
		</div>
	</div>
	
	<div class='form-group'>
		<label class='col-lg-2 control-label' for='description'>Description</label>
		<div class='col-lg-10'>
			<textarea class='form-control' type='text' id='description' name='description'><?php echo @if_empty($mdl->ket,'');?></textarea>
		</div>
	</div>
	
	<div class='form-group'>
		<label class='col-lg-2 control-label' for='content_id'>Template</label>
		<div class='col-lg-10'>
			<input type='hidden' id='template_id' name='template_id' class='form-control' onchange='load_template();'>
		</div>
	</div>
	
	<!-- content detail here -->
	<div class='form-group'>
		<label class='col-lg-2 control-label' for='content'>Detail Content</label>
		<input type='hidden' name='id_content' id='id_content' value='<?php echo @if_empty($mdl->post_id,0);?>'/>
		<div class='col-lg-10'>
			<textarea class='form-control' id='txt_content' name='txt_content'><?php echo @if_empty($txt_content,'');?></textarea>
		</div>
	</div>
	
	<div class='form-group'>
		<div class='col-lg-offset-2 col-lg-10'>
			<div class='btn-group'>
				<?php if(isset($mdl->gall_id) && isset($mdl->pic_id)){ ?>
					<a class='btn btn-primary btn-sm' href='<?php echo base_url().'admin/gallery/delete/'.$mdl->gall_id.'/'.$mdl->pic_id;?>'><span class='glyphicon glyphicon-trash'></span></a>
				<?php	} ?>
				<a href='<?php echo base_url().'admin/gallery/detail/'.$gall_id.'/';?>' class='btn btn-primary btn-sm'>Cancel</a>
				<input type='submit' name='submit' id='submit' value='Save' class='btn btn-primary btn-sm'/>
			</div>
		</div>
	</div><!-- bottom form button group-->
	
</form>

<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>includes/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	
	var options = {
			 filebrowserBrowseUrl: '<?php echo base_url();?>includes/kcfinder/browse.php?type=files',
			 filebrowserImageBrowseUrl: '<?php echo base_url();?>includes/kcfinder/browse.php?type=images',
			 filebrowserFlashBrowseUrl: '<?php echo base_url();?>includes/kcfinder/browse.php?type=flash',
			 filebrowserUploadUrl: '<?php echo base_url();?>includes/kcfinder/upload.php?type=files',
			 filebrowserImageUploadUrl: '<?php echo base_url();?>includes/kcfinder/upload.php?type=images',
			 filebrowserFlashUploadUrl: '<?php echo base_url();?>includes/kcfinder/upload.php?type=flash'
		};
	
   CKEDITOR.replace( 'txt_content', options );/**/
   
function load_template(){
	var _id = $('#template_id').val();
	$.post( '<?php echo base_url().'admin/';?>gallery/load_content/'+_id,	{ }, function (data){ CKupdate(data); }
	);
}

function CKupdate(data){
	/*
	snipeet to blogging #NEED
	*/
	
	CKEDITOR.remove(CKEDITOR.instances['txt_content']);
	$('#txt_content').val(data);
	$('#cke_txt_content').remove();
	CKEDITOR.replace('txt_content', options);
	
}

// select2 view image
$("#template_id").select2({
	data:<?php echo Modules::run('gallery/admin/get_link_content'); ?>,
	//width: "element",
	height: "element",
	formatResult: formatResult,
	formatSelection: formatSelect,
	
});
function formatResult(state) { 
	return "<img class='flag' src='<?php echo base_url();?>uploads/galleries/" + state.pic + "' alt='" +state.title+ "' value='"+state.id+"' /> <span class='lead'>" + state.title+"</span>";
}
function formatSelect(state){
	return state.title;
}

</script>
