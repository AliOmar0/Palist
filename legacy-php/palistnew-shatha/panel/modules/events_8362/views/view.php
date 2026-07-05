<?php 
$id=check_get_id();
$_form_resp=db('events_8362','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('events_8362','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="events_8362_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="events_8362"><!--

		--><div class="view_box events_8362_view_title ">
<div class="view_label view_label_title"><?=l("Title<>العنوان")?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box events_8362_view_event_date ">
<div class="view_label view_label_event_date"><?="Event Date"?></div>
<div class="viewValue  "><?=l($_form_resp[0]['event_date'])?></div>
</div><!--

		--><div class="view_box events_8362_view_events_description ">
<div class="view_label view_label_events_description"><?=l("Events Description<>وصف المناسبة")?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['events_description'])?></div>
</div><!--

		--><div class="view_box events_8362_view_photo ">
<div class="view_label view_label_photo"><?="Photo"?></div>
<div class="viewValue  "><?php pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

--></div>
<?php } ?>