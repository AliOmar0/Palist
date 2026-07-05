<?php 
$id=check_get_id();
$_form_resp=db('sms_1583164170','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('sms_1583164170','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="sms_1583164170_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="sms_1583164170"><!--

		--><div class="view_box  sms_1583164170_view_country_code  ontwo in ">
<div class="view_label view_label_country_code"><?=l('Country Code<>المقدمة الدولية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['country_code'])?></div>
</div><!--

		--><div class="view_box  sms_1583164170_view_phone_number  ontwo in ">
<div class="view_label view_label_phone_number"><?=l('Phone Number<>رقم الخلوي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['phone_number'])?></div>
</div><!--

		--><div class="view_box  sms_1583164170_view_message  ">
<div class="view_label view_label_message"><?=l('Message<>الرسالة')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['message'])?></div>
</div><!--

--></div>
<?php } ?>