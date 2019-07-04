<h3 class='heading'>
	Gallery
	<div class="pull-right">
		<a href='<?php echo base_url().'admin/gallery/detail/1'?>'><button class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-book'></span> View Template</button></a>
		<a href='<?php echo base_url().'admin/gallery/add'?>'><button class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-plus'></span> Add New Gallery</button></a>
	</div>
</h3>
<p class='description'>List of galleries used by your webiste.</p>

<div class='clearfix margin-bottom-20'></div>

<table class="table table-condensed table-striped table-hover" width='100%' cellspacing='0' cellpadding='0'>
<thead>
	<tr>
		<th>Name</th><th>URI</th><th>Description</th><th>Author</th>
		<th>Last modified</th><th>Modified by</th><th>Action</th>
	</tr>
</thead>	
<?php if(count($state)){ foreach($state as $d){ if($d->id == 1)  continue; ?>
	<tr>
		<td><?php echo $d->name;?></td><td><?php echo $d->uri;?></td><td><?php echo $d->description;?></td>
		<td><?php echo $d->input_name;?></td><td><?php echo $d->update_date;?></td><td><?php echo $d->update_name;?></td>
		<td>
			<div class='btn-group pull-right'>
				<a class='btn btn-default btn-xs' href='<?php echo base_url().'admin/gallery/detail/'.$d->id;?>'><span class="glyphicon glyphicon-picture"> View Image</span></a>
				<a class='btn btn-primary btn-xs' href='<?php echo base_url().'admin/gallery/edit/'.$d->id;?>'><span class="glyphicon glyphicon-edit"> Edit</span></a>
			</div>
		</td>
	</tr>
<?php } } ?>
	
</table>
