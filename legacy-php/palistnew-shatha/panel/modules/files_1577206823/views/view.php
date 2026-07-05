<?php 
$id=check_get_id();
$_form_resp=db('files_1577206823','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('files_1577206823','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="files_1577206823_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="files_1577206823"><!--

		--><div class="view_box  files_1577206823_view_full_name  ontwo in ">
<div class="view_label view_label_full_name"><?=l('Full Name<>اسم الملف الكامل')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['full_name'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_name  ontwo in ">
<div class="view_label view_label_name"><?=l('Name<>الاسم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['name'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_original_name  ">
<div class="view_label view_label_original_name"><?=l('Original Name<>الاسم الأصلي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['original_name'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_protected_file  ">
<div class="view_label view_label_protected_file"><?=l('Protected File<>محمي')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['protected_file']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  files_1577206823_view_related_module  ">
<div class="view_label view_label_related_module"><?=l('Related Module<>البرمجية المرتبطة')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['related_module']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  files_1577206823_view_related_module_id  ">
<div class="view_label view_label_related_module_id"><?=l('Related Module ID<>معرّف البرمجية المرتبطة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['related_module_id'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_uploader_module_prefix  ">
<div class="view_label view_label_uploader_module_prefix"><?=l('Uploader Module Prefix<>نوع المستخدم الرافع للملف')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['uploader_module_prefix']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  files_1577206823_view_uploader_user_id  ">
<div class="view_label view_label_uploader_user_id"><?=l('Uploader User ID<>المستخدم الرافع للملف')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['uploader_user_id'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_extension  ">
<div class="view_label view_label_extension"><?=l('Extension<>الامتداد')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['extension'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_height  ontwo in ">
<div class="view_label view_label_height"><?=l('Height<>الطول')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['height'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_width  ontwo in ">
<div class="view_label view_label_width"><?=l('Width<>العرض')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['width'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_quality  ">
<div class="view_label view_label_quality"><?=l('Quality<>الجودة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['quality'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_type  ">
<div class="view_label view_label_type"><?=l('Type<>النوع')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['type'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_sub_type  ">
<div class="view_label view_label_sub_type"><?=l('Sub Type<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['sub_type'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_size  ">
<div class="view_label view_label_size"><?=l('Size<>الحجم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['size'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_source_name  ">
<div class="view_label view_label_source_name"><?=l('Source Name<>المصدر')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['source_name'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_source_link  ">
<div class="view_label view_label_source_link"><?=l('Source Link<>رابط مصدر الملف')?></div>
<div class="viewValue  "><a href="<?=$_form_resp[0]['source_link'] ?>" target="_blank"><i>link</i></a></div>
</div><!--

		--><div class="view_box  files_1577206823_view_reference  ">
<div class="view_label view_label_reference"><?=l('Reference<>رقم مرجعي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['reference'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_average_color  ">
<div class="view_label view_label_average_color"><?=l('Average Color<>اللّون المتوسط')?></div>
<div class="viewValue  colorView style="background:<?=$_form_resp[0]['average_color']?>""></div>
</div><!--

		--><div class="view_box  files_1577206823_view_credit  ">
<div class="view_label view_label_credit"><?=l('Credit<>مالك الملف')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['credit'])?></div>
</div><!--

		--><div class="view_box  files_1577206823_view_credit_link  ">
<div class="view_label view_label_credit_link"><?=l('Credit Link<>رابط مالك الملف')?></div>
<div class="viewValue  "><a href="<?=$_form_resp[0]['credit_link'] ?>" target="_blank"><i>link</i></a></div>
</div><!--

		--><div class="view_box  files_1577206823_view_caption  ">
<div class="view_label view_label_caption"><?=l('Caption<>وصف')?></div>
<div class="viewValue  viewText mce "><?=l($_form_resp[0]['caption'])?></div>
</div><!--

--></div>
<?php } ?>