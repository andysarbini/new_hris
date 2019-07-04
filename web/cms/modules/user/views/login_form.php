<?php
/**
 * @package		CMS Blank
 * @subpackage	admin (default) -login
 * @author		Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="row">
	<div class="col-sm-4 col-sm-push-4 logo">
		<img class="img-responsive" src="<?php echo template_img(); ?>/site-logo.png" alt="RESKA">
	</div>
</div>
<h1 class='text-center'>RESKA</h1>
<p class='lead text-center'><span class='font-3x font-weight-4x'>S</span>ervice <span class='font-3x font-weight-4x'>U</span>sage &amp; pe<span class='font-3x font-weight-4x'>R</span>f<span class='font-3x font-weight-4x'>O</span>rmance re<span class='font-3x font-weight-4x'>P</span>orting &amp; <span class='font-3x font-weight-4x'>A</span>naly<span class='font-3x font-weight-4x'>T</span>ical su<span class='font-3x font-weight-4x'>I</span>te</p>

<?php if( isset($error) ) { ?>
	<p class="text-danger text-center"><i class="fa fa-exclamation-triangle"></i> Check your username or email and password.</p>
<?php	} ?>


<div class="login-form text-center">
	<form method="POST" class="form">
		<div class="form-group">
			<label class="control-label sr-only" for="email">Username</label>
			<input type="text" class="form-control input-lg" name="email" placeholder="Username or Email" autofocus autocomplete="email" >
		</div>
		<div class="form-group">
			<label class="control-label sr-only" for="password">Password</label>
			<input type="password" class="form-control input-lg" name="password" placeholder="Password">
		</div>
		<div class="form-group captcha">
			<label class="control-label col-md-6" for="captcha"><img src='<?php echo base_url().'captcha';?>' alt='captcha'></label>
			<input type="text" class="form-control input-lg col-md-6" name="captcha" placeholder='Captcha'>
		</div>
		<div class="form-group">
			<input type="submit" value="Login" name="submit" class="btn btn-lg btn-success">
		</div>
	</form>
</div>
