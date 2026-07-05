<?php 
$id=check_get_id();
$_form_resp=db('member_education_8417','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('member_education_8417','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="member_education_8417_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="member_education_8417"><!--

		--><div class="view_box  member_education_8417_view_related_id  ">
<div class="view_label view_label_related_id"><?=l('Related ID<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['related_id'])?></div>
</div><!--

		--><div class="view_box  member_education_8417_view_name_degree  onfour in ">
<div class="view_label view_label_name_degree"><?=l('Name of the university (highest degree)<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['name_degree'])?></div>
</div><!--

		--><div class="view_box  member_education_8417_view_college_name  onfour in ">
<div class="view_label view_label_college_name"><?=l('College Name<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['college_name'])?></div>
</div><!--

		--><div class="view_box  member_education_8417_view_specializationin_arabic  onfour in ">
<div class="view_label view_label_specializationin_arabic"><?=l('Specialization(In Arabic)<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['specializationin_arabic'])?></div>
</div><!--

		--><div class="view_box  member_education_8417_view_specializationin_english  onfour in ">
<div class="view_label view_label_specializationin_english"><?=l('Specialization(In English)<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['specializationin_english'])?></div>
</div><!--

		--><div class="view_box  member_education_8417_view_university_year  onfour in ">
<div class="view_label view_label_university_year"><?=l('University Graduation Year<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['university_year'])?></div>
</div><!--

		--><div class="view_box  member_education_8417_view_undergraduate_degree  onfour in ">
<div class="view_label view_label_undergraduate_degree"><?=l('Undergraduate degree<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('undergraduate_degree_8371',"WHERE deleted=0  AND id='".$_form_resp[0]['undergraduate_degree']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='';
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

		--><div class="view_box  member_education_8417_view_appreciation  onfour in ">
<div class="view_label view_label_appreciation"><?=l('Appreciation<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['appreciation'])?></div>
</div><!--

		--><div class="view_box  member_education_8417_view_university_country  onfour in ">
<div class="view_label view_label_university_country"><?=l('University Country<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('countries_1556139283',"WHERE deleted=0  AND id='".$_form_resp[0]['university_country']."'  $addition_where",NULL,'LIMIT 1');
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

--></div>
<?php } ?>