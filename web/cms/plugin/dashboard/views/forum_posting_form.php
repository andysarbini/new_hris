<?php if($this->session->flashdata('msg')): ?>
<div class="alert alert-success fade in">
    <?php echo $this->session->flashdata('msg'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('errmsg')): ?>
<div class="alert alert-danger fade in">
    <?php echo $this->session->flashdata('errmsg'); ?>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-8">
        <form action="<?php echo base_url(); ?>submit-posting-diskusi" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="uri" value="<?php if(@if_empty($uri)){ echo $uri; } ?>" />
        <input type="hidden" name="page" value="<?php if(@if_empty($page)){ echo $page; } ?>" />
        <input type="hidden" name="cat_param" value="<?php if(@if_empty($cat_param)){ echo $cat_param; } ?>" />
        
        <div class="form">
            <input type="hidden" name="POST_ID" value="<?php if(@if_empty($forum_info['POST_ID'])){ echo $forum_info['POST_ID']; } ?>"  />
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Judul <sup class="text-danger">*</sup></label>
                        <input type="text" name="POST_TITLE" maxlength="60" value="<?php if(@if_empty($forum_info['POST_TITLE'])){ echo $forum_info['POST_TITLE']; } ?>" class="form-control" required autofocus />
                        <div class="help-block">Maks. 60 karakter</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Keterangan Singkat <sup class="text-danger">*</sup></label>
                        <textarea class="form-control" name="POST_DESC" maxlength="100" required><?php if(@if_empty($forum_info['POST_DESC'])){ echo $forum_info['POST_DESC']; } ?></textarea>
                        <div class="help-block">Isikan keterangan singkat mengenai konten Anda. (Maks. 100 karakter)</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kategori</label>
                        <input type="text" class="form-control" value="<?php echo strtoupper($category_info['CAT_TITLE']); ?>" disabled>
                        <input type="hidden" name="POST_CATEGORY_ID" value="<?php if(@if_empty($category_info['CAT_ID'])){ echo $category_info['CAT_ID']; } ?>" />
                    </div>
                    <?php if((@if_empty($category_info['IS_CONTENT_TEXT'])) && $category_info['IS_CONTENT_TEXT'] == 1): ?>
                    <div class="form-group">
                        <label class="control-label">Konten</label>
                        <textarea name='POST_CONTENT' id='content' class='tinymce form-control'><?php if(@if_empty($forum_info['POST_CONTENT'])){ echo $forum_info['POST_CONTENT']; } ?></textarea>
                    </div>
                    <?php endif; ?>

                    <?php if(((@if_empty($category_info['IS_CONTENT_IMAGE'])) && $category_info['IS_CONTENT_IMAGE'] == 1) || 
                    ((@if_empty($category_info['IS_CONTENT_AUDIO'])) && $category_info['IS_CONTENT_AUDIO'] == 1) || 
                    ((@if_empty($category_info['IS_CONTENT_VIDEO'])) && $category_info['IS_CONTENT_VIDEO'] == 1) ):
                    ?>
                    <div class="form-group">
                        <label class="control-label">Upload Media</label>
                        <input type="hidden" name="IS_CONTENT_IMAGE" value="<?php if(@if_empty($category_info['IS_CONTENT_IMAGE'])){ echo $category_info['IS_CONTENT_IMAGE']; } ?>" />
                        <input type="hidden" name="IS_CONTENT_AUDIO" value="<?php if(@if_empty($category_info['IS_CONTENT_AUDIO'])){ echo $category_info['IS_CONTENT_AUDIO']; } ?>" />
                        <input type="hidden" name="IS_CONTENT_VIDEO" value="<?php if(@if_empty($category_info['IS_CONTENT_VIDEO'])){ echo $category_info['IS_CONTENT_VIDEO']; } ?>" />
                    
                        <input type="file" name="POST_UPLOAD_FILE" />
        
                        <div class="help-block">
                            <?php 
                                $output = "Ukuran maks. 30MB untuk berkas";
                                if((@if_empty($category_info['IS_CONTENT_IMAGE'])) && $category_info['IS_CONTENT_IMAGE'] == 1){
                                    $output .= " gambar (JPG, PNG, GIF) ";
                                }
                                if((@if_empty($category_info['IS_CONTENT_AUDIO'])) && $category_info['IS_CONTENT_AUDIO'] == 1){
                                    $output .= " audio (MP3, MP4, WAV) ";
                                }
                                if((@if_empty($category_info['IS_CONTENT_VIDEO'])) && $category_info['IS_CONTENT_VIDEO'] == 1){
                                    $output .= " video (MPG, MP4, MOV) ";
                                }
                                $output .= "";
                                echo $output;
                                ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <div class="form-group form-group-btn">
                <button type="submit" class="btn btn-default">Kirim</button>
                <a href="<?php echo base_url().$uri; ?>" class="btn btn-link">Kembali</a>
            </div>
        </div>
        </form>
    </div>
    <!--<div class="col-md-4">
        <h4 class="lead">Postingan Saya</h4>
        <div id="data_list"></div>
        <nav aria-label="navigation">
            <div id="pagination_link"></div>
        </nav>
    </div>-->

</div>


