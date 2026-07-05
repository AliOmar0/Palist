<?php 
$id=check_get_id();
$_form_resp=db('users_8400','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('users_8400','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="users_8400_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="users_8400"><!--

		--><div class="view_box  users_8400_view_username  ">
<div class="view_label view_label_username"><?=l('Username<>اسم المستخدم')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['username'])?></div>
</div><clear></clear><!--

		--><div class="view_box  users_8400_view_password  ontwo in ">
<div class="view_label view_label_password"><?=l('Password<>الرقم السري')?></div>
<div class="viewValue  ">*****</div>
</div><!--

		--><div class="view_box  users_8400_view_email_address  ontwo in ">
<div class="view_label view_label_email_address"><?=l('Email Address<>عنوان البريد الالكتروني')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['email_address'])?></div>
</div><!--

		--><div class="view_box  users_8400_view_profile_photo  ">
<div class="view_label view_label_profile_photo"><?=l('Profile Photo<>صورة شخصية')?></div>
<div class="viewValue  "><?php if($_form_resp[0]['profile_photo']!='')pic($_form_resp[0]['profile_photo'],200,100)?></div>
</div><!--

		--><div class="view_box  users_8400_view_active  ">
<div class="view_label view_label_active"><?=l('Active<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['active']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  users_8400_view_full_name  ontwo in ">
<div class="view_label view_label_full_name"><?=l('Full Name(In Arabic)<>الاسم الرباعي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['full_name'])?></div>
</div><!--

		--><div class="view_box  users_8400_view_full_name_en  ontwo in ">
<div class="view_label view_label_full_name_en"><?=l('Full Name(In English)<>الاسم الرباعي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['full_name_en'])?></div>
</div><!--

		--><div class="view_box  users_8400_view_date_of_birth  ">
<div class="view_label view_label_date_of_birth"><?=l('Date of Birth<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['date_of_birth'])?></div>
</div><!--

		--><div class="view_box  users_8400_view_province  ">
<div class="view_label view_label_province"><?=l('Province<>المحافظة')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('provinces_8371',"WHERE deleted=0  AND id='".$_form_resp[0]['province']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  users_8400_view_id_number  ">
<div class="view_label view_label_id_number"><?=l('Id Number/passport<>جواز سفر/رقم الهوية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['id_number'])?></div>
</div><!--

		--><div class="view_box  users_8400_view_gender  ">
<div class="view_label view_label_gender"><?=l('Gender<>الجنس')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('gender_8371',"WHERE deleted=0  AND id='".$_form_resp[0]['gender']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  users_8400_view_specialization  ">
<div class="view_label view_label_specialization"><?=l('Specialization<>التخصص')?></div>
<div class="viewValue  ">
		<!--<?php
		$__m='users_8400';
		$comp=comp($__m,$_form_resp[0]['id'],'majors_8367');
		if($comp!=1){
			for($_i=0;$_i<count($comp);$_i++){
				$tmp=db('majors_8367',"WHERE id='".$comp[$_i]['child_id']."'",NULL,'LIMIT 1')[0]?>
				--><div class="comp_title"><?=l($tmp['title'])?></div><!--
		<?php }
			}
		?>--></div>
</div><!--

		--><div class="view_box  users_8400_view_employment_status  ">
<div class="view_label view_label_employment_status"><?=l('Employment Status<>الحالة الوظيفية')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('employment_status_8368',"WHERE deleted=0  AND id='".$_form_resp[0]['employment_status']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  users_8400_view_organisation  onthree in ">
<div class="view_label view_label_organisation"><?=l('Organisation<>مؤسسة العمل')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['organisation'])?></div>
</div><!--

		--><div class="view_box  users_8400_view_business_type  onthree in ">
<div class="view_label view_label_business_type"><?=l('Business type<>نوع العمل ')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('business_type_8368',"WHERE deleted=0  AND id='".$_form_resp[0]['business_type']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  users_8400_view_work_nature  onthree in ">
<div class="view_label view_label_work_nature"><?=l('work nature<>طبيعة العمل ')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['work_nature'])?></div>
</div><!--

--></div>
<?php } ?>