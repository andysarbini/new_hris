<?php
/**
 * @package			CMS Blank
 * @theme				Campus
 * @copyright		Single User License (Copyright 2012 - 2014)
 * @author			Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="container">
	<div class='row'>
		<div class='col-sm-4 hidden'>
			<div class="gmap">
				<?php //echo Modules::run('api/options', 'mdl_contact_maps');?>
				<img src="http://maps.googleapis.com/maps/api/staticmap?center=-6.1698693,106.8589526&zoom=13&size=420x370&scale=1&markers=size:mid%7Ccolor:red%7CCempaka_Sari_3&sensor=true_or_false">
			</div>
			<address>
				<h4><?php echo site_name(); ?></h4>
				APL Tower, Lt. 10 Unit 11 Jl. Letjen. S. Parman Cupertino, CA. <i class='fa fa-phone-square fa-fw'></i> (021) 0909 090909 <i class='fa fa-fax fa-fw'></i> (021) 0909 090909
			</address>
		</div>
		
		<div class='center-block' style='width: 640px; max-width: 86%;'>
			<div class="form-horizontal" id="contact_form">
				<div class="form-group">					
					<label class="col-sm-3 control-label" for="inputName">Name <strong class="stars red">*</strong></label>
					<div class="col-sm-6">
						<input class="form-control" type="text" id="inputName" name='name' autofocus/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="inputEmail">Email <strong class="stars red">*</strong></label>
					<div class="col-sm-6">
						<input class="form-control" type="text" id="inputEmail" name='email' />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="inputSubject">Subject</label>
					<div class="col-sm-6">
					<input class="form-control" type="text" id="inputSubject" name='subject' />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="inputMessage">Message <strong class="stars red">*</strong></label>
					<div class="col-sm-6">
						<textarea class="form-control" rows="6" id="inputMessage" name='message'></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="img_captcha">Captcha</label>
					<div class="col-sm-3">
						<div id='img_captcha' class='capthca-text'>your captcha here</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="captcha">Re-type Captcha <strong class="stars red">*</strong></label>
					<div class="col-sm-6">
						<input class="form-control" type="text" id="captcha" name='captcha' />
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
						<button class="btn btn-primary btn-sm" type="submit" onclick='send_message();'>Send</button>
						<div class="clearfix"></div>
						<div id='err_msg'></div>
					</div>
				</div>
			
			</div> <!-- /contact forms -->
		</div>
	</div>
</div>


<!-- Load jquery for maps -->
<script src="<?php echo template_js(); ?>/maps/modernizr.custom.js"></script>

<!-- Load jquery for captcha -->
<script type='text/javascript'>
$(document).ready(function() { get_captcha(); });

function get_captcha(){
	$.post(
		'<?php echo base_url();?>contact/captcha',
		{},
		function(data){
			console.log(data);
			$('#img_captcha').html(data);
		}
	);
}

function send_message(){
	var msg = cek_before_send();
	if( msg == true){
		// ok, send it
		$.post(
			'<?php echo base_url();?>contact/send',
			{ 
				name:$('#inputName').val(), 
				email:$('#inputEmail').val(),
				subjek:$('#inputSubjek').val(),
				message:$('#inputMessage').val(),
				captcha:$('#captcha').val()
			},
			function (data){
				var msg = 'message failed';
				var alert = 'alert-danger';
				if(data){
					msg = '<h4><strong>Thank You!</strong></h4><p>Your message has been sent.</p>';
					$('#inputName').val('');
					$('#inputEmail').val('');
					$('#inputSubjek').val('');
					$('#inputMessage').val('');
					$('#captcha').val('');
					
					alert = 'alert-info';
				} 
				
				get_captcha();
				
				$('#err_msg').html('<div class="alert '+alert+' fade in alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button>'+msg+'</div>');
				//$('#err_msg').html(msg);
				
			}
		);
		
	} else {
		$('#err_msg').html(msg);
	}
}

function cek_before_send(){
	if( !$('#captcha').val() ||!$('#inputName').val() || !$('#inputEmail').val() || !$('#inputMessage').val() ) return '<div class="alert alert-danger fade in alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><h4><strong>Oh snap!</strong></h4><p>Fields with asterisk should not leave empty and try submitting again.</p></div>';
	else return true;
}
</script>
