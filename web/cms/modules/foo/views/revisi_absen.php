<div class="row">
   <div class="col-md-12">
     <div class="card">
		<div class="card-header" >
		<h2><strong>Formulir Revisi Absen</strong></h2>
		</div>
			
        <div class="card-body">
            <form id="form_revisi">
                <div class="form-group row">
                    <label for="tgl_absensi" class="col-md-2 col-form-label">Tanggal Absensi</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control tgl_absensi" name="tgl_absensi" id="tgl_absensi" />        
                        <div class="invalid_tgl_absensi"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alasan" class="col-md-2 col-form-label">Alasan</label>
                    <div class="col-md-10">
                        <select name="alasan" id="alasan" class="form-control">
                            <option value="">-- Pilih Alasan --</option>
                            <option value="Alasan 1">Alasan 1</option>
                            <option value="Alasan 2">Alasan 2</option>
                            <option value="Alasan 3">Alasan 3</option>
                        </select>     
                        <div class="invalid_alasan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-md-2 col-form-label">Keterangan</label>
                    <div class="col-md-10">
                        <textarea name="keterangan" id="keterangan" rows="5" class="form-control"></textarea>
                        <div class="invalid_keterangan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jam_datang" class="col-md-2 col-form-label">Jam Datang</label>
                    <div class="col-md-10">
                        <input type="time" class="form-control jam_datang" name="jam_datang" id="jam_datang" />        
                        <div class="invalid_jam_datang"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jam_pulang" class="col-md-2 col-form-label">Jam Pulang</label>
                    <div class="col-md-10">
                        <input type="time" class="form-control jam_pulang" name="jam_pulang" id="jam_pulang" />        
                        <div class="invalid_jam_pulang"></div>
                    </div>
                </div>
				<div class="form-group row">
                    <label for="jam_datang" class="col-md-2 col-form-label">Upload File Pendukung</label>
                    <div class="col-md-10">
                        <div class="ibox ">
                        
                        <div class="ibox-content">

                            <div class="custom-file">
                                <input id="logo" type="file" class="form-control">
                                <label for="logo" class="custom-file-label">Ukuran File Maximal 2 Mb</label>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
        <div class="col-md-10">
            <div class="form-group text-center">
				<div class="col-sm-5 col-sm-offset-5">
					<button class="btn btn-white btn-sm" type="submit">Cancel</button>
                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                </div>
            </div>
		</div>
            </form>
       </div>
     </div>
   </div>
 </div>

 <script>
    
    function load_revisi(id)
    {
        $.ajax({
            url: `<?= base_url('api/revisi_absen/show/') ?>${auth.token}?id=${id}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(response){
                if(response.data.length === 1){
                    var html = '';
                    $.each(response.data, function(k,v){
                        $('#tgl_absensi').datepicker('setDate', new Date(v.tgl_absensi));
                        $('#alasan').val(v.alasan);
                        $('#keterangan').val(v.keterangan);
                        $('#jam_datang').val(v.jam_datang);
                        $('#jam_pulang').val(v.jam_pulang);
                    })
                }
            },
            error: function(err){
            }
        })
    }
    $(document).ready(function(){
        var id = location.hash.substr(14);
        load_revisi(id);
        $('.tgl_absensi').datepicker({
            format: "dd-mm-yyyy",
            orientation: "auto",
            endDate: new Date(),
        });
        $('#form_revisi').validate({
            rules: {
                tgl_absensi: "required",
                alasan: "required",
                keterangan: "required",
                jam_datang: "required",
                jam_pulang: "required"
            },
            messages: {
                tgl_absensi: "Pilih jenis izin yang akan diajukan",
                alasan: "Pilih alasan revisi",
                keterangan: "Masukkan keterangan revisi",
                jam_datang: "Silahkan pilih jam datang",
                jam_pulang: "Silahkan pilih jam pulang"
            },
            errorClass: 'is-invalid',
            errorPlacement: function(error, element) {
                var name = $(element).attr("id");
                // error.appendTo(element.next());
                error.appendTo($('.invalid_'+name));
            },
            submitHandler: function(form){
                $.ajax({
                    url: `<?= base_url('api/revisi_absen/edit/') ?>${auth.token}?id=${id}`,
                    type: 'POST',
                    data: $(form).serialize(),
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#submit_add').html('<i class="fa fa-fw fa-spinner fa-spin"></i>');
                    },
                    success: function(response){
                        if(response.status === 200){
                            toastr.info(response.message, response.description)
                            location.hash = '#/revisi_absen';
                        } else {
                             $('#submit_add').html('Submit');
                            toastr.error(response.message, response.description)
                        }
                    },
                    error: function(err){
                         $('#submit_add').html('Submit');
                        toastr.error('Tidak dapat mengakases server', 'Gagal');
                    }
                })
            }
        })
    });
 </script>