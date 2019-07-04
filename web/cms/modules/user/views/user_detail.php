<?php 
	debug($user);
/*
Dump => object(stdClass)#26 (9) {
  ["USR_ID"] => string(1) "5"
  ["USR_NAME"] => string(6) "padang"
  ["USR_REF"] => string(0) ""
  ["USR_EMAIL"] => string(6) "padang"
  ["USR_PASS"] => string(32) "6b2c00faeb3ef416c3c4c26d991095e9"
  ["USR_GRP_ID"] => string(1) "4"
  ["USR_INDATE"] => string(19) "0000-00-00 00:00:00"
  ["USR_UPDATE"] => NULL
  ["USR_ACCESS"] => string(1) "1"
}
*/ 
?>

<table class="table table-responsive table-striped table-bordered table-condensed table-hover">
	<thead></thead>
	<tbody>
		<tr><th>Nama</th><td><?php echo $user->USR_NAME;?></td></tr>
		<tr><th>Email</th><td><?php echo $user->USR_EMAIL;?></td></tr>
	</tbody>
</table>
<a class="btn btn-success btn-sm" href="<?php echo base_url()."user/profile/form/";?>">Ubah Profile / Password</a>
