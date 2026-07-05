
<?php
if(isLogged(mid($_user))){
    $resp_u=db('users_8400',"WHERE !deleted AND id='".$_SESSION['user_id']."'",NULL);

    ?>

<div class="edit_join_form">
    
<?php
     echo form($_join_request,'j_editProfile');
    $_GET['id']=$_SESSION['user_id'];
    $passOnce=true;
    v($_join_request,'edit',false);
//   require modules_dir.$_join_request.'/views/editNoForm.php';
    ?>



<?php $_m='joining_request_form_8371';?>
<section id="joining_request_form_wrap" class="major_section w1200">
<?php
$resp=db($_m,"WHERE !deleted AND user=".$_SESSION['user_id'],NULL);
if($resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
else { for($i=0;$i<count($resp);$i++){?>
<div class="joining_request_form_box in">

<div class="big_group"><?=l('personal information<>المعلومات الشخصية')?></div>
    <div class="l_grid2">

    <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Full Name In Arabic:<> الاسم الرباعي بالعربي:')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                 <h2 class="joining_request_form_full_name"><?=$resp[$i]['full_name']?></h2>
                </div>
        </div>


        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Full Name In English:<> الاسم الرباعي بالانجليزي:')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                 <h2 class="joining_request_form_full_name"><?=$resp[$i]['full_name_en']?></h2>
                </div>
        </div>

        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Id Number:<>رقم الهوية :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                <div class="joining_request_form_id_number"><?=$resp[$i]['id_number']?></div>
                </div>
        </div>

        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Place of Birth:<>مكان الولادة :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                <h2 class="joining_request_form_palce_of_birth"><?=$resp[$i]['palce_of_birth']?></h2>
                </div>
        </div>

        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Date of Birth:<>تاريخ الولادة :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                <h2 class="joining_request_form_palce_of_birth"><?=$resp[$i]['date_of_birth']?></h2>
                </div>
        </div>

        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Social Situation :<> الحالة الاجتماعية :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                 <h2 class="joining_request_form_social_situation"><?=l(detail('social_situation_8368','title','id',$resp[$i]['social_situation']))?></h2>
                </div>
        </div>

        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Gender:<>الجنس :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                <div class="joining_request_form_gender"><?=l(detail('gender_8371','title','id',$resp[$i]['gender']))?></div>
                </div>
        </div>
        <div class="e_b">
        <div class="e_h mid">
             <?=l('Majors: <> التخصصات :');?>
        </div><!--
        --><div class="e_d mid bidi">
            <!--<?php
                $comp=comp('users_8400',$resp_u[0]['id'],'majors_8367');
               
                if($comp!=1){
                    for($_z=0;$_z<count($comp);$_z++){
                        $tmp=db('majors_8367',"WHERE id='".$comp[$_z]['child_id']."'",NULL,'LIMIT 1')[0]?>
                        --><div class="join_req_list_comp_item2 in "><?=l($tmp['title'])?></div><!--
                <?php }
                    }
                ?>-->
         </div>
        </div>
        <div class="e_b">
        <div class="e_h mid">
            <?=l('Employment Status:  <>  الحالة الوظيفية :');?>
        </div><!--
        --><div class="e_d mid bidi"> <?=l(detail('employment_status_8368','title','id',$resp_u[0]['employment_status']))?> </div>
        </div>
        <div class="e_b">
        <div class="e_h mid">
             <?=l('Organisation:  <>  منظمة :');?>
        </div><!--
        --><div class="e_d mid bidi">
             <?=$resp_u[0]['organisation']?>
         </div>
        </div>
        <div class="e_b">
        <div class="e_h mid">
            <?=l('Business type: <> نوع العمل :');?>
        </div><!--
        --><div class="e_d mid bidi">
              <?=l(detail('business_type_8368','title','id',$resp_u[0]['business_type']))?>
         </div>
        </div>
        <div class="e_b">
        <div class="e_h mid">
             <?=l('Work nature: <> طبيعة العمل  :');?>
        </div><!--
        --><div class="e_d mid bidi">
             <?=$resp_u[0]['work_nature']?>
         </div>
        </div>
   
</div>


<div class="big_group l_grid4"><?=l('High School Certificate<>شهادة الثانوية العامة')?></div>
    
<div class="l_grid2">
        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Branch:<>الفرع :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                <h2 class="joining_request_form_branch in"><?=l(detail('branch_8371','title','id',$resp[$i]['branch']))?></h2>
                </div>
        </div>

        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Average:<>المعدل :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                <h2 class="joining_request_form_average"><?=$resp[$i]['average']?></h2>
                </div>
        </div>

        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Graduation Year:<>سنة التخرج :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                <h2 class="joining_request_form_graduation_year"><?=$resp[$i]['graduation_year']?></h2>
                </div>
        </div>

        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('High School Country:<>بلد التخرج من الثانوية :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_country"><?=l(detail('high_school_country_8371','title','id',$resp[$i]['country']))?></h2>
                </div>
        </div>
</div>
<div class="big_group"><?=l('The Highest University Degree<>أعلى شهادة جامعية')?></div>

<div class="l_grid2">
    <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Name of the university (highest degree) :<>اسم الجامعة :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_name_degree"><?=$resp[$i]['name_degree']?></h2>
                </div>
        </div>
        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('College Name:<>اسم الكلية :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_college_name"><?=$resp[$i]['college_name']?></h2>
                </div>
        </div>
        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Specailaization Arabic:<>التخصص بالعربي :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_specialization"><?=$resp[$i]['specialization']?></h2>
                </div>
        </div>
        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Specailaization In English:<>التخصص بالانجليزي :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_specialization"><?=$resp[$i]['specialization_en']?></h2>
                </div>
        </div>

        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('University Graduation Year :<>سنة التخرج :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_university_year"><?=$resp[$i]['university_year']?></h2>
                </div>
        </div>
        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Undergraduate degree :<>الدرجة الجامعية :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_undergraduate_degree"><?=l(detail('undergraduate_degree_8371','title','id',$resp[$i]['undergraduate_degree']))?></h2>
                </div>
        </div>
        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Appreciation:<>التقدير :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_appreciation"><?=$resp[$i]['appreciation']?></h2>
                </div>
        </div>
        <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('University Country:<>بلد الجامعة :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_university_country"><?=l(detail('university_country_8371','title','id',$resp[$i]['university_country']))?></h2>
                </div>
        </div>

</div>
    

    <div class="big_group"><?=l('Another university or college<>جامعة أو كلية أخرى')?></div>

    <div class="l_grid2">
    <?php if($resp[$i]['other_degree']!=''){?>
        <div class="e_b">
                    <div class="e_h mid">
                    <h2 class="joining_request_form_branch in"><?=l('Name of the other university (highest degree):<>اسم الجامعة الأخرى :')?></h2>
                    </div><!--
                    --><div class="e_d mid bidi">
                        
                    <h2 class="joining_request_form_other_degree"><?=$resp[$i]['other_degree']?></h2>
                    </div>
        </div>
    <?php
    }?>

    <?php if($resp[$i]['other_college_name']!=''){?>
        <div class="e_b">
                    <div class="e_h mid">
                    <h2 class="joining_request_form_branch in"><?=l('Other College Name:<>اسم الكلية الأخرى :')?></h2>
                    </div><!--
                    --><div class="e_d mid bidi">
                        
                    <h2 class="joining_request_form_other_college_name"><?=$resp[$i]['other_college_name']?></h2>
                    </div>
        </div>
    <?php
    }?>

    <?php if($resp[$i]['other_specialization']!=''){?>
        <div class="e_b">
            <div class="e_h mid">
            <h2 class="joining_request_form_branch in"><?=l('Other Specialization:<>تخصص أخر:')?></h2>
            </div><!--
            --><div class="e_d mid bidi">
                
            <h2 class="joining_request_form_other_specialization"><?=$resp[$i]['other_specialization']?></h2>
            </div>
        </div>
        <?php
    }?>

<?php if($resp[$i]['other_year']!=''){?>
    <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('University Graduation Year :<>سنة التخرج :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_other_year"><?=$resp[$i]['other_year']?></h2>
                </div>
    </div>
    <?php
    }?>

<?php if($resp[$i]['other_ungraduate_degree']!=0){?>
        <div class="e_b">
                    <div class="e_h mid">
                    <h2 class="joining_request_form_branch in"><?=l('Undergraduate degree :<>الدرجة الجامعية :')?></h2>
                    </div><!--
                    --><div class="e_d mid bidi">
                        
                    <h2 class="joining_request_form_other_ungraduate_degree"><?=l(detail('undergraduate_degree_8371','title','id',$resp[$i]['other_ungraduate_degree']))?></h2>
                    </div>
        </div>
    <?php
    }?>

<?php if($resp[$i]['appreciation_university']!=''){?>
    <div class="e_b">
                <div class="e_h mid">
                <h2 class="joining_request_form_branch in"><?=l('Appreciation :<>التقدير :')?></h2>
                </div><!--
                --><div class="e_d mid bidi">
                    
                <h2 class="joining_request_form_appreciation_university"><?=$resp[$i]['appreciation_university']?></h2>
                </div>
    </div>
    <?php
    }?>

<?php if($resp[$i]['other_university_country']!=0){?>
        <div class="e_b">
                    <div class="e_h mid">
                    <h2 class="joining_request_form_branch in"><?=l('University Country :<>بلد الجامعة:')?></h2>
                    </div><!--
                    --><div class="e_d mid bidi">
                        
                    <h2 class="joining_request_form_other_university_country"><?=l(detail('university_country_8371','title','id',$resp[$i]['other_university_country']))?></h2>
                    </div>
        </div>
   
    
<?php
    }?>

</div>
<div class="big_group"><?=l('The Atachments<>المرفقات')?></div>

<div>
    <?php if($resp[$i]['proof_passport']!=0){?>
        <div class="e_b">
                    <div class="e_h w45 mid">
                    <h2 class="joining_request_form_branch in"><?=l('Proof of identity (identity / passport) :<>
                        اثبات شخصية(هوية/جواز سفر):')?></h2>
                    </div><!--
                    --><div class="e_d w45 mid bidi">
                         <!-- <a href="<?= u.$resp[$i]['proof_passport'];?>">view file</a> -->
                         <?php $_key='proof_passport'; include 'legion_file.php' ?>
                    </div>
        </div>   
        <?php
            }?>

        <?php if($resp[$i]['high_attested']!=0){?>
                <div class="e_b">
                            <div class="e_h w45 mid">
                            <h2 class="joining_request_form_branch in"><?=l('High school certificate (attested):<>
                                شهادة الثانوية العامة(مصدقة)')?></h2>
                            </div><!--
                            --><div class="e_d w45 mid bidi">
                                <!-- <img src="<?= uploads_link.img($resp[$i]['high_attested']);?>"/> -->
                                <?php $_key='high_attested'; include 'legion_file.php' ?>
                            </div>
                </div>   
        <?php
            }?>

                <?php if($resp[$i]['certificate_conduct']!=0){?>
                    <div class="e_b">
                                <div class="e_h mid w45">
                                <h2 class="joining_request_form_branch in"><?=l('Certificate of non-conviction / good conduct:<>
                                    شهادة عدم محكومية/حسن سير وسلوك')?></h2>
                                </div><!--
                                --><div class="e_d mid w45 bidi">
                                    <!-- <img src="<?= uploads_link.img($resp[$i]['certificate_conduct']);?>"/> -->
                                    <?php $_key='certificate_conduct'; include 'legion_file.php' ?>
                                </div>
                    </div>   
            <?php
                }?>

                <?php if($resp[$i]['work_proof']!=0){?>
                    <div class="e_b">
                                <div class="e_h w45 mid">
                                <h2 class="joining_request_form_branch in"><?=l('Work Proof:<>
                                  اثبات عمل')?></h2>
                                </div><!--
                                --><div class="e_d w45 mid bidi">
                                    <!-- <img src="<?= uploads_link.img($resp[$i]['work_proof']);?>"/> -->
                                    <?php $_key='work_proof'; include 'legion_file.php' ?>
                                </div>
                    </div>   
            <?php
                }?>

            <?php if($resp[$i]['bank_receipt']!=0){?>
                            <div class="e_b">
                                        <div class="e_h w45 mid">
                                        <h2 class="joining_request_form_branch in"><?=l('Bank Receipt:<>
                                        إيصال البنك')?></h2>
                                        </div><!--
                                        --><div class="e_d w45 mid bidi">
                                            <!-- <img src="<?= uploads_link.img($resp[$i]['bank_receipt']);?>"/> -->
                                            <?php $_key='bank_receipt'; include 'legion_file.php' ?>
                                        </div>
                            </div>   
                    <?php
                        }?>

        <?php if($resp[$i]['all_attested']!=0){?>
                        <div class="e_b">
                                    <div class="e_h w45 mid">
                                    <h2 class="joining_request_form_branch in"><?=l('All University certificates (attested) :<> الشهادات الجامعية (المصدقه)')?></h2>
                                    </div><!--
                                    --><div class="e_d w45 mid bidi">
                                    <?php $resp[$i]['files']=$resp[$i]['all_attested']  ; include 'legion_files.php' ?>
                                    </div>
                        </div>   
                <?php
                    }?>
</div>
<?php  
}//for


}//else
unset($resp);?>

</section>


<input type="submit" value="<?= l('Save<>حفظ')?>" class="btn"/>
</form>
</div>

</div> 

<script>


if('.<?=$_join_request?>_active'){
    $('.<?=$_join_request?>_confirm_password,.<?=$_join_request?>_id_number,.<?=$_join_request?>_gender,.<?=$_join_request?>_full_name,.<?=$_join_request?>_full_name_en,.<?=$_join_request?>_palce_of_birth,.<?=$_join_request?>_date_of_birth,.<?=$_join_request?>_branch,.<?=$_join_request?>_average,.<?=$_join_request?>_graduation_year,.<?=$_join_request?>_confirm_password,.<?=$_join_request?>_country,.<?=$_join_request?>_name_degree,.<?=$_join_request?>_college_name,.<?=$_join_request?>_specialization,.<?=$_join_request?>_specialization_en,.<?=$_join_request?>_university_year,.<?=$_join_request?>_undergraduate_degree,.<?=$_join_request?>_appreciation,.<?=$_join_request?>_university_country,.<?=$_join_request?>_other_degree,.<?=$_join_request?>_other_specialization,.<?=$_join_request?>_other_ungraduate_degree,.<?=$_join_request?>_other_degree,.<?=$_join_request?>_appreciation_university,.<?=$_join_request?>_other_university_country,.<?=$_join_request?>_other_college_name,.<?=$_join_request?>_other_year,.<?=$_join_request?>_social_situation,.<?=$_join_request?>_high_attested,.<?=$_join_request?>_proof_passport,.<?=$_join_request?>_certificate_conduct,.<?=$_join_request?>_confirm_that,.joining_request_form_8371_addanotheruniversityorcollege,.joining_request_form_8371_thehighestuniversitydegree,.joining_request_form_8371_highschoolcertificate').hide();
}


$('.joining_request_form_8371_governorate_abroad').hide();

$('#for_field_province_residence').on('change', function () {

    if ($('#for_field_province_residence').val() == '3') {

        $('.joining_request_form_8371_governorate_abroad').show();
    } else {
        $('.joining_request_form_8371_governorate_abroad').hide();
    }
});


</script>


<script>
    $('.<?=$_join_request?>_active').hide();
    $('.<?=$_join_request?>_confirm_password,.<?=$_join_request?>_order_number,.<?=$_join_request?>_active').hide();    
    $('.<?=$_join_request?>_user').hide();  
    $('.<?=$_join_request?>_submitted').hide();
</script>




<?php
    $module=$_join_request;
    include 'legion_front_handler.php';
}else{
   goP();   
}

