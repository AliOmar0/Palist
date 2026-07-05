<?php 
$id=check_get_id();
$_form_resp=db('video_gallery_8367','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('video_gallery_8367','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="video_gallery_8367_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="video_gallery_8367"><!--

		--><div class="view_box  video_gallery_8367_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  video_gallery_8367_view_youtube_link  ">
<div class="view_label view_label_youtube_link"><?=l('Youtube Link<>رابط اليوتيوب')?></div>
<div class="viewValue  "><a href="<?=$_form_resp[0]['youtube_link'] ?>" target="_blank"><i>link</i></a></div>
</div><!--

--></div>
<?php } ?>