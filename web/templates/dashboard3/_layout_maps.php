<div class="col-md-12 text-center">
<svg baseprofile="tiny" fill="#7c7c7c" height="500" stroke="#ffffff" stroke-linecap="round" 
     stroke-linejoin="round" 
     stroke-width="2" version="1.2" viewbox="120 30 550 300" width="1350" xmlns="http://www.w3.org/2000/svg"
   
>
   
<?php
   foreach($maps as $var=>$_){
      echo '<path d="'.$_->path.'" id="id_'.$_->no_prop.'" name="" class="id_'.$_->no_prop.' map_svg_path"></path>'."\n\r";
   }
?>
</svg>
</div>
<div class="col-md-12 text-center rows">
   <button class="btn_reset_map_tr" onclick="reset_map_tr();" class="btn btn-info">Show All</button>
   <br /><br />
</div>
<div class="col-md-12 text-center rows" id="map-table"></div>