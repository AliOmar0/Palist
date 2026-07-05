<?php
if(isLogged(moduleID($_user))){

 $_m='joining_request_form_8371';
 
 
 ?>
<section id="joining_request_form_wrap" class="major_section w1200">
<?php
$resp=db($_m,"WHERE !deleted AND user='".$_SESSION['user_id']."'",NULL);


$resp_u=db('users_8400',"WHERE !deleted AND id='".$_SESSION['user_id']."'",NULL);


// d($resp[0]['submitted']);
// d($resp[0]['active']);
if($resp==1)
{?>
<div id="j_f_wrap">
    <div class="join_req_formatted_text"><?=cl('join_req','formatted_text');?></div>
    <div class="join_req_users_info">
    <div>
            <div class="in w5 info_lable"><?=l('Majors: <>  التخصصات :');?></div><!--
            --><div class="in w75 info_data"><!--<?php
                $comp=comp('users_8400',$resp_u[0]['id'],'majors_8367');
                if($comp!=1){
                    for($_z=0;$_z<count($comp);$_z++){
                        $tmp=db('majors_8367',"WHERE id='".$comp[$_z]['child_id']."'",NULL,'LIMIT 1')[0]?>
                        --><div class="join_req_list_comp_item in w25"><?=l($tmp['title'])?></div><!--
                <?php }
                    }
                ?>--></div></div>
                
                    <div class="join_req_users_employment_status in w25 j_r_f">
                        <div class="in w50 info_lable"> <?=l('Employment Status:  <>  الحالة الوظيفية:');?></div><!--
                    --><div class="in w50 info_data"> <?=l(detail('employment_status_8368','title','id',$resp_u[0]['employment_status']))?></div>
                    </div><!--
                    --><div class="join_req_users_organisation in w25 j_r_f">
                        <div class="in w35 info_lable"><?=l('Organisation:  <> منظمة:');?></div><!--
                        --><div class="in w65 info_data"> <?=$resp_u[0]['organisation']?></div>
                </div><!--
                    --><div class="join_req_users_business_type in w25 j_r_f">
                        <div class="in w35 info_lable"> <?=l('Business type: <> نوع العمل :');?></div><!--
                    --><div class="in w65 info_data"> <?=l(detail('business_type_8368','title','id',$resp_u[0]['business_type']))?></div>
                </div><!--
                    --><div class="join_req_users_work_nature in w25 j_r_f">
                        <div class="in w35 info_lable"> <?=l('Work nature: <> طبيعة العمل :');?></div><!--
                    --><div class="in w65 info_data"> <?=$resp_u[0]['work_nature']?></div>
                </div>
                </div>
  
  <?php  $passOnce=true;
    require modules_dir."joining_request_form_8371/views/add.php";?>

    <input type="hidden" form="joining_request_form_8371" name="new_request" value="<?=rand()?>"/>
    <input class="btn" type="submit" form="joining_request_form_8371" value="<?= l('Save<>حفظ')?>">
</div>

<div id="c_successSignup" >
    <?= l('Your joining request is added <>تم تقديم طلب انتسابك ')?>
        
    </div>
    <script> 
     function successjoin(){
    
        $('#c_successSignup').show();
        $('#j_f_wrap').hide();

        // show('');
    }
</script>
    <?php $_m='users_8400';
    $respa=db($_m,"WHERE !deleted AND id=".$_SESSION['user_id'],NULL);

    if($respa==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';

    else{?>
            <script>
                    $('.joining_request_form_8371_full_name input').val('<?=$respa[0]['full_name']?>');
                        $('.joining_request_form_8371_full_name_en input').val('<?=$respa[0]['full_name_en']?>');
                        $('.joining_request_form_8371_email_address input').val('<?=$respa[0]['email_address']?>');
                        $('.joining_request_form_8371_date_of_birth input').val('<?=$respa[0]['date_of_birth']?>');
                        $('.joining_request_form_8371_province_residence select').val('<?=$respa[0]['provience']?>');
                        $('.joining_request_form_8371_gender select').val('<?=$respa[0]['gender']?>');
                        $('.joining_request_form_8371_id_number input').val('<?=$respa[0]['id_number']?>');
                        $('.joining_request_form_8371_confirm_email_address input').val('<?=$respa[0]['email_address']?>');
            </script>
         <?php
        }?>
    <?php   
}



elseif($resp!=1 && $resp[0]['submitted']==0 && $resp[0]['active']==0)
{


    ?>
    <div class="join_req_users_info">
    <div>
            <div class="in w5 info_lable"><?=l('Majors: <>  التخصصات :');?></div><!--
            --><div class="in w75 info_data"><!--<?php
                $comp=comp('users_8400',$resp_u[0]['id'],'majors_8367');
                if($comp!=1){
                    for($_z=0;$_z<count($comp);$_z++){
                        $tmp=db('majors_8367',"WHERE id='".$comp[$_z]['child_id']."'",NULL,'LIMIT 1')[0]?>
                        --><div class="join_req_list_comp_item in w25"><?=l($tmp['title'])?></div><!--
                <?php }
                    }
                ?>--></div></div>
                
                    <div class="join_req_users_employment_status in w25 j_r_f">
                        <div class="in w50 info_lable"> <?=l('Employment Status:  <>  الحالة الوظيفية:');?></div><!--
                    --><div class="in w50 info_data"> <?=l(detail('employment_status_8368','title','id',$resp_u[0]['employment_status']))?></div>
                    </div><!--
                    --><div class="join_req_users_organisation in w25 j_r_f">
                        <div class="in w35 info_lable"><?=l('Organisation:  <>  منظمة :');?></div><!--
                        --><div class="in w65 info_data"> <?=$resp_u[0]['organisation']?></div>
                </div><!--
                    --><div class="join_req_users_business_type in w25 j_r_f">
                        <div class="in w35 info_lable"> <?=l('Business type: <> نوع العمل :');?></div><!--
                    --><div class="in w65 info_data"> <?=l(detail('business_type_8368','title','id',$resp_u[0]['business_type']))?></div>
                </div><!--
                    --><div class="join_req_users_work_nature in w25 j_r_f">
                        <div class="in w35 info_lable"> <?=l('Work nature: <> طبيعة العمل :');?></div><!--
                    --><div class="in w65 info_data"> <?=$resp_u[0]['work_nature']?></div>
                </div>
                </div>
    <?php
    echo form($_join_request,'j_editProfile');
    // $_GET['id']=$_SESSION['user_id'];
    $_GET['id']=$resp[0]['id'];
    $passOnce=true;
    v($_join_request,'edit',false);
    ?>

    <input id="save_btn" type="submit" value="<?= l('Save<>حفظ')?>" class="btn"/>
    <input type="submit" id="submit_btn"  onClick="changeSubmitted()" value="<?= l('Submit<>إرسال')?>" class="btn in"/>
    <input class="in"  form='joining_request_form_8371' type="hidden" name="submitted" value="0" id="change_submit_value"/>

</form>

<?php
}                                                  



elseif($resp!=1 && $resp[0]['submitted']!=0 && $resp[0]['active']==0){?>

<div class="edited_j_form"><?=l('Your joining request is added <>تم تقديم طلب انتسابك ')?></div>
<?php
}
else { 
    require 'updatedForm.php';

}
unset($resp);?>

</section>


<script>
    $('.<?=$_join_request?>_password,.<?=$_join_request?>_order_number,.<?=$_join_request?>_active').hide();
    $('.<?=$_join_request?>_confirm_password,.<?=$_join_request?>_order_number,.<?=$_join_request?>_active').hide();    
    $('.<?=$_join_request?>_user').hide();  
    $('.<?=$_join_request?>_submitted').hide();
</script>


<script>
    function changeSubmitted(){
        $('#change_submit_value').val('1');
        $('#save_btn').click();
        $('#change_submit_value').hide();

        
     
    }

  

//to show and hide the another governate if selected is others
$('.joining_request_form_8371_governorate_abroad').hide();
$('#for_field_province_residence').on('change', function () {

if ($('#for_field_province_residence').val() == '3') {

    $('.joining_request_form_8371_governorate_abroad').show();
} else {
    $('.joining_request_form_8371_governorate_abroad').hide();
}
});

$('.joining_request_form_8371_confirm_email_address').hide();


</script>

  

            
           </div>
    
  
<?php }

else{
goSign();
}

?>
<!-- 
<script>
function saved(){
    alert('Saved');
}
</script> -->