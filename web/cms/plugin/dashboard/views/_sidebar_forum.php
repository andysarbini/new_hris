<div class="col-md-4">
    <div class="section-search panel panel-none" >
        <form action="<?php echo base_url().$uri; ?>" method="GET">
            <div class="form-group form-group-lg">
                <input type="text" class="form-control" name="keywords" value="<?php if(@if_empty($original_keywords)){ echo $original_keywords; } ?>" placeholder="Temukan postingan..." />
            </div>
        </form>
    </div>
    
    <?php if($sidebar_post_list): ?>

        <p>Lainnya dalam kategori <b><?php echo $forum_detail->CAT_TITLE; ?></b></p>
        
        <?php foreach($sidebar_post_list as $k => $v): ?>
        <?php $url_link = base_url()."birdbagi-forum/".$v->CAT_URI."/".$v->POST_URI."/".$v->POST_ID; ?>
        <h4><a href="<?php echo $url_link; ?>"><?php echo $v->POST_TITLE; ?></a></h4>
        <?php endforeach; ?>
        
    <?php endif; ?>
</div>