<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: user
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="page-header">
	<h1>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;User
	</h1>
</div>

<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked menu-list">
			<li class="active">
				<a class="font-2x" href='<?php echo base_url().'admin/user'?>'>User</a>
			</li>
			<li>
				<a class="font-2x" href='<?php echo base_url().'admin/group'?>'>Group</a>
			</li>
<!--
			<li>
				<a class="font-2x" href='<?php echo base_url().'admin/contact'?>'>Contact</a>
			</li>
-->
		</ul><!-- /content menu -->
	</div>
	<div class="col-sm-10">
		<ul class="nav nav-tabs" role="tablist" id="editor-tab">
			<li role="presentation" class="active"><a href="#detail">Detail</a></li>
			<li role="presentation"><a href="#options">Options</a></li>
			<li role="presentation"><a href="#permissions">Group</a></li>
		</ul>
		
		<form class='form-horizontal' method='post' role='form' action='<?php echo base_url().'admin/user/simpan';?>'>
		
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="detail">
				<div class='form-group'>
					<label class='control-label col-sm-2' for='nama'>Username</label>
					<div class='col-sm-4'>
						<input class='form-control input-sm' type='hidden' id='id' name='id' value='<?php echo @if_empty($user->id, 0);?>' />
						<input class='form-control input-sm' type='text' name='nama' id='nama' placeholder='Username' value='<?php echo @if_empty($user->nama, '');?>'/>
						<span style='color:red; font-weight:bold;' id='alert_double_name'></span>
					</div>
				</div>				
				<div class='form-group' style='display: none;'>
					<label class='control-label col-sm-2 disabled' for='ref'>User Ref. ID</label>
					<div class='col-sm-4'>
						<input class='form-control input-sm' type='text' name='ref' id='ref' placeholder='User Reference' value='<?php echo @if_empty($user->ref, '');?>' disabled/>
					</div>
				</div>
				<div class='form-group'>
					<label class='control-label col-sm-2' for='email'>Email</label>
					<div class='col-sm-4'>
						<input class='form-control input-sm' type='text' name='email' id='email' readonly placeholder='Email User' value='<?php echo @if_empty($user->email, '');?>'/>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="options">
				<div class='form-group'>
					<label class='control-label col-sm-2' for='pass'>Change Password</label>
					<div class='col-sm-4'>
						<input class='form-control input-sm' type='password' name='pass' id='pass' value='' />
					</div>
				</div>
				<div class='form-group'>
					<label class='control-label col-sm-2' for='acc'>Status</label>
					<div class='col-sm-4'>
					<select id='acc' name='acc' class='form-control input-sm'>
						<?php echo gen_option_html(Modules::run('api/select', 'mstr_status', 'STAT_ID id, STAT title'), @if_empty($user->acc,1));?>
					</select>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="permissions">
				<div class='form-group'>
					<label class='control-label col-sm-2' for='group_id'>Group</label>
					<div class='col-sm-4'>
						<select id='group_id' name='group_id' class='form-control input-sm'>
							<?php echo gen_option_html(Modules::run('api/select', 'mdl_user_group', 'USR_GRP_ID id, USR_GRP_NAME title'), @if_empty($user->group_id,0));?>
						</select>
					</div>
				</div>
			</div>
		</div>
			<div class='button-set'>
				<input type='submit' id='save' value='Save' class='btn btn-success btn-sm'/>
				<a class='btn btn-default btn-sm' href='<?php echo base_url().'admin/user';?>'>Cancel</a>
				<?php if(@if_empty($user->id, false)) { ?><a id='btn-delete-user' class='btn btn-link btn-cancel btn-sm pull-right' href='<?php echo base_url().'user/admin/hapus/'.$user->id;?>'><i class='fa fa-trash-o'></i> Delete</a><?php } ?>
			</div><!-- bottom form button group-->
		</form>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		
		$('#editor-tab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		})
		
		$('#btn-delete-user').on('click', function () {
        return confirm('Are you sure want to delete this user?');
		});
		
	});
	
$('#nama').blur(function(){
	
	$('#email').val($('#nama').val());
				
	// check double name
	$.post('<?php echo base_url().'admin/user/check_existing_username'; ?>', {'id':$('#id').val(),'name':$('#nama').val()},
		function(d){
			if(parseInt(d) > 0) {
				$('#alert_double_name').html("this name not available to use");
				$('#save').hide();
			} else {
				$('#alert_double_name').html("");
				$('#save').show();
			}
		}
	,'json');
	
	
});
</script>
