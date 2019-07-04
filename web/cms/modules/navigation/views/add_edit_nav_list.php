<?php
/**
 * @package		: CMS Blank
 * @base			: admin (default)
 * @module		: navigation
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>


<input id='nav_list_id' type='hidden' value='<?php echo @if_empty($nav->id,0);?>' />
<input id='owner_group_id' type='hidden' value='<?php echo $owner_group->id;?>' /> 

<div class='form-horizontal'>
	<div class='form-group'>
		<label class='col-sm-4 control-label' for='nav_list_title'>Title</label>
		<div class='col-sm-6'>
			<input class='form-control input-sm' id='nav_list_title' name='title' type='text' value='<?php echo @if_empty($nav->title,'');?>' onblur="gen_title_to_uri('#nav_list_title', '#nav_list_uri');"/> 
		</div>
	</div>

	<div class='form-group'>
		<label class='col-sm-4 control-label' for='nav_list_uri'>URI</label>
		<div class='col-sm-6'>
			<input class='form-control input-sm' id='nav_list_uri' type='text' value='<?php echo @if_empty($nav->uri,'');?>' /> 
		</div>
	</div>

	<div class='form-group'>
		<label class='col-sm-4 control-label' for='nav_list_type'>Type</label>
		<div class='col-sm-6'>
			<select id='nav_list_type' class='form-control input-sm'>
				<?php echo gen_option_html(Modules::run('api/select', 'mdl_navigation_type',array('id'=>'NAV_TYPE_ID', 'title'=>'NAV_TYPE')), @if_empty($nav->type_id,0));?>
			</select>
		</div>
	</div>

	<div class='form-group'>
		<label class='col-sm-4 control-label' for='nav_list_urm'>URL/Module</label>
		<div class='col-sm-6'>
			<input class='nav_list_urm form-control form-control input-sm' id='nav_list_urm' type='text' value='<?php echo @if_empty($nav->type_id, 0) != 1 ? @if_empty($nav->url,'') : '';?>' />
		</div>
	</div>
<?php /*
	<div class='form-group'>
		<label class='col-sm-4 control-label' for='nav_list_url'>Content</label>
		<div class='col-sm-6'>
			<select id='nav_list_url' class='form-control input-sm'>
				<?php echo gen_option_html(Modules::run('api/select', 'vw_mdl_content_user_group', 'POST_URI id, POST_TITLE title', array('POST_ISACTIVE'=>1)), (@if_empty($nav->type_id, 0) == 1 ? @if_empty($nav->url,0) : 0));?>
			</select>
		</div>
	</div>
*/ ?>
	<div class='form-group'>
		<label class='col-sm-4 control-label' for='nav_list_id_parent'>Parent</label> 
		<div class='col-sm-6'>
			<select class='form-control input-sm' id='nav_list_id_parent'>
				<?php echo gen_option_html($parent, @if_empty($nav->parent_id,@if_empty($parent_selected,0)),array('id'=>0, 'title'=>'No Parent'));?>
			</select>
		</div>
	</div>

	<div class='form-group'>
		<label class='col-sm-4 control-label' for='nav_list_target'>Target</label>
		<div class='col-sm-6'>
			<select class='form-control input-sm' id='nav_list_target'>
				<option value=''>None</option>
				<option value='_blank'>New Window</option>
			</select>
		</div>
	</div>

	<div class='form-group'>
		<label class='col-sm-4 control-label' for='nav_list_poss'>Sort</label>
		<div class='col-sm-2'>
			<input class='form-control input-sm' id='nav_list_poss' type='text' value='<?php echo @if_empty($nav->poss,0);?>' /> 
		</div>
	</div>

	<div class='form-group'>
		<div class='col-sm-6 col-sm-push-4'>
			
			<button id='simpan-nav-list' class="btn btn-sm btn-success" onclick="simpan_nav_list();">Save</button>
			<?php if(@if_empty($nav->id,false)){ ?>
			<button id="simpan-nav-list" class="btn btn-link btn-sm btn-cancel pull-right" onclick="hapus_nav_list();"><i class="fa fa-trash-o"></i> Delete</button>
			<?php } ?>
			
		</div>
	</div>
</div>
