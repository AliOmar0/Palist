<?php 
$id=check_get_id();
$_form_resp=db('notifier_1644648674','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('notifier_1644648674','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="notifier_1644648674_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="notifier_1644648674"><!--

		--><div class="view_box  notifier_1644648674_view_module_id  ">
<div class="view_label view_label_module_id"><?=l('Module ID<>البرمجية')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['module_id']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  notifier_1644648674_view_module_action  ">
<div class="view_label view_label_module_action"><?=l('Module Action<>الأمر')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_actions',"WHERE deleted=0  AND id='".$_form_resp[0]['module_action']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='title';
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

		--><div class="view_box  notifier_1644648674_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  notifier_1644648674_view_email_notification  ">
<div class="view_label view_label_email_notification"><?=l('Email Notification<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['email_notification']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>