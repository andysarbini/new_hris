<div class="row">
	<div class="col-md-8 col-sm-10">
		<!-- Featured image -->
		<?php if(@if_empty($content->POST_FEATURE_IMAGE)) { ?>
						
		<div class="panel panel-none">
			<img src="<?php echo base_url()."uploads/images/".$content->POST_FEATURE_IMAGE;?>"  width="100%" />
		</div>

		<?php } ?>
		<div class="panel panel-none">
			<div class="text-center text-muted">
				<h3><span class="fab fa-audible"></span></h3>
				<p>Ditulis oleh <b><?php echo $content->USR_NAME_INPUT;?></b> dalam <b><?php echo $content->CAT_TITLE;?></b></p>
			</div>
            <hr class="hoz">
			<div class="article-body">
				
				<?php echo $content->POST_CONTENT; ?>

				<!-- Likes Comments Impressions -->
				<!--<div class="rating" content_id='<?php //echo $content->POST_ID?>' user_id='<?php //echo get_session('user_id');?>'></div>-->
                <div class="help-block">
                    <ul class="list-inline text-right">
                    <?php
                    $is_already_rated = check_is_already_rated($content->POST_ID, get_session('user_id'), 'content', 'love');
                    $is_already_comment = check_is_already_rated($content->POST_ID, get_session('user_id'), 'content', 'comment');
                    ?>
                    <li>
                    <?php if($is_already_rated): ?>
                    <span class="far fa-heart text-danger fa-fw"></span>
                    <?php else: ?>
                    <a class="rating_love" content_id="<?php echo $content->POST_ID; ?>" user_id="<?php echo get_session('user_id'); ?>" size="large">
                    <span class="far fa-heart fa-fw"></span>
                    </a>
                    <?php endif; ?>
                    <?php echo $content->love; ?>
                    </li>
                    <li>
                    <?php if($is_already_comment): ?>
                    <a href="#form_comment">
                    <span class="far fa-comment text-info fa-fw"></span>
                    </a>
                    <?php else: ?>
                    <a href="#form_comment">
                    <span class="far fa-comment fa-fw"></span>
                    </a>
                    <?php endif; ?>
                    <?php echo $content->comment; ?>
                    </li>
                    <li>
                    <span class="far fa-eye fa-fw"></span>
                    <?php echo $content->view; ?>
                    </li>
                    </ul>
                </div>
			</div>
			
            <?php echo Modules::run("rating/comment", $content->POST_ID, 1);?>

		</div>
	</div>
    <div class="col-md-4">
        <?php if($data_list_artikel): ?>
        <h4 class="lead">Berita dan Artikel Lainnya</span></h4>
        <ul>
            <?php foreach($data_list_artikel as $k => $v): ?>
            <?php $link = base_url()."news/".$v->CAT_URI."/".$v->POST_ID; ?>
            <li><a href="<?php echo $link; ?>"><b><?php echo $v->POST_TITLE; ?></b></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>



