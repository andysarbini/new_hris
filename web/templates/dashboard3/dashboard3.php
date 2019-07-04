<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="format-detection" content="telephone=no">

  <title><?php echo @if_empty($page_title, "Dashboard");?></title>

  <!-- Mapbox Dependencies
  <link href='https://api.tiles.mapbox.com/mapbox.js/v2.0.0/mapbox.css' rel='stylesheet' />
  <script type="text/javascript" src='https://api.tiles.mapbox.com/mapbox.js/v2.0.0/mapbox.js'></script>
  <script type="text/javascript" src='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-heat/v0.1.0/leaflet-heat.js'></script> -->

  <!-- Demo Dependencies -->
  <script> function base_url() { return "<?php echo base_url();?>" }; </script>
  <script src="<?php echo template_dir(); ?>asset/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo template_dir(); ?>asset/jquery.knob.min.js" type="text/javascript"></script>
  <script src="<?php echo template_dir(); ?>asset/bootstrap.min.js" type="text/javascript"></script>
  <link href="<?php echo template_dir(); ?>asset/bootstrap.min.css" rel="stylesheet" type="text/css" />

  <!-- keen-analysis@1.2.2  - ->
  <script src="https://d26b395fwzu5fz.cloudfront.net/keen-analysis-1.2.2.js" type="text/javascript"></script>

  <!-- keen-dataviz@1.1.3 - ->
  <link href="https://d26b395fwzu5fz.cloudfront.net/keen-dataviz-1.1.3.css" rel="stylesheet" />
  <script src="https://d26b395fwzu5fz.cloudfront.net/keen-dataviz-1.1.3.js" type="text/javascript"></script>

  <!-- Dashboard -->
  <link rel="stylesheet" type="text/css" href="<?php echo template_dir(); ?>keen/keen-dashboards.css" />
  <?php echo @if_empty($include_script,''); ?>

  <style>
    html, body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      background-color: #f9f9f9;
      font-weight: 400;
      color: #333;
    }
    a {
      color: #55acee;
      transition: 300ms ease-in;
      cursor: pointer;
    }
    .btn {
      transition: 300ms ease-in;
    }
    a:hover,
    a:focus {
      color: #40c4ff;
    }
    #mainContent  {
      margin-top: 100px;
    }
    .navbar-default {
      min-height: 60px;
      background-color: #fff;
      padding-top: 10px;
      padding-bottom: 10px;
      box-shadow: 0 6px 24px -6px rgba(0, 0, 0, .14);
    }
    .dashboard-panels {
      margin-top: 5%;
    }
    .dashboard-panels .panel {
      position: relative;
      margin: 20px 0;
      min-height: 140px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, .14);
    }
    .dashboard-panels .panel-info {
      background-color: #55acee;
      color: #e1f5fe;
    }
    .dashboard-panels a .panel-info h3 {
      color: #fff;
    }
    .dashboard-panels a:hover,
    .dashboard-panels a:hover .panel-info {
      text-decoration: none;
    }
    .dashboard-panels .panel::before,
    .dashboard-panels .panel::after {
      position: absolute;
      content: '';
      background-color: rgba(0, 0, 0, .014);
      width: 0;
      height: 0;
      transition: all 300ms ease-out;
    }
    .dashboard-panels .panel::before {
      top: 0;
      left: 0;
    }
    .dashboard-panels .panel::after {
      bottom: 0;
      right: 0;
    }
    .dashboard-panels a:hover .panel::before,
    .dashboard-panels a:hover .panel::after{
      width: 100%;
      height: 100%;
    }
    .dashboard-panels a:hover .panel-info .icon > img {
      -webkit-filter: grayscale(100%);
      filter: grayscale(100%);
    }
    .dashboard-panels .panel h3 {
      position: relative;
      z-index: 5;
      margin-top: 30%;
      margin-bottom: 40px;
      line-height: 1.6;
    }
    .dashboard-panels .panel-info .icon {
      width: 120px;
      height: 120px;
      margin: 0 auto;
      padding: 30px;
      background-color: #fff;
      border: 1px solid #55acee;
      position: absolute;
      z-index: 5;
      left: 0;
      right: 0;
      border-radius: 50%;
      top: -40px;
    }
    .dashboard-panels .panel-info .icon > img {
      width: 100%;
      display: inline-block;
      opacity: .7;
    }
    .navbar-default .brand {
      font-weight: 600;
      font-size: 17px;
      position: absolute;
      width: 440px;
      text-align: center;
      right: 0;
      left: 0;
      top: 15px;
      margin-left: auto;
      margin-right: auto;
    }
    .navbar-default .brand a {
      color: #55acee;
    }
    .navbar-right .form-control {
      width: 140px;
    }
    .dashboard-tab {
      margin-top: 20px;
      margin-bottom: 20px;
    }
    .dashboard-tab .nav-tabs li a {
      color: #b0b0b0;
      background-color: #eee;
      box-shadow: inset 0 -3px 6px rgba(0, 0, 0, .024);
    }
    .dashboard-tab .nav-tabs li.active a {
      background-color: #55acee;
      color: #fff;
      border-left-color: #55acee;
      border-top-color: #55acee;
      border-right-color: #55acee;
      border-bottom-color: transparent;
      box-shadow: none;
    }
    .dashboard-tab .nav-tabs {
      border-bottom-color: #eee;
    }
    .dashboard-tab .nav-tabs > li > a {
      margin-right: 5px;
    }
    .btn-default {
      background-color: #55acee;
      color: #fff;
    }
    .btn-default:hover,
    .btn-default:focus,
    .btn-default:active {
      background-color: #40c4ff;
      color: #fff;
    }
    .tab-content {
      padding-top: 20px;
      padding-bottom: 20px;
    }
    .dashboard-tab .nav-tabs li a {
      font-size: 17px;
      font-weight: 600;
    }
    .chart-wrapper {
      background-color: #fff;
      border-radius: 4px;
      border: 1px solid #eee;
      margin-bottom: 30px;
    }
    .chart-wrapper .table {
      margin-bottom: 0;
    }
    .chart-wrapper .table-condensed {
      width: 100%;
    }
    .chart-wrapper .table-bordered {
      border: 0;
    }
    .chart-wrapper .table-hover > tbody > tr:hover > td {
      background-color: #ffc;
    }
    .chart-wrapper .table > thead > tr > th,
    .chart-wrapper .table > tbody > tr > td,
    .chart-wrapper .table > tbody > tr > th,
    .chart-wrapper .table > tfoot > tr > td,
    .chart-wrapper .table > tfoot > tr > th {
      border-color: #eee;
    }

    .chart-wrapper .table > tbody > tr > td,
    .chart-wrapper .table-condensed > thead > tr > th,
    .chart-wrapper .table-condensed > tbody > tr > td,
    .chart-wrapper .table-condensed > tbody > tr > th,
    .chart-wrapper .table-condensed > tfoot > tr > td,
    .chart-wrapper .table-condensed > tfoot > tr > th,
    .chart-title,
    .chart-notes {
      vertical-align: middle;
      padding: 4px 14px;
    }
    .chart-wrapper .table-lg > tbody > tr > td {
      padding-top: 30px;
      padding-bottom: 30px;
    }
    .chart-wrapper .table > tbody > tr > td h1 {
      margin: 0;
    }
    
    .chart-title {
      text-align: center;
      padding-top: 12px;
      padding-bottom: 20px;
      color: #b0b0b0;
      font-size: 17px;
      font-weight: 600;
    }
    .chart-wrapper .table-condensed > thead > tr > th {
      border-left: 0;
      border-right: 0;
      font-size: 12px;
    }
    .chart-notes {
      text-transform: uppercase;
      padding-bottom: 12px;
      text-align: right;
      font-size: 10px;
      letter-spacing: 2px;
      color: #b0b0b0;
    }
    .chart-wrapper .table-bordered > tbody > tr > td:first-child,
    .chart-wrapper .table-bordered > thead > tr > th:first-child,
    .chart-wrapper .table-bordered > tbody > tr > th:first-child,
    .chart-wrapper .table-condensed > tfoot > tr > th:first-child {
      border-left-color: transparent;
    }
    .chart-wrapper .table-bordered > tbody > tr > td:last-child,
    .chart-wrapper .table-bordered > thead > tr > th:last-child,
    .chart-wrapper .table-bordered > tbody > tr > th:last-child,
    .chart-wrapper .table-condensed > tfoot > tr > th:last-child {
      border-right-color: transparent;
    }
    .text-primary {
      color: #b0b0b0;
    }
  </style>

</head>
<body>

  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!--a class="navbar-brand" href="../">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a-->
      </div>
      <div class="navbar-collapse collapse">
        
        <!-- Custom page posisi center absolute -->
        <div class="brand">
          <a href="./"><?php echo $page_title;?></a>
        </div>
        
        <div class="row">

          <!-- Login/Logout button -->
          <div class="col-md-3">
            <a href="<?php echo base_url()."logout";?>" class="btn btn-danger">Logout</a>
          </div>
          
          <!-- Others -->
          <?php echo @if_empty($page_param, '');?>

        </div>
      </div>
    </div>
  </div>



	<div class="container-fluid" id="mainContent">
    <div class="row">

      <?php // echo @if_empty($sidebar,''); ?>
      
      <mp:Contentmain />

    </div>
	</div>
</body>
</html>
