<div class="view-table-list">
	<!-- Fake Filter berdasarkan -->
	<div class="form-inline">
		<label for="" style="visibility:hidden">Filter berdasarkan</label>
	</div>
	<table class="table" id="data-table">
		<thead>
			<tr>
				<th>Kategori <span class="fas fa-sort pull-right"></span> </th>
				<th>Judul <span class="fas fa-sort pull-right"></span> </th>
				<th>Keterangan <span class="fas fa-sort pull-right"></span> </th>
				<th class="no-sort">Berkas</th>
				<!-- <th width="26px" class="no-sort"><span class="sr-only">Actions</span></th> -->
			</tr>
		</thead>
		<tbody>
	<?php foreach($tables as $var=>$v){ ?>
			<tr>
				<td><?php echo $v->category ? $str_category[$v->category]:'';?></td>
				<td><?php echo $v->title;?></td>
				<td><?php echo $v->description;?></td>
				<td><?php echo $v->file ? "<a href='".base_url().'uploads/info/'.$v->file."' class='btn btn-default btn-xs'><span class='fas fa-download fa-fw' aria-hidden='true'></span> Download</a>":"";?></td>
				<!-- <td>
					<div class="dropdown pull-right">
						<a class="btn btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-cog fa-lg"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="actionmenu">
						  <li><a class="#">Lihat</a></li>
						</ul>
					</div>
				</td> -->
			</tr>
	<?php } ?>
		</tbody>
	</table>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Pusat Informasi Karyawan</h4>
	      </div>
	      <div class="modal-body"><!-- load content --></div>
	    </div>
	  </div>
	</div>
</div>

<div class="clearfix"></div>
