<?php 
$id=check_get_id();
$_form_resp=db('majors_8367','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('majors_8367','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="majors_8367_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="majors_8367"><!--

		--><div class="view_box majors_8367_view_title ">
<div class="view_label view_label_title"><?=l("Title<>العنوان")?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

--></div>
<?php } ?>