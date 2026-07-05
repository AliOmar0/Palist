<?php 
$id=check_get_id();
$_form_resp=db('documentations_8343','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('documentations_8343','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="documentations_8343_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="documentations_8343"><!--

		--><div class="view_box  documentations_8343_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  documentations_8343_view_content  ">
<div class="view_label view_label_content"><?=l('Content<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

		--><div class="view_box  documentations_8343_view_errors  ">
<div class="view_label view_label_errors"><?=l('Errors<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['errors']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>