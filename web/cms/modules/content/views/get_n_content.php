<h3>Latest Blog</h3>
<ul>
<?php 
if(count($content_n)) {
	
	$_url = full_url();
	
	// news-events page 
	
	if( ! $this->uri->segment(2) && ! $this->uri->segment(3)) // http://192.168.0.120/hmvc_rafa/news-events
		$_url_n = $_url .'/1/';
	
	elseif( ! $this->uri->segment(3)) // http://192.168.0.120/hmvc_rafa/news-events/2/nama-nisi
		$_url_n = $_url .'/';
		
	else // http://192.168.0.120/hmvc_rafa/news-events/2/nama-nisi
		$_url_n = str_replace($this->uri->segment(3),'',$_url);
	
	foreach($content_n as $t) echo "<li><a href='".$_url_n.$t->uri."'>". $t->title ."</a></li>";
}
?>
</ul>
