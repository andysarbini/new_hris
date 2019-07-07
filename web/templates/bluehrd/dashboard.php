<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>BlueBird - <?php echo if_empty($title,'Hello'); ?></title>
	
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
			
			<?php echo Modules::run("gallery/view","slider-homepage", "bb_dashboard_slide");?>

			<div class="row">
				<!-- Left Content -->
				<div class="col-md-8">
					<?php if(!empty($featured)): ?>
					<!-- Featured Article -->
					<div class="featured-article bg-dark">
						<div id="carousel_panel" class="carousel slide in" data-ride="carousel" data-interval="6500">
							<ol class="carousel-indicators">
								<?php foreach( $featured as $var=>$v ):  ?>
								<?php 
								$active ='';
								if($var == 0){
									$active = 'active';
								} 
								?>
								<li data-target="#carousel_panel" data-slide-to="<?php echo $var; ?>" class="<?php echo $active; ?>">
								</li>
								<?php endforeach; ?>
							</ol>
							
							<div class="carousel-inner" role="listbox">
								<!-- News -->
								<?php foreach( $featured as $var=>$v ):  ?>
								<?php 
								$active ='';
								if($var == 0){
									$active = 'active';
								} 
								?>
								<div class="item <?php echo $active; ?>">
									<div class="media">
										<div class="media-left" style="padding-top:10px;">
											<a href="<?php echo base_url()."news/".$v->cat_uri."/".$v->post_id;?>">
												<img class="media-object thumbnail" src="<?php echo base_url()."uploads/images/".$v->post_feature_image; ?>" alt="" height="180">
											</a>
										</div>
										<div class="media-body">
											<p><span class="flag label label-info">Featured Article</span></p>
											<h4 class="media-heading">
											<a href="<?php echo base_url()."news/".$v->cat_uri."/".$v->post_id;?>">
											<?php echo $v->post_title;?></a>
											</h4>
											<p><?php echo substr($v->post_description, 0, 120);?> ... </p>
											<div class="row hidden">
											<div class="col-md-8 col-sm-8">
											<div class="help-block">Ditulis oleh <span><a href="#"><?php echo $v->usr_name_input;?></a></span> 
											dalam <span><a href="#"><?php echo $v->cat_title;?></a></span>
											</div>
											</div>
											<div class="col-md-4 col-sm-4 text-right">
											<div class="help-block">
											<ul class="list-inline">
											<li><span class="far fa-heart fa-fw"></span> 16</li>
											<li><span class="far fa-comment fa-fw"></span> 2</li>
											<li><span class="far fa-eye fa-fw"></span> 1.5k</li>
											</ul>
											</div>
											</div>
											</div>
										</div>
									</div>	
								</div>
								<?php endforeach; ?>
							</div>
							
							<?php if(count($featured) > 0): ?>
							<!-- Controls -->
							<a class="left carousel-control" href="#carousel_panel" role="button" data-slide="prev">
								<span class="fas fa-angle-left fa-2x" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#carousel_panel" role="button" data-slide="next">
								<span class="fas fa-angle-right fa-2x" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
							<?php endif;?>
						</div>
					</div>
					<?php endif; ?>

					<!-- Panel Newsfeed -->
					<div class="panel panel-default panel-newsfeed">
						<div class="panel-heading"><h4>Newsfeed</h4></div>
						<div class="panel-body" id="article_list"><!-- Ajax Content Load --></div>
						<div class="panel-footer">
							<div class="btn-actions pull-right"><a class="btn btn-link btn-sm" href="<?php echo base_url(); ?>news">LIHAT SEMUA</a></div>
							<nav aria-label="Page navigation" id="pagination_link"><!-- Ajax Pagination Load --></nav>
						</div>
					</div>

					<!-- Panel Forum -->
					<?php if($toptri_forum_post_list): ?>
					<div class="page-header"><h3><span class="far fa-comments fa-fw fa-lg text-danger" aria-hidden="true"></span> BIRDBAGI FORUM</h3></div>
					<div class="row">
						<?php if($toptri_forum_post_list): ?>
						<div class="col-md-8">
							<div class="panel panel-default">
							<?php foreach($toptri_forum_post_list as $k => $v): ?>
								<?php
								$is_already_rated = check_is_already_rated($v->POST_ID, get_session('user_id'), 'forum', 'love');
								$is_already_comment = check_is_already_rated($v->POST_ID, get_session('user_id'), 'forum', 'comment');
								?>
								<?php $post_date = date("d-m-Y H:i",strtotime($v->POST_CREATED)); ?>
								<?php $url_link = base_url()."birdbagi-forum/".$v->CAT_URI."/".$v->POST_URI."/".$v->POST_ID; ?>
								<div class="panel-body"s>
								<h4><a href="<?php echo $url_link; ?>"><?php echo $v->POST_TITLE; ?></a></h4>
								<p><?php echo $v->POST_DESC; ?></p>
								<div class="row">
									<div class="col-md-8 col-sm-8">
										<?php $url_link_user = base_url()."profile/view/".$v->usr_id; ?>
										<div class="help-block">Oleh <a href="<?php echo $url_link_user; ?>"><b><?php echo $v->nama_lengkap; ?></b></a> pada <?php echo $post_date; ?> </a></div>
									</div>
									<div class="col-md-4 col-sm-4 text-right">
										<div class="help-block">
											<ul class="list-inline">
												<li>
												<?php if($is_already_rated): ?>
												<span class="far fa-heart text-danger fa-fw"></span>
												<?php else: ?>
												<a class="rating_love_forum" forum_id="<?php echo $v->POST_ID; ?>" user_id="<?php echo get_session('user_id'); ?>" size="medium">
												<span class="far fa-heart fa-fw"></span>
												</a>
												<?php endif; ?>
												<?php echo @if_empty($v->love, 0); ?>
												</li>
												<li>
												<?php if($is_already_comment): ?>
												<a href="<?php echo $url_link; ?>#form_comment">
												<span class="far fa-comment text-info fa-fw"></span>
												</a>
												<?php else: ?>
												<a href="<?php echo $url_link; ?>#form_comment">
												<span class="far fa-comment fa-fw"></span>
												</a>
												<?php endif; ?>
												<?php echo @if_empty($v->comment, 0); ?>
												</li>
												<li><span class="far fa-eye fa-fw" aria-hidden="true"></span>&nbsp;
												<?php echo @if_empty($v->view, 0); ?>
												</li>
											</ul>
										</div>
									</div>
								</div>
								</div>
							<?php endforeach; ?>
							</div>
						</div>
						<?php endif; ?>

						<?php if($forum_categories): ?>
						<div class="col-md-4">
							<ul class="list-inline list-cloud">
							<?php foreach($forum_categories as$k => $v): ?>
							<?php $url_link = base_url()."birdbagi-forum/".$v->CAT_URI; ?>
							<li><a href="<?php echo $url_link; ?>"><?php echo $v->CAT_TITLE; ?></a></li>
							<?php endforeach; ?>
							</ul>
						</div>
						<?php endif;?>
						
					</div>
					<?php endif; ?>
				</div>
				
				<!-- Sidebar -->
				<div class="col-md-4">
					<div class="panel panel-box panel-danger">
						<div class="panel-heading">
							<a href="<?php echo base_url()."dashboard/birthday";?>">
								<h4>PEMBERITAHUAN</h4>
								<h2>Ulang Tahun Karyawan</h2>
								<p><b>Yang berulang tahun hari ini</b></p>
								
								<ul class="list-inline list-condensed">
								<?php
									foreach($birthdays as $var=>$v){
										$_p = array(
											"nip"=>$v->nip,
											"id"=>$v->usr_id,
											"pic"=>$v->profile_picture,
											"nama"=>$v->nama_lengkap
										);
										echo $this->load->view("cuti/user_detail",$_p,true);
									}
								?>
								</ul>
							</a>
						</div>
						<div class="panel-footer text-right">
							<a href="<?php echo base_url()."dashboard/birthday";?>">Lihat Semua<span class="fas fa-chevron-right fa-fw" aria-hidden="true"></span></a>
						</div>
					</div>
					<div class="panel panel-box panel-warning">
						<div class="panel-heading">
							<a href="<?php echo base_url()."informasi";?>">
								<h4>PUSAT INFORMASI KARYAWAN</h4>
								<h2>Unduh Formulir</h2>
								<p><b>Pusat informasi karyawan serta pengunduhan.</b></p>
							</a>
						</div>
						<div class="panel-footer text-right">
							<a href="<?php echo base_url()."informasi";?>">Lihat Semua<span class="fas fa-chevron-right fa-fw" aria-hidden="true"></span></a>
						</div>
					</div>
					<div class="panel panel-box panel-success">
						<div class="panel-heading">
							<a href="<?php echo base_url()."bblearning";?>">
								<h4>LIMITLESS LEARNING</h4>
								<h2>Unduh Materi</h2>
								<p><b>Download berbagai materi gambar, video, dan lainnya.</b></p>
							</a>
						</div>
						<div class="panel-footer text-right">
							<a href="<?php echo base_url()."bblearning";?>">Lihat Semua<span class="fas fa-chevron-right fa-fw" aria-hidden="true"></span></a>
						</div>
					</div>
					<div class="panel panel-box panel-primary">
						<div class="panel-heading">
							<a href="<?php echo base_url()."qa";?>">
								<h4>BANTUAN</h4>
								<h2>Formulir Keluhan</h2>
								<p><b>Dapatkan bantuan jika ada hal yang ingin ditanyakan.</b></p>
							</a>
						</div>
						<div class="panel-footer text-right">
							<a href="<?php echo base_url()."qa";?>">Isi Formulir<span class="fas fa-chevron-right fa-fw" aria-hidden="true"></span></a>
						</div>
					</div>

					<!-- Panel Gallery -->
					<div class="panel panel-info">
						<div class="panel-heading"><h4>GALERI</h4></div>
						<div class="rgallery">
							<?php foreach( $gallery as $var=>$v ): ?>
							<?php if($var < 4):?>
							<?php
							$_url_link = base_url()."gallery/".$v->GALL_URI;
							?>
							<div class="card">
								<div class="media">
									<div class="media-top">
										<a href="<?php echo $_url_link?>">
											<img class="lazy img-responsive" data-original="<?php echo get_image_gallery_path($v->GALL_ID); ?>" alt="image">
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading" style="margin-bottom:0px;">
											<a href="<?php echo $_url_link?>"><?php echo substr($v->GALL_NAME, 0, 250);?></a>
										</h4>
										<div class="help-block" style="margin-bottom:10px;margin-top:0px;">
											Update terakhir pada 
											<span>
												<?php 
												if($v->GALL_UPDATE_DATE != "0000-00-00 00:00:00"){
													echo date("d-m-Y H:i", strtotime($v->GALL_UPDATE_DATE)); 
												}else{
													echo date("d-m-Y H:i", strtotime($v->GALL_CREATE_DATE)); 
												}
												?>
											</span>
										</div>
									</div>
								</div>
							</div>
							<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		
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
