<div class="row">
    <div class="col-md-6">
    <div class="card">
		<div class="card-header" >
		    <h2><strong>Upload Form</strong></h2>
        </div>
        <div class="card-body">
            <form id="form_kantor" action="<?php echo base_url()."attendance/revisi/save";?>" method="post"  enctype="multipart/form-data">
				<input type="hidden" name="rev_id" value="<?php echo @if_empty($data->rev_id, 0);?>" />
                <div class="form-group row">
                    <label for="nama_kantor" class="col-md-2 col-form-label">Tanggal Awal</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control datepicker" name="date_from" value="<?php echo @if_empty($data->date_from, '');?>"/>        
                        <div class="invalid_nama_kantor"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_kantor" class="col-md-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control datepicker" name="date_to" value="<?php echo @if_empty($data->date_to, '');?>"/>        
                        <div class="invalid_nama_kantor"></div>
                    </div>
                </div>		
                <div class="form-group row">
                    <label for="jenis_izin" class="col-md-2 col-form-label">Jenis Pengajuan</label>
                    <div class="col-md-10">
                        <select name="rev_type_id" class="form-control">
                        <?php 
                            $_tipe_revisi = mdl_opt('bb_opt_tipe_revisi');
                            echo gen_option_html($_tipe_revisi, @if_empty($data->rev_type_id));
                        ?>
                        </select>     
                        <div class="invalid_izin"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="subhect" class="col-md-2 col-form-label">Subject</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control subjek" name="subjek" value="<?php echo @if_empty($data->subjek, '');?>"/>
                        <div class="invalid_nama_kantor"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-md-2 col-form-label">Keterangan</label>
                    <div class="col-md-10">
                        <textarea name="keterangan" rows="5" class="form-control"><?php echo @if_empty($data->keterangan, '');?></textarea>
                        <div class="invalid_alamat"></div>
                    </div>
                </div>  
                <div class="form-group row">
                    <div class="form-group"><label class="col-sm-2 control-label">Upload File</label>
                        <div class="col-sm-10"><input type="file" name="file" class="form-control" >
<?php if(isset($data->path_file)) { 
	$this->load->config('attendance');

	$rule_upload = $this->config->item('revisi_uploads');
?><br />
	<a href="<?php echo base_url().$rule_upload['upload_path'].'/'.$data->path_file;?>" class="btn btn-white"><i class="fa fa-download"> <?php echo $data->path_file;?></i> </a>
	<br />
	<br />
<?php } ?>
                    </div>
                </div>
				<br />
				<br />
                <div class="form-group row">
					<div class="form-group"><label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                        	<a href="<?php echo base_url()."attendance/revisi";?>" class="btn btn-white btn-sm pull-left" >Cancel</a>
<?php if(isset($data->rev_id)) { ?>
	<a href="<?php echo base_url()."attendance/revisi/delete/".$data->rev_id;?>" class="btn btn-red btn-sm btn-danger" onclick="return confirm('Anda Yakin!');">Delete</a>
<?php } ?>
							<button class="btn btn-primary btn-sm pull-right" type="submit">Save</button>
	                    </div>
                    </div>
				</div>
		    </form>
        </div>                
    </div>                 
</div>