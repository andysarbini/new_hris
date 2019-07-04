<div class='container text-center'>
<label>Input Email</label>
<input type='text' placeholder='Your Login Mail' id='email'/>
<button class='btn btn-sm' id='btn-recovery'><span class="glyphicon glyphicon-envelope"></span></button>

<div id='msg'></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#btn-recovery').click(function(){
	$.post('<?php echo $url_key;?>', {email:$('#email').val()},function(data){
		var m='';
		if(parseInt(data)){ m = 'Email recovery has sent to your email';}
		else{m = 'Error try againt later';}
		$('#msg').html(m);
	});});
});
</script>