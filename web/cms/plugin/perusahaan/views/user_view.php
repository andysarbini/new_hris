<div class="page-header">
  <div class="button-set pull-right"></div>
  <h2>Pusat Informasi Karyawan</h2>
  <p class="lead">Semua pusat informasi karyawan dapat Anda temukan di sini</p>
</div>


<?php
/*
 * 
  gak ada filter, 1 menu info 1 page 
  dump($info);
  Dump => object(stdClass)#23 (5) {
  ["info_id"] => string(1) "3"
  ["category"] => string(0) ""
  ["title"] => string(9) "test ke 2"
  ["description"] => string(41) "Untuk perusahaan BB jabatan Division Head"
  ["file"] => string(24) "cover_lampiran_V.1_2.pdf"
  }
*/
//debug($breadcrumb);
/*
 ["id"] => string(3) "129"
    ["title"] => string(24) "Pusat Informasi Karyawan"
    ["type"] => string(1) "2"
    ["url"] => string(9) "informasi"
    ["parent_id"] => string(1) "0"
    */ 

$html_breadcrumb = '<ol class="breadcrumb">';

$html_breadcrumb .= '<li><a href="'.base_url().'">Dashboard</a></li>';


$_c = 0; $_max = count($breadcrumb);

foreach($breadcrumb as $var=>$v){
	
	if(++$_c != $_max) $html_breadcrumb .= '<li><a href="'.gen_url_by_type_nav((array) $v, $v->type).'">'.$v->title.'</a></li>';
	
	else $html_breadcrumb .= '<li>'.$v->title.'</li>';
	
}

$html_breadcrumb .= '</ol>';

echo $html_breadcrumb;

if(isset($info)) {
?>

<!-- Category VIDEO: Judul dan Filter -->
<div class="page-header page-subheader">
	<h4 class="sr-only"><i class="far fa-file-video fa-fw fa-lg"></i> Files</h4>
	<div class="form-inline hidden">
    <label for="search" class="control-label sr-only">Cari</label>
    <div class="form-group">
      <input type="search" class="form-control">
    </div>

		<label class="control-label" for="category_selection_video">Filter berdasarkan</label>
		<div class="form-group">
			<select id='category_selection_video' class='form-control'>
			<option value="all" selected>- Silakan pilih -</option>
			  <?php // echo gen_option_html($obj_category,""); ?>
			</select>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- Category FILE: per 5 item -->
<div class="flexgrid">
    <div class="col-sm-3">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <label class="control-label">Judul</label>
            <p><?php echo $info->title;?></p>
          </div>
          <div class="form-group">
            <label class="control-label">Keterangan</label>
            <p><?php echo $info->description;?></p>
          </div>
        </div>
        <?php if($info->file){ ?>
          <div class="panel-footer text-center">
          <a href="<?php echo base_url()."uploads/info/".$info->file;?>" class="btn btn-default btn-block"><span class="fa fa-download fa-fw" aria-hidden="true"></span> Download</a>
          </div>
        </div>
    </div>
</div>
<!-- <nav aria-label="navigation" id="paging_files">
    Ajax Load Paging
</nav> -->
<?php }
} else {
  ?>

<div class="alert alert-warning">Anda Tidak Dapat Mengakses Halaman ini</div>

<?php } ?>


