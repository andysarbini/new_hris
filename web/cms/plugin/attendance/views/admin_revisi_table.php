<br />
<br />

<div class='col-lg-12 col-md-6'>
    <div class="ibox">
        <div class='ibox-title'>
            <form class='form-inline' role='form' method="get">
                <div class="form-group">
                    <select name="year" class="form-control">
                        <?php
                            $_slc_year = "";
                            
                            for($i = $min_year; $i <= $max_year; $i++) $_slc_year .=  "<option value='".$i."'".($year == $i ? " selected":"").">".$i."</option>";
                            
                            if($_slc_year !== '') echo $_slc_year;

                            else {
                                $_now_year = date('Y');
                        
                                echo "<option value='".$_now_year."' selected>".$_now_year."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="month" class="form-control">
                    <?php 
                        $months = json_decode(mdl_opt('bb_opt_bulan'), true);
                        
                        $_slc_month = "";
                        
                        foreach($months as $var=>$val) $_slc_month .=  "<option value='".$var."'".($month == $var ? " selected":"").">".$val."</option>";
                        
                        echo $_slc_month;
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <select name="rev_type_id" class="form-control">
                        <option value="0">Seluruhnya</option>
                    <?php 
                        $_tipe_revisi = mdl_opt('bb_opt_tipe_revisi');
                        echo gen_option_html($_tipe_revisi, @if_empty($param->rev_type_id));
                    ?>
                    </select>     
                </div>
                <div class="form-group">
                    <select name="closed_status" class="form-control">
                    <?php 
                        $_closed_status = json_encode(array("0"=>"Pending", "1"=>"Accept", "2"=>"Reject"));
                        echo gen_option_html($_closed_status, @if_empty($param->_closed_status));
                    ?>
                    </select>     
                </div>
                <button class="btn btn-primmary" type="submit">Tampilkan</button>
            </form>
        </div>
    </div>
</div>
    

<div class='col-md-12'>
<?php 

if( count((array) $revs)){ ?>
	<table class="table table-striped" id="att-table">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Dari</th>
				<th>Sampai</th>
				<th>Jenis</th>
				<th>File</th>
				<th>Subjek</th>
				<th>Keterangan</th>
				<th>Status</th>
				
			</tr>
		</thead>
		<tbody>
<?php
	$_rev_type_id = json_decode(mdl_opt('bb_opt_tipe_revisi'), true);
    $_status = array("0"=>"PENDING", "1"=>"ACCEPT", "2"=>"REJECT");
    foreach($revs as $_var=>$_){
		echo "<tr>";
		echo "<td>".$_->nama_lengkap."</td>";
		echo "<td>".$_->date_from."</td>";
		echo "<td>".$_->date_to."</td>";
		echo "<td>".$_rev_type_id[$_->rev_type_id]."</td>";
		echo "<td><a href='".base_url().$upload_path.'/'.$_->path_file."'>".$_->path_file."</a></td>";
		echo "<td>".$_->subjek."</td>";
		echo "<td>".$_->keterangan."</td>";
		echo "<td>"."<a href='".base_url()."attendance/admin/revisi_form/".$_->rev_id."'>".$_status[$_->closed_status]."</a></td>";
		echo "</tr>";
	}
?>
		</tbody>
	</table>
<?php } else { ?>
    <h2 class="text-center">Tidak Ada Revisi yang diajukan</h2>
<?php } ?>
</div>
