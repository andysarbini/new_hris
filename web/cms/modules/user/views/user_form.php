<h3 class='heading'>
	User: <strong>Add New User</strong>
</h3>
<p class='description'>Daftar pengguna website.</p>

<div class='clearfix margin-bottom-20'></div>

<form method='post' class='form-horizontal' role='form' action='<?php echo  base_url().'admin/user/simpan';?>'>
	
	<div class="form-group">
		<label class='col-lg-2 control-label' for='user'>User Name</label>
		<div class='col-lg-10'>
			<input type='text' id='user' name='user' value='' placeholder='User Name'/>
		</div>
	</div>
	
	<div class="form-group">
		<label class='col-lg-2 control-label' for='pass'>Password</label>
		<div class='col-lg-10'>
			<input type='text' id='pass' name='pass' value='' placeholder='Password'/>
		</div>
	</div>
	
	<div class="form-group">
		<label class='col-lg-2 control-label' for='repass'>Retype Password</label>
		<div class='col-lg-10'>
			<input type='text' id='repass' name='repass' value='' placeholder='Retype Password'/>
		</div>
	</div>
	
	<div class='form-group'>
		<div class='col-lg-offset-2 col-lg-10'>
			<a href='' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-trash'></span></a>
			<a href='<?php echo base_url().'admin/user' ;?>' class='btn btn-primary btn-sm'>Cancel</a>
			<input type='submit' value='Save' class='btn btn-primary btn-sm'/>
		</div>
	</div>

</form>
