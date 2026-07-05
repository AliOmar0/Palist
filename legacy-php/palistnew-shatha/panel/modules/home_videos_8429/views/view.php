<?php 
$id=check_get_id();
$_form_resp=db('home_videos_8429','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('home_videos_8429','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="home_videos_8429_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="home_videos_8429"><!--

		--><div class="view_box  home_videos_8429_view_video  ">
<div class="view_label view_label_video"><?=l('Video<>')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$post;
							$post=['file'=>$_form_resp[0]['video']];
							include cms_dir.'legion_file.php';
							$post=$tmp;
							?>
							</div>
</div><!--

		--><div class="view_box  home_videos_8429_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

--></div>
<?php } ?>