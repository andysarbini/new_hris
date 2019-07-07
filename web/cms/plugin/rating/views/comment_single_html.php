<?php 
foreach($comments as $var=>$v){ ?>
<li>
	
	<div class="media">
		<div class="media-left">
			<img src="<?php echo base_url()."uploads/profile/".$v->profile_picture;?>" width="40" class="img-circle">
		</div>
		<div class="media-body">
			<p><span class="help-block"><a href="<?php echo base_url()."profile/view/".$v->usr_id;?>"><b><?php echo $v->nama_lengkap;?></b></a> <span class="sr-only">pada <?php echo $v->tgl;?></span></span> <?php echo $v->value;?></p>
		</div>
	</div>
	
</li>
<?php } ?>
