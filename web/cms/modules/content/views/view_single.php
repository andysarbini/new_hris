this is kampret

<?php if(isset($content->title)) { ?>
<h2 class="heading"><?php echo $content->title; ?></h2>

<div class='article-info'>
	<p>By <strong><?php echo $content->author ?></strong><br>Published <?php $bln = array('January','February', 'March','April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');list($tgl, $jam) = explode(' ',$content->tgl); $tgl = explode('-',$tgl); $jam = explode(':', $jam); echo $tgl[2].' '.$bln[(int)$tgl[1]].' '.$tgl[0]. ' '.$jam[0].':'.$jam[1];?></p>
</div>

<div class='article-body'><?php 

echo $content->content;


?></div>

<ul class="pager">
<?php 
	
	if(isset($_prev)) echo '<li class="previous"><a href="'.$_prev.'"><i class="icon-arrow-left"></i> Prev</a></li>';
	
	if(isset($_back)) echo '<li><a href="' . $_back.'"><i class="icon-home"></i> Back</a></li>';

	if(isset($_next)) echo '<li class="next"><a href="'.$_next.'">Next <i class="icon-arrow-right"></i></a></li>';
?>
</ul>

<?php
 } else { ?>

<div class="lead"><a href='<?php echo base_url();?>'>Not Found</a></div>

<?php } ?>
