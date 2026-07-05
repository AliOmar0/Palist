<?php 
$id=check_get_id();
$_form_resp=db('croner_8308','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('croner_8308','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="croner_8308_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="croner_8308"><!--

		--><div class="view_box  croner_8308_view_module_prefix  ">
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

		--><div class="view_box  croner_8308_view_item_id  ">
<div class="view_label view_label_item_id"><?=l('Item ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['item_id'])?></div>
</div><!--

		--><div class="view_box  croner_8308_view_remark  ">
<div class="view_label view_label_remark"><?=l('Remark<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['remark'])?></div>
</div><!--

		--><div class="view_box  croner_8308_view_emails  ">
<div class="view_label view_label_emails"><?=l('Emails<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['emails'])?></div>
</div><!--

--></div>
<?php } ?>