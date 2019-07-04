<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: user
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="page-header">
	<h1>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;User
		<div class="pull-right"><a class="btn btn-lg btn-link btn-green" href='<?php echo base_url().'admin/user/add';?>'><span class="">New User</span> <i class='fa fa-plus-circle fa-fw'></i> </a></div>
	</h1>
</div>

<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked menu-list">
			<li class="active">
				<a class="font-2x" href='<?php echo base_url().'admin/user'?>'>User</a>
			</li>
			<li>
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
						<th width="33%">User</th>
						<th width="8%" class="text-center">Status</th>
						<th>Email</th>
						<th>Group</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<?php if(count($user)){ foreach($user as $d){ ?>

					<tr>
						<td><a href='<?php echo base_url().'admin/user/edit/'.$d->id;?>'><?php echo $d->nama;?></a></td>
						<td class="text-center"><?php echo $d->acc ? '<i class="fa fa-check-circle green"></i>':'<i class="fa fa-times-circle"></i>';?> </td>
						<td><small><?php echo $d->email;?></small></td>
						<td><small><?php echo $d->group_name;?></small></td>
						<td>
							<a class='btn btn-default btn-xs pull-right' href='<?php echo base_url().'admin/user/edit/'.$d->id;?>'><i class="fa fa-edit"></i> Edit</a>
						</td>
					</tr>

				<?php } } ?>
			</table>
		</div>
	</div>
</div>
