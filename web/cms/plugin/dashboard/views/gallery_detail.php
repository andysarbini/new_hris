<div class="row">
    <div class="col-md-8">

        <div class="flexgrid">
            <?php if($result): ?>
            <?php foreach($result as $key => $var):?>
            <div class="col-md-3">

                <a class="openModalLink" data-id="<?php echo $var->GALL_PIC_ID; ?>">
                <?php 
                if($gall_info_result->GALL_TYPE == "videos"){
                    $img = base_url().'templates/bluehrd/img/bbg.jpg';
                    if(@if_empty($var->GALL_PIC_THUMBNAIL)){
                        $img = base_url().'/uploads/galleries/'.$var->GALL_PIC_THUMBNAIL;
                    }
                }else{
                    $img = base_url().'templates/bluehrd/img/no-image.png';
                    if(@if_empty($var->GALL_PIC_THUMBNAIL)){
                        $img = base_url().'/uploads/galleries/'.$var->GALL_PIC_THUMBNAIL;
                    }else{
                        if(@if_empty($var->GALL_PIC_PATH)){
                            $img = base_url().'/uploads/galleries/'.$var->GALL_PIC_PATH;
                        }
                    }
                }
                ?>
                <div class="panel panel-default lazy" data-original="<?php echo $img; ?>" style="background:url('<?php echo $img; ?>') 50% 50% no-repeat;background-size:cover;">
                    <?php if($gall_info_result->GALL_TYPE == "videos"): ?>
                    <img src="<?php echo base_url(); ?>templates/bluehrd/img/play.png" style="position:absolute;z-index:100;left:25px;top:20px;" />
                    <?php endif; ?>
                    <div class="panel-body text-center">
                    <div class="form-group sr-only">
                    <p><?php echo $var->GALL_PIC_NAME;?></p>
                    </div>
                    </div>
                </div>
                </a>

            </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>
                
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Module -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-actions pull-right hidden"><button class="btn btn-primary">Refresh</button> </div>
                <h4>GALERI LAINNYA</h4>
            </div>
            <?php if($sidebar_result): ?>
            <?php foreach($sidebar_result as $key => $var): ?>
            <?php if($key < 3): ?>
            <div class="card">
                <div class="media">
                <div class="media-top">
                    <a href="<?php echo base_url(); ?>gallery/<?php echo $var->GALL_URI;?>">
                    <img class="img-responsive lazy" src="<?php echo get_image_gallery_path($var->GALL_ID); ?>" data-original="<?php echo get_image_gallery_path($var->GALL_ID); ?>" alt="">
                    </a>
                </div>
                <div class="media-body ">
                    <h4 class="media-heading" style="margin-bottom:0px;">
                        <a href="<?php echo base_url(); ?>gallery/<?php echo $var->GALL_URI;?>"
                        ><?php echo $var->GALL_NAME; ?>
                        </a>
                    </h4>
                    <div class="help-block" style="margin-bottom:5px;margin-top:0px;">
                        Update terakhir pada 
                        <span>
                            <?php 
                            if($var->GALL_UPDATE_DATE != "0000-00-00 00:00:00"){
                                echo date("d-m-Y H:i", strtotime($var->GALL_UPDATE_DATE)); 
                            }else{
                                echo date("d-m-Y H:i", strtotime($var->GALL_CREATE_DATE)); 
                            }
                            ?>
                        </span>
                    </div>
                </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_gallery">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header hidden">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="row-fluid comment-wrap">
                <div class="col-md-9">
                    <div class="img-placeholder">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="image_src">
                        <!--<img src="<?php //echo base_url();?>templates/bluehrd/img/no-image.png" alt="">-->
                        <!--Load by Ajax-->
                        </div>
                        <div class="help-block count-top">
                            <ul class="list-inline">
                                <li>
                                    <!--<div class="text-center">202</div>
                                    <div><span class="far fa-heart fa-fw fa-2x" aria-hidden="true"></span></div>-->
                                    <!-- Load by Ajax -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 caption">
                    <div id="short_info">
                        <!--<a href="#"><b>Admin</b></a> memposting dalam <a href="#">Nama Galeri</a>-->
                        <!--Load by Ajax-->
                    </div><br>
                    <p><!--Load by Ajax--></p>
                    <div id="comment-form"></div>
                    <nav class="pager">
                        <li id="prev_id" class="previous">
                            <!--<a href="#"><span class="fa fa-chevron-left"></span> <span class="sr-only">Previous</span></a>-->
                            <!--Load by Ajax-->
                        </li>
                        <li class="text-info">
                            <!--1 dari 12 gambar-->
                            <!--Load by Ajax-->
                        </li>
                        <li id="next_id" class="next">
                            <!--<a href="#"><span class="sr-only">Next</span> <span class="fa fa-chevron-right"></span></a>-->
                            <!--Load by Ajax-->
                        </li>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
