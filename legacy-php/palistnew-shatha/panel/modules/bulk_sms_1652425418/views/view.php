<?php 
$id=check_get_id();
$_form_resp=db('bulk_sms_1652425418','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('bulk_sms_1652425418','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="bulk_sms_1652425418_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="bulk_sms_1652425418"><!--

		--><div class="view_box  bulk_sms_1652425418_view_message  ">
<div class="view_label view_label_message"><?=l('Message<>الرسالة')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['message'])?></div>
</div><!--

		--><div class="view_box  bulk_sms_1652425418_view_module_prefix  ontwo in ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>نوع الحساب')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['module_prefix']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='module_name';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($sub_resp[0][$x[$e]]); 
                        }
                        }
                        ?></div>
</div><!--

		--><div class="view_box  bulk_sms_1652425418_view_mobile_field  ontwo in ">
<div class="view_label view_label_mobile_field"><?=l('Mobile Field<>خانة الخلوي')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_fields',"WHERE deleted=0  AND id='".$_form_resp[0]['mobile_field']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='label';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($sub_resp[0][$x[$e]]); 
                        }
                        }
                        ?></div>
</div><!--

--></div>
<?php } ?>