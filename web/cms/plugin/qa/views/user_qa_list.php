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

<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-8">

				<!-- Status ini muncul ketika user berhasil submit pertanyaan -->
				<?php if($status == 'success'){ ?>
					<div class="alert alert-warning"><p>Terimakasih, pertanyaan Anda sudah terkirim dan sedang dalam proses.</p></div>
				<?php } ?>

				<!-- Tidak perlu menampilkan daftar ini di frontend -->
				<?php if(count($qa)){ ?>
				<div class="panel panel-default hidden">
					<div class="panel-heading">
						<h4><span class="fa fa-bullhorn fa-lg text-info"></span> Pertanyaan Anda</h4>
					</div>

					<div class="panel-body">
						<?php 
						foreach( $qa	 as $var=>$v ){  
							$_url_news = base_url()."qa/view/".$v->qa_id; 
						?>
						<div class="media">
							<div class="media-left">
								<a href="<?php echo $_url_news?>">
								<img class="media-object thumbnail" src="<?php echo base_url()."uploads/profile/".$v->profile_picture; ?>" alt="" width="75">
								</a>
							</div>
							<div class="media-body">
								<h4 class="media-heading"><a href="<?php echo $_url_news;?>"><?php echo $v->subjek;?></a> </h4>
								<p><?php echo $v->ask;?></p>
								<div class="help-block"><?php echo bluehrd_tgl($v->qa_date);?> <span class="text-info"><?php echo $v->category;?></span></div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php } ?>

				<div class="panel panel-none">
					<form action="<?php echo base_url()."qa/save_ask";?>" method="post" name="form_ask" id="form_ask">
						<div class="form-group">
							<label class="control-label" for="category">Pertanyaannya mengenai apa?<sup class="text-danger">*</sup></label>
							<select class="form-control form-inline" name="category" id="category">
								<option value="">- Silakan pilih -</option>
								<option value="benefit">Benefit</option>
								<option value="karir">Karir</option>
								<option value="pelatihan">Pelatihan</option>
								<option value="tunjangan">Tunjangan</option>
								<option value="lainnya">Lainnya</option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label" for="subjek">Judul<sup class="text-danger">*</sup></label>
							<input type="text" class="form-control" name="subjek" id="subjek">
						</div>
						<div class="form-group">
							<label class="control-label" for="pertanyaan">Jelaskan pertanyaan Anda dengan bahasa yang baik dan sopan<sup class="text-danger">*</sup></label>
							<textarea id="pertanyaan" class="form-control" name="pertanyaan"></textarea>
						</div>
						<div class="form-group form-group-btn">
							<button type="submit" class="btn btn-default">Kirim</button>
							<button type="reset" value="Batal" class="btn btn-link">Batal</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
