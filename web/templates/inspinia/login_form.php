<form role="form" method="POST">
<?php if( isset($error) ) { ?>
	<div class="alert alert-danger" role="alert">
		<p class="text-danger text-center"><i class="fa fa-exclamation-triangle"></i> Check your username password.</p>
	</div>
	<?php	} ?>
					<fieldset>
						<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="Email / Username" autofocus autocomplete="email" required>
						</div>
						<div class="form-group">
						<input type="password" class="form-control input-lg" name="password" placeholder="Password" required>
						</div>
						<!-- Change this to a button or input when using this as a form -->
						<input type="submit" value="Login" name="submit" class="btn btn-primary block full-width m-b">
					</fieldset>
</form>