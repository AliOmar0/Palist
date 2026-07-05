<?php 
$id=check_get_id();
$_form_resp=db('publications_8367','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('publications_8367','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="publications_8367_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="publications_8367"><!--

		--><div class="view_box  publications_8367_view_photo  ">
<div class="view_label view_label_photo"><?=l('Photo<>صورة')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box  publications_8367_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  publications_8367_view_link  ">
<div class="view_label view_label_link"><?=l('Link<>')?></div>
<div class="viewValue  "><a href="<?=$_form_resp[0]['link'] ?>" target="_blank"><i>link</i></a></div>
</div><!--

		--><div class="view_box  publications_8367_view_publish_date  ">
<div class="view_label view_label_publish_date"><?=l('Publish Date<>تاريخ البرنامج')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['publish_date'])?></div>
</div><!--

--></div>
<?php } ?>