<?php 
if(isset($_GET['success'])){
if($_GET['success']) { ?>
	<div class="alert alert-success success">Pertanyaan Anda berhasil dikirim</div>
<?php } else { ?>
	<div class="alert alert-danger failed">Pertanyaan Anda gagal dikirim, silakan coba lagi</div>
<?php }} ?>

<div class="row">
  <div class="col-md-8 col-sm-10">
    <form method="post" action="<?php echo base_url()."qa/save"?>" id="form_qa">
      <div class="form-group">
        <label class="control-label" for="subjek">Judul</label>
        <input class="form-control" type="text" id="subjek" aria-describedby="emailHelp" name="subjek">
      </div>
      <div class="form-group">
        <label class="control-label" for="ask">Pertanyaan</label>
        <textarea class="form-control" id="ask" name="ask"></textarea>
      </div>
      <div class="form-group form-group-btn">
        <input type="submit" class="btn btn-default" value="Kirim">
        <button type="reset" class="btn btn-link">Reset</button>
      </div>
    </form>
  </div>
</div>
