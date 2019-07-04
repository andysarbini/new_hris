<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HRIS | <?php echo @if_empty($title, 'Welcome');?></title>

    <link href="<?php echo template_dir(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo template_dir(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo template_dir(); ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo template_dir(); ?>css/style.css" rel="stylesheet">

</head>

<body>

<div id="wrapper">

    <?php include_once('navigation.php');?>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?php include_once('navigation_top.php');?>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <mp:Contentmain />
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo template_dir(); ?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo template_dir(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo template_dir(); ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo template_dir(); ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo template_dir(); ?>js/inspinia.js"></script>
<script src="<?php echo template_dir(); ?>js/plugins/pace/pace.min.js"></script>


</body>

</html>
