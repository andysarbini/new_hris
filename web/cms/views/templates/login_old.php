<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login Dashboard</title>

    <!-- Bootstrap -->
    <!-- <link rel='stylesheet/less' type='text/css' href='css/template.less'> -->
    <link rel='stylesheet' type='text/css' href='<?php echo template_css(); ?>/template.css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <script> 
      var base_url = "<?php echo base_url();?>";
	  </script>
  </head>
  <body class="landing">

	<mp:Contentmain />

    <script src="<?php echo template_js(); ?>/assets/jquery-3.1.0.min.js"></script>
    <script src="<?php echo template_js(); ?>/assets/bootstrap.min.js"></script>
    <!-- <script src='js/assets/less-1.7.0.min.js'></script> -->
  </body>
</html>