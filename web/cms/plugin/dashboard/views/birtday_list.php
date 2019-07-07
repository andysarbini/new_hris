<div class="view-table-list">
	<!-- Fake Filter berdasarkan -->
	<div class="form-inline">
		<label for="" class="control-label" style="visibility:hidden">Filter berdasarkan</label>
	</div>
	<table id="example" class="table table-valign display">
		<thead>
			<tr>
			   <th width="33%">Nama <span class="fas fa-sort pull-right"></span> </th>
			   <th>Perusahaan <span class="fas fa-sort pull-right"></span> </th>
			   <th>Jabatan <span class="fas fa-sort pull-right"></span> </th>
			   <!-- <th width="15%" class="text-center">Tanggal Lahir <span class="fas fa-sort pull-right"></span> </th> -->
			   <!-- <th width="26px" class="no-sort"><span class="sr-only">Actions</span></th> -->
			</tr>
		</thead>
		<tbody>
				
	 <?php foreach($birthdays as $var=>$v){ 
		 $_p = array(
				"nip"=>$v->nip,
				"id"=>$v->usr_id,
				"pic"=>$v->profile_picture,
				"nama"=>$v->nama_lengkap
			);	
		 
		 ?>
		<tr>
			<td>
			<?php echo $this->load->view('cuti/foto_nama_nip_id',$_p,true); ?> 
			</td>
			<td><?php echo $slc_company[$v->company];?></td>
			<td><?php echo $slc_jabatan[$v->jabatan];?></td>
			<!-- <td class="text-center"><small><?php // echo bluehrd_tgl($v->tgl_lahir);?></small></td> -->
			<!-- <td>
				<div class="dropdown pull-right">
					<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-cog fa-lg"></i></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
						<li><a class="#" onclick="">Lihat</a></li>
					</ul>
				</div>
			</td> -->
		</tr>
	<?php } ?>
	
		</tfoot>
	</table>
</div>

<div class="clearfix"></div>
