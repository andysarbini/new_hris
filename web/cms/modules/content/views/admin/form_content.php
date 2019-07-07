<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: content
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="page-header">
	<h2>
	<i class="fa fa-file-text-o"></i> Content
	<small>&mdash; Editor</small>
	</h2>
</div>

<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked menu-list">
			<li class="active">
				<a class="font-2x" href='<?php echo base_url().'admin/content'?>'>Content</a>
			</li>
			<li>
				<a class="font-2x" href='<?php echo base_url().'admin/category'?>'>Categories</a>
			</li>
			<li class="hidden">
				<a class="font-2x" href='<?php echo base_url().'admin/gallery'?>'>Galleries</a>
			</li>
			<li class="hidden">
				<a class="font-2x" href='<?php echo base_url().'admin/polling'?>'>Poll</a>
			</li>
			<li class="hidden">
				<a class="font-2x" href='<?php echo base_url().'admin/events'?>'>Events</a>
			</li>
		</ul><!-- /content menu -->
	</div>
	<div class="col-sm-10">
		
		<ul class="nav nav-tabs" role="tablist" id="editor-tab">
			<li role="presentation" class="active"><a href="#detail">Detail</a></li>
			<li role="presentation"><a href="#featured-img">Featured Image</a></li>
			<li role="presentation"><a href="#options">Options</a></li>
		</ul>
		
		<form class='add_content form-horizontal'  role='form' method='post' action='<?php echo base_url().'admin/content/simpan';?>'  enctype="multipart/form-data">
			<input type='hidden' value='<?php echo @if_empty($state->id,0);?>' name='cont_id' />
			<input type='hidden' value='<?php echo @$referer;?>' name='referer' />
		
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="detail">
					
					<div class="form-group">
						<label class='col-sm-2 control-label' for='title'>Title</label>
						<div class='col-sm-8'>
							<input class='form-control input-lg' type='text' name='title' id='title' value='<?php echo @if_empty($state->title,'');?>' />
						</div>
					</div>
					
					<div class="form-group">
						<label class='col-sm-2 control-label' for='uri'>URI</label>
						<div class='col-sm-8'>
							<input class='form-control input-sm' type='text' id='uri'  name='uri' value='<?php echo @if_empty($state->uri,'');?>' />
						</div>
					</div>
				
					<div class="form-group">
						<label class='col-sm-2 control-label' for='description'>Description</label>
						<div class='col-sm-4'>
							<textarea name='description' id='description' class='form-control input-sm' row='3'><?php echo @if_empty($state->description,'');?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class='col-sm-2 control-label' for='title_short'>Alt Description</label>
						<div class='col-sm-4'>
							<input class='form-control input-sm' type='text' name='title_short' id='title_short' value='<?php echo @if_empty($state->title_short,'');?>' />
						</div>
					</div>
				
					<div class="form-group">
						<label class='col-sm-2 control-label' for='content'>Content</label>
						<div class='col-sm-8'>
							<textarea name='content' id='content' class='tinymce form-control' row='3'><?php echo @if_empty($state->content,'');?></textarea>
						</div>
					</div>
				
				</div>
				<div role="tabpanel" class="tab-pane fade" id="featured-img">
				
					<div class="form-group">
						<label class='col-sm-2 control-label' for='feature_img'>Upload</label>
						<div class='col-sm-4'>
							<?php 
							echo isset($state->feature_img) && $state->feature_img != '' ? "<div class='panel'><img src='".@img_thumb('/uploads/images/'.$state->feature_img, 440, 440)."' class='img-responsive img-retina img-thumbnail'></div>":'';?>
							<input class='' type='file' name='feature_img' id='feature_img'/>
						</div>
					</div>
				
				</div>
				<div role="tabpanel" class="tab-pane fade" id="options">
					
					<div class="form-group">
						<label class='col-sm-2 control-label' for='active'>Enable</label>
						<div class='col-sm-4'>
							<select name='active' id='active' class='form-control input-sm'>
								<?php
									$boolean = Modules::run('api/options','opt_boolean');
									
									echo gen_option_html($boolean, @if_empty($state->active, 1) );
								?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class='col-sm-2 control-label' for='category'>Category</label>
						<div class='col-sm-4'>
							<select name='category' id='category' class='form-control input-sm'>
								<?php echo gen_option_html($category_option, @if_empty($state->category, 0)); ?>
							</select>
						</div>
					</div>
					
					<!-- Tambahkan Fungsi Article as Featured --->
					<div class="form-group">
						<label class='col-sm-2 control-label' for='featured_article'>Featured</label>
						<div class='col-sm-4'>
							<select name='featured_article' id='featured_article' class='form-control input-sm'>
								<option value="yes">Yes</option>
								<option value="no" selected>No</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class='col-sm-2 control-label' for='mainpage'>Mainpage</label>
						<div class='col-sm-4'>
							<select name='mainpage' id='mainpage' class='form-control input-sm'>
								<?php
									$boolean = Modules::run('api/options','opt_boolean');
									
									echo gen_option_html($boolean, @if_empty($state->mainpage, 0) );
								?>
							</select>
						</div>
					</div>
				
				</div>
				
			</div>
		
			<div class='button-set'>
				<input class='btn btn-success btn-sm' id="save" type='submit' name='submit' value='Save'/>
				<a class='btn btn-default btn-sm' href='<?php echo $referer;?>'>Cancel</a>
				<?php if(@if_empty($state->id,false)){ ?>
					<a class='btn btn-link btn-cancel btn-sm pull-right' href='<?php echo base_url().'admin/content/delete/'.$state->id.'/?referer='.$referer;?>'><i class='fa fa-trash-o'></i> Delete</a>
				<?php } ?>
			</div><!-- bottom form button group -->

		</form>
	
	</div>
</div>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>includes/ckeditor/ckeditor.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url();?>includes/js/admin-default.js"></script>

<script type="text/javascript">
	
   CKEDITOR.replace( 'content', 
		{
			 filebrowserBrowseUrl: '<?php echo base_url();?>includes/kcfinder/browse.php?type=files',
			 filebrowserImageBrowseUrl: '<?php echo base_url();?>includes/kcfinder/browse.php?type=images',
			 filebrowserFlashBrowseUrl: '<?php echo base_url();?>includes/kcfinder/browse.php?type=flash',
			 filebrowserUploadUrl: '<?php echo base_url();?>includes/kcfinder/upload.php?type=files',
			 filebrowserImageUploadUrl: '<?php echo base_url();?>includes/kcfinder/upload.php?type=images',
			 filebrowserFlashUploadUrl: '<?php echo base_url();?>includes/kcfinder/upload.php?type=flash'
		}
    );

$(document).ready(function(){

	$('#title').keyup(function(){ gen_title_to_uri('#title', '#uri'); });
	
	$('#editor-tab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	})
	
});
</script>
