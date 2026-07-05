<?php 
$id=check_get_id();
$_form_resp=db('tester_1565720578','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('tester_1565720578','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="tester_1565720578_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="tester_1565720578"><!--

		--><div class="view_box  tester_1565720578_view_raw_post  ">
<div class="view_label view_label_raw_post"><?=l('Raw Post<>المعلومات المُرسلة')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['raw_post'])?></div>
</div><!--

		--><div class="view_box  tester_1565720578_view_specific_data  ">
<div class="view_label view_label_specific_data"><?=l('Specific Data<>معلومات محددة')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['specific_data'])?></div>
</div><!--

--></div>
<?php } ?>