<?php 
$id=check_get_id();
$_form_resp=db('contact_form_8363','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('contact_form_8363','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="contact_form_8363_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="contact_form_8363"><!--

		--><div class="view_box  contact_form_8363_view_name  ontwo in ">
<div class="view_label view_label_name"><?=l('Name<>الاسم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['name'])?></div>
</div><!--

		--><div class="view_box  contact_form_8363_view_email  ontwo in ">
<div class="view_label view_label_email"><?=l('Email<>البريد الالكتروني')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['email'])?></div>
</div><!--

		--><div class="view_box  contact_form_8363_view_mobile_number  ontwo in ">
<div class="view_label view_label_mobile_number"><?=l('Mobile Number<>رقم الجوال')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['mobile_number'])?></div>
</div><!--

		--><div class="view_box  contact_form_8363_view_telephone  ontwo in ">
<div class="view_label view_label_telephone"><?=l('Telephone<>رقم الهاتف')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['telephone'])?></div>
</div><!--

		--><div class="view_box  contact_form_8363_view_message  ">
<div class="view_label view_label_message"><?=l('Message<>الرسالة')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['message'])?></div>
</div><!--

--></div>
<?php } ?>