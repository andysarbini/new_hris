<div class="wrapper wrapper-content animated fadeInRight">



<!-- End Header -->
<div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Upload File Data Karyawan </h5>
            </div>
            <div class="ibox-content">
                <div class="row" style="padding: 0 8px 0 8px;">
                <form action="<?php echo base_url()."profile_2/save";?>" method="post"  enctype="multipart/form-data">
                        
                
                <div class="form-group"><label>Jenis</label>
                        <select name="tipeberkas" class="form-control">
						
                        <?php 
                            $_tipe_revisi = mdl_opt('bb_opt_user_tipe_file');
                            echo gen_option_html($_tipe_revisi, @if_empty($data->tipeberkas));
                        ?>
                     </select> 
                        </div>
                        <div class="form-group"><label>File Pendukung</label>

                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                    <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Select file</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="file">
                                </span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>


                        
<?php if(isset($data->path_file)) { 
$this->load->config('fileupload_c');

$rule_upload = $this->config->item('profilupload');
?><br />
<a href="<?php echo base_url().$rule_upload['upload_path'].'/'.$data->path_file;?>" class="btn btn-white"><i class="fa fa-download"> <?php echo $data->path_file;?></i> </a>
<br />
<br />
<?php } ?>
            
                            
                        </div>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Upload</strong></button>
                    </form>  
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>File Data Karyawan </h5>
            </div>
            <div class="ibox-content">
            <?php
if(count((array) $listkaryawan)){

$_a_jenis = json_decode(mdl_opt('bb_opt_user_tipe_file'), true);
// $_a_status= array("Open", "Close");
// $_a_keputusan = array("Tolak", "Terima");

echo "<table class='table table-striped'>";
echo "<thead>";
echo "<tr>";
echo "<th>Berkas</th>";
echo "<th>Nama File</th>";
echo "<th>Aksi</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach($listkaryawan as $var=>$_){
echo "<tr>";
echo "<td>".$_->tipeberkas."</td>";
// echo"<td>asfsaf</td>";
echo "<td>"."<a href='".base_url()."uploads/".$_->path_file."'>".$_->path_file."</a></td>";
echo "<td><i class='fa fa-close'></i><a href='#'>Delete</a></td>";
echo "</tr>";
}
echo "</tbody>";
echo "</table>";

} else {
echo "<center>Tidak Ada pengajuan revisi</center>";
}
?>


            </div>
        </div>
    </div>
</div>


</div>