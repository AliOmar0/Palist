<?php 
$id=check_get_id();
$_form_resp=db('bulk_push_notification_1633289547','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('bulk_push_notification_1633289547','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="bulk_push_notification_1633289547_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="bulk_push_notification_1633289547"><!--

		--><div class="view_box  bulk_push_notification_1633289547_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  bulk_push_notification_1633289547_view_message  ">
<div class="view_label view_label_message"><?=l('Message<>الرسالة')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['message'])?></div>
</div><!--

		--><div class="view_box  bulk_push_notification_1633289547_view_specific_users_module  ">
<div class="view_label view_label_specific_users_module"><?=l('Specific Users Module<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['specific_users_module']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('bulk_push_notification_1633289547','specific_users_module',$sub_resp[0],true);
                        ?></div>
</div><!--

--></div>
<?php } ?>