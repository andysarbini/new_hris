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
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="data_list"><!-- Ajax content --></div>
            </div>
        </div>
        <nav aria-label="navigation">
            <div id="pagination_link"><!-- Ajax content --></div>
        </nav>
    </div>

</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_delete_forum">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <div class="media">
                    <div class="media-left media-middle">
                        <span class="fas fa-exclamation-triangle fa-fw fa-3x text-warning" aria-hidden="true"></span>
                    </div>
                    <div class="media-body">
                        <h4>Apakah anda yakin akan menghapus ini?</h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
                <a href="#" class="btn btn-default">Hapus</a>
            </div>
        </div>
    </div>
</div>

