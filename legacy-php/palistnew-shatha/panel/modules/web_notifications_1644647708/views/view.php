<?php 
$id=check_get_id();
$_form_resp=db('web_notifications_1644647708','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('web_notifications_1644647708','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="web_notifications_1644647708_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="web_notifications_1644647708"><!--

		--><div class="view_box  web_notifications_1644647708_view_user  ontwo in ">
<div class="view_label view_label_user"><?=l('User<>المستخدم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['user'])?></div>
</div><!--

		--><div class="view_box  web_notifications_1644647708_view_user_module  ontwo in ">
<div class="view_label view_label_user_module"><?=l('User Module<>نوع المستخدم')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['user_module']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  web_notifications_1644647708_view_module_id  ">
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

		--><div class="view_box  web_notifications_1644647708_view_action_id  ">
<div class="view_label view_label_action_id"><?=l('Action ID<>الأمر')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_actions',"WHERE deleted=0  AND id='".$_form_resp[0]['action_id']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  web_notifications_1644647708_view_related_id  ">
<div class="view_label view_label_related_id"><?=l('Related ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['related_id'])?></div>
</div><!--

		--><div class="view_box  web_notifications_1644647708_view_custom_title  ">
<div class="view_label view_label_custom_title"><?=l('Custom Title<>عنوان خاص')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['custom_title'])?></div>
</div><!--

		--><div class="view_box  web_notifications_1644647708_view_custom_link  ">
<div class="view_label view_label_custom_link"><?=l('Custom Link<>رابط خاص')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['custom_link'])?></div>
</div><!--

		--><div class="view_box  web_notifications_1644647708_view_seen  ">
<div class="view_label view_label_seen"><?=l('Seen<>شوهِد')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['seen']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>