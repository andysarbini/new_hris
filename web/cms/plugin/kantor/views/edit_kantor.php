<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">

<div class="col-lg-12">
                   <div class="ibox float-e-margins">
                        
                        <div class="ibox-content">
						
					<?php if (validation_errors()) : ?>
					<div class="alert alert-danger" role="alert">
					<?= validation_errors(); ?>
					</div>
					<?php endif; ?>
                       
				<form method="post" class="form-horizontal">
					<input type="hidden" name="id" value="<?= $kantor['office_id']; ?>"> 						
						<div class="form-group"><label class="col-md-2 control-label">Nama Perusahaan</label>
						<div class="col-md-6"><select class="form-control m-b" name="company_id">
                                        
											<?php foreach ($per as $r) : ?>
											<option value="<?= $r['company_id']; ?>" <?=$r['company_id'] == $kantor['company_id'] ? "selected" : null ?>><?= $r['company']; ?></option>
											<?php endforeach; ?> </select></div>
						</div>																		

						<div class="form-group"><label class="col-md-2 control-label">Nama Kantor</label>
							<div class="col-md-6"><input type="text" class="form-control" name="kantor" value="<?= $kantor['office']; ?>"></div>
                            </div>

						   <div class="form-group row">
								<label for="alamat" class="col-md-2 control-label">Alamat</label>
								<div class="col-md-6">
								<textarea name="alamat" id="alamat" rows="2" class="form-control"><?= $kantor['alamat']; ?></textarea>
								<div class="invalid_alamat"></div>
							</div>
							</div>

							<div class="form-group"><label class="col-md-2 control-label">Provinsi</label>
							<div class="col-md-6"><select class="form-control m-b" name="provinsi" id="provinsi">
								
								<?php foreach ($provinsi as $p) : ?>
											<option value="<?= $p['prov_kode']; ?>" <?=$p['prov_kode'] == $kantor['no_prop'] ? "selected" : null ?>><?= $p['prov']; ?></option>
											<?php endforeach; ?> </select></div>
							</div>																											 							
							<div class="form-group"><label class="col-md-2 control-label">Kab/Kota</label>
							<div class="col-md-6"><select class="form-control m-b" name="kabupaten" id="kabupaten">
								
											<?php foreach ($kabu as $b) : ?>
											<option class="<?= $b['PROV_KODE']; ?>" value="<?= $b['KAB_KODE']; ?>"><?= $b['KAB']; ?></option>
											<?php endforeach; ?> </select></div>
							</div>																						
																											   
							<div class="form-group"><label class="col-md-2 control-label">Longitude</label>
								<div class="col-md-5"><input type="text" class="form-control" name="lon" value="<?= $kantor['lon']; ?>"></div>
								
                            </div>
							<div class="form-group"><label class="col-md-2 control-label">Latitude</label>
                            <div class="col-md-5"><input type="text" class="form-control" name="lat" value="<?= $kantor['lat']; ?>"></div>
                            </div>
							
								<div class="form-group"><label class="col-md-2 control-label">GMT</label>
							<div class="col-md-5"><select class="form-control m-b" name="gmt">
								<option value="7">(GMT+7) WIB</option>
								<option value="8">(GMT+8) WITA</option>
								<option value="9">(GMT+9) WIT</option>											
								</select></div>
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

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-2.2.3.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#kategori').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>kantor/getkabkot",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option>'+data[i].KAB+'</option>';
                    }
                    $('.subkategori').html(html);
                     
                }
            });
        });
    });
</script>
				