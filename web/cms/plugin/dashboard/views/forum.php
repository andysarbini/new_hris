<div class="row">
    <div id="category_id" data-value="<?php  echo $category_id; ?>"></div>
    <div id="keywords" data-value="<?php echo $keywords; ?>"></div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="data_list"><!-- Ajax content --></div>
            </div>
        </div>
        <nav aria-label="navigation">
            <div id="pagination_link"><!-- Ajax content --></div>
        </nav>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_category_forum">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Kategori BirdBagi Forum</h4>
                </div>
                <div class="modal-body" >
                    
                    <?php if($categories): ?>

                    <div class="row">

                        <?php foreach($categories as $key => $var): ?>
    
                        <div class="col-md-4">
                            <div class="panel-panel-default text-center">
                                <a href="<?php echo base_url().$uri; ?>/posting-diskusi-baru/<?php echo $var->CAT_URI; ?>">
                                    <img src="<?php echo base_url(); ?>uploads/forum/discussion_icon.png" height="50px"/>
                                    <br />
                                    <?php echo $var->CAT_TITLE; ?>
                                </a>
                            </div>
                        </div>
    
                        <?php endforeach; ?>

                    </div>

                    <?php endif;?>

                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <?php if($categories): ?>
    <?php echo $this->load->view('_main_sidebar_forum', $categories);?>
    <?php endif; ?>


</div>

