<?php //dump($qa); exit();
/*
Dump => array(1) {
  [0] => object(stdClass)#23 (9) {
    ["post_id"] => string(2) "99"
    ["post_title"] => string(26) "Cheerson CX-30 User manual"
    ["post_uri"] => string(26) "cheerson-cx-30-user-manual"
    ["post_title_short"] => string(0) ""
    ["post_feature_image"] => string(0) ""
    ["post_description"] => string(22) "bb learning content 01"
    ["usr_name_input"] => string(5) "admin"
    ["post_input_date"] => string(19) "2018-04-10 09:53:22"
    ["cat_title"] => string(11) "BB Learning"
  }
}
/**/
?>

<div class="form-group">
	<label for="email">Status</label>
	<select class="form-control"  name="slc_status" id="slc_status">
		<option value="open">open</option>
		<option value="close">close</option>
	</select>
</div>
<button onclick="show_by_status();" class="btn btn-default">Show</button>


<?php if(count($qa)){ ?>
	
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="fa fa-bullhorn fa-lg text-info"></span> Pertanyaan Anda</h4>
	</div>

	<div class="panel-body">
		<?php 
		foreach( $qa as $var=>$v ){  
			$_url_news = base_url()."qa/admin/view/".$v->qa_id; 
		?>
		<div class="media">
			<div class="media-left">
				<a href="<?php echo $_url_news?>">
				<img class="media-object thumbnail" src="<?php echo base_url()."uploads/profile/".$v->profile_picture; ?>" alt="" width="75">
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><a href="<?php echo $_url_news;?>"><?php echo $v->subjek;?></a></h4>
				<p><?php echo $v->ask;?></p>
				<div class="help-block"><?php echo bluehrd_tgl($v->qa_date);?> status:<?php $v->status;?></div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<?php } else { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="fa fa-bullhorn fa-lg text-info"></span> Tidak ada pertanyaan</h4>
	</div>
</div>

<?php } ?>


