<div class="col-md-4">
    <div class="section-search panel panel-none">
        <form>
            <div class="form-group form-group-lg">
                <input type="text" class="form-control" name="keywords" value="<?php if(@if_empty($original_keywords)){ echo $original_keywords; } ?>"  placeholder="Temukan postingan ..." />
            </div>
        </form>
    </div>
    <?php if($categories): ?>
        <?php $url_link = base_url()."birdbagi-forum"; ?>
        <ul class="list-inline list-cloud">
            <li><a href="<?php echo $url_link; ?>">Semua</a></li>
            <?php foreach($categories as $k => $v): ?>
            <?php $url_link = base_url()."birdbagi-forum/".$v->CAT_URI; ?>
            <li><a href="<?php echo $url_link; ?>"><?php echo $v->CAT_TITLE; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>