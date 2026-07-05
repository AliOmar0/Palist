<?php 
$id=check_get_id();
$_form_resp=db('cookies_1565697908','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('cookies_1565697908','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="cookies_1565697908_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="cookies_1565697908"><!--

		--><div class="view_box  cookies_1565697908_view_user_id  ontwo in ">
<div class="view_label view_label_user_id"><?=l('User ID<>رقم مُعرّف المستخدم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['user_id'])?></div>
</div><!--

		--><div class="view_box  cookies_1565697908_view_module_id  ontwo in ">
<div class="view_label view_label_module_id"><?=l('Module ID<>نوع المستخدم')?></div>
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

		--><div class="view_box  cookies_1565697908_view_token  ">
<div class="view_label view_label_token"><?=l('Token<>الشيفرة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['token'])?></div>
</div><!--

		--><div class="view_box  cookies_1565697908_view_browser  ">
<div class="view_label view_label_browser"><?=l('Browser<>نوع المتصفح')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['browser'])?></div>
</div><!--

		--><div class="view_box  cookies_1565697908_view_browser_name  ">
<div class="view_label view_label_browser_name"><?=l('Browser Name<>اسم المتصفح')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['browser_name'])?></div>
</div><!--

--></div>
<?php } ?>