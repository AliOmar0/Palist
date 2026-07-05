<?php 
$id=check_get_id();
$_form_resp=db('control_1566842582','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('control_1566842582','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="control_1566842582_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="control_1566842582"><!--

		--><div class="view_box  control_1566842582_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  control_1566842582_view_code  ">
<div class="view_label view_label_code"><?=l('Code<>مُعَرِّف خاص')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['code'])?></div>
</div><!--

		--><div class="view_box  control_1566842582_view_photo  ontwo in ">
<div class="view_label view_label_photo"><?=l('Photo<>صورة')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box  control_1566842582_view_file  ontwo in ">
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

		--><div class="view_box  control_1566842582_view_color  ontwo in ">
<div class="view_label view_label_color"><?=l('Color<>')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['color']?>""></div>
</div><!--

		--><div class="view_box  control_1566842582_view_active  ontwo in ">
<div class="view_label view_label_active"><?=l('Active<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['active']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  control_1566842582_view_text  ">
<div class="view_label view_label_text"><?=l('Text<>النص')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['text'])?></div>
</div><!--

		--><div class="view_box  control_1566842582_view_formatted_text  ">
<div class="view_label view_label_formatted_text"><?=l('Formatted Text<>النص الكامل')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['formatted_text'])?></div>
</div><!--

--></div>
<?php } ?>