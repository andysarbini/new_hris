<style>

</style>
<?php  foreach($content as $n){ 
		$num = !is_numeric( $this->uri->segment(2) ) ? '1/':'';
		$url = full_url().'/'.$num.$n->uri;
	?>
	<div class='notif-thumb clearfix'>
		<div class='lead'><a href='<?php echo $url;?>'><?php echo $n->title;?></a></div>
<?php 
	if($img = content_get_first_img($n->content)){
		 $e_img = explode('/', $img);
		 $img =  base_url().'uploads/.thumbs/images/'.end($e_img);
		 echo '<img class="span1" src="'.$img.'"/>';
	}
	
?>
		<div class='notif-content' pid='<?php echo $n->id;?>'><?php echo content_get_readmore($n->content);?>
		<a class='btn btn-small btn-info' href='<?php echo $url?>'>[more]</a></div>
	</div>
<?php } ?> 
<div class="pagination">
<ul>
<?php /* pages section */
	echo $paging;
?>
</ul>
</div>
