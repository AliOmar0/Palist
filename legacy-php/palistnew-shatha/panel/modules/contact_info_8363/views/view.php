<?php 
$id=check_get_id();
$_form_resp=db('contact_info_8363','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('contact_info_8363','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="contact_info_8363_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="contact_info_8363"><!--

		--><div class="view_box contact_info_8363_view_phone ">
<div class="view_label view_label_phone"><?="Phone"?></div>
<div class="viewValue  "><?=l($_form_resp[0]['phone'])?></div>
</div><!--

		--><div class="view_box contact_info_8363_view_email ">
<div class="view_label view_label_email"><?="Email"?></div>
<div class="viewValue  "><?=l($_form_resp[0]['email'])?></div>
</div><!--

		--><div class="view_box contact_info_8363_view_location ">
<div class="view_label view_label_location"><?=l("Location<>الموقع")?></div>
<div class="viewValue  "><?=l($_form_resp[0]['location'])?></div>
</div><!--

--></div>
<?php } ?>