<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: category
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="page-header">
	<h2>
		<i class="fa fa-sitemap"></i> Category
		<small>&mdash; Editor</small>
	</h2>
</div>

<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked menu-list">
			<li>
				<a class="font-2x" href='<?php echo base_url().'admin/content'?>'>Content</a>
			</li>
			<li class="active">
				<a class="font-2x" href='<?php echo base_url().'admin/category'?>'>Category</a>
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
			<li role="presentation"><a href="#options">Options</a></li>
		</ul>

		<form class='form-horizontal' role='form' method='post' action='<?php echo base_url().'admin/category/simpan';?>'>
			<input type='hidden' name='cat_id' id='cat_id' value='<?php echo @if_empty($cat->id, 0);?>'/>
	
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="detail">
				<div class="form-group">
					<label class='col-sm-2 control-label' for="cat_title">Title</label>
					<div class='col-sm-4'>
						<input type="text" class='form-control input-sm' name="cat_title" id="cat_title" placeholder="Title" value='<?php echo @if_empty($cat->title, '');?>' />
					</div>
				</div>
				
				<div class="form-group">
					<label class='col-sm-2 control-label' for="cat_uri">URI</label>
					<div class='col-sm-4'>
						<input type="text" class='form-control input-sm' name="cat_uri" id="cat_uri" placeholder="Uri" value='<?php echo @if_empty($cat->uri, '');?>' />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cat_ket">Description</label>
					<div class='col-sm-4'>
						<textarea id="cat_ket" class='form-control input-sm' name="cat_ket" placeholder="Description" form-groups='6'><?php echo @if_empty($cat->ket, '');?></textarea>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="options">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="is_active">Status</label>
					<div class='col-sm-4'>
						<select id='is_active' name='is_active' class='form-control input-sm'>
							<?php echo gen_option_html(Modules::run('api/_active/select'), @if_empty($cat->acc, 1), array());?>
						</select>
					</div>
				</div>
			</div>
		</div>
		
			<div class='button-set'>				
				<button type="submit" class="btn btn-success btn-sm">Save</button>
				<a href='<?php echo base_url().'admin/category/view';?>' class='btn btn-default btn-sm'>Cancel</a>
				<?php 
					$_id = @if_empty($cat->id, false);
					echo $_id ? "<a href='".base_url().'admin/category/hapus/'.$_id."' class='btn btn-link btn-cancel btn-sm pull-right'><i class='fa fa-trash-o'></i> Delete</a>":'';
				?>
			</div><!-- bottom form button group -->
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cat_uri').click(function(){ gen_title_to_uri('#cat_title', '#cat_uri'); });
		
		$('#editor-tab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		})
	});
</script>
