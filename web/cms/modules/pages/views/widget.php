<?php 
$widget = Modules::run('widget/get_widget_pages', $pages->id);

if (count($widget)) {
echo '';
$widget_code = Modules::run('widget/get_widget_content', $widget);

if (count($widget_code)) {
	echo '<div class="row-fluid">';
	foreach ($widget_code as $code) {
		if(isset($code->code) && $code->acc) {
			echo '<div class="span4 margin-bottom-20">';
			if($code->title_show) echo '<h3 class="text-left">'.$code->title.'</h3>';
			echo Shortcodes::parse($code->code);
			echo '</div>';
		}
	}
	echo '</div>';
}
echo '';
}
?>
