<?php 
$id=check_get_id();
$_form_resp=db('about_the_syndicate_8362','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('about_the_syndicate_8362','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="about_the_syndicate_8362_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="about_the_syndicate_8362"><!--

		--><div class="view_box  about_the_syndicate_8362_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_photo  ">
<div class="view_label view_label_photo"><?=l('Photo<>الصورة')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_photo_in_single  ">
<div class="view_label view_label_photo_in_single"><?=l('Photo_in_single<>')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo_in_single']!='')pic($_form_resp[0]['photo_in_single'],200,100)?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_summary  ">
<div class="view_label view_label_summary"><?=l('Summary<>ملخص')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['summary'])?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_content  ">
<div class="view_label view_label_content"><?=l('Content<>المحتوى')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_mission_icon  ">
<div class="view_label view_label_mission_icon"><?=l('Mission Icon<>ايقونة الرسالة')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['mission_icon']!='')pic($_form_resp[0]['mission_icon'],200,100)?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_mission_title  ">
<div class="view_label view_label_mission_title"><?=l('Mission Title<>عنوان الرسالة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['mission_title'])?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_mission_content  ">
<div class="view_label view_label_mission_content"><?=l('Mission Content<>محتوى الرسالة')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['mission_content'])?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_vision_icon  ">
<div class="view_label view_label_vision_icon"><?=l('Vision Icon<>أيقونة الرؤية')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['vision_icon']!='')pic($_form_resp[0]['vision_icon'],200,100)?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_vision_title  ">
<div class="view_label view_label_vision_title"><?=l('Vision Title<>عنوان الرؤية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['vision_title'])?></div>
</div><!--

		--><div class="view_box  about_the_syndicate_8362_view_vision_content  ">
<div class="view_label view_label_vision_content"><?=l('Vision Content<>محتوى الرؤية')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['vision_content'])?></div>
</div><!--

--></div>
<?php } ?>