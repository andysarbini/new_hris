<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php $url_link = base_url()."birdbagi-forum/".$forum_detail->CAT_URI; ?>
                <?php $url_link_user = base_url()."profile/view/".$forum_detail->usr_id; ?>
                <div class="help-block">
                    <p><a href="<?php echo $url_link_user; ?>">
                    <b><?php echo $forum_detail->nama_lengkap; ?></b></a> menulis pada <?php echo date("d-m-Y H:i", strtotime($forum_detail->POST_CREATED)); ?> <span class="hidden">dalam <a href="<?php echo $url_link; ?>"><b><?php echo $forum_detail->CAT_TITLE; ?></b></a></span></p>
                </div>
                <h3><?php echo $forum_detail->POST_TITLE; ?></h3>
                <p><?php echo $forum_detail->POST_DESC; ?></p>
                <hr>
                <div class="article-body">
                    <p>
                        <?php if(@if_empty($forum_detail->POST_CONTENT)){ echo $forum_detail->POST_CONTENT; }; ?>
                    
                        <?php if(@if_empty($forum_detail->POST_UPLOAD_FILE)): ?>
                            <?php $url_file= base_url()."uploads/forum/".$forum_detail->POST_UPLOAD_FILE; ?>
                            <?php if(strpos($forum_detail->POST_FILE_TYPE, 'image') !== FALSE ): ?>
                            <img class="lazy img-responsive" src="<?php echo $url_file; ?>" data-original="<?php echo $url_file; ?>" />
                            <?php endif; ?>
                            <?php if(strpos($forum_detail->POST_FILE_TYPE, 'video') !== FALSE ): ?>
                            <embed src="<?php echo $url_file;?>" width="600" height="400" autostart="0">
                            <?php endif; ?>
                            <?php if(strpos($forum_detail->POST_FILE_TYPE, 'audio') !== FALSE ): ?>
                            <embed src="<?php echo $url_file;?>" width="300" height="50" autostart="0">
                            <?php endif; ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="panel-footer">
                <div class="help-block">
                    <ul class="list-inline text-right">
                        <?php
                        $is_already_rated = check_is_already_rated($forum_detail->POST_ID, get_session('user_id'), 'forum', 'love');
                        $is_already_comment = check_is_already_rated($forum_detail->POST_ID, get_session('user_id'), 'forum', 'comment');
						?>
                        <li>
                        <?php if($is_already_rated): ?>
                        <span class="far fa-heart text-danger fa-fw"></span>
                        <?php else: ?>
                        <a class="rating_love_forum" forum_id="<?php echo $forum_detail->POST_ID; ?>" user_id="<?php echo get_session('user_id'); ?>" size="large">
                        <span class="far fa-heart fa-fw"></span>
                        </a>
                        <?php endif; ?>
                        <?php //echo $forum_detail->love; ?>
                        <span id='li-f-love'></span>
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
                        <span id='li-f-comment'></span>
                        <?php //echo $forum_detail->comment; ?>
                        </li>
                        <li>
                        <span class="far fa-eye fa-fw"></span>
                        <?php //echo $forum_detail->view; ?>
                        <span id='li-f-view'></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="comments">
            <div class="form">
                <div class="form-group">
					<input type="hidden" id="category_id" value="" />
					<input type="hidden" id="keywords" value="" />
					<input type="hidden" id="inp_content_id" value="f<?php echo $forum_detail->POST_ID;?>">
                <textarea class="form-control" id="inp_comment" placeholder="Berikan komentar Anda ..."></textarea>
                </div>
                <div class="form-group form-group-btn text-right">
                <button class="btn btn-default " onclick="save_comment_f();false;">Kirim Komentar</button>
                </div>
            </div>
            
            <!-- Comments -->
            <div class="page-header">
                <h5>KOMENTAR</h5>
            </div>
            <ul class="list-unstyled" id="comment-form"></ul>
            <?php if($forum_detail->comment > 5): ?>
            <button id='btn-load-more-comment' class='btn btn-link btn-sm' onclick="get_comment_f();false;">Lihat Lainnya</button>
            <?php endif; ?>
          
            <div class="hidden">
            <nav aria-label="navigation">
                <ul class="pagination pagination-sm">
                <li class="disabled">
                    <a href="#" onclick="return false" aria-label="Previous">
                    <span aria-hidden="true"><span class="fa fa-caret-left"></span></span>
                    </a>
                </li>
                <li class="active"><a href="#" onclick="return false">1</a></li>
                <li><a href="#" onclick="return false">2</a></li>
                <li><a href="#" onclick="return false">3</a></li>
                <li>
                    <a href="#" onclick="return false" aria-label="Next">
                    <span aria-hidden="true"><span class="fa fa-caret-right"></span></span>
                    </a>
                </li>
                </ul>
            </nav>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <?php echo $this->load->view('_sidebar_forum');?>

</div>

