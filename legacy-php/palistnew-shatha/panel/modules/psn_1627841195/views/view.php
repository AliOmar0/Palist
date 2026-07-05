<?php 
$id=check_get_id();
$_form_resp=db('psn_1627841195','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('psn_1627841195','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="psn_1627841195_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="psn_1627841195"><!--

		--><div class="view_box  psn_1627841195_view_user  ">
<div class="view_label view_label_user"><?=l('User<>المستخدم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['user'])?></div>
</div><!--

		--><div class="view_box  psn_1627841195_view_module_prefix  ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>نوع المستخدم')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['module_prefix']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('psn_1627841195','module_prefix',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  psn_1627841195_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  psn_1627841195_view_message  ">
<div class="view_label view_label_message"><?=l('Message<>الرسالة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['message'])?></div>
</div><!--

		--><div class="view_box  psn_1627841195_view_seen  ">
<div class="view_label view_label_seen"><?=l('Seen<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['seen']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  psn_1627841195_view_extra  ">
<div class="view_label view_label_extra"><?=l('Extra<>اضافات')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['extra'])?></div>
</div><!--

--></div>
<?php } ?>