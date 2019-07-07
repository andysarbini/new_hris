<?php 

#dump($slip);
/*
  ["slip_id"] => string(1) "1"
  ["usr_id"] => string(1) "4"
  ["tahun"] => string(4) "2018"
  ["bulan"] => string(1) "1"
  ["summary"] => string(0) ""
  ["status"] => string(4) "paid"
  ["document"] => string(0) ""
  ["nama_lengkap"] => string(13) "savira savira"
  ["nip"] => string(6) "S4V1R4"
  ["profile_picture"] => string(36) "9159a80e18956277c2bd0201e28c58c5.jpg"
**/
?>

<table class="table">
  <tbody>
    <tr>
      <td>Tahun</td><td><?php echo $slip->tahun;?></td>
    </tr>
    <tr>
      <td>Bulan</td><td><?php echo $bulan[$slip->bulan];?></td>
    </tr>
    <tr>
      <td>Keterangan</td><td><?php echo $slip->summary;?></td>
    </tr>
    <tr>
      <td>Status</td><td><?php echo $slip->status;?></td>
    </tr>
    <tr>
      <td>Upload Berkas</td><td><?php if($slip->document){ ?><a class="btn btn-default btn-xs" href="<?php echo base_url()."uploads/slip/".$slip->document;?>"><span class="fas fa-download fa-fw" aria-hidden="true"></span> Download</a><?php } ?></td>
    </tr>
  </tbody>
</table>
