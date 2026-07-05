<?php 
$id=check_get_id();
$_form_resp=db('quick_access_1563567918','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('quick_access_1563567918','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="quick_access_1563567918_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="quick_access_1563567918"><!--

		--><div class="view_box  quick_access_1563567918_view_module_prefix  ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>البرمجية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['module_prefix'])?></div>
</div><!--

		--><div class="view_box  quick_access_1563567918_view_action_of_module  ">
<div class="view_label view_label_action_of_module"><?=l('Action of Module<>الأمر')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['action_of_module'])?></div>
</div><!--

		--><div class="view_box  quick_access_1563567918_view_title_of_link  ">
<div class="view_label view_label_title_of_link"><?=l('Title of link<>عنوان الرابط')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title_of_link'])?></div>
</div><!--

		--><div class="view_box view_group quick_access_1563567918_view_Custom  ">
<div class="view_label view_label_Custom"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Custom'])?></div>
</div><clear></clear><!--

		--><div class="view_box  quick_access_1563567918_view_custom_link  ">
<div class="view_label view_label_custom_link"><?=l('Custom Link<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['custom_link'])?></div>
</div><!--

		--><div class="view_box  quick_access_1563567918_view_icon  ">
<div class="view_label view_label_icon"><?=l('Icon<>')?></div>
<div class="viewValue  "><i><?=$_form_resp[0]['icon']?></i></div>
</div><!--

--></div>
<?php } ?>