<div class="row">
	<div class="col-md-3">
		<div class="thumbnail">
			<img src='<?php echo img_thumb("uploads/profile/".$user->profile_picture, 260,260);?>' class="img-responsive">
		</div>
		<?php if($id_pengunjung == $user->usr_id) { ?>
		<div style="margin-bottom:20px;">
		<a class="btn btn-default btn-block" href="<?php echo base_url()."profile/edit";?>">Edit Profil</a>
		</div>
		<?php } ?>		
		
            <div class="ibox-title">
                <h5>Dokumen Pendukung </h5>
            
           <?php
				if(count((array) $listkaryawan)){

				$_a_jenis = json_decode(mdl_opt('bb_opt_user_tipe_file'), true);
				// $_a_status= array("Open", "Close");
				// $_a_keputusan = array("Tolak", "Terima");

				echo "<table class='table table-striped'>";
				echo "<thead>";
				echo "<tr>";
				echo "<th>Berkas</th>";				
				echo "<th>Action</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				foreach($listkaryawan as $var=>$_){
				echo "<tr>";
				echo "<td>".$_->tipeberkas."</td>";
				// echo"<td>asfsaf</td>";
				
				echo "<td>"; ?>
				
				<div class='infont col-md-3 col-sm-4'><a href='#'><i class='fa fa-download'></i></a></div>
				<div class='infont col-md-3 col-sm-4'><a href='<?= base_url(); ?>profil/delete/<?= $_->file_id; ?>'><i class='fa fa-times'></i></a></div>	
				<?php "</td>";
				echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";

				} else {
				echo "<center>Tidak Ada pengajuan revisi</center>";
				}
				?> 
				<button class="btn btn-outline btn-success  dim" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i></button>
				
			</div>
		
	</div>

		

	<div class="col-md-9 table-responsive">
		<table class="table">
			<tbody>
				<?php
					$_not_show = array("usr_id","profile_picture","usr_name", "usr_access", "usr_grp_name", "USR_GRP_DESC");
					foreach($user as $var=>$val){
						if(!in_array($var, $_not_show)){
							echo "<tr>";
							
							$txt = '';
							
							switch($var){
								
								//case 'company': $txt = 'perusahaan'; break;
								
								case 'tgl_masuk': 
								
								case 'tgl_lahir':
								
									$val = bbdate($val);
								
								break;
								
								default: break;
								
							}
							
							echo "<td width='33%' style='font-weight:400;text-transform:uppercase;'>".ucwords( $var!='company' ?  str_replace("_"," ",$var) : 'perusahaan')."</td>";
							switch ($var) {
								case 'company':
									echo "<td>".get_option_value("bb_opt_company",$val)."</td>";
									break;
								case 'tipe_karyawan':
									echo "<td>".get_option_value("bb_opt_tipe_karyawan",$val)."</td>";
									break;
								case 'jabatan':
									echo "<td>".get_option_value("bb_opt_jabatan",$val)."</td>";
									break;
								case 'grade':
									echo "<td>".get_option_value("bb_opt_grade",$val)."</td>";
									break;
								case 'level':
									echo "<td>".get_option_value("bb_opt_level",$val)."</td>";
									break;
								case 'cost_ctr':
									echo "<td>".get_option_value("bb_opt_cost_ctr",$val)."</td>";
									break;
								case 'pool':
									echo "<td>".get_option_value("bb_opt_pool",$val)."</td>";
									break;
								case 'status_karyawan':
									echo "<td>".get_option_value("bb_opt_status_karyawan",$val)."</td>";
									break;
								default:
									echo "<td>".$val."</td>";
									break;
							}
							echo "</tr>";
						}
						
					}
				?>	
			</tbody>
		</table>
	</div>
</div>

<!--Andy, modal upload file-->
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
			<div class="ibox-title">
                <h5>Upload Dokumen Pendukung</h5>
            </div>
            <div class="modal-body">
				<form action="<?php echo base_url()."profile/save";?>" method="post"  enctype="multipart/form-data">            
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                
				<button class="btn btn-success " type="submit"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Upload</span></button>
            </div>
			</form>
         </div>
        </div>
    </div>
