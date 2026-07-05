<?php 
$id=check_get_id();
$_form_resp=db('photos_library__8366','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('photos_library__8366','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="photos_library__8366_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="photos_library__8366"><!--

		--><div class="view_box photos_library__8366_view_title ">
<div class="view_label view_label_title"><?=l("Title<>العنوان")?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box photos_library__8366_view_cover_photo ">
<div class="view_label view_label_cover_photo"><?="Cover Photo"?></div>
<div class="viewValue  "><?php pic($_form_resp[0]['cover_photo'],200,100)?></div>
</div><!--

--></div>
<?php } ?>