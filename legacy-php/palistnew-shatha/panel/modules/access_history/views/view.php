<?php 
$id=check_get_id();
$_form_resp=db('access_history','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('access_history','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="access_history_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="access_history"><!--

		--><div class="view_box  access_history_view_module_prefix  ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>')?></div>
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

		--><div class="view_box  access_history_view_user_id  ">
<div class="view_label view_label_user_id"><?=l('User ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['user_id'])?></div>
</div><!--

		--><div class="view_box  access_history_view_remark  ">
<div class="view_label view_label_remark"><?=l('Remark<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['remark'])?></div>
</div><!--

		--><div class="view_box  access_history_view_ip  ">
<div class="view_label view_label_ip"><?=l('IP<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['ip'])?></div>
</div><!--

		--><div class="view_box  access_history_view_browser  ">
<div class="view_label view_label_browser"><?=l('Browser<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['browser'])?></div>
</div><!--

		--><div class="view_box  access_history_view_referer  ">
<div class="view_label view_label_referer"><?=l('Referer<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['referer'])?></div>
</div><!--

		--><div class="view_box  access_history_view_browser_language  ">
<div class="view_label view_label_browser_language"><?=l('Browser Language<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['browser_language'])?></div>
</div><!--

--></div>
<?php } ?>