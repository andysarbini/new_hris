<img src="<?php echo base_url()."uploads/images/".$content->POST_FEATURE_IMAGE;?>" />
<br />
<div class="content">
<?php echo $content->POST_CONTENT; ?>
</div>

<div class="col-md-6">
	<div class="help-block">Ditulis oleh <span><?php echo $content->USR_NAME_INPUT;?></span> 
	dalam <span><?php echo $content->CAT_TITLE;?></span></div>
</div>

<div class="col-md-6 text-right rating"  content_id='<?php echo $content->POST_ID?>' user_id='<?php echo get_session('user_id');?>'>
</div>
