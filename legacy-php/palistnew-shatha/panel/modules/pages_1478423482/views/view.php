<?php 
$id=check_get_id();
$_form_resp=db('pages_1478423482','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('pages_1478423482','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="pages_1478423482_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="pages_1478423482"><!--

		--><div class="view_box  pages_1478423482_view_title  ">
<div class="view_label view_label_title"><?=l('Title<>العنوان')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['title'])?></div>
</div><!--

		--><div class="view_box  pages_1478423482_view_slug  ">
<div class="view_label view_label_slug"><?=l('Slug<>كلمة تمييز الرابط')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['slug'])?></div>
</div><!--

		--><div class="view_box  pages_1478423482_view_content  ">
<div class="view_label view_label_content"><?=l('Content<>المحتوى')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['content'])?></div>
</div><!--

		--><div class="view_box  pages_1478423482_view_photo  onfour in ">
<div class="view_label view_label_photo"><?=l('Photo<>صورة')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['photo']!='')pic($_form_resp[0]['photo'],200,100)?></div>
</div><!--

		--><div class="view_box  pages_1478423482_view_files  onfour in ">
<div class="view_label view_label_files"><?=l('Files<>الملفات')?></div>
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

		--><div class="view_box view_group pages_1478423482_view_Advanced Settings  ">
<div class="view_label view_label_Advanced Settings"><?=l('<>خصائص متقدّمة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['Advanced Settings'])?></div>
</div><clear></clear><!--

		--><div class="view_box  pages_1478423482_view_additional_file  onfour in ">
<div class="view_label view_label_additional_file"><?=l('Additional File<>ملف إضافي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['additional_file'])?></div>
</div><!--

		--><div class="view_box  pages_1478423482_view_signin_required  onfour in ">
<div class="view_label view_label_signin_required"><?=l('Signin Required<>يجب ان يكون مسجلاً')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['signin_required']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('pages_1478423482','signin_required',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  pages_1478423482_view_with_share_functionality  onfour in free_width ">
<div class="view_label view_label_with_share_functionality"><?=l('With Share Functionality<>مع خاصية المشاركة')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['with_share_functionality']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  pages_1478423482_view_with_messenger  onfour in free_width ">
<div class="view_label view_label_with_messenger"><?=l('With Messenger<>مع صندوق المحادثة')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['with_messenger']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>