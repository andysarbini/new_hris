<h3 class='heading'>
	Member <strong>(Edit)</strong>
</h3>
<p class='description'>Tambah, edit, hapus member yang terdaftar di website.</p>

<div class='clearfix margin-bottom-20'></div>

<?php echo inc_script(array('css/ui-lightness/jquery-ui-1.10.2.custom.min.css', 'js/jquery-ui-1.10.2.custom.min.js', 'js/tgldatepicker_jqueryui.js')); ?>

<form class='forms' method='post' action='<?php echo base_url().'admin/member/simpan';?>' enctype='multipart/form-data'>
	
	<div class='row-fluid'>
		<label class='span2' for='name'>Name</label>
		<div class='span4'>
			<input class='input-xlarge' type='text' name='name' id='name' value='<?php echo @if_empty($member->name, ''); ?>' placeholder='Name Member' />
			<input class='input-xlarge' type='hidden' name='id' id='id' value='<?php echo @if_empty($member->id, 0); ?>' />
		</div>
	</div>
	
	<div class='row-fluid'>
		<label class='span2' for='email'>Email</label>
		<div class='span4'>
			<input class='input-xlarge' type='text' name='email' id='email' value='<?php echo @if_empty($member->email, ''); ?>' placeholder='Email' />
		</div>
	</div>
	
	<div class='row-fluid'>
		<label class='span2' for='sex'>Sex</label>
		<div class='span4'>
			<select id='sex' name='sex' class='select2 input-large'>
				<?php echo gen_option_html( Modules::run('api/_sex/select') , @if_empty($member->sex, 1));?>
			</select>
		</div>
	</div>
	
	<div class='row-fluid'>
		<label class='span2' for='tgl'>Birth Date</label>
		<div class='span4'>
			<input class='input-xlarge' type='text' name='tgl' id='tgl' class='tgldatepicker' placeholder='Birth Date' value='<?php echo @if_empty($member->tgl, ''); ?>' />
		</div>
	</div>
	
	<div class='row-fluid'>
		<label class='span2' for='addr'>Address</label>
		<div class='span4'>
			<textarea class='input-xlarge' id='addr' name='addr'><?php echo @if_empty($member->addr, ''); ?></textarea>
		</div>
	</div>
	
	<div class='row-fluid'>
		<label class='span2' for='pic'>Picture</label>
		<div class='span4'>
			<?php echo @if_empty($member->raw, false) ? '<a href="'.base_url().'uploads/members/'.$member->pic.'" target="_blank"><img src="'.base_url().'uploads/members/'.$member->raw.'_thumb'.$member->ext.'"></a><br>':''; ?>
			<input type='file' name='pic' id='pic' /> 
		</div>
	</div>
	
	<div class='clearfix margin-bottom-20'></div>
	
	<div class='row-fluid'>
		<label class='span2' for='active'>Status</label>
		<div class='span4'>
			<select name='active' id='active' class='select2 input-large'>
				<?php echo gen_option_html( Modules::run('api/_active/select') , @if_empty($member->active, 1));?>
			</select>
		</div>
	</div>
	
	<div class='clearfix margin-bottom-20'></div>
	
	<div class='pull-left btn-group'>
		<?php if(@if_empty($member->id, false)) { ?><a class='btn btn-small' href='<?php echo base_url().'admin/member/hapus/'.$member->id;?>'><i class='icon-trash'></i> Delete</a><?php } ?>
		<a class='btn btn-small' href='<?php echo base_url().'admin/member';?>'><i class='icon-remove'></i> Cancel</a>
		<input type='submit' id='save' value='Save' class='btn btn-success btn-small'/>
	</div>
	
</form>

<?php if(@if_empty($member->id, false)) { ?>

<div class='pull-right'>

	 <!-- modals -->
	 <a href="#myModal" role="button" class="btn btn-info btn-small" data-toggle="modal"><i class='icon-lock icon-white'></i> <strong>Change Login Password</strong></a>
	 
</div>

<!-- Modal -->
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel" class='modal-heading'>User <strong>(Edit)</strong></h3>
		</div>
		<div class="modal-body forms">
			<div class='row-fluid'>
				<label class='span4' for='pass-login'>Login Password</label>
				<div class='span4'>
					<input class='input-xlarge' type='password' name='pass-login' id='pass-login' value='' placeholder='login password '/>
				</div>
			</div>
			<div class='row-fluid'>
				<label class='span4' for='repass-login'>Retype Password</label>
				<div class='span4'>
					<input class='input-xlarge' type='password' name='repass-login' id='repass-login' value='' placeholder='retype login password '/>
				</div>
			</div>
			<div class='row-fluid'>
				<label class='span4' for='group_id'>Group Member</label>
				<div class='span4'>
					<select id='group_id'  class='select2 input-large'>
						<?php echo gen_option_html(Modules::run('api/adm_group/select'), $member->group_id);?>
					</select>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-success btn-small" id='btn-login-pass'>Save Changes</button>
		</div>
	</div>
	
<script type='text/javascript'>

$(document).ready(function(){
	
	$('#btn-login-pass').click(function() { change_pass_login(); });
	
	 $( "#tgl" ).datepicker();
	
});

function change_pass_login(){
	
	$.post( '<?php echo base_url();?>admin/member/change_pass', 
		{
			'email':$('#email').val(),
			'pass-login': $('#pass-login').val(), 
			'repass-login':$('#repass-login').val(),
			'group_id':$('#group_id').val(),
			'json':1
		},
		
		function (data){ 
			console.log('save');
			
			$('#myModal').modal('hide');
			$('#repass-login').val('');
			$('#pass-login').val('');
		}, 
		"json"
	);
	
}
</script>
<?php } ?>
