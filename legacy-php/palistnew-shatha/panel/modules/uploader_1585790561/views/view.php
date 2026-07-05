<?php 
$id=check_get_id();
$_form_resp=db('uploader_1585790561','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('uploader_1585790561','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="uploader_1585790561_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="uploader_1585790561"><!--

		--><div class="view_box  uploader_1585790561_view_photo  ">
<div class="view_label view_label_photo"><?=l('Photo<>')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box  uploader_1585790561_view_file  ">
<div class="view_label view_label_file"><?=l('File<>')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$post;
							$post=['file'=>$_form_resp[0]['file']];
							include cms_dir.'legion_file.php';
							$post=$tmp;
							?>
							</div>
</div><!--

--></div>
<?php } ?>