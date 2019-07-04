<table class='table table-striped table-bordered table-hover table-condensed'>
	<thead>
		<tr><th>Name</th><th>Email</th><th>IP Address</th><th>Date</th><th>logs</th></tr>
	</thead>
	<tbody>
<?php
foreach($logs as $var=>$d){
	echo "<tr>";
	echo "<td>".$d->name."</td>";
	echo "<td>".$d->email."</td>";
	echo "<td>".$d->ip."</td>";
	echo "<td>".$d->tgl."</td>";
	echo "<td>".$d->msg."</td>";
	echo "</tr>";
}
?>
	</tbody>
</table>