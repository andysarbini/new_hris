<?php
/**
 * @package		: CMS Blank
 * @base		: admin (default)
 * @module		: home
 * @copyright	: Single User License (Copyright 2012 - 2014)
 * @author		: Indra Sadik <g3n1k@yahoo.com>, Dwi Rianto <dwiriantop@gmail.com>
 */
?>

<div class="page-header">
	<h1> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Panel Kendali</h1>
</div>

<div class="row">
	<div class="col-md-8 quick-access">
		<div class="flexgrid">
			<div class="col-md-3">
				<div class="panel panel-default text-center">
					<a href="<?php echo base_url();?>admin/group">
						<div class="panel-body">
							<span aria-hidden="true" class="far fa-address-card fa-3x"></span>
						</div>
					</a>
					<p><a href="<?php echo base_url();?>admin/group">Group</a></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default text-center">
					<a href="<?php echo base_url();?>admin/user">
						<div class="panel-body">
							<span aria-hidden="true" class="far fa-user fa-3x"></span>
						</div>
					</a>
					<p><a href="<?php echo base_url();?>admin/user">User</a></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default text-center">
					<a href="<?php echo base_url();?>acl">
						<div class="panel-body">
							<span aria-hidden="true" class="far fa-copy fa-3x"></span>
						</div>
					</a>
					<p><a href="<?php echo base_url();?>acl">Access</a></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default text-center">
					<a href="<?php echo base_url();?>attendance/admin/revisi">
						<div class="panel-body">
							<span aria-hidden="true" class="far fa-calendar-check fa-3x"></span>
						</div>
					</a>
					<p><a href="<?php echo base_url();?>attendance/admin/revisi">Revisi</a></p>
				</div>
			</div>
<!--
			<div class="col-md-3">
				<div class="panel panel-default text-center">
					<a href="<?php echo base_url();?>options/admin/">
						<div class="panel-body">
							<span aria-hidden="true" class="far fa-question-circle fa-3x"></span>
						</div>
					</a>
					<p><a href="<?php echo base_url();?>options/admin/">Opt Config</a></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default text-center">
					<a href="<?php echo base_url();?>admin/navigation/">
						<div class="panel-body">
							<span aria-hidden="true" class="far fa-calendar-alt fa-3x"></span>
						</div>
					</a>
					<p><a href="<?php echo base_url();?>admin/navigation">Menu</a></p>
				</div>
			</div>
			<!--
							<span aria-hidden="true" class="far fa-calendar-alt fa-3x"></span>
							<span aria-hidden="true" class="far fa-address-card fa-3x"></span>
							<span aria-hidden="true" class="far fa-clock fa-3x"></span>
							<span aria-hidden="true" class="far fa-file fa-3x"></span>
							<span aria-hidden="true" class="far fa-copy fa-3x"></span>
							<span aria-hidden="true" class="fas fa-bars fa-3x"></span>
							<span aria-hidden="true" class="far fa-question-circle fa-3x"></span>
							<span aria-hidden="true" class="fas fa-chalkboard-teacher fa-3x"></span>
							<span aria-hidden="true" class="far far fa-images fa-3x"></span>
							<span aria-hidden="true" class="far fa-money-bill-alt fa-3x"></span>
							<span aria-hidden="true" class="fas fa-sliders-h fa-3x"></span>
			-->
		</div>
	</div>
	<!-- System info -->
	<div class="col-md-4">
		<table class="table">
			<tbody>
			<tr>
				<td width="25%">Framework</td><td>Codeigniter Build-01052018dsh</td>
			</tr>
			<tr>
				<td width="25%">Updated</td><td>24-06-2018</td>
			</tr>
			<tr>
				<td width="25%">PHP</td><td>5.x or above</td>
			</tr>
			<tr>
				<td width="25%">Database</td><td>MySQL 5</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
