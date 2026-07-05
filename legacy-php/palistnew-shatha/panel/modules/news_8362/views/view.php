<?php 
$id=check_get_id();
$_form_resp=db('news_8362','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('news_8362','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="news_8362_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="news_8362"><!--

		--><div class="view_box  news_8362_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  news_8362_view_photo  ">
<div class="view_label view_label_photo"><?=l('Photo<>الصورة')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box  news_8362_view_summary  ">
<div class="view_label view_label_summary"><?=l('Summary<>الملخص')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['summary'])?></div>
</div><!--

		--><div class="view_box  news_8362_view_content  ">
<div class="view_label view_label_content"><?=l('Content<>المحتوى')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

		--><div class="view_box  news_8362_view_publish_date  ">
<div class="view_label view_label_publish_date"><?=l('Publish Date<>تاريخ النشر')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['publish_date'])?></div>
</div><!--

--></div>
<?php } ?>