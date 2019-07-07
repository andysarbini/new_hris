<div class="row">
	<div class="col-md-8">
		<div class="panel panel-none">
			<div class="media article-body">
                <?php if(@if_empty($content->POST_FILE_TYPE)): ?>
                    <?php if($content->POST_FILE_TYPE == "video"): ?>
                        <?php if($content->POST_FILE_EXTENSION == "mp4"):?>
                        <video width="320" height="240" controls>
                        <source src="<?php echo base_url()."uploads/images/".$content->POST_FEATURE_IMAGE;?>" type="video/mp4">
                        Your browser does not support the video tag.
                        </video> 
                        <?php elseif($content->POST_FILE_EXTENSION == "flv"):?>
                        <video width="320" height="240" controls>
                        <source src="<?php echo base_url()."uploads/images/".$content->POST_FEATURE_IMAGE;?>" type="video/x-flv">
                        Your browser does not support the video tag.
                        </video>
                        <?php else: ?>
							<?php if(@if_empty($content->POST_FILE_EXTENSION)): ?>
							<embed src="<?php echo base_url()."uploads/images/".$content->POST_FEATURE_IMAGE;?>" autostart="false" height="240" width="320" />
							<?php endif; ?>
						<?php endif; ?>
                    <?php endif; ?>
                    <?php if($content->POST_FILE_TYPE == "file"): ?>
						<?php if($content->POST_FILE_EXTENSION == "pdf"):?>
						<embed src="<?php echo base_url()."uploads/images/".$content->POST_FEATURE_IMAGE;?>" width="600" height="400">
						<?php else: ?>
							<?php if(@if_empty($content->POST_FILE_EXTENSION)): ?>
							<object src="<?php echo base_url()."uploads/images/".$content->POST_FEATURE_IMAGE;?>"><embed src="<?php echo base_url()."uploads/images/".$content->POST_FEATURE_IMAGE;?>" width="600" height="400"></embed></object>
							<?php endif; ?>
						<?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
				<div class="content">
					<?php echo $content->POST_CONTENT; ?>
				</div>

				<!-- Likes Comments Impressions -->
				<div class="row hidden">
					<div class="col-md-push-7 col-sm-push-5 col-md-5 col-sm-5 text-right">
						<div class="rating" content_id='<?php echo $content->POST_ID?>' user_id='<?php echo get_session('user_id');?>'></div>
					</div>
				</div>
				
				<div class="hidden">
					<div class="help-block">Ditulis oleh <span><?php echo $content->USR_NAME_INPUT;?></a></span> dalam <span><?php echo "<a href='".base_url()."dashboard/categories/".$content->CAT_URI."'>".$content->CAT_TITLE."</a>".$content->CAT_TITLE;?></span></div>
				</div>
			</div>
		</div>
	</div>

	<!-- Sidebar -->
	<!--<div class="col-md-4"></div>-->
	
</div>


<?php //echo Modules::run("rating/comment", $content->POST_ID, 1);?>
