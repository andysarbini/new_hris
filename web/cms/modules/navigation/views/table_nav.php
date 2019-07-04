<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: navigation
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<table class='table table-striped table-hover'>

	<thead>
		<tr>
			<th width="25%">Title</th>
			<th width="25%">URI</th>
			<th>Group</th>
			<th width="34%">&nbsp;</th>
		</tr>
	</thead>

	<?php
	if (@count($tables)) {
		foreach ($tables as $t) { ?>
		<tr id='<?php echo 'nav'. $t->id;?>'>
			<td><a data-toggle="modal" href="#modals" onclick='navlist(<?php echo $t->id.','.$t->group_id;?>);'><?php echo $t->title;?></a></td>
			<td><?php echo $t->uri;?></td>
			<td><?php echo $t->group_name;?></td>
			<td>
				<div class="dropdown pull-right">
					<a class="btn btn-xs btn-default" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-gear"></i></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
						<li><a data-toggle="modal" href="#modals" class="" onclick='navlist(<?php echo $t->id.','.$t->group_id;?>);'>View</a></li>
						<li><a class='' onclick='load_form_nav(<?php echo $t->id;?>);'>Edit</a></li>
						<li class="divider"></li>
						<li><a class='btn-cancel' onclick='hapus_nav(<?php echo $t->id;?>);'><i class="fa fa-trash-o"></i> Delete</a></li>
					</ul>
				</div>
			</td>
		</tr>
		<?php };
	}

