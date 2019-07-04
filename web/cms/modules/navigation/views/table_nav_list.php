<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: navigation
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Title</th>
			<th>URI</th>
			<th>Content</th>
			<th class="text-center" width="20px">Sort</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<?php 
	if (count($tables)) {
	foreach ($tables as $t) { ?>
	<tr>
		<td><a href='#' onclick='load_form_nav_list(<?php echo $t['id'];?>,0)'><?php echo gen_child_tree($t['level']).$t['title'];?></a></td>
		<td><?php echo $t['uri'];?></td>
		<td><?php echo $t['content'];?></td>
		<td class='text-center'><?php echo $t['poss'];?></td>
		<td>
			<div class="dropdown pull-right">
				<a class="btn btn-xs btn-default" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-gear"></i> Config</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
					<li><a onclick='load_form_nav_list(<?php echo $t['id'];?>,0)'>Edit</a></li>
					<li><a onclick='load_form_nav_list(0,<?php echo $t['id'];?>)'>Add Sub Item</a></li>
				</ul>
			</div>
		</td>
	</tr>
	<?php };
	}
?>
