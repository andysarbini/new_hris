<input type='hidden' id='wid_id' name='wid_id' value='<?php echo @if_empty($wid->id, 0);?>' />

<div class='form-horizontal'>

	<div class='form-group'>
		<label class='col-lg-2 control-label' for='wid_title' >Title</label>
		<div class='col-lg-10'>
			<input class='form-control' id='wid_title' name='wid_title' type='text' value='<?php echo @if_empty($wid->title,'');?>' /> 
		</div>
	</div>
	
	<div class='form-group'>
			<label class='col-lg-2 control-label' for='wid_title' >Show Title</label>
			<div class='col-lg-10' id='radio_show_title'>
				
			</div>
		</div>

	<div class='form-group'>
		<label class='col-lg-2 control-label' for='wid_uri' >URI</label>
		<div class='col-lg-10'>
			<input class='form-control' id='wid_uri' name='wid_uri' type='text' value='<?php echo @if_empty($wid->uri,'');?>' /> 
		</div>
	</div>

	<div class='form-group'>
		<label class='col-lg-2 control-label' for='wid_code' >Code Widget</label>
		<div class='col-lg-10'>
			<textarea class='form-control' rows='4' id='wid_code' name='wid_code'><?php echo @if_empty($wid->code,'');?></textarea>
		</div>
	</div>

	<div class='form-group'>
		<label class='col-lg-2 control-label' for='select-pages' >Page</label>
		<div class='col-lg-10'>
			<select multiple id='select-pages' rows='10' class='form-control'>
				<option value=''>No Data Navigation Pages</option>
			</select>
		</div>
	</div>

	<div class='form-group'>
		<label class='col-lg-2 control-label' for='isactive' >Status</label>
		<div class='col-lg-4'>
			<select id='isactive' class='form-control'>
				<option value='1'>Enable</option>
				<option value='0'>Disable</option>
			</select>
		</div>
	</div>
	
	<div class='form-group'>
		<div class='col-lg-offset-2 col-lg-10'>
			<div class='btn-group'>
				<a href='#' onclick='hide_modal();return false;' class='btn btn-primary btn-sm'>Cancel</a>
				<input type='button' value='Save' id='btn_simpan' class='btn btn-primary btn-sm'>
			</div>
		</div>
	</div>

</div>
