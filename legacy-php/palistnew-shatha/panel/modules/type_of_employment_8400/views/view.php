<?php 
$id=check_get_id();
$_form_resp=db('type_of_employment_8400','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('type_of_employment_8400','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="type_of_employment_8400_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="type_of_employment_8400"><!--

		--><div class="view_box  type_of_employment_8400_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

--></div>
<?php } ?>