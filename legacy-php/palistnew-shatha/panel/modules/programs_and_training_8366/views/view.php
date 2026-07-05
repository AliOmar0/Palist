<?php 
$id=check_get_id();
$_form_resp=db('programs_and_training_8366','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('programs_and_training_8366','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="programs_and_training_8366_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="programs_and_training_8366"><!--

		--><div class="view_box  programs_and_training_8366_view_photo  ">
<div class="view_label view_label_photo"><?=l('Photo<>صورة')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box  programs_and_training_8366_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  programs_and_training_8366_view_content  ">
<div class="view_label view_label_content"><?=l('Content<>المحتوى')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

		--><div class="view_box  programs_and_training_8366_view_publish_date  ">
<div class="view_label view_label_publish_date"><?=l('Publish Date<>تاريخ البرنامج')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['publish_date'])?></div>
</div><!--

--></div>
<?php } ?>