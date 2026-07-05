<?php 
$id=check_get_id();
$_form_resp=db('advertisements_8362','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('advertisements_8362','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="advertisements_8362_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="advertisements_8362"><!--

		--><div class="view_box advertisements_8362_view_title ">
<div class="view_label view_label_title"><?=l("Title<>العنوان")?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box advertisements_8362_view_content ">
<div class="view_label view_label_content"><?=l("Content<>المحتوى")?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

		--><div class="view_box advertisements_8362_view_photo ">
<div class="view_label view_label_photo"><?="Photo"?></div>
<div class="viewValue  "><?php pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

--></div>
<?php } ?>