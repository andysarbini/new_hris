<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: navigation
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<input type='hidden' name='nav_id' id='nav_id' value='<?php echo @if_empty($nav->id,0);?>' />

<div class="well">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="text-center">Create A Menu</h4>
		</div>
		<div class="panel-body">
			<div class='form-horizontal'>
				<div class="form-group">
					<label class="control-label col-sm-3" for="nav_title">Title</label>
					<div class="col-sm-9">
						<input type='text' name='nav_title' id='nav_title' class='form-control input-sm' value='<?php echo @if_empty($nav->title,'');?>' placeholder='Title Nav' />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="nav_uri">URI</label>
					<div class="col-sm-9">
						<input type='text' name='nav_uri' id='nav_uri' class='form-control input-sm' value='<?php echo @if_empty($nav->uri,'');?>' placeholder='Uri Nav' />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="group_id">Group</label>
					<div class="col-sm-9">
						<select name='group_id' id='group_id' class='form-control input-sm'>
							<option value='0'>- Please Select -</option>
								<?php foreach($groups as $g){ ?> 
							<option value='<?php echo $g->group_id;?>' <?php echo @if_empty($nav->group_id)==$g->group_id ?'selected':'';?>><?php echo $g->group_name;?></option>
								<?php } ?>
						</select>
					</div>
				</div>
				<div class="text-center button-set">
					<div class="">
						<button id='btn_reset_form_nav' class='btn btn-link btn-sm' onclick='load_form_nav(0);'><i class="fa fa-remove fa-2x"></i><br>Cancel</button>
						<button id='btn_simpan_nav' class='btn btn-link btn-save btn-sm' onclick='simpan_nav()'><i class="fa fa-check fa-2x"></i><br>Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
