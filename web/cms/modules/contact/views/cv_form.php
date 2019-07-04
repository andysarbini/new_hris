<form action='<?php echo base_url();?>contact/sendcv' method='post' enctype='multipart/form-data'>
<div id="contact_form">
	  <div class="control-group">
		<div class="controls">
		  <input class="span6" type="text" id="inputName" name='name' placeholder='Name'/>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input class="span6" type="text" id="inputEmail" name='email' placeholder='Email'/>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <textarea class="span6" rows="4" id="inputMessage" name='message' placeholder='Message'></textarea>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type='file' name='cv' id='inputCv' placeholder='Attach Your CV' /> 
		  <br />we only accept .doc, .docx, .pdf, odt file, and size not more than 5MB
		</div>
	  </div>
	  
	  <hr>
	  <div class="control-group text-center">
		<div class="controls">
		  <input type='submit' value='Send' class='btn bnt-large'/>
		<div id='err_msg' class="stars text-red"></div>
		</div>
	  </div>
</div>

</form>

<?php 
$ci =& get_instance();
if(@$ci->session->userdata('send_cv_success')) { ?>
<div>Thanks your cv was sending</div>
<?php 
	$ci->session->set_userdata('send_cv_success',0);
} ?>
<!-- Load jquery for captcha 
<script type='text/javascript'>

function send_message(){
	var msg = cek_before_send();
	
	if( msg === true){
		// ok, send it
		$.post(
			'<?php echo base_url();?>contact/sendcv',
			{ 
				first_name:$('#firstName').val(), 
				last_name:$('#lastName').val(), 
				email:$('#inputEmail').val(),
				city_town:$('#cityTown').val(),
				education:$('#inputEducation').val(),
				phone:$('#inputPhone').val(),
			},
			function (data){
				var msg = 'message failed';
				var alert = 'alert-error';
				if(data){
					msg = '<h4><strong>Thank You!</strong></h4><p>Your CV has been sent.</p>';
					$('#firstName').val('');
					$('#lastName').val('');
					$('#cityTown').val('');
					$('#inputEducation').val('');
					$('#inputEmail').val('');
					$('#inputPhone').val('');
					
					alert = 'alert-success';
				} 
				
				$('#err_msg').html('<div class="alert '+alert+' margin-top-40"><button type="button" class="close" data-dismiss="alert">&times;</button>'+msg+'</div>');
				//$('#err_msg').html(msg);
				
			}
		);
		
	} else {
		$('#err_msg').html('<div class="alert alert-error margin-top-40"><button type="button" class="close" data-dismiss="alert">&times;</button><h4><strong>Oh snap!</strong></h4><p>Fields with asterisk should not leave empty and try submitting again.</p></div>');
	}
	
}

function cek_before_send(){
	if( ! $('#firstName').val() || ! $('#inputEmail').val() || ! $('#inputAccept').val() || ! $('#inputEducation').val() ) 
	return false;
	else return true;
}
</script>
-->
