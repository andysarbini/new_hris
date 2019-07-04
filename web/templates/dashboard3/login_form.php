<style>
	.login-panel {
		color: #fff;
		position: absolute;
		z-index: 1;
		left: 0;
		top: 0;
		bottom: 0;
		height: 100%;
		padding-top: 10%;
		padding-left: 30px;
		padding-right: 30px;
		background-image: linear-gradient(to bottom right, #55acee, #6200ea);
		box-shadow: 8px 0 24px rgba(0, 0, 0, .24);
	}
	.row:before {
		position: absolute;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		width: 100%;
		height: 100%;
		z-index: 0;
		display: block;
		content: ' ';
		background-image: url('templates/dashboard3/img/map.png') !important;
		background-repeat: no-repeat;
		background-position: 100% 50%;
		background-size: 68%
	}
	.panel {
		background-color: transparent;
	}
	.form-control {
		padding-top: 24px;
		padding-bottom: 24px;
		margin-bottom: 20px;
	}
	.logo img {
		display: block;
		margin: 0 auto;
	}
	.form-control,
	.btn-lg {
		border-radius: 4px;
		font-size: 14px;
	}
	.btn {
		margin-top: 40px;
		box-shadow: 0 6px 14px -6px rgba(0, 0, 0, .24);
		transition: 300ms ease-out;
		text-transform: uppercase;
		letter-spacing: 4px;
		padding-top: 14px;
		padding-bottom: 14px;
	}
	.btn:hover,
	.btn:focus {
		box-shadow: none;
	}
</style>
<div class="row">
	<div class="col-md-4 login-panel">
		<div class="panel">
			<div class="panel-heading logo">
				<img class="img-responsive" src="<?php echo template_img(); ?>/capil.png" alt="Minduk">
			</div>
			<div class="panel-body">
				<form role="form" method="POST">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="E-mail" name="email" type="text" autofocus>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password" name="password" type="password" value="">
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
