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
		<small>&mdash; Category Module</small>
		<div class="pull-right"><a class="btn btn-lg btn-link btn-green" href='<?php echo base_url().'admin/category/add';?>'><span class="">New Category</span> <i class='fa fa-plus-circle fa-fw'></i> </a></div>
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
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="33%">Title</th>
						<th width="8%" class="text-center">Status</th>
						<th>Description</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($contents)){ foreach($contents as $d){ ?>
					<tr>
						<td><a href='<?php echo base_url().'admin/category/edit/'.$d->id;?>'><?php echo $d->title;?></a></td>
						<td class="text-center"><?php echo Modules::run('api/_active/title', $d->acc);?></td>
						<td><small><?php echo $d->ket;?></small></td>
						<td class="text-right"><a class="btn btn-default btn-xs" href='<?php echo base_url().'admin/category/edit/'.$d->id;?>'><i class='fa fa-edit'></i> Edit</a></td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
