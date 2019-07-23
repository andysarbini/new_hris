<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" class="js-site-favicon" href="inconis.png">

    <title>Login Applikasi</title>

    
	<!-- Bootstrap -->
    <link rel='stylesheet' type='text/css' href='<?php echo template_css(); ?>/font-awesome/css/font-awesome.css'>
    <link rel='stylesheet' type='text/css' href='<?php echo template_css(); ?>/bootstrap.min.css'>
	<link rel='stylesheet' type='text/css' href='<?php echo template_css(); ?>/animate.css'>
	<link rel='stylesheet' type='text/css' href='<?php echo template_css(); ?>/style.css'>
<script> 
      var base_url = "<?php echo base_url();?>";
</script>

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><img src="inconis.png"></h1>

            </div>
            <h3>Applikasi Absensi</h3>
            <p>Project Telkom Akses.</p>
            
			
            <mp:Contentmain />
			<p class="text-muted text-center"><small>Belum Punya Akun ?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Buat Akun Sekarang.</a>
            <p class="m-t"> <small>Smartelco Apps &copy; 2019</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
	<script src="<?php echo template_js(); ?>/jquery-3.1.1.min.js"></script>
    <script src="<?php echo template_js(); ?>/bootstrap.min.js"></script>
    <script src="<?php echo template_js(); ?>/alert-login.js"></script>

</body>

</html>
