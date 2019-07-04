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
	<h1>
		 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Group
		<div class="pull-right"><a class="btn btn-lg btn-link btn-green" href='<?php echo base_url().'admin/group/add'?>'><span class="">New Group</span> <i class='fa fa-plus-circle fa-fw'></i> </a></div>
	</h1>
	
</div>

<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked menu-list">
			<li>
				<a class="font-2x" href='<?php echo base_url().'admin/user'?>'>User</a>
			</li>
			<li class="active">
				<a class="font-2x" href='<?php echo base_url().'admin/group'?>'>Group</a>
			</li>
			<li>
				<a class="font-2x" style='display:none' href='<?php echo base_url().'admin/contact'?>'>Contact</a>
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
				<tbody id='tbody-list-widget'>
					<?php 
					if (count($group)) {
						foreach ($group as $t) { ?><tr id='tr_<?php echo $t->id;?>'>
						<td><a href="<?php echo base_url().'admin/group/edit/'.$t->id;?>"><?php echo $t->name;?></a></td>
						<td class="text-center"><?php echo Modules::run('api/_active/title', $t->acc);?></td>
						<td><small><?php echo $t->ket;?></small></td>
						<td>
							<a class="btn btn-default btn-xs pull-right" href="<?php echo base_url().'admin/group/edit/'.$t->id;?>"><i class="fa fa-edit"></i> Edit</a>
						</td>
					</tr>
						<?php };
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
