<div class="input-group input-group-sm hidden">
	<a href='<?php echo base_url().'acl';?>' class='btn btn-info'>ACL Page</a>
	<button class='btn btn-info' >Add Module</button>
</div>

<div class="page-header">
	<h2>
		<i class="fa fa-toggle-off"></i> Access Control List
		<small>&mdash; Module Page</small>
		<div class="pull-right"><button class="btn btn-lg btn-link btn-green" onclick="addform();"><span class="">New Module Page</span> <i class="fa fa-plus-circle fa-fw"></i> </button></div>

	</h2>
</div>


<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked menu-list">
			<li>
				<a class="font-2x" href='<?php echo base_url().'acl'?>'>Access</a>
			</li>
			<li>
				<a class="font-2x" href='<?php echo base_url().'area/propinsi'?>'>Propinsi</a>
			</li>
			<li class="active">
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
		<table class='table table-striped table-hover'>
<thead>
	<tr>
		<th>Module</th>
		<th>Desription</th>
		<th>Active</th>
	</tr>
</thead>
<tbody>
<?php

	if(count($table_module)){
		$bool = array('<i class="fa fa-times-circle"><span class="sr-only">Disabled</span></i>', '<i class="fa fa-check-circle green"><span class="sr-only">Enabled</span></i>');
		foreach($table_module as $var=>$d){
			echo "<tr>";
			echo "<td><a href='#' onclick='editform($d->id);false;'>".$d->name."</a></td>";
			echo "<td>".$d->ket."</td>";
			echo "<td>".$bool[$d->isactive]."</td>";
			echo "</tr>";
		}
	}
?>
</tbody>
</table>

	</div>
</div>


<div class="modal fade" id='myModal'>
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">
      	<div class='form-horizontal'>
			<div class='form-group'>
      			<div class='col-sm-2'>
      				<label for='in-module' class='control-label'>Name</label>
      			</div>
      			<div class='col-sm-10'>
      				<input id='in-module' class='form-control' name='in-module' />
      			</div>
      		</div>
      		<div class='form-group'>
      			<div class='col-sm-2'>
      				<label for='in-module' class='control-label'>Desc</label>
      			</div>
      			<div class='col-sm-10'>
      				<textarea id='in-description' class='form-control' name='in-description'></textarea>
      			</div>
      		</div>
      		<div class='form-group'>
      			<div class='col-sm-4'>
      				<label for='in-module' class='control-label'>Active</label>
      			</div>
      			<div class='col-sm-8'>
      				<select id='in-active' name='in-active' class='form-control'>
<?php echo gen_option_html(Modules::run('api/options', 'opt_boolean'), 0);?>
      				</select>
      			</div>
      		</div>
      		<input type='hidden' id='in-id' value='0'>
			<div>
				<button type="button" class="btn btn-success btn-sm" onclick='saveform();false;'>Save</button>
				<button type="button" class="btn btn-danger btn-sm" onclick='deleteform();false;'>Delete</button>
			</div>
      	</div>
      </div>
    </div>
  </div>
</div>
