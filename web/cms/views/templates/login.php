<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Dashboard</title>

    
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

                <h1 class="logo-name">IN+</h1>

            </div>
            <h3>Welcome to IN+</h3>
            <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
			
            <mp:Contentmain />
			
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
	<script src="<?php echo template_js(); ?>/jquery-3.1.1.min.js"></script>
    <script src="<?php echo template_js(); ?>/bootstrap.min.js"></script>

</body>

</html>
