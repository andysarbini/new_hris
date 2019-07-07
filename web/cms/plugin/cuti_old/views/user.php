	<div id="history" class="tab-pane fade in active">
		<div>
			<select name="year" id="year">
<?php
	$_slc_year	= $slc_year;
	$_now_year 	= date("Y");
	$_next_year	= $_now_year + 1;
	$_low_year	= @if_empty($lowest_year) ? $lowest_year : $_now_year ;

	for($i = $_low_year; $i <= $_next_year; $i++)

		echo "<option value='".$i."'".( $_slc_year == $i ? " selected":"" ).">".$i."</option>";
?>
			</select>
			<table class="table">
            <thead>
              <tr><th>Type</th><th>Start Date</th><th>End Date</th><th class="text-center">Days</th><th>Reason</th><th>Status</th></tr>
            </thead>
				<tbody id="cuti-table-body">
				
				</tbody>
			</table>

			<button onclick="form_cuti();" class="btn btn-info">Ajukan Cuti</button>
		</div>
	</div>
	

<div class="modal" tabindex="-1" role="dialog" id="form-modal">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title">Form Pengajuan</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		<form method="post" action="<?php echo base_url()."cuti/create";?>">
			<div class="input-group input-daterange">
				<input type="text" class="form-control" id="tgl_from" name="tgl_from">
				<div class="input-group-addon">to</div>
				<input type="text" class="form-control" id="tgl_to" name="tgl_to">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="form_cuti();">Close</button>
	  </div>
	</div>
  </div>
</div>
