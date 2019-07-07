<?php //dump($user);
/*
Dump => object(stdClass)#23 (22) {
  ["usr_id"] => string(1) "4"
  ["nip"] => string(6) "S4V1R4"
  ["nama_lengkap"] => string(13) "savira savira"
  ["tgl_lahir"] => string(10) "1988-04-27"
  ["posisi"] => string(16) "HR Asst. Manager"
  ["atasan"] => string(5) "Staff"
  ["atasan_nip"] => string(5) "T3B3T"
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
  ["profile_picture"] => string(36) "9159a80e18956277c2bd0201e28c58c5.jpg"
  ["usr_name"] => string(6) "savira"
  ["usr_access"] => string(1) "1"
  ["usr_grp_name"] => string(4) "user"
  ["USR_GRP_DESC"] => string(56) "Kelompok pengguna Terdaftar dan yang diperbolehkan masuk"
}

*/ 
?>

<div class="media">
  <div class="media-top thumbnail">
    <img class="img-responsvie" src="<?php echo img_profile("uploads/profile/" . $user->profile_picture, 260,260);?>" >
  </div>
  <div class="media-body">
    <label class="control-label">Nama</label>
    <p><?php echo $user->nama_lengkap;?></p>
    <label class="control-label">Tanggal Lahir</label>
    <p><?php echo $user->tgl_lahir;?></p>
    <label class="control-label">Posisi</label>
    <p><?php echo $user->posisi;?></p>
  </div>
  </div>
</div>
