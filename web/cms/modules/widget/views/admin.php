<h3 class='heading'>
	Widgets
	<div class="pull-right">
		<input type='button' id='btn-add-widget' value='Add Widget' class='btn btn-primary btn-sm'/>
	</div>
</h3>
<p class='description'>Tambah, edit, hapus widget.</p>

<div class='clearfix margin-bottom-20'></div>

<!--input type='hidden'-->
<div>
	<?php 
	$ci = & get_instance();
	$ci->load->view('table-widget');
	?>
</div>

<div id="modals" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class='modal-title'>Widget <strong>(Edit)</strong></h4>
			</div>
			
			<div class="modal-body" id='nav-list'>	
				<?php $ci->load->view('form-widget');?>
			</div>
		</div>
	</div>
</div>
