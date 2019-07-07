<div id="history" class="tab-pane fade in active">
    <h3>Request For Leave Administration</h3>
    <div>
        <select name="year" id="year">
<?php
    $_slc_year	= $slc_year;
    $_now_year 	= date("Y");
    $_next_year	= $_now_year + 1;
    $_low_year	= @if_empty($lowest_year) ? $lowest_year : $_now_year ;

    for($i = $_low_year; $i <= $_next_year; $i++)

        echo "<option value='".$i."'".( $_slc_year == $i ? " selected":"" ).">".$i."</option>";
?>
        </select>
        <select name="status" id="status">
<?php

    $_s = array("ditolak", "menunggu", "diterima");
    
    for($i = 0; $i < 3 ; $i++)

		echo "<option value='".$i."'".( $_status[$i] == $status ? " selected":"" ).">".$_s[$i]."</option>";
?>
		</select>
		<table class="table">
			<thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
			</thead>
			<tbody id="cuti-table-body">
				
			</tbody>
		</table>
	</div>
</div>
	