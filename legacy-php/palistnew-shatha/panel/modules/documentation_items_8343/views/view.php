<?php 
$id=check_get_id();
$_form_resp=db('documentation_items_8343','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('documentation_items_8343','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="documentation_items_8343_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="documentation_items_8343"><!--

		--><div class="view_box  documentation_items_8343_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  documentation_items_8343_view_documentation  ">
<div class="view_label view_label_documentation"><?=l('Documentation<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('documentations_8343',"WHERE deleted=0  AND id='".$_form_resp[0]['documentation']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  documentation_items_8343_view_content  ">
<div class="view_label view_label_content"><?=l('Content<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

		--><div class="view_box  documentation_items_8343_view_additional_content  ">
<div class="view_label view_label_additional_content"><?=l('Additional Content<>')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['additional_content'])?></div>
</div><!--

		--><div class="view_box  documentation_items_8343_view_order_number  ">
<div class="view_label view_label_order_number"><?=l('Order Number<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['order_number'])?></div>
</div><!--

--></div>
<?php } ?>