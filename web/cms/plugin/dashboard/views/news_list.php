<div class="row">
    <div class="col-md-8">
        <div id="base_url" data-value="<?php  echo base_url(); ?>"></div>
        <div id="category_id" data-value="<?php  echo $category_id; ?>"></div>
        <div class="panel panel-default">
            <div class="panel-body" id="data_list">
                <!-- Load Content Ajax -->
            </div>
            <div class="panel-footer">
                <nav aria-label="navigation" id="pagination_link">
                <!-- Load Content Ajax -->
                </nav>
            </div>
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