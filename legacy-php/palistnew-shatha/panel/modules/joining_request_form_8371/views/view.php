<?php 
$id=check_get_id();
$_form_resp=db('joining_request_form_8371','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('joining_request_form_8371','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="joining_request_form_8371_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="joining_request_form_8371"><!--

		--><div class="view_box  joining_request_form_8371_view_user  onfour in ">
<div class="view_label view_label_user"><?=l('User<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('users_8400',"WHERE deleted=0  AND id='".$_form_resp[0]['user']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='username';
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

		--><div class="view_box  joining_request_form_8371_view_active  onfour in ">
<div class="view_label view_label_active"><?=l('Active<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['active']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_submitted  onfour in ">
<div class="view_label view_label_submitted"><?=l('Submitted<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['submitted']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box view_group joining_request_form_8371_view_personal information  ">
<div class="view_label view_label_personal information"><?=l('<>المعلومات الشخصية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['personal information'])?></div>
</div><clear></clear><!--

		--><div class="view_box  joining_request_form_8371_view_email_address  onfour in ">
<div class="view_label view_label_email_address"><?=l('Email Address<>عنوان البريد الالكتروني')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['email_address'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_confirm_email_address  onfour in ">
<div class="view_label view_label_confirm_email_address"><?=l('Confirm Email Address<>تأكيد عنوان البريد الالكتروني')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['confirm_email_address'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_full_name  onfour in ">
<div class="view_label view_label_full_name"><?=l('Full Name(In Arabic)<>الاسم الرباعي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['full_name'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_full_name_en  onfour in ">
<div class="view_label view_label_full_name_en"><?=l('Full Name(In English)<>الاسم الرباعي')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['full_name_en'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_id_number  onfour in ">
<div class="view_label view_label_id_number"><?=l('Id Number<>رقم الهوية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['id_number'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_gender  onfour in ">
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

		--><div class="view_box  joining_request_form_8371_view_mobile_number  onfour in ">
<div class="view_label view_label_mobile_number"><?=l('Mobile Number<>رقم الموبايل')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['mobile_number'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_palce_of_birth  onfour in ">
<div class="view_label view_label_palce_of_birth"><?=l('Place of Birth<>مكان الميلاد')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['palce_of_birth'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_date_of_birth  onfour in ">
<div class="view_label view_label_date_of_birth"><?=l('Date of Birth<>تاريخ الميلاد')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['date_of_birth'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_social_situation  onfour in ">
<div class="view_label view_label_social_situation"><?=l('Social Situation<>الحالة الاجتماعية')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('social_situation_8368',"WHERE deleted=0  AND id='".$_form_resp[0]['social_situation']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  joining_request_form_8371_view_province_residence  onfour in ">
<div class="view_label view_label_province_residence"><?=l('Province of current residence<> محافظة السكن الحالي')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('provinces_8371',"WHERE deleted=0  AND id='".$_form_resp[0]['province_residence']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  joining_request_form_8371_view_governorate_abroad  onfour in ">
<div class="view_label view_label_governorate_abroad"><?=l('Governorate in case of residence abroad<>المحافظة في حالة الاقامة بالخارج')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['governorate_abroad'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_mother_province  onfour in ">
<div class="view_label view_label_mother_province"><?=l('Mother province<>المحافظة الأم')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('provinces_8371',"WHERE deleted=0  AND id='".$_form_resp[0]['mother_province']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  joining_request_form_8371_view_home_adress  onfour in ">
<div class="view_label view_label_home_adress"><?=l('Home Adress<> عنوان السكن')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['home_adress'])?></div>
</div><!--

		--><div class="view_box view_group joining_request_form_8371_view_High School Certificate  ">
<div class="view_label view_label_High School Certificate"><?=l('<>شهادة الثانوية العامة')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['High School Certificate'])?></div>
</div><clear></clear><!--

		--><div class="view_box  joining_request_form_8371_view_branch  onfour in ">
<div class="view_label view_label_branch"><?=l('Branch<>الفرع')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('branch_8371',"WHERE deleted=0  AND id='".$_form_resp[0]['branch']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box  joining_request_form_8371_view_average  onfour in ">
<div class="view_label view_label_average"><?=l('Average<>المعدل')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['average'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_graduation_year  onfour in ">
<div class="view_label view_label_graduation_year"><?=l('Graduation Year<>سنة التخرج')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['graduation_year'])?></div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_country  onfour in ">
<div class="view_label view_label_country"><?=l('Country<>البلد')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('high_school_country_8371',"WHERE deleted=0  AND id='".$_form_resp[0]['country']."'  $addition_where",NULL,'LIMIT 1');
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

		--><div class="view_box view_group joining_request_form_8371_view_University Degrees  ">
<div class="view_label view_label_University Degrees"><?=l('<>الشهادات الجامعية')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['University Degrees'])?></div>
</div><clear></clear><!--

		--><div class="view_box view_group joining_request_form_8371_view_The Attachments  ">
<div class="view_label view_label_The Attachments"><?=l('<>المرفقات')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['The Attachments'])?></div>
</div><clear></clear><!--

		--><div class="view_box  joining_request_form_8371_view_all_attested  onfour in ">
<div class="view_label view_label_all_attested"><?=l('All University certificates (attested)<>تحميل الشهادات الجامعية (مصدقه)')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$resp;
							$i=0;
							$resp=[['files'=>$_form_resp[0]['all_attested']]];
							include cms_dir.'legion_files.php';
							$resp=$tmp;
							?>
							</div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_proof_passport  onfour in ">
<div class="view_label view_label_proof_passport"><?=l('Proof of identity (identity / passport)<>اثبات شخصية(هوية/جواز سفر)')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$post;
							$post=['file'=>$_form_resp[0]['proof_passport']];
							include cms_dir.'legion_file.php';
							$post=$tmp;
							?>
							</div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_high_attested  onfour in ">
<div class="view_label view_label_high_attested"><?=l('High school certificate (attested)<>شهادة الثانوية العامة(مصدقة)')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$post;
							$post=['file'=>$_form_resp[0]['high_attested']];
							include cms_dir.'legion_file.php';
							$post=$tmp;
							?>
							</div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_certificate_conduct  onfour in ">
<div class="view_label view_label_certificate_conduct"><?=l('Certificate of non-conviction / good conduct<>شهادة عدم محكومية/حسن سير وسلوك')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$post;
							$post=['file'=>$_form_resp[0]['certificate_conduct']];
							include cms_dir.'legion_file.php';
							$post=$tmp;
							?>
							</div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_work_proof  onfour in ">
<div class="view_label view_label_work_proof"><?=l('Work Proof<>اثبات عمل')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$post;
							$post=['file'=>$_form_resp[0]['work_proof']];
							include cms_dir.'legion_file.php';
							$post=$tmp;
							?>
							</div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_bank_receipt  onfour in ">
<div class="view_label view_label_bank_receipt"><?=l('Bank Receipt<>إيصال البنك')?></div>
<div class="viewValue  ">
							<?php
							$tmp=$post;
							$post=['file'=>$_form_resp[0]['bank_receipt']];
							include cms_dir.'legion_file.php';
							$post=$tmp;
							?>
							</div>
</div><!--

		--><div class="view_box  joining_request_form_8371_view_confirm_that  ">
<div class="view_label view_label_confirm_that"><?=l('I declare that all the information including the academic certificates in the application are correct, and in the event that it turns out otherwise, the Association has the right to withdraw its decision to register me as a member, and I also bear the civil and criminal legal responsibility resulting from that.<>أقر بأن جميع المعلومات بما في ذلك الشهادات الأكاديمية في الطلب صحيحة ، وفي حال تبين خلاف ذلك ، يحق للجمعية سحب قرارها بالتسجيل كعضو ، كما أنني أتحمل المسؤولية المدنية والجنائية. المسؤولية القانونية الناتجة عن ذلك.')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['confirm_that']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>