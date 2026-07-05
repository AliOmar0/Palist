<?php 
$id=check_get_id();
$_form_resp=db('languages_1557157519','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('languages_1557157519','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="languages_1557157519_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="languages_1557157519"><!--

		--><div class="view_box  languages_1557157519_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  languages_1557157519_view_prefix  ">
<div class="view_label view_label_prefix"><?=l('Prefix<>الدالة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['prefix'])?></div>
</div><!--

		--><div class="view_box  languages_1557157519_view_language_name  ">
<div class="view_label view_label_language_name"><?=l('Language Name<>اسم اللغة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['language_name'])?></div>
</div><!--

		--><div class="view_box  languages_1557157519_view_direction  ">
<div class="view_label view_label_direction"><?=l('Direction<>اتجاه الكتابة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['direction'])?></div>
</div><!--

		--><div class="view_box  languages_1557157519_view_active  ">
<div class="view_label view_label_active"><?=l('Active<>التفعيل')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['active']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>