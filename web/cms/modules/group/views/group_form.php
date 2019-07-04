<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: content
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="page-header">
	<h1>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Group
	</h1>
</div>

<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked menu-list">
			<li>
				<a class="font-2x" href='<?php echo base_url().'admin/user'?>'>User</a>
			</li>
			<li class="active">
				<a class="font-2x" href='<?php echo base_url().'admin/group'?>'>Group</a>
			</li>
			<li>
				<a class="font-2x" style='display:none' href='<?php echo base_url().'admin/contact'?>'>Contact</a>
			</li>
		</ul><!-- /content menu -->
	</div>
	<div class="col-sm-10">
		<ul class="nav nav-tabs" role="tablist" id="editor-tab">
			<li role="presentation" class="active"><a href="#detail">Detail</a></li>
			<li role="presentation"><a href="#options">Options</a></li>
		</ul>
		
		<form class='form-horizontal' role='form' method='post' action='<?php echo base_url().'admin/group/simpan';?>' enctype='multipart/form-data'>
		
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="detail">
					<div class='form-group'>
						<label class='control-label col-sm-2' for='name'>Group Name</label>
						<div class='col-sm-4'>
							<input class='form-control input-sm' type='text' name='name' id='name' value='<?php echo @if_empty($group->name, ''); ?>' placeholder='Group Name' />
							<input class='form-control input-sm' type='hidden' name='id' id='id' value='<?php echo @if_empty($group->id, 0); ?>' />
						</div>
					</div>
					<div class='form-group'>
						<label class='control-label col-sm-2' for='ket'>Description</label>
						<div class='col-sm-4'>
							<textarea class='form-control input-sm' id='ket' name='ket' placeholder='Group Description'><?php echo @if_empty($group->ket, ''); ?></textarea>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="options">
					<div class='form-group'>
						<label class='control-label col-sm-2' for='acc'>Status</label>
						<div class='col-sm-4'>
							<select name='acc' id='acc' class='form-control input-sm'>
								<?php echo gen_option_html( Modules::run('api/_active/select') , @if_empty($group->acc, 1));?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class='button-set'>
				<input type='submit' id='save' value='Save' class='btn btn-success btn-sm'/>
				<a class='btn btn-default btn-sm' href='<?php echo base_url().'admin/group';?>'>Cancel</a>
				<?php if(@if_empty($group->id, false)) { ?><a id='btn-delete-user-group' class='btn btn-link btn-cancel btn-sm pull-right' href='<?php echo base_url().'group/admin/hapus/'.$group->id;?>'><i class='fa fa-trash-o'></i> Delete</a><?php } ?>
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
	
	$('#btn-delete-user-group').on('click', function () {
        return confirm('Are you sure want to delete this user group?');
		});
	
});
</script>
