<?php 
$id=check_get_id();
$_form_resp=db('modules','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('modules','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="modules_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="modules"><!--

		--><div class="view_box  modules_view_module_name  ">
<div class="view_label view_label_module_name"><?=l('Module Name<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['module_name'])?></div>
</div><!--

		--><div class="view_box  modules_view_module_prefix  ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['module_prefix'])?></div>
</div><!--

		--><div class="view_box  modules_view_order_by  ">
<div class="view_label view_label_order_by"><?=l('Order By<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['order_by'])?></div>
</div><!--

		--><div class="view_box  modules_view_version  ">
<div class="view_label view_label_version"><?=l('Version<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['version'])?></div>
</div><!--

		--><div class="view_box  modules_view_main_icon  ">
<div class="view_label view_label_main_icon"><?=l('Main Icon<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['main_icon'])?></div>
</div><!--

		--><div class="view_box  modules_view_legion_version  ">
<div class="view_label view_label_legion_version"><?=l('Legion Version<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['legion_version'])?></div>
</div><!--

		--><div class="view_box  modules_view_legion_build  ">
<div class="view_label view_label_legion_build"><?=l('Legion Build<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['legion_build'])?></div>
</div><!--

		--><div class="view_box  modules_view_is_edit_only  ">
<div class="view_label view_label_is_edit_only"><?=l('Is Edit Only<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['is_edit_only']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  modules_view_is_complemantary  ">
<div class="view_label view_label_is_complemantary"><?=l('Is Complemantary<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['is_complemantary']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  modules_view_models  ">
<div class="view_label view_label_models"><?=l('Models<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['models'])?></div>
</div><!--

		--><div class="view_box  modules_view_ml  ">
<div class="view_label view_label_ml"><?=l('ML<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['ml']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  modules_view_core  ">
<div class="view_label view_label_core"><?=l('Core<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['core']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  modules_view_cluster  ">
<div class="view_label view_label_cluster"><?=l('Cluster<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['cluster']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  modules_view_external_access  ">
<div class="view_label view_label_external_access"><?=l('External Access<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['external_access']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  modules_view_commerce  ">
<div class="view_label view_label_commerce"><?=l('Commerce<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['commerce']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>