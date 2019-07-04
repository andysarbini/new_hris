<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: navigation
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<ul class="nav navbar-nav">
	<!--
	<li>
		<a href="<?php echo base_url(); ?>admin/navigation">Menu</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>admin/user">User</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>admin/content">Content</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>admin/widget" onclick="return false">Theme</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>acl">ACL</a>
	</li>
	<!-- -->
	<li class="dropdown ">
	<!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Control Panel</a>
		<ul class="dropdown-menu">-->
			<?php if(count($menus)){ foreach($menus as $m){ ?>
				<li><?php echo "<a href='".gen_url_by_type($m['url'], $m['type_id'])."' title='".$m['uri']."'>".$m['title']."</a> "; ?></li>
			<?php } }?>
		<!--</ul>-->
	</li>
</ul>

<ul class="nav navbar-nav navbar-right">
	<li ><a href='<?php echo base_url(); ?>' target='_blank'><i class="fa fa-home"></i> View Site</a></li>
	<li><a href='<?php echo base_url();?>logout'>Logout <i class="fa fa-sign-out"></i></a></li>
</ul>

<p class="navbar-text navbar-right hidden">
	<b>STATUS:</b> <span class="label label-success">Updated</span> 20-11-2014 (2.5)
</p>

