<?php 
$id=check_get_id();
$_form_resp=db('error_1528374155','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('error_1528374155','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="error_1528374155_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="error_1528374155"><!--

		--><div class="view_box  error_1528374155_view_error_desc  ">
<div class="view_label view_label_error_desc"><?=l('Error Desc<>وصف الخطأ')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['error_desc'])?></div>
</div><!--

		--><div class="view_box  error_1528374155_view_icon  ">
<div class="view_label view_label_icon"><?=l('Icon<>الأيقونة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['icon'])?></div>
</div><!--

		--><div class="view_box  error_1528374155_view_die  ">
<div class="view_label view_label_die"><?=l('Die<>إيقاف إجباري للبرمجية')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['die']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>