<?php 
$id=check_get_id();
$_form_resp=db('business_type_8368','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('business_type_8368','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="business_type_8368_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="business_type_8368"><!--

		--><div class="view_box business_type_8368_view_title ">
<div class="view_label view_label_title"><?=l("Title<>")?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

--></div>
<?php } ?>