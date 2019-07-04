	<div class='container' id='gallery<?php //echo @end($_uri);?>'>
		<div class="row-fluid" style='padding-bottom:60px'>
			
			<h1 class='page-title text-center margin-bottom-20' style='position:relative;background:none;animation:text-animation-top 1s;-webkit-animation:text-animation-top 700ms;-moz-animation:text-animation-top 1s;' id='h1-main-title'>
				<?php echo $pages->title;?>
			</h1>
			
			<div class='content-center'>
				<?php echo Shortcodes::parse($pages->content);?>
			</div>
		</div>
		<p class="text-center back-button"><a onclick='window.history.back();'><img src='<?php echo template_img().'/company-button.png';?>'/> <strong>Back</strong></a></p>
		
	</div>

<script type='text/javascript'>
	
//$(document).ready(function(){ document.title = <?php echo $pages->uri;?>; console.log('xxx xxx');});

$(document).ready(function(){
	
	//document.title = '<?php echo $pages->title;?>';
	//window.history.pushState({},"", '<?php session_start();echo base_url().if_empty($_SESSION['gallery_type'], 'content').'/'.$pages->uri;?>');
});
</script>
