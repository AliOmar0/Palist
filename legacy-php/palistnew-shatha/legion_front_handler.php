<?php

if(db('module_fields',"WHERE module_id='".mid($module)."' AND type='location'")!=1){
	$mapHere=true;
	include_once core_dir.'modules/map.php';
}
else $mapHere=false;

if($module!=NULL){
$m=db('module_settings',"WHERE module_prefix='$module'",NULL,"LIMIT 1");
    if($m!=0 || $m!=1){
        $m=$m[0];
		$m['info']=db('modules',"WHERE module_prefix='$module'",NULL,'LIMIT 1')[0];
		$m['module_id']=$m['info']['id'];
    }
		
		
if(detail('modules','ml','module_prefix',$module) == true){
?>
<script>
if (!document.getElementById('bread')) {
	document.getElementById('<?=$module?>').insertAdjacentHTML('afterbegin','<div id="bread"></div>');
}
</script>
<?php
		echo "<script>
		var ml_supp_input_names=".json_encode(explode(',',$m['ml_fields'])).";</script>";
		require panel_dir.'core/modules/lang.php';
	}
}