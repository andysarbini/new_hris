<?php
//	dump($qa);
/*
Dump => object(stdClass)#22 (22) {
  ["qa_id"] => string(1) "1"
  ["subjek"] => string(47) "Bagaimana Saya menjadi seorang driver yang baik"
  ["ask"] => string(134) "bagaimana saya menjadi seorang driver yang baik terhadap costumer, apakah saya mengajaknya ngobrol, atau saya biarkan mereka melamun ?"
  ["status"] => string(4) "open"
  ["qa_date"] => string(19) "2018-04-16 23:29:28"
  ["usr_id"] => string(1) "4"
  ["nip"] => string(6) "321456"
  ["nama_lengkap"] => string(13) "savira savira"
  ["tgl_lahir"] => string(10) "1988-04-27"
  ["posisi"] => string(16) "HR Asst. Manager"
  ["atasan"] => string(5) "Staff"
  ["tgl_masuk"] => string(10) "2018-01-02"
  ["company"] => string(13) "Blue Bird Tbk"
  ["tipe_karyawan"] => string(9) "Permanent"
  ["jabatan"] => string(16) "Departement Head"
  ["grade"] => string(1) "1"
  ["level"] => string(1) "1"
  ["cost_ctr"] => string(7) "HOBASIT"
  ["pool"] => string(2) "HO"
  ["status_karyawan"] => string(5) "Tetap"
  ["email_corporate"] => string(15) "savira@mail.com"
  ["profile_picture"] => string(36) "a2871792b0758f2773b09942fcb2afaa.jpg"
}*/
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4>
			<span class="fa fa-bullhorn fa-lg text-info"></span> 
			<a href="<?php echo base_url()."qa" ;?>" >Bantuan / Pertanyaan</a> &gt;&gt; <?php echo $qa->subjek;?></b>
		</h4>
	</div>
	<div class="panel-body">
		<?php echo $qa->ask;?>
	</div>
	<div class="panel-footer">
		status: <span class="btn-<?php echo $qa->status == "open" ? "info" : "link" ;?>"><?php echo $qa->status;?></span>
		<?php echo bluehrd_tgl($qa->qa_date);?>
	</div>
</div>

<?php 
if(count($ans)){
	//dump($ans);
	foreach($ans as $var=>$val){
		 $_url_news = base_url()."profile/view/".$val->usr_id;
?>
<div class="panel panel-default">
	<div class="media">
		<div class="panel-body">
			<div class="media-left">
				<a href="<?php echo $_url_news;?>">
					<img class="media-object thumbnail" src="<?php echo base_url()."uploads/profile/".@if_empty($val->profile_picture, 'no-avatar.png'); ?>" alt="" width="75">
				</a>
			</div>
			<div class="media-body">
				<?php echo $val->answer;?>
			</div>
			<div class="panel-footer">
				<span><?php echo bluehrd_tgl($val->date_log);?></span>
			</div>
		</div>
		
	</div>
</div>
<?php 
}}
?>



<?php if($qa->status == "open") { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4>Percakapan</h4>
	</div>
	<div class="panel-body">
		<form action="<?php echo base_url()."qa/save_answer";?>" method="post" id="form_answer">
			<input type="hidden" name="qa_id" id="qa_id" value="<?php echo $qa_id;?>" />
			<div class="form-group">
				<textarea id="answer" class="form-control" id="answer" name="answer"></textarea>
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</div>
<?php } ?>
