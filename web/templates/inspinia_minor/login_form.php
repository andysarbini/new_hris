kdldkaldk
<div class="row">
	<div class="col-md-4 login-panel">
		<div class="panel">
			
			<div class="panel-body">
			
				<form role="form" method="POST">
					<fieldset>
						<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="Username or Email" autofocus autocomplete="email" >
						</div>
						<div class="form-group">
						<input type="password" class="form-control input-lg" name="password" placeholder="Password">
						</div>
						<!-- Change this to a button or input when using this as a form -->
						<input type="submit" value="Login" name="submit" class="btn btn-lg btn-warning btn-block">
					</fieldset>
				</form>
	<?php if( isset($error) ) { ?>
	<p class="text-danger text-center"><i class="fa fa-exclamation-triangle"></i> Check your username password.</p>
	<?php	} ?>

			</div>
		</div>
	</div>
</div>
