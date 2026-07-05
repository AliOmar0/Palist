<?php 
$id=check_get_id();
$_form_resp=db('entries_log_8503','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('entries_log_8503','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="entries_log_8503_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="entries_log_8503"><!--

		--><div class="view_box  entries_log_8503_view_entry_module  ontwo in ">
<div class="view_label view_label_entry_module"><?=l('Entry Module<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['entry_module']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  entries_log_8503_view_entry_id  ontwo in ">
<div class="view_label view_label_entry_id"><?=l('Entry ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['entry_id'])?></div>
</div><!--

		--><div class="view_box  entries_log_8503_view_user_module  ">
<div class="view_label view_label_user_module"><?=l('User Module<>')?></div>
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

		--><div class="view_box  entries_log_8503_view_user_id  ontwo in ">
<div class="view_label view_label_user_id"><?=l('User ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['user_id'])?></div>
</div><!--

		--><div class="view_box  entries_log_8503_view_action  ">
<div class="view_label view_label_action"><?=l('Action<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['action'])?></div>
</div><!--

		--><div class="view_box  entries_log_8503_view_remark  ">
<div class="view_label view_label_remark"><?=l('Remark<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['remark'])?></div>
</div><!--

--></div>
<?php } ?>