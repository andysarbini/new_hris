<table <table class="table table-striped 	table-bordered table-hover table-condensed">
	<thead>
		<tr>
			<th>Judul</th>
		</tr>
	</thead>
	<tbody>

<?php 
	//dump($bbl); 
	/*
	["bbl_id"] => string(1) "6"
    ["level"] => string(1) "1"
    ["grade"] => string(1) "1"
    ["company"] => string(13) "Blue Bird Tbk"
    ["content_id"] => string(3) "116"
    ["category"] => string(10) "bblearning"
    ["title"] => string(38) "test contoh ke bbl id test update lagi"
    */
    foreach($bbl as $var=>$v) { 
		if((int) $v->content_id){
?>
	<tr>
		<td><a href="<?php echo base_url()."bluehrd/bbl/v/".$v->bbl_id;?>"><?php echo ucfirst($v->title);?></a></td>
	</tr>
<?php }} ?>
	
