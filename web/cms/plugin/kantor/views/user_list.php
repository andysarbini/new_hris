<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">
					<?= $this->session->flashdata('message'); ?>
					<button type="button" class="btn btn-w-m btn-primary" onclick="window.location.replace('<?= base_url('kantor/tambah'); ?>');">Add Data</button>
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Nama Perusahaan</th>
                        <th>Nama Kantor</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
						<th>Kab/Kota</th>
                        <th>Longitude</th>
						<th>Latitude</th>
						<th>GMT</th>
						<th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
					 <?php $i = 1; ?>
                    <?php foreach ($kantor as $var=>$v) : ?>
                        <tr>
                            <td><?php echo $v->company;?></td>
                            <td><?php echo $v->office;?></td>
                            <td><?php echo $v->alamat;?></td>
                            <td><?php echo $v->prov;?></td>
                            <td><?php echo $v->kab;?></td>
							<td><?php echo $v->lon;?></td>
                            <td><?php echo $v->lat;?></td>
                            <td><?php echo $v->gmt;?></td>
                            
                            <td>
                                <a href="<?= base_url(); ?>kantor/edit/<?= $v->office_id; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url(); ?>kantor/hapus/<?= $v->office_id; ?>" class="badge badge-danger">delete</a>
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
        <Strong>Added New kantor</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('menu/submenu'); ?>" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama kantor</label>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo @if_empty($sm->nama_perusahaan,'');?>">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Alamat:</label>
            <textarea class="form-control" id="message-text"><?php echo @if_empty($sm->nama_perusahaan,'');?></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lattitude</label>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo @if_empty($sm->nama_perusahaan,'');?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Longitude</label>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo @if_empty($sm->nama_perusahaan,'');?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Propinsi</label>
            <select class="form-control m-b" name="prov">
            <?php echo gen_option_html(Modules::run('api/select', 'mdl_navigation_type',array('id'=>'NAV_TYPE_ID', 'title'=>'NAV_TYPE')), @if_empty($nav->type_id,0));?>
            </select>            
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Kab/Kota</label>
            <select class="form-control m-b" name="prov">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                    </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>