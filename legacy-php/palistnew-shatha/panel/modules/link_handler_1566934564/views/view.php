<?php 
$id=check_get_id();
$_form_resp=db('link_handler_1566934564','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('link_handler_1566934564','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="link_handler_1566934564_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="link_handler_1566934564"><!--

		--><div class="view_box  link_handler_1566934564_view_module_prefix  ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>البرمجيّة')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['module_prefix']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('link_handler_1566934564','module_prefix',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_all_entries  onthree in ">
<div class="view_label view_label_all_entries"><?=l('All Entries<>كل المُدخلات')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['all_entries'])?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_single  onthree in ">
<div class="view_label view_label_single"><?=l('Single<>مُدخل مٌفرد')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['single'])?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_custom  onthree in ">
<div class="view_label view_label_custom"><?=l('Custom<>خصخصة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['custom'])?></div>
</div><!--

		--><div class="view_box view_group link_handler_1566934564_view_Single Meta  ">
<div class="view_label view_label_Single Meta"><?=l('<>معلومات المشاركة لمُدخّل مُفرد')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Single Meta'])?></div>
</div><clear></clear><!--

		--><div class="view_box  link_handler_1566934564_view_single_title  onfour in ">
<div class="view_label view_label_single_title"><?=l('Single Title<>عنوان المُدخّل')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_fields',"WHERE deleted=0  AND id='".$_form_resp[0]['single_title']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('link_handler_1566934564','single_title',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_single_description  onfour in ">
<div class="view_label view_label_single_description"><?=l('Single Description<>وصف المُدخّل')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_fields',"WHERE deleted=0  AND id='".$_form_resp[0]['single_description']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('link_handler_1566934564','single_description',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_publish_date_field  onfour in ">
<div class="view_label view_label_publish_date_field"><?=l('Publish Date Field<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_fields',"WHERE deleted=0  AND id='".$_form_resp[0]['publish_date_field']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('link_handler_1566934564','publish_date_field',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_single_photo  onfour in ">
<div class="view_label view_label_single_photo"><?=l('Single Photo<>صورة المُدخَل')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_fields',"WHERE deleted=0  AND id='".$_form_resp[0]['single_photo']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('link_handler_1566934564','single_photo',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_single_title_alternative  onfour in ">
<div class="view_label view_label_single_title_alternative"><?=l('Single Title Alternative<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_fields',"WHERE deleted=0  AND id='".$_form_resp[0]['single_title_alternative']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('link_handler_1566934564','single_title_alternative',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_single_alternative  onfour in ">
<div class="view_label view_label_single_alternative"><?=l('Single Description Alternative<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_fields',"WHERE deleted=0  AND id='".$_form_resp[0]['single_alternative']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('link_handler_1566934564','single_alternative',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_single_photo_description  onfour in ">
<div class="view_label view_label_single_photo_description"><?=l('Single Photo Description<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('module_fields',"WHERE deleted=0  AND id='".$_form_resp[0]['single_photo_description']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('link_handler_1566934564','single_photo_description',$sub_resp[0],true);
                        ?></div>
</div><clear></clear><!--

		--><div class="view_box  link_handler_1566934564_view_single_title_prefix  onfour in ">
<div class="view_label view_label_single_title_prefix"><?=l('Single Title Prefix<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['single_title_prefix'])?></div>
</div><!--

		--><div class="view_box view_group link_handler_1566934564_view_All Entries Meta  ">
<div class="view_label view_label_All Entries Meta"><?=l('<>معلومات المشاركة لجميع المدخلات')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['All Entries Meta'])?></div>
</div><clear></clear><!--

		--><div class="view_box  link_handler_1566934564_view_all_entries_title  onfour in ">
<div class="view_label view_label_all_entries_title"><?=l('All Entries Title<>عنوان جميع المدخلات')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['all_entries_title'])?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_robot_index  onfour in ">
<div class="view_label view_label_robot_index"><?=l('Robot Index<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['robot_index']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_robot_follow  onfour in ">
<div class="view_label view_label_robot_follow"><?=l('Robot Follow<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['robot_follow']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_all_entries_photo  onfour in ">
<div class="view_label view_label_all_entries_photo"><?=l('All Entries Photo<>صورة جميع المدخلات')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['all_entries_photo']!='')pic($_form_resp[0]['all_entries_photo'],200,100)?></div>
</div><!--

		--><div class="view_box  link_handler_1566934564_view_all_entries_description  ">
<div class="view_label view_label_all_entries_description"><?=l('All Entries Description<>وصف جميع المدخلات')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['all_entries_description'])?></div>
</div><!--

--></div>
<?php } ?>