<?php //dump($bbl);
/*
Dump => array(1) {
  [0] => object(stdClass)#23 (9) {
    ["post_id"] => string(2) "99"
    ["post_title"] => string(26) "Cheerson CX-30 User manual"
    ["post_uri"] => string(26) "cheerson-cx-30-user-manual"
    ["post_title_short"] => string(0) ""
    ["post_feature_image"] => string(0) ""
    ["post_description"] => string(22) "bb learning content 01"
    ["usr_name_input"] => string(5) "admin"
    ["post_input_date"] => string(19) "2018-04-10 09:53:22"
    ["cat_title"] => string(11) "BB Learning"
  }
}
/**/


?>

<div class="panel panel-default">
		<div class="panel-heading">
			<h4><span class="fa fa-bullhorn fa-lg text-info"></span> <?php echo $title;?></h4>
		</div>

		<div class="panel-body">
			<?php foreach( $categories	 as $var=>$v ){ 
				$_url_news = base_url()."view/".$v->post_id;
				?>
			<!-- Newsfeed loads per 4 items -->
			<div class="media">
				<div class="media-left">
					<a href="<?php echo $_url_news;?>">
					<img class="media-object thumbnail" src="<?php echo base_url()."uploads/images/".$v->post_feature_image; ?>" alt="" width="150">
					</a>
				</div>
				<div class="media-body">
					<div class="help-block"><?php echo bluehrd_tgl($v->post_input_date);?></div>
					<h4 class="media-heading"><a href="<?php echo $_url_news;?>"><?php echo $v->post_title;?></a></h4>
					<p><?php echo $v->post_description;?> ... </p>
					<div class="row">
						<div class="col-md-6">
							<div class="help-block">Ditulis oleh <span><a href="#"><?php echo $v->usr_name_input;?></a></span> dalam <span><a href="<?php echo base_url()."category/".$v->cat_uri;?>"><?php echo $v->cat_title;?></a></span></div>
						</div>
						<div class="col-md-6 text-right rating"  content_id='<?php echo $v->post_id?>' user_id='<?php echo get_session('user_id');?>'>
							
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>

	</div>
</div>
