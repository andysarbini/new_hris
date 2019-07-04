<h3 class='heading'>
	Gallery: <strong><?php echo $gall->name;?></strong>
	<div class="pull-right">
		<a href='<?php echo base_url().'admin/gallery/'?>'><button class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-chevron-left'></span> All Gallery</button></a>
		<a href='<?php echo base_url().'admin/gallery/add_edit_img/'.$gall->id?>'><button class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-plus'></span> Add New Image</button></a>
	</div>
</h3>
<p class='description'>Tambah, edit, hapus galeri konten.</p>

<div class='clearfix margin-bottom-20'></div>

<table class="table table-condensed table-striped table-hover" width='100%' cellspacing='0' cellpadding='0'>
	<thead>
		<tr>
			<th>Name</th>
			<th>Image</th>
			<th>Description</th>
		</tr>
	</thead>
	
	<?php if(count($state)){ 
		
		$img = base_url().$directory;
		
		$gall_path = base_url().'admin/gallery/';
		
		foreach($state as $d){ ?>
	
	<tr>
		<td width='18%'><a href='<?php echo base_url().'admin/gallery/add_edit_img/'.$gall->id.'/'.$d->id;?>' class='btn-link'><?php echo $d->name;?></a>  <?php if($d->main) { ?>
<span title="main pic for gallery" data-placement="top" data-toggle="tooltip" class="glyphicon glyphicon-star"></span>
<?php } ?></td>
		<td width='18%' style='padding:10px'>
			<?php $img_path = $img.'/'.$d->path; ?>
			<a class='img-view' data-img='<?php echo $img_path;?>' data-target="#imgModal" role="button" class="btn" data-toggle="modal">
				<img class='img-responsive'  src="<?php echo img_thumb($img_path,80,80);?>" alt='<?php echo $d->name;?>' />
			</a>
		</td>
		<td width='50%'><?php echo $d->description;?></td>
		<td width='8%'>
			<div class='btn-group pull-right'>
				<a href='<?php echo $gall_path . 'add_edit_img/'.$gall->id.'/'.$d->id;?>' class='btn btn-primary btn-xs'><span class="glyphicon glyphicon-edit"></span></a>
				<a href='<?php echo $gall_path . 'delete_img/'.$gall->id.'/'.$d->id;?>' class='btn btn-primary btn-xs'><span class="glyphicon glyphicon-trash"></span></a>
			</div>
		</td>
	</tr>
	
	<?php } } ?>
	
</table>

<div id='imgModal' class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
     
      <div class="modal-body">
        <center><img src='' id='img-tag'></center>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>

$( document ).ready(function() {
	
	$( ".img-view" ).click(function() {
		$('#img-tag').attr('src',$(this).attr('data-img'));
	});
});


</script>
