<?php 
$id=check_get_id();
$_form_resp=db('social_situation_8368','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('social_situation_8368','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="social_situation_8368_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="social_situation_8368"><!--

		--><div class="view_box social_situation_8368_view_title ">
<div class="view_label view_label_title"><?=l("Title<>")?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

--></div>
<?php } ?>