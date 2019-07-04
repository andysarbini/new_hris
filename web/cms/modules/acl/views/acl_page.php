
<div class="page-header">
	<h2>
		<i class="fa fa-toggle-off"></i> Access Control List
		<small>&mdash; Group to Module</small>
		</h2>
</div>

<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked menu-list">
			<li class="active">
				<a class="font-2x" href='<?php echo base_url().'acl'?>'>Access</a>
			</li>
			<li>
				<a class="font-2x" href='<?php echo base_url().'area/propinsi'?>'>Propinsi</a>
			</li>
			<li>
				<a class="font-2x" href='<?php echo base_url().'area/kabupaten'?>'>Kabupaten</a>
			</li>
			<li>
				<a class="font-2x" href='<?php echo base_url().'acl/module'?>'>Module</a>
			</li>
			<li>
				<a class="font-2x" href='<?php echo base_url().'admin/group'?>'>Group</a>
			</li>
			
		</ul><!-- /content menu -->
	</div>
	<div class="col-sm-10">
	
		<div class="form-group input-group-sm row">
			<input id='id_group' type='hidden' value="<?php echo $id_group;?>">
			<select id='slc_group' class="form-control col-md-6">
				<?php echo gen_option_html($select_group, @if_empty($id_group, 0), array('id'=>0,'title'=>'Select Group'));?>
			</select>
			<button class="btn btn-info" onclick="change_group();false;">View Access</button>
		</div>
<br />
<?php if($table_module) {?>
<div class='row'>
	<div class='col-md-6'>
		<table class='table table-striped table-hover table-bordered table-condensed'>
		<thead>
			<tr>
				<th>Module</th>
				<th class='col-md-1'>View</th>
				<th class='col-md-1'>Insert</th>
				<th class='col-md-1'>Update</th>
				<th class='col-md-1'>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php

/**
	load seluruh module active yg ada
	jadikan column module
	looping ke acl, default 0
*/
$aclnya = array();
foreach($table_module as $var=>$d){
	$aclnya[$d->id_module] = array('acl_id'=>$d->acl_id,'v'=>$d->v,'i'=>$d->i,'u'=>$d->u,'d'=>$d->d);
}
foreach ($list_module as $key => $d) {

	echo "<tr>";

	echo "<th>".$d->name."</th>";

	$acl_id = @if_empty($aclnya[$d->id]['acl_id'], 0);

	$td_1 = "<td  class='text-center'><input type='checkbox' acl_id='{$acl_id}' id_module='{$d->id}' class='checkbox_acl'";

	$td_2 = "></td>";

	echo $td_1." viud='v'".( @if_empty($aclnya[$d->id]['v']) ?' checked':'').$td_2;

	echo $td_1." viud='i'".( @if_empty($aclnya[$d->id]['i']) ?' checked':'').$td_2;

	echo $td_1." viud='u'".( @if_empty($aclnya[$d->id]['u']) ?' checked':'').$td_2;

	echo $td_1." viud='d'".( @if_empty($aclnya[$d->id]['d']) ?' checked':'').$td_2;

	echo "</tr>";
}

?>
		</tbody>
		</table>
	</div>
<!--
	<div class="col-md-6">
		<?php //echo Modules::run('area/group',  $id_group);
		?>
	</div>
-->
</div>
<?php } else{ ?>
<h2 class='text-center'>Please Select Group</h2>
<?php } ?>

	</div>
	
</div>
