<h3 class='heading'>
	Member
	<div class='pull-right'>
		<a href='<?php echo base_url().'admin/member/add'?>'><button class='btn btn-small'>Add New Member</button></a>
	</div>
</h3>
<p class='description'>Member yang terdaftar di website.</p>

<div class='clearfix margin-bottom-20'></div>

<table class="table table-striped table-hover" width='100%' cellspacing='0' cellpadding='0'>
	<thead>
		<tr>
			<th>Member</th>
			<th width='8%' style='text-align:center'>Status</th>
			<th width='8%' style='text-align:center'>&nbsp;</th>
		</tr>
	</thead>
	<tbody id='tbody-list-widget'>
<?php 
if (count($member)) {
	foreach ($member as $t) { ?><tr id='tr_<?php echo $t->id;?>'>
	<td class='f116'>
		<a href='<?php echo base_url().'uploads/members/'.$t->pic;?>' target='_blank'><img src='<?php echo base_url().'uploads/members/'.$t->raw.'_thumb'.$t->ext;?>' alt='<?php echo $t->name;?>'/></a>
		<a class="btn-link" href="<?php echo base_url().'admin/member/edit/'.$t->id;?>">
			<strong><?php echo $t->name;?></strong>
		</a>
			&nbsp;
			
			(<?php echo Modules::run('api/_sex/title',$t->sex);?>) &nbsp;
			<?php echo $t->tgl;?>
		
	</td>
	
	<td style='text-align:center'>
		<?php echo $t->active ? '<span class="label label-success">Enabled</span>':'<span class="label label-important">Disabled</span>';?>
	</td>
	
	<td>
		<a class="btn btn-mini" href="<?php echo base_url().'admin/member/edit/'.$t->id;?>"><i class="icon-edit"></i> Edit</a>
	</td>
</tr>
	<?php };
}
?>
	</tbody>
	<tfoot>
	
	</tfoot>
</table>
