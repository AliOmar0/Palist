<?php 
$id=check_get_id();
$_form_resp=db('members_8364','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('members_8364','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="members_8364_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="members_8364"><!--

		--><div class="view_box  members_8364_view_name  ">
<div class="view_label view_label_name"><?=l('Name<>الاسم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['name'])?></div>
</div><!--

		--><div class="view_box  members_8364_view_job_name  ">
<div class="view_label view_label_job_name"><?=l('Job Name<>اسم الوظيفة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['job_name'])?></div>
</div><!--

		--><div class="view_box  members_8364_view_photo  ">
<div class="view_label view_label_photo"><?=l('Photo<>صورة')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box  members_8364_view_summary  ">
<div class="view_label view_label_summary"><?=l('Summary<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['summary'])?></div>
</div><!--

		--><div class="view_box  members_8364_view_content  ">
<div class="view_label view_label_content"><?=l('Content<>المحتوى')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

		--><div class="view_box  members_8364_view_order_number  ">
<div class="view_label view_label_order_number"><?=l('Order Number<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['order_number'])?></div>
</div><!--

--></div>
<?php } ?>