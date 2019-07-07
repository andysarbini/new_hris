<div class="form" id="form_comment">
	<div class="form-group">
		<input type="hidden" value="<?php echo $content_id;?>" id="inp_content_id" />
		<textarea class="form-control" id="inp_comment" placeholder="Berikan komentar Anda ..."></textarea>
	</div>
	<div class="form-group form-group-btn text-right">
		<button class="btn btn-default" onclick="save_comment();">Kirim Komentar</button>
	</div>
</div>

<!-- Comments -->
<div class="page-header">
	<h5>KOMENTAR</h5>
</div>
<ul class="list-unstyled" id="list_comment">
	<?php  $this->load->view("comment_single_html", $comments); ?>
</ul>
<?php if(@if_empty($content->comment) && $content->comment > 5): ?>
<button class="btn btn-link btn-sm" onclick="load_comment_paging();false;" id="btn_comment_page">Lihat Lainnya</button>
<?php endif; ?>
