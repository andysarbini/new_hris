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
		<small>&mdash; Content Module</small>
		<div class="pull-right"><a class="btn btn-lg btn-link btn-green" href='<?php echo base_url().'admin/content/add'?>'><span class="">New Content</span> <i class='fa fa-plus-circle fa-fw'></i> </a></div>
	</h2>
</div>

<div class="row">
	<div class="col-sm-2">
		<div class="form">
			<div class="form-group">
				<label class="control-label sr-only">Filter</label>
				<div class="input-group input-group-sm">
					<form method="get">
						<select id='id_category' name='id_category' class='form-control'>
							<?php echo gen_option_html($category_option, $id_category,array('id'=>0,'title'=>'All Categories'));?>
						</select>
						<div class="input-group-btn">
							<input type="submit" class="btn btn-default" name="submit" type="button" value="Search">
						</div>
					</form>
				</div>
			</div>
		</div><!-- /filter -->
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
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="33%">Title</th>
						<th width="8%" class="text-center">Featured</th>
						<th width="8%" class="text-center">Status</th>
						<th>Category</th>
						<th width="20%">URI</th>
						<th width="11%">Created</th>
						<!--<th>Group</th>-->
						<!--th>Published</th-->
						<!--<th>Group</th>-->
						<th width="11%">Modified</th>
						<th colspan="2"></th>
					</tr>
				</thead>
				<tbody>
					<?php if($ada = count($contents)){ foreach($contents as $d){ ?>

					<tr>
						<td width="33%"><a href='<?php echo base_url().'admin/content/edit/'.$d->id;?>'><?php echo $d->title;?></a></td>
						<td class="text-center"><?php if($d->mainpage) {?> <i class="fa fa-star fa-fw orange tip" data-toggle="tooltip" data-placement="top" title="Featured Item"></i><?php } ?></td>
						<td class="text-center"><?php echo $d->active ? '<i class="fa fa-check-circle green"></i>' : '<i class="fa fa-times-circle"></i>';?></td>
						<td><?php echo $d->category_title; ?></td>
						<td><small><?php echo $d->uri;?></small></td>
						<td><small><a class="tip" data-toggle="tooltip" data-placement="top" title="Created by: <?php echo $d->input_name;?>"><?php echo $d->input_name;?></a></small></td>
						<!--<td><?php echo $d->input_group;?></td>-->
						<!--td><?php echo $d->input_date;?></td-->
						<!--<td><?php echo $d->update_group;?></td>-->
						<td><small><a class="tip" data-toggle="tooltip" data-placement="top" title="Modified: <?php echo $d->update_date;?>"><?php echo $d->update_date;?></a></small></td>
						<td><small><a class="tip" data-toggle="tooltip" data-placement="top" title="Last Modified by: <?php echo $d->update_name;?>"><?php echo $d->update_name;?></a></small></td>	
						<td><a class='btn btn-default btn-xs pull-right' href='<?php echo base_url().'admin/content/edit/'.$d->id;?>'><i class='fa fa-edit'></i> Edit</a></td>
					</tr>

					<?php } } ?>
				</tbody>
		</table>
		</div>

		<?php if($ada) { ?><div class="text-right"><ul class="pagination pagination-sm"><?php echo $paging; ?></ul></div><?php } ?>

	</div>
</div>

<script>
	$(document).ready(function(){
		$('#btn-category').click(function(){ window.location.href = "<?php echo base_url().'admin/content/?id_category=';?>"+$('#id_category').val(); });
	});
</script>
