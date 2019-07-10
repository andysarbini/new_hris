<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.7
*
-->

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Inconis <?php echo @if_empty($title,'Hello'); ?></title>
	
	<link href="<?php echo template_dir(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo template_dir(); ?>css/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo template_dir(); ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo template_dir(); ?>css/style.css" rel="stylesheet">



    <!-- Toastr style -->
	<link href="<?php echo template_dir(); ?>css/toastr/toastr.min.css" rel="stylesheet">
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
	<link href="<?php echo template_dir(); ?>js/assets/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="js/assets/gritter/jquery.gritter.css" rel="stylesheet"> 







</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
		<?php echo Modules::run('navigation/generate_menu_array2', "dashboard-side-menu", 'sidebar'); ?>
		<!-- Navigation -->
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="<?php echo base_url()."logout"?>">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>
        </div>
		<div class="wrapper wrapper-content">
		<?php if(@if_empty($title)) { ?>
		<div class="page-header">
		
				<?php if(@if_empty($label) && ($label == "Forum")): ?>
				<div class="button-set pull-right">
				<a href="<?php echo base_url(); ?>birdbagi-forum/mypost" class="btn btn-default">POSTINGAN SAYA</a>
				<a data-toggle="modal" data-target="#modal_category_forum" class="btn btn-default">POSTING DISKUSI BARU</a>
				</div>
				<?php endif; ?>
				<?php if(@if_empty($label) && ($label == "BBLearning" || $label == "Gallery")): ?>
				<div class="button-set pull-right form-group col-lg-3" style="padding-right:0px;">
				<form>
				<input class="form-control" type="text" name="keywords" placeholder="Enter Kata Pencarian..." style="height:35px;" value="<?php if(@if_empty($original_keywords)){ echo $original_keywords; }?>" />
				</form>
				</div>
				<?php endif; ?>
				<h2><?php echo $title;?></h2>
				<?php if(@if_empty($description)): ?>
					<p class="lead"><?php echo $description;?></p>
				<?php endif ?>	
				<?php if(@if_empty($content)): ?>
				<div class="help-block">Ditulis oleh <a href=""><b><?php echo $content->USR_NAME_INPUT;?></b></a> pada DD-MM-YYYY dalam <span><?php echo "<a href='".base_url()."dashboard/categories/".$content->CAT_URI."'>".$content->CAT_TITLE."</a>";?></span></div>
				<?php endif; ?>
			</div>
		<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        
        <ol class="breadcrumb">
		<mp:Breadcrumb />
        </ol>
    </div>
</div>
<?php } ?>
		<mp:Contentmain />
		</div>           
		<div class="footer">
                    <div class="pull-right">
                        10GB of <strong>250GB</strong> Free.
                    </div>
                    <div>
                        <strong>Copyright</strong> Example Company &copy; 2014-2017
                    </div>
                </div>
    <!-- Mainly scripts -->
    <script src="<?php echo template_js(); ?>/jquery-3.1.1.min.js"></script>
    <script src="<?php echo template_js(); ?>/bootstrap.min.js"></script>
    <script src="<?php echo template_js(); ?>/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo template_js(); ?>/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>



    <!-- Peity -->
    <script src="<?php echo template_js(); ?>/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo template_js(); ?>/demo/peity-demo.js"></script>
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo template_js(); ?>/inspinia.js"></script>
    <script src="<?php echo template_js(); ?>/plugins/pace/pace.min.js"></script>
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo template_js(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

       <!-- Toastr -->
    <script src="<?php echo template_js(); ?>/plugins/toastr/toastr.min.js"></script>
    <script src="js/plugins/toastr/toastr.min.js"></script>

	<?php echo @if_empty($include_script,''); ?>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                


            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [300,50,100],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [70,27,85],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });
    </script>
</body>
</html>
