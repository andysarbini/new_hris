<div class="help-block">
	<ul class="list-inline">
		<li><span class="far fa-heart fa-fw"></span> <?php echo @if_empty($rating->love, 0);?></li>
		<li><span class="far fa-comment fa-fw rating_comment"> </span> <?php echo @if_empty($rating->comment, 0);?></li>
		<li><span class="far fa-eye fa-fw rating_view"> </span> <?php echo @if_empty($rating->view, 0);?></li>
	</ul>
</div>
