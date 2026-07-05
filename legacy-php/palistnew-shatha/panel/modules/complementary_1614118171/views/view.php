<?php 
$id=check_get_id();
$resp=db('complementary_1614118171','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('complementary_1614118171','view') || $resp==0 || $resp==1)echo $noPermission;else{?>
<div id="complementary_1614118171_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="complementary_1614118171"><!--

		--><div class="view_box complementary_1614118171_view_mother_module_prefix  ontwo in">
<div class="view_label view_label_mother_module_prefix"><?="Mother Module Prefix"?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$resp[0]['mother_module_prefix']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box complementary_1614118171_view_mother_id  ontwo in">
<div class="view_label view_label_mother_id"><?="Mother ID"?></div>
<div class="viewValue  "><?=l($resp[0]['mother_id'])?></div>
</div><!--

		--><div class="view_box complementary_1614118171_view_child_module_prefix  ontwo in">
<div class="view_label view_label_child_module_prefix"><?="Child Module Prefix"?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$resp[0]['child_module_prefix']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box complementary_1614118171_view_child_id  ontwo in">
<div class="view_label view_label_child_id"><?="Child ID"?></div>
<div class="viewValue  "><?=l($resp[0]['child_id'])?></div>
</div><!--

--></div>
<?php } ?>