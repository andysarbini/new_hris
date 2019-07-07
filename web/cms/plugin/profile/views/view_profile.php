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
