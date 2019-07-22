<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">

<div class="col-lg-12">
                   <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Input Data Kantor</h5>
                            
                        </div>
                        <div class="ibox-content">
						
					<?php if (validation_errors()) : ?>
					<div class="alert alert-danger" role="alert">
					<?= validation_errors(); ?>
					</div>
					<?php endif; ?>
                       
				<form action="<?=base_url('kantor/tambah'); ?>" method="post" class="form-horizontal">
						
						<div class="form-group"><label class="col-md-2 control-label">Nama Perusahaan</label>

                                    <div class="col-md-6"><select class="form-control m-b" name="nama_perusahaan">
                                        <option value="">--Pilih--</option>
											<?php foreach ($per as $r) : ?>
											<option value="<?= $r['company_id']; ?>"><?= $r['company']; ?></option>
											<?php endforeach; ?> </select></div>
						</div>												
																														                     
									<div class="form-group"><label class="col-md-2 control-label">Nama Kantor</label>
							<div class="col-md-6"><input type="text" class="form-control" name="nama_kantor"></div>
                            </div>

						   <div class="form-group row">
								<label for="alamat" class="col-md-2 control-label">Alamat</label>
								<div class="col-md-6">
								<textarea name="alamat_kantor" id="alamat" rows="2" class="form-control"></textarea>
								<div class="invalid_alamat"></div>
							</div>
							</div>
							<!--<div class="form-group"><label class="col-lg-2 control-label">Provinsi</label>
								<div class="col-lg-6"><input type="text" class="form-control"></div>
                            </div>
							 <div class="form-group"><label class="col-lg-2 control-label">Kab/Kota</label>
								<div class="col-lg-6"><input type="text" class="form-control"></div>
                            </div>-->
							<div class="form-group"><label class="col-md-2 control-label">Provinsi</label>
							<div class="col-md-6"><select class="form-control m-b" name="provinsi" id="provinsi">
								<option value="">--Pilih--</option>
											<?php foreach ($provinsi as $p) : ?>
											<option value="<?= $p['prov_kode']; ?>"><?= $p['prov']; ?></option>
											<?php endforeach; ?> </select></div>
							</div>
																											 							
							<div class="form-group"><label class="col-md-2 control-label">Kab/Kota</label>
							<div class="col-md-6"><select class="form-control m-b" name="kabupaten" id="kabupaten">
								<option value="" >--Pilih--</option>
											<?php foreach ($kabu as $b) : ?>
											<option class="<?= $b['PROV_KODE']; ?>" value="<?= $b['KAB_KODE']; ?>"><?= $b['KAB']; ?></option>
											<?php endforeach; ?> </select></div>
							</div>														
						   
							<div class="form-group"><label class="col-md-2 control-label">Longitude</label>
								<div class="col-md-5"><input type="text" class="form-control" name="longitude"></div>
								
                            </div>
							<div class="form-group"><label class="col-md-2 control-label">Latitude</label>
                            <div class="col-md-5"><input type="text" class="form-control" name="latitude"></div>
                            </div>
							
								<div class="form-group"><label class="col-md-2 control-label">GMT</label>
							<div class="col-md-5"><select class="form-control m-b" name="gmt">
								<option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
								<option value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
								<option value="Etc/GMT+10">(GMT-10:00) Hawaii</option>
								<option value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
								
								<option value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option></select></div>
								</div>
                            <div class="form-group">
                                    <div class="col-md-offset-7 col-md-10">
                                        <button class="btn btn-sm btn-white" type="submit">Save Data</button>
                                    </div>
                            </div>
                    </form>
                        </div>
                    </div>
                </div>

                       



</div>
            </div>
<!-- Jasny -->
<link href="<?php echo template_dir(); ?>css/jasny/jasny-bootstrap.min.css" rel="stylesheet">
<script src="<?php echo template_js(); ?>/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="<?php echo template_js(); ?>/jquery-3.1.1.min.js"></script>
<script src="<?php echo template_js(); ?>/jquery.chained.min.js"></script>

<!-- summernote -->
<link href="<?php echo template_dir(); ?>css/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo template_dir(); ?>css/summernote/summernote-bs3.css" rel="stylesheet">

<script src="<?php echo template_js(); ?>/plugins/summernote/summernote.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

        });

    </script>
	
<script>$(document).ready(function() {
    var dropdown1 = {
        1 : ['Four', 'Five', 'Six'],
        2 : ['Seven', 'Eight', 'Nine'],
        3 : ['Ten', 'Eleven', 'Twelve'],
        4 : ['Thirteen', 'Fourteen', 'Fifteen'],
        5 : ['Sixteen', 'Seventeen', 'Eighteen']            
    }
    $('#first_selected').html(
            '<option>'+dropdown1[1].join('</option><option>')+'</option>'
        );
    $('#first').on('change',function() {
        $('#first_selected').html(
            '<option>'+dropdown1[$(this).val()].join('</option><option>')+'</option>'
        );
    });
});	</script>

<script>
	$(document).ready(function() {
		$('#provinsi').change(function() {
			var provinsi_id = $(this).val();
			
			$.ajax({
				type: 'post', //method
				url: 'kota.php', //action
				data: 'prov_id='+provinsi_id, //$_posst['prov_id']
				success: function(response) {
					$('#kota').html(response);
				}
			});
		})
	});
</script>

<script>
            $("#kabupaten").chained("#provinsi"); // disini kita hubungkan kabupaten dengan provinsi
            $("#kecamatan").chained("#kota"); // disini kita hubungkan kecamatan dengan kota
        </script>
				