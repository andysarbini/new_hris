<h3 class='heading'>
	Gallery <strong>(Edit)</strong>
</h3>
<p class='description'>Tambah, edit, hapus galeri konten.</p>

<div class='clearfix margin-bottom-20'></div>

<form class="add_gallery form-horizontal" role='form' method='post' action='<?php echo base_url().'admin/gallery/simpan';?>'  >
	
	<input type='hidden' value='<?php echo @if_empty($state->id,0);?>' name='gall_id' />
	
	<div class='form-group'>
		<div class='col-lg-offset-2 col-lg-10'>
			<div class='btn-group'>
				<?php if(@if_empty($state->id,false)){ ?>
					<a class='btn btn-primary btn-sm' href='<?php echo base_url().'admin/gallery/delete_gall/'.$state->id;?>'><span class='glyphicon glyphicon-trash'></span></a>
				<?php } ?>
				
				<a class='btn btn-primary btn-sm' href='<?php echo base_url();?>admin/gallery'>Cancel</a>
				<input class='btn btn-primary btn-sm' id="save" type='submit' name='submit' value='Save' />
			</div>
		</div>
	</div><!-- top form button group-->
	
	<div class='form-group'>
		<label class='col-lg-2 control-label' for='name'>Name</label>
		<div class='col-lg-10'>
			<input class='form-control' type='text' id='name' name='name' value='<?php echo @if_empty($state->name,'');?>' />
		</div>
	</div>

	<div class='form-group'>
		<label class='col-lg-2 control-label' for='uri'>URI</label>
		<div class='col-lg-10'>
			<input class='form-control' type='text' id='uri' name='uri' value='<?php echo @if_empty($state->uri,'');?>'  onblur="gen_title_to_uri('#name', '#uri');"/>
		</div>
	</div>

	<div class='form-group'>
		<label class='col-lg-2 control-label' for='template_id'>Template</label>
		<div class='col-lg-10'>
			your choice <b><?php echo @if_empty($state->template,'');?></b>
		
			<input type='hidden' id='template' name='template' value='<?php echo @if_empty($state->template,'');?>'>
		
			<input type='hidden' id='template_id' name='template_id' class='form-control'>
		</div>
	</div>

	<div class='form-group'>
		<label class='col-lg-2 control-label' for='desc'>Description</label>
		<div class='col-lg-10'>
			<textarea class='form-control' name='desc'><?php echo @if_empty($state->description,'');?></textarea>
		</div>
	</div>

	
	<div class='form-group'>
		<div class='col-lg-offset-2 col-lg-10'>
			<div class='btn-group'>
				<?php if(@if_empty($state->id,false)){ ?>
					<a class='btn btn-primary btn-sm' href='<?php echo base_url().'admin/gallery/delete_gall/'.$state->id;?>'><span class='glyphicon glyphicon-trash'></span></a>
				<?php } ?>
				
				<a class='btn btn-primary btn-sm' href='<?php echo base_url();?>admin/gallery'>Cancel</a>
				<input class='btn btn-primary btn-sm' id="save" type='submit' name='submit' value='Save' />
			</div>
		</div>
	</div><!-- bottom form button group-->

</form>

<script>
$("#template_id").select2({
	data:[{"pic":"tmp_gallery_careosul.jpg","id":"carousel","title":"Carousel"},{"pic":"tmp_gallery_product_tsa.jpg","id":"product_tsa","title":"Product"},{"pic":"tmp_gallery_project.jpg","id":"project","title":"Project"},{"pic":"tmp_gallery_slides.jpg","id":"slides","title":"Slides"},{"pic":"tmp_gallery_slides.jpg","id":"portfolio","title":"Portfolio"}],
	//width: "element",
	height: "element",
	formatResult: formatResult,
	formatSelection: formatSelect,
	
});
function formatResult(state) { 
	return "<img class='flag' src='<?php echo base_url();?>uploads/galleries/templates/" + state.pic + "' alt='" +state.title+ "' value='"+state.id+"' /> <span class='lead'>" + state.title+"</span>";
}
function formatSelect(state){
	return state.title;
}

</script>
