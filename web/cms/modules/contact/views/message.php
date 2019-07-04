<!DOCTYPE HTML>
<html>
<style>
/*!
 * Bootstrap v2.3.2
 *
 * Copyright 2012 Twitter, Inc
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built with all the love in the world @twitter by @mdo and @fat.
 */
.clearfix{*zoom:1;}.clearfix:before,.clearfix:after{display:table;content:"";line-height:0;}
.clearfix:after{clear:both;}
html{font-size:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;}
a:focus{outline:thin dotted #333;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
a:hover,a:active{outline:0;}
small{font-size:85%;}
strong{font-weight:bold;}
em{font-style:italic;}
cite{font-style:normal;}
h1,h2,h3,h4,h5,h6{margin:10px 0;font-family:inherit;font-weight:bold;line-height:20px;color:inherit;text-rendering:optimizelegibility;}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-weight:normal;line-height:1;color:#999999;}
h1,h2,h3{line-height:40px;}
h1{font-size:38.5px;}
h2{font-size:31.5px;}
h3{font-size:24.5px;}
h4{font-size:17.5px;}
h5{font-size:14px;}
h6{font-size:11.9px;}
h1 small{font-size:24.5px;}
h2 small{font-size:17.5px;}
h3 small{font-size:14px;}
h4 small{font-size:14px;}
.page-header{padding-bottom:9px;margin:20px 0 30px;border-bottom:1px solid #eeeeee;}
ul,ol{padding:0;margin:0 0 10px 25px;}
ul ul,ul ol,ol ol,ol ul{margin-bottom:0;}
li{line-height:20px;}
ul.unstyled,ol.unstyled{margin-left:0;list-style:none;}
ul.inline,ol.inline{margin-left:0;list-style:none;}ul.inline>li,ol.inline>li{display:inline-block;*display:inline;*zoom:1;padding-left:5px;padding-right:5px;}
dl{margin-bottom:20px;}
dt,dd{line-height:20px;}
dt{font-weight:bold;}
dd{margin-left:10px;}
.dl-horizontal{*zoom:1;}.dl-horizontal:before,.dl-horizontal:after{display:table;content:"";line-height:0;}
.dl-horizontal:after{clear:both;}
.dl-horizontal dt{float:left;width:160px;clear:left;text-align:right;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.dl-horizontal dd{margin-left:180px;}
pull-right p,blockquote.pull-right small{text-align:right;}
blockquote.pull-right small:before{content:'';}
blockquote.pull-right small:after{content:'\00A0 \2014';}
q:before,q:after,blockquote:before,blockquote:after{content:"";}
address{display:block;margin-bottom:20px;font-style:normal;line-height:20px;}
table{max-width:100%;background-color:transparent;border-collapse:collapse;border-spacing:0;}
.table{width:100%;margin-bottom:20px;}.table th,.table td{padding:8px;line-height:20px;text-align:left;vertical-align:top;border-top:1px solid #dddddd;}
.table th{font-weight:bold;}
.table thead th{vertical-align:bottom;}
.table caption+thead tr:first-child th,.table caption+thead tr:first-child td,.table colgroup+thead tr:first-child th,.table colgroup+thead tr:first-child td,.table thead:first-child tr:first-child th,.table thead:first-child tr:first-child td{border-top:0;}
.table tbody+tbody{border-top:2px solid #dddddd;}
.table .table{background-color:#ffffff;}
.table-condensed th,.table-condensed td{padding:4px 5px;}
.table-bordered{border:1px solid #dddddd;border-collapse:separate;*border-collapse:collapse;border-left:0;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}.table-bordered th,.table-bordered td{border-left:1px solid #dddddd;}
.table-bordered caption+thead tr:first-child th,.table-bordered caption+tbody tr:first-child th,.table-bordered caption+tbody tr:first-child td,.table-bordered colgroup+thead tr:first-child th,.table-bordered colgroup+tbody tr:first-child th,.table-bordered colgroup+tbody tr:first-child td,.table-bordered thead:first-child tr:first-child th,.table-bordered tbody:first-child tr:first-child th,.table-bordered tbody:first-child tr:first-child td{border-top:0;}
.table-bordered thead:first-child tr:first-child>th:first-child,.table-bordered tbody:first-child tr:first-child>td:first-child,.table-bordered tbody:first-child tr:first-child>th:first-child{-webkit-border-top-left-radius:4px;-moz-border-radius-topleft:4px;border-top-left-radius:4px;}
.table-bordered thead:first-child tr:first-child>th:last-child,.table-bordered tbody:first-child tr:first-child>td:last-child,.table-bordered tbody:first-child tr:first-child>th:last-child{-webkit-border-top-right-radius:4px;-moz-border-radius-topright:4px;border-top-right-radius:4px;}
.table-bordered thead:last-child tr:last-child>th:first-child,.table-bordered tbody:last-child tr:last-child>td:first-child,.table-bordered tbody:last-child tr:last-child>th:first-child,.table-bordered tfoot:last-child tr:last-child>td:first-child,.table-bordered tfoot:last-child tr:last-child>th:first-child{-webkit-border-bottom-left-radius:4px;-moz-border-radius-bottomleft:4px;border-bottom-left-radius:4px;}
.table-bordered thead:last-child tr:last-child>th:last-child,.table-bordered tbody:last-child tr:last-child>td:last-child,.table-bordered tbody:last-child tr:last-child>th:last-child,.table-bordered tfoot:last-child tr:last-child>td:last-child,.table-bordered tfoot:last-child tr:last-child>th:last-child{-webkit-border-bottom-right-radius:4px;-moz-border-radius-bottomright:4px;border-bottom-right-radius:4px;}
.table-bordered tfoot+tbody:last-child tr:last-child td:first-child{-webkit-border-bottom-left-radius:0;-moz-border-radius-bottomleft:0;border-bottom-left-radius:0;}
.table-bordered tfoot+tbody:last-child tr:last-child td:last-child{-webkit-border-bottom-right-radius:0;-moz-border-radius-bottomright:0;border-bottom-right-radius:0;}
.table-bordered caption+thead tr:first-child th:first-child,.table-bordered caption+tbody tr:first-child td:first-child,.table-bordered colgroup+thead tr:first-child th:first-child,.table-bordered colgroup+tbody tr:first-child td:first-child{-webkit-border-top-left-radius:4px;-moz-border-radius-topleft:4px;border-top-left-radius:4px;}
.table-bordered caption+thead tr:first-child th:last-child,.table-bordered caption+tbody tr:first-child td:last-child,.table-bordered colgroup+thead tr:first-child th:last-child,.table-bordered colgroup+tbody tr:first-child td:last-child{-webkit-border-top-right-radius:4px;-moz-border-radius-topright:4px;border-top-right-radius:4px;}
.table-striped tbody>tr:nth-child(odd)>td,.table-striped tbody>tr:nth-child(odd)>th{background-color:#f9f9f9;}
.table-hover tbody tr:hover>td,.table-hover tbody tr:hover>th{background-color:#f5f5f5;}
table td[class*="span"],table th[class*="span"],.row-fluid table td[class*="span"],.row-fluid table th[class*="span"]{display:table-cell;float:none;margin-left:0;}
.table tbody tr.success>td{background-color:#dff0d8;}
.table tbody tr.error>td{background-color:#f2dede;}
.table tbody tr.warning>td{background-color:#fcf8e3;}
.table tbody tr.info>td{background-color:#d9edf7;}
.table-hover tbody tr.success:hover>td{background-color:#d0e9c6;}
.table-hover tbody tr.error:hover>td{background-color:#ebcccc;}
.table-hover tbody tr.warning:hover>td{background-color:#faf2cc;}
.table-hover tbody tr.info:hover>td{background-color:#c4e3f3;}
</style>
<body>
<table class="table table-striped table-bordered table-hover table-condensed table-responsive">
<thead>
<tr><th width="20%">Message</th><th>Detail</th></tr>
</thead>
<tbody>
<?php
	foreach($_POST as $var=>$val){
		$var = ucwords(str_replace('_',' ', $var));
		if($var != 'Captcha')echo "<tr><td>{$var}</td><td>".nl2br($val)."</td></tr>";
	}
?>
</tbody>
</table>
</body>
</html>
