<div class="page-header">
	<div class="button-set pull-right">
	<a class="btn btn-default" href="<?php echo base_url()."options/admin/form/null/array_2"?>">TAMBAH BARU</a>
	</div>
	<h1>Pengaturan</h1>
	<p class="lead">Tambah atau edit variable option</p>
</div>

<div class="row">
	<div class="col-md-8">
		<div class="tab-wrapper">
			<ul class="nav nav-tabs" role="tablist" id="editor-tab">
				<li role="presentation" class="active"><a href="#detail">Detail</a></li>
				<li role="presentation"><a href="#options">Option</a></li>
			</ul>
		
			<div style="display:none;" id="clone-div">
				<div class="form-row row">
					<div class="col-md-5">
						<div class="form-group">
							<div class="input-group">
								<!-- <label class="control-label" for="inputKey" class="col-sm-2 col-form-label">Key</label> -->
								<span class="input-group-addon">Key</span>
								<input type="text" class="form-control" name="var[]" placeholder="Masukkan Key" value="">
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<!-- <label class="control-label" for="inputValue" class="col-sm-2 col-form-label">Value</label> -->
							<div class="input-group">
								<span class="input-group-addon">Value</span>
								<input type="text" class="form-control" name="val[]" placeholder="Masukkan Value" value="">
							</div>
						</div>
					</div>
					<div class="col-md-1">
						<button class="btn remove_parent" title="Hapus"><span class="fas fa-times fa-fw text-danger" aria-hidden="true"></span> <span class="sr-only">Hapus</span></button>
					</div>
				</div>
			</div>
			
			<form class="form-horizontal" action="<?php echo base_url()."admin/options/save";?>" method="post">
		
				<input type="hidden" value="<?php echo @if_empty($opt->OPT_ID, 0);?>" name="OPT_ID">
		
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="detail">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="OPT">Nama Options</label>
							<div class="col-sm-10">
								<input type="text" value="<?php echo @if_empty($opt->OPT, "");?>" name="OPT" class="form-control">
								<div id="emailHelp" class="help-block">Khusus untuk SIAK &amp; DPT gunakan awalan <b>"opt_"</b></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="OPT_KET">Keterangan</label>
							<div class="col-sm-10">
								<textarea name="OPT_KET" class="form-control"><?php echo @if_empty($opt->OPT_KET, "");?></textarea>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="options">
						<label class="col-sm-2 control-label" for="">Variable</label>
						<div class="col-sm-10">
							<div id="form-div">
								<?php
								if(@if_empty($opt->OPT_VAL, false)){
									
									$_ = json_decode($opt->OPT_VAL);
									
									foreach($_ as $var=>$val){
										echo '<div class="form-row row">';
										echo '<div class="col-sm-5">';
										echo '	<div class="form-group">';
										// echo '		<label class="control-label" for="inputKey" class="col-sm-2 col-form-label">Key</label>';
										echo '		<div class="input-group">';
										echo '			<span class="input-group-addon">Key</span>';
										echo '			<input type="text" class="form-control" name="var[]" placeholder="Enter Key" value="'.$var.'">';
										echo '		</div>';
										echo '	</div>';
										echo '</div>';
										echo '<div class="col-sm-5">';
										echo '	<div class="form-group">';
										// echo '		<label class="control-label" for="inputValue" class="col-sm-2 col-form-label">Value</label>';
										echo '		<div class="input-group">';
										echo '			<span class="input-group-addon">Value</span>';
										echo '			<input type="text" class="form-control" name="val[]" placeholder="Enter Value" value="'.$val.'">';
										echo '		</div>';
										echo '	</div>';
										echo '</div>';
										echo '<div class="col-md-1">';
										echo '	<button class="btn remove_parent" title="Hapus"><span class="fas fa-times fa-fw text-danger" aria-hidden="true"></span> <span class="sr-only">Hapus</span></button>';
										echo '</div>';
										echo '</div>';
									}
								}
								?>
							</div>
							
							<div class="row">
								<div class="col-sm-10">
									<div class="form-group">
										<button type="button" class="btn btn-link btn-block" onclick="add_field('#clone-div','#form-div');false;"><span class="fas fa-plus fa-fw" aria-hidden="true"></span> Tambah Variable</button>
									</div>
								</div>
							</div>
						</div>
					</div>
		
					<div class="clearfix"></div>
		
					<div class="form-group form-group-btn">
						<div class='col-sm-10 col-sm-offset-2 button-set'>
							<button type="submit" class="btn btn-default">Simpan</button>
							<a type="button" href="<?php echo base_url()."admin/options"?>" class="btn btn-link">Batal</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4">
	<!--
		<div class="alert alert-info">
			<p>Beberapa variable option selection dapat Anda ubah dan sesuaikan dengan kebutuhannya di sini. Misal, Anda ingin membuat pilihan untuk Jenis Kendaraan, masukkan kata kunci (<i>key</i>) yang <u>unik</u> serta nilainya (<i>value</i>).</p><br>
			<ul class="list-unstyled">
				<li>key = 0, value = - Pilih Jenis Kendaraan -</li>
				<li>key = 1, value = Sedan</li>
				<li>key = 2, value = SUV</li>
				<li>key = 3, value = APV</li>
				<li>key = 4, value = Bus</li>
				<li>key = 5, value = Truck</li>
			</ul>
			<br>
			<div class="form-group">
				<label class="control-label">Jenis Kendaraan</label>
				<select class="form-control" name="" id="">
					<option value="0">- Pilih Jenis Kendaraan -</option>
					<option value="1">Sedan</option>
					<option value="2">SUV</option>
					<option value="3">APV</option>
					<option value="4">Bus</option>
					<option value="5">Truck</option>
				</select>
			</div>
		</div>
	-->
	</div>
</div>

<script type="text/javascript">
 
 $(document).ready(function(){
	 
	 $('#editor-tab a').click(function (e) {
		 e.preventDefault()
		 $(this).tab('show')
	 })
	 
 });
 </script>
