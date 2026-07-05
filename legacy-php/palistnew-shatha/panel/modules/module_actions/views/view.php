<?php 
$id=check_get_id();
$_form_resp=db('module_actions','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('module_actions','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="module_actions_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="module_actions"><!--

		--><div class="view_box  module_actions_view_module_id  ">
<div class="view_label view_label_module_id"><?=l('Module ID<>')?></div>
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

		--><div class="view_box  module_actions_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  module_actions_view_type  ">
<div class="view_label view_label_type"><?=l('Type<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['type'])?></div>
</div><!--

		--><div class="view_box  module_actions_view_icon  ">
<div class="view_label view_label_icon"><?=l('Icon<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['icon'])?></div>
</div><!--

		--><div class="view_box  module_actions_view_private  ">
<div class="view_label view_label_private"><?=l('Private<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['private']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>