<!-- Category FILE: Judul dan Filter -->
<div id="keywords" data-value="<?php if(@if_empty($original_keywords)){ echo $original_keywords; }?>"></div>
<div class="page-header page-subheader">
	<h4 class="sr-only"><i class="far fa-copy fa-fw fa-lg"></i> Files</h4>
	<div class="form-inline">
		<label class="control-label" for="category_selection_file">Filter berdasarkan</label>
		<div class="form-group">
			<select id='category_selection_file' name='' class='form-control'>
				<option value="all" selected>- Silakan pilih -</option>
				<?php echo gen_option_html($obj_category,""); ?>
			</select>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- Category FILE: per 5 item -->
<div id="bblearning_files" class="flexgrid">
    <!-- Ajax Load Content -->
</div>
<nav aria-label="navigation" id="paging_files">
    <!-- Ajax Load Paging -->
</nav>

<hr>
<!-- Category VIDEO: Judul dan Filter -->
<div class="page-header page-subheader">
	<h4 class="sr-only"><i class="far fa-file-video fa-fw fa-lg"></i> Videos</h4>
	<div class="form-inline">
		<label class="control-label" for="category_selection_video">Filter berdasarkan</label>
		<div class="form-group">
			<select id='category_selection_video' class='form-control'>
			<option value="all" selected>- Silakan pilih -</option>
			<?php echo gen_option_html($obj_category,""); ?>
			</select>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- Category VIDEO: per 5 item -->
<div id="bblearning_videos" class="flexgrid">
    <!-- Ajax Load Content -->
</div>
<nav aria-label="navigation" id="paging_videos">
    <!-- Ajax Load Paging -->
</nav>