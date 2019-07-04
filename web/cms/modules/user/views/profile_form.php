<form method='post' class='form-horizontal' role='form' action='<?php echo  base_url().'user/profile/save';?>'>
	
	<div class="form-group">
		<label class='col-lg-2 control-label' for='user'>User Name</label>
		<div class='col-lg-10'>
			<input type='text' id='user' class="form-control"  name='user' value='<?php echo @if_empty($user->USR_NAME,'');?>' placeholder='User Name'/>
		</div>
	</div>
	
	<div class="form-group">
		<label class='col-lg-2 control-label' for='email'>Email</label>
		<div class='col-lg-10'>
			<input type='text' id='email' class="form-control"  name='email' value='<?php echo @if_empty($user->USR_EMAIL,'');?>' placeholder='User Name'/>
		</div>
	</div>
	
	<div class="form-group">
		<label class='col-lg-2 control-label' for='pass'>Password</label>
		<div class='col-lg-10'>
			<input type='text' id='pass' class="form-control"  name='pass' value='' placeholder='Password'/>
			<small id="emailHelp" class="form-text text-muted">kosongkan jika tidak ingin mengubah password</small>
		</div>
	</div>
	
	<div class="form-group">
		<label class='col-lg-2 control-label' for='repass'>Retype Password</label>
		<div class='col-lg-10'>
			<input type='text' id='repass' class="form-control"  name='repass' value='' placeholder='Retype Password'/>
			<small id="emailHelp" class="form-text text-muted">kosongkan jika tidak ingin mengubah password</small>
		</div>
	</div>
	
	<div class='form-group'>
		<div class='col-lg-offset-2 col-lg-10'>
			<a href='<?php echo base_url().'user/profile' ;?>' class='btn btn-primary btn-sm'>Cancel</a>
			<input type='submit' value='Save' class='btn btn-primary btn-sm'/>
		</div>
	</div>

</form>
