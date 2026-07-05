<?php 
$id=check_get_id();
$_form_resp=db('join_us_8367','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('join_us_8367','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="join_us_8367_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="join_us_8367"><!--

		--><div class="view_box  join_us_8367_view_major  ">
<div class="view_label view_label_major"><?=l('Major<>التخصص')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('majors_8367',"WHERE deleted=0  AND id='".$_form_resp[0]['major']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  join_us_8367_view_cv  ">
<div class="view_label view_label_cv"><?=l('Cv<>السيرة الذاتية')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$resp;
							$i=0;
							$resp=[['files'=>$_form_resp[0]['cv']]];
							include cms_dir.'legion_files.php';
							$resp=$tmp;
							?>
							</div>
</div><!--

--></div>
<?php } ?>