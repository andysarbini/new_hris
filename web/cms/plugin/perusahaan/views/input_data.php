<div class="col-lg-12">
    <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h3 class="m-t-none m-b">Input Data Karyawan</h3>                        
            </div>
            <div class="ibox-content">
                <div class="row">
                    
                <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

                        
                      
                    <form action="<?= base_url('karyawan/tambah'); ?>" method="post" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">ID Kantor</label>
                            <div class="col-sm-10"><input type="text" name = "id_kantor" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">NIP Karyawan</label>
                            <div class="col-sm-10"><input type="text" name="nip_karyawan" class="form-control" ></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Karyawan</label>
                            <div class="col-sm-10"><input type="text" name="nama_karyawan" placeholder="Nama Karyawan" class="form-control"></div>
                        </div>    
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="submit">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>  
                </div>
            </div>
    </div>
</div>