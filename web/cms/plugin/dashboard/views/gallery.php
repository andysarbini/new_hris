<div id="keywords" data-value="<?php if(@if_empty($original_keywords)){ echo $original_keywords; }?>"></div>
<div class="page-header page-subheader">
<div class="pull-right">
<div class="form-inline">
<label class="control-label">Filter berdasarkan</label>
<div class="input-group">
    <select id='category_selection_file' name='category_selection_file' class='form-control'>
    <option value="all" selected>- Silakan pilih -</option>
    <?php echo gen_option_html($obj_category,""); ?>
    </select>
</div>
</div>
</div>
<h4><i class="fas fa-images fa-fw fa-lg"></i> Foto</h4>
</div>
<div class="clearfix"></div>

<div id="gallery_files" class="flexgrid">
<!-- Load Content Data -->
</div>
<nav id="paging_files" aria-label="navigation">
<!-- Load Content Paging -->
</nav>

<hr>

<div class="page-header page-subheader">
<div class="pull-right">
<div class="form-inline">
<label class="control-label">Filter berdasarkan</label>
<div class="input-group">
    <select id='category_selection_video' name='category_selection_video' class='form-control'>
    <option value="all" selected>- Silakan pilih -</option>
    <?php echo gen_option_html($obj_category,""); ?>
    </select>
</div>
</div>
</div>
<h4><i class="far fa-file-video fa-fw fa-lg"></i> Video</h4>
</div>
<div class="clearfix"></div>

<div id="gallery_videos" class="flexgrid">
<!-- Ajax Load Data -->
</div>
<nav id="paging_videos" aria-label="navigation">
<!-- Ajax Load Paging -->
</nav>