<div class="form" id="form_comment">
	<div class="form-group">
		<input type="hidden" value="<?php echo $content_id;?>" id="inp_content_id" />
		<textarea class="form-control" id="inp_comment" placeholder="Berikan komentar Anda ..."></textarea>
	</div>
	<button class="btn btn-default btn-block" onclick="save_comment_g();">Kirim Komentar</button>
</div>

<!-- Comments -->
<div class="page-header">
	<h5>KOMENTAR</h5>
</div>
<div class="comment-list">
	<ul class="list-unstyled" id="list_comment">
		<?php  $this->load->view("comment_single_html", $comments); ?>
	</ul>
</div>
