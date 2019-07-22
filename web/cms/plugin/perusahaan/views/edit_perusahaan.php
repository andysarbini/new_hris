
<div class="col-lg-10">            
            <div class="ibox-content">
                <div class="row">
                    
                <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

                        
                      
                    <form method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="<?= $perusahaan['company_id']; ?>">                        					
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Perusahaan</label>
                            <div class="col-sm-10"><input type="text" name = "nama" class="form-control" value="<?= $perusahaan['company']; ?>"> </div>
                        </div>
						<div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-10"><textarea name="alamat"  class="form-control"><?= $perusahaan['alamat']; ?></textarea>
                        </div>
						<div class="form-group"><label class="col-sm-2 control-label">Telepon</label>
                            <div class="col-sm-10"><input type="text" name = "telepon" class="form-control" value="<?= $perusahaan['telepon']; ?>"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Kodepos</label>
                            <div class="col-sm-10"><input type="text" name = "kodepos" class="form-control" value="<?= $perusahaan['kodepos']; ?>"></div>
                        </div>
						<div class="form-group"><label class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10"><textarea name="keterangan"  class="form-control"><?= $perusahaan['keterangan']; ?></textarea></div>
                        </div>

                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="button" onclick="window.location.replace('<?= base_url('perusahaan'); ?>');">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>  
                </div>
            </div>
</div>