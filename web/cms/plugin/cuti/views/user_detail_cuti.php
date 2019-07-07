<?php 

//dump($cuti);
/*
Dump => object(stdClass)#23 (13) {
  ["cuti_id"] => string(2) "16"
  ["usr_id"] => string(1) "4"
  ["usr_id_atasan"] => string(1) "0"
  ["type_id"] => string(1) "2"
  ["tgl_from"] => string(10) "2018-04-07"
  ["tgl_to"] => string(10) "2018-03-26"
  ["days"] => string(1) "0"
  ["alasan"] => string(0) ""
  ["alasan_atasan"] => string(0) ""
  ["status"] => string(1) "2"
  ["tgl_input"] => string(19) "2018-05-04 22:00:49"
  ["type"] => string(10) "Cuti Hamil"
  ["quota"] => string(7) "90 Hari"
}
**/
?>

<div class="panel panel-default">
  <div class="panel-body">
    <label class="control-label">Jenis Cuti</label>
    <p><?php echo $cuti->type;?></p>
    <div class="row">
      <div class="col-md-3">
        <label class="control-label">Tanggal Mulai</label>
        <p><?php echo bbdate($cuti->tgl_from);?></p>
      </div>
      <div class="col-md-3">
        <label class="control-label">Tanggal Akhir</label>
        <p><?php echo bbdate($cuti->tgl_to);?></p>
      </div>
      <div class="col-md-2">
        <label class="control-label">Hari</label>
        <p><?php echo duration($cuti->tgl_from, $cuti->tgl_to);?></p>
      </div>
      <div class="col-md-2">
        <label class="control-label">Kuota</label>
        <p><?php echo $cuti->quota;?></p>
      </div>
      <div class="col-md-2">
        <label class="control-label">Status</label>
        <p><?php echo status($cuti->status);?></p>
      </div>
    </div>
    <label class="control-label">Sisa Cuti (hari):</label>
    <p><?php 
			$_ = explode('-',$cuti->tgl_from);
			echo sisa_cuti( $_[0], $cuti->usr_id);
		?>
	</p>
    <label class="control-label">Alasan Pengajuan Cuti:</label>
    <p><?php echo $cuti->alasan;?></p>
    <label class="control-label">Pesan dari Atasan:</label>
    <p><?php echo $cuti->alasan_atasan;?></p>
    <label class="control-label">Document:</label>
    <p><?php echo $cuti->document != '' ? "<a href='".base_url().'uploads/cuti/'.$cuti->document."' target='_blank' alt='".$cuti->document."'>".$cuti->document."</a>":"";?></p>
    
  </div>
</div>
