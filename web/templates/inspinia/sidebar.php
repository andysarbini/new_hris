<?php 
$_fa = array(
		"fa fa-calendar",
		"fa fa-money",
		"fa fa-rocket",
		"fa fa-id-badge", 
		"fa fa-pie-chart", 
		"fa fa-picture-o", 
		"fa fa-star", 
		"fa fa-database", 
		"fa fa-sitemap",
		"fa fa-pie-chart"
	);
$_c = 0;
foreach($menus as $var=>$v):
	if($_c >= count($_fa)) $_c = 0;
	$string = $v['title']; 
	$convert_last_url = preg_replace('/[^A-Za-z0-9\-&_]/',' ', $string);
	$convert_last_url = str_replace(' ', '-', $convert_last_url); 
	$convert_last_url = strtolower($convert_last_url);
	$_url = '<i class="'.$_fa[$_c++].'"></i> <span class="nav-label">'.$v['title'].'</span> ';
?>
<li>
	<?php if(isset($v['childs_1'])): ?>
		<a href="<?php echo gen_url_by_type_nav($v, $v["type_id"]);?>"><?php echo $_url.'<span class="fa arrow"></span>';?></a>
		<ul class="nav nav-second-level collapse">
	<?php else: ?>
		<a href="<?php echo gen_url_by_type_nav($v, $v["type_id"]);?>"><?php echo $_url;?></a>
	<?php endif; ?>
		
	<?php if(isset($v["childs_1"]) && count($v["childs_1"]) > 0): ?>
		<?php $temp_parent_id = $v['id']; ?>
		<?php foreach($v["childs_1"] as $cvar=>$c): ?>
			<?php if(isset($c["childs_2"]) && count($c["childs_2"]) > 0): ?>
				<?php foreach($c["childs_2"] as $cvar2=>$c2): ?>
					<li><a href="<?php echo gen_url_by_type_nav($c, $c["type_id"]);?>"><?php echo $_i.' '.$c["title"].$_j;?></a></li>
				<?php endforeach;?>
			<?php else: ?>
				<li><a href="<?php echo gen_url_by_type_nav($c, $c["type_id"]);?>"><?php echo $_i.' '.$c["title"].$_j;?></a></li>
			<?php endif; ?>			
		<?php endforeach;?>
	<?php endif; ?>

	<?php if(isset($v['childs_1'])): ?>
			</ul> 
	<?php endif; ?>
	
	</li>
<?php endforeach; ?>