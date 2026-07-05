<?php 
$id=check_get_id();
$_form_resp=db('privileges_1565709771','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('privileges_1565709771','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="privileges_1565709771_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="privileges_1565709771"><!--

		--><div class="view_box  privileges_1565709771_view_user_id  ">
<div class="view_label view_label_user_id"><?=l('User ID<>رقم مُعرّف المستخدم')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('admins',"WHERE deleted=0  AND id='".$_form_resp[0]['user_id']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='username';
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

		--><div class="view_box  privileges_1565709771_view_module_name  ">
<div class="view_label view_label_module_name"><?=l('Module Name<>نوع المستخدم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['module_name'])?></div>
</div><!--

		--><div class="view_box  privileges_1565709771_view_type_name  ">
<div class="view_label view_label_type_name"><?=l('Type Name<>الأمر')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['type_name'])?></div>
</div><!--

--></div>
<?php } ?>