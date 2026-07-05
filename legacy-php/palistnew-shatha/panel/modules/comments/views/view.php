<?php 
$id=check_get_id();
$_form_resp=db('comments','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('comments','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="comments_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="comments"><!--

		--><div class="view_box  comments_view_module_prefix  ">
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

		--><div class="view_box  comments_view_related_id  ">
<div class="view_label view_label_related_id"><?=l('Related ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['related_id'])?></div>
</div><!--

		--><div class="view_box  comments_view_commenter_module  ">
<div class="view_label view_label_commenter_module"><?=l('Commenter Module<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['commenter_module']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  comments_view_commenter_id  ">
<div class="view_label view_label_commenter_id"><?=l('Commenter ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['commenter_id'])?></div>
</div><!--

		--><div class="view_box  comments_view_comment  ">
<div class="view_label view_label_comment"><?=l('Comment<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['comment'])?></div>
</div><!--

		--><div class="view_box view_group comments_view_Additional Info  ">
<div class="view_label view_label_Additional Info"><?=l('<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Additional Info'])?></div>
</div><clear></clear><!--

		--><div class="view_box  comments_view_remark  ">
<div class="view_label view_label_remark"><?=l('Remark<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['remark'])?></div>
</div><!--

		--><div class="view_box  comments_view_files  ">
<div class="view_label view_label_files"><?=l('Files<>')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$resp;
							$i=0;
							$resp=[['files'=>$_form_resp[0]['files']]];
							include cms_dir.'legion_files.php';
							$resp=$tmp;
							?>
							</div>
</div><!--

--></div>
<?php } ?>