<!--onclick="window.location.replace('<?//= base_url('perusahaan/tambah'); ?>');" -->
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">
					<?= $this->session->flashdata('message'); ?>
          <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
					<button type="button" class="btn btn-w-m btn-primary" data-toggle="modal" data-target="#newSubMenuModal">Add Data</button>
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Nama Perusahaan</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Kodepos</th>
						            <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
					 <?php $i = 1; ?>
                    <?php foreach ($perusahaan as $var=>$v) : ?>
                        <tr>
                            <td><?php echo $v->company;?></td>
                            <td><?php echo $v->alamat;?></td>
                            <td><?php echo $v->telepon;?></td>
                            <td><?php echo $v->kodepos;?></td>
                            <td><?php echo $v->keterangan;?></td>
                            
                            <td>
                                <a href="<?= base_url(); ?>perusahaan/edit/<?= $v->company_id; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url(); ?>perusahaan/hapus/<?= $v->company_id; ?>" class="badge badge-danger">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
					
                   
                    
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <Strong>Added New perusahaan</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('perusahaan/tambah'); ?>" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama perusahaan</label>
            <input type="text" class="form-control" id="recipient-name" name="nama" value="<?php echo @if_empty($sm->company,'');?>">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Alamat:</label>
            <textarea class="form-control" id="message-text" name="alamat"><?php echo @if_empty($sm->alamat,'');?></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Telepon</label>
            <input type="text" class="form-control" id="recipient-name" name="telepon" value="<?php echo @if_empty($sm->telepon,'');?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Kodepos</label>
            <input type="text" class="form-control" id="recipient-name" name="kodepos" value="<?php echo @if_empty($sm->kodepos,'');?>">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Keterangan:</label>
            <textarea class="form-control" id="message-text"name="ket" ><?php echo @if_empty($sm->keterangan,'');?></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Save</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>        
        