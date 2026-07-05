<?php 
$id=check_get_id();
$_form_resp=db('fonts_1582219344','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('fonts_1582219344','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="fonts_1582219344_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="fonts_1582219344"><!--

		--><div class="view_box  fonts_1582219344_view_css_name  ">
<div class="view_label view_label_css_name"><?=l('CSS Name<>اسم الخط')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['css_name'])?></div>
</div><!--

		--><div class="view_box  fonts_1582219344_view_file  ">
<div class="view_label view_label_file"><?=l('File<>الملف')?></div>
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