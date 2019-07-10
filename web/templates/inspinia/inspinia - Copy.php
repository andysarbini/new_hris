<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>BlueBird <?php echo @if_empty($title,'Hello'); ?></title>

	<link rel='stylesheet' type='text/css' href='<?php echo template_css(); ?>/template.css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
</head>
<body>
	<!-- SideNav -->
	<div id="sideNav" class="col-fixed">
		<?php echo Modules::run('navigation/generate_menu_array2', "dashboard-side-menu", 'sidebar2'); ?>
	</div>

	<div id="main">
		<div class="sidebar-close-btn">
			<a href="javascript:void(0)" onclick="closeNav()" id="closeBtn"><span>&times;</span></a>
		</div>
		<?php echo Modules::run('bluehrd_api/user/bluehrd_user_data'); ?>

		<section class="container-fluid container--navbar-fixed-top">
		
			<?php if(@if_empty($title)) { ?>

			<div class="page-header">
				<?php if(@if_empty($label) && ($label == "Forum")): ?>
				<div class="button-set pull-right">
				<a href="<?php echo base_url(); ?>birdbagi-forum/mypost" class="btn btn-default">POSTINGAN SAYA</a>
				<a data-toggle="modal" data-target="#modal_category_forum" class="btn btn-default">POSTING DISKUSI BARU</a>
				</div>
				<?php endif; ?>
				<?php if(@if_empty($label) && ($label == "BBLearning" || $label == "Gallery")): ?>
				<div class="button-set pull-right form-group col-lg-3" style="padding-right:0px;">
				<form>
				<input class="form-control" type="text" name="keywords" placeholder="Enter Kata Pencarian..." style="height:35px;" value="<?php if(@if_empty($original_keywords)){ echo $original_keywords; }?>" />
				</form>
				</div>
				<?php endif; ?>
				<h2><?php echo $title;?></h2>
				<?php if(@if_empty($description)): ?>
					<p class="lead"><?php echo $description;?></p>
				<?php endif ?>	
				<?php if(@if_empty($content)): ?>
				<div class="help-block">Ditulis oleh <a href=""><b><?php echo $content->USR_NAME_INPUT;?></b></a> pada DD-MM-YYYY dalam <span><?php echo "<a href='".base_url()."dashboard/categories/".$content->CAT_URI."'>".$content->CAT_TITLE."</a>";?></span></div>
				<?php endif; ?>
			</div>

			<mp:Breadcrumb />
						
			<?php } ?>

			<mp:Contentmain />

			<div class="footer">
				<ul class="list-inline">
					<li>Copyright &copy; 2018 PT Bluebird TBK</li>
					<li><a href="<?php echo base_url()."pages/tentang";?>">Tentang</a></li>
					<li><a href="<?php echo base_url()."pages/syarat-ketentuan";?>">Syarat & Ketentuan</a></li>
					<li><a href="<?php echo base_url()."pages/kebijakan";?>">Kebijakan</a></li>
					<li><a href="<?php echo base_url()."pages/bantuan";?>">Bantuan</a></li>
				</ul>
			</div>

		</section>
	</div>

	<script> function base_url() { return "<?php echo base_url();?>" }; </script>
	<script src="<?php echo template_js(); ?>/assets/jquery-3.1.0.min.js"></script>
	<script src="<?php echo template_js(); ?>/assets/jquery.lazyload.min.js"></script>
	<?php echo @if_empty($include_script,''); ?>
	<script src="<?php echo base_url()."cms/plugin/notification/js/num.js"; ?>"></script>
	
	<script src="<?php echo template_js(); ?>/assets/bootstrap.min.js"></script>
	<script src="<?php echo template_js(); ?>/assets/template.js"></script>
	
	<script>
		$(document).ready(function() {
			$('.tip').tooltip({container: 'body'});
			$('#modal_gallery').on('hidden.bs.modal', function (e) {
				$('.embed-responsive').find('video').attr('src', '');
			})
		});
	</script>
	
</body>
</html>
