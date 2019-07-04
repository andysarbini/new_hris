<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: contact
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="page-header">
	<h2>
	<i class="fa fa-envelope-o"></i> Contact
	<small>&mdash; Contact Module</small>
	</h2>
</div>

<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked menu-list">
			<li>
				<a class="font-2x" href='<?php echo base_url().'admin/user'?>'>User</a>
			</li>
			<li>
				<a class="font-2x" href='<?php echo base_url().'admin/group'?>'>User Group</a>
			</li>
			<li class="active">
				<a class="font-2x" href='<?php echo base_url().'admin/contact'?>'>Contact</a>
			</li>
		</ul><!-- /content menu -->
	</div>
	<div class="col-sm-10">
		<ul class="nav nav-tabs" role="tablist" id="editor-tab">
			<li role="presentation" class="active"><a href="#detail">Detail</a></li>
			<li role="presentation"><a href="#contactform">Contact Form</a></li>
			<li role="presentation"><a href="#googlemap">Google Map</a></li>
		</ul>
		
		<form class='form-horizontal' role='form' method='post' action='<?php echo base_url().'admin/'.$module.'/simpan';?>' >
		
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="detail">
					<div class="form-group">
						<label class='control-label col-sm-2' for='email'>Email To</label>
						<div class='col-sm-4'>
							<input class='form-control input-sm' type='text' id='email'  name='email' value='<?php echo @if_empty($email,'');?>' />
						</div>
					</div>
					<div class="form-group">
						<label class='control-label col-sm-2' for='subject'>Email Subject</label>
						<div class='col-sm-4'>
							<input class='form-control input-sm' type='text' id='subject'  name='subject' value='<?php echo @if_empty($subject,'');?>' />
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="contactform">
					<!-- Disini layout contact form tolong buatkan fungsi -->
					<div class="form-group">
						<label class='col-sm-2 control-label' for='active'>Enable</label>
						<div class='col-sm-4'>
							<select name='active' id='active' class='form-control input-sm'>
								<?php
									$boolean = Modules::run('api/options','opt_boolean');
									echo gen_option_html($boolean, @if_empty($state->active, 1) );
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class='control-label col-sm-2' for='email_name'>Name field</label>
						<div class='col-sm-1'>
							<div class="radio">
								<label>
									<input type="radio" name="email_name" id="option_yes" value="Yes" checked> Yes
								</label>
							</div>
						</div>
						<div class='col-sm-1'>
							<div class="radio">
								<label>
									<input type="radio" name="email_name" id="option_no" value="No"> No
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class='control-label col-sm-2' for='email_address'>Email field</label>
						<div class='col-sm-1'>
							<div class="radio">
								<label>
									<input type="radio" name="email_address" id="option_yes" value="Yes" checked> Yes
								</label>
							</div>
						</div>
						<div class='col-sm-1'>
							<div class="radio">
								<label>
									<input type="radio" name="email_address" id="option_no" value="No"> No
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class='control-label col-sm-2' for='email_message'>Message field</label>
						<div class='col-sm-1'>
							<div class="radio">
								<label>
									<input type="radio" name="email_message" id="option_yes" value="Yes" checked> Yes
								</label>
							</div>
						</div>
						<div class='col-sm-1'>
							<div class="radio">
								<label>
									<input type="radio" name="email_message" id="option_no" value="No"> No
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class='control-label col-sm-2' for='email_address_web'>Address field</label>
						<div class='col-sm-1'>
							<div class="radio">
								<label>
									<input type="radio" name="email_address_web" id="option_yes" value="Yes" checked> Yes
								</label>
							</div>
						</div>
						<div class='col-sm-1'>
							<div class="radio">
								<label>
									<input type="radio" name="email_name" id="option_no" value="No"> No
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class='control-label col-sm-2' for='email_address_text'>Address Text</label>
						<div class='col-sm-4'>
							<textarea class="form-control input-sm" name="email_address_text" id="email_address_text" rows="6"></textarea>
						</div>
					</div>
				</div>
					<!-- Google map perlu revisi -->
				<div role="tabpanel" class="tab-pane fade" id="googlemap">
					<div class="form-group">
						<label class='control-label col-sm-2' for='maps'>Embed Code</label>
						<div class='col-sm-10'>
							<textarea class='form-control input-sm' name='maps' id='maps' rows=6 ><?php echo @if_empty($maps,'');?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class='button-set'>
				<input class='btn btn-success btn-sm' id="save" type='submit' name='submit' value='Save' />
				<a class='btn btn-default btn-sm' href='<?php echo base_url().'admin/'.$module;?>'>Cancel</a>
			</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		
		$('#editor-tab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		})
		
	});
</script>
