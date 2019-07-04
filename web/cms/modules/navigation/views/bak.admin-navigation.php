
<ul class="nav navbar-nav">
	<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Control Panel</a>
		
			<?php if(count($menus)){ 
				
	session_start();
	$_SESSION['counter']=0;
	echo draw_menu($menus, 0, array('ul' => '<ul class="dropdown-menu">', 'ul_2'=>'<ul>'));
	$_SESSION['counter']=0;
			 }?>
		
	</li>
</ul>

<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle profile-name" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo get_session('name'); ?> <b class="caret"></b></a>
		
		<ul class="dropdown-menu">
			<li><a href='<?php echo base_url(); ?>' target='_blank'>View Site</a></li>
			<li><a href='<?php echo base_url();?>logout'>Logout</a></li>
		</ul>
		
	</li>
</ul>

