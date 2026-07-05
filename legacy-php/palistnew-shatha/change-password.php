

<?php
if(isLogged(mid($_user))){    
    ?>
<div class="change_password_form">
<form id="c_users_1607779937" autocomplete="off" action="" onsubmit="return submitter(this,'<?=urlPanel?>');" method="post" enctype="multipart/form-data" lpformnum="1" class="passa">
<input type="hidden" value="" name="e">
<input type="hidden" name="module" value="users_1607779937"> 
<input type="hidden" name="action" value="edit"> 
<input type="hidden" name="c_changePassword" value="<?= rand()?>"/>

<!--



--><div class="form_field users_1607779937_first_name">
<label for="for_field_old"><?= l('Current Password<>كلمة السر الحالية');?> <span class="required_star">*</span></label>
<div class="input_area">
 <a id="eye_icon" class="po" onclick="showOldPassword()"> <i>visibility_off</i></a>
<input id="for_field_old"  required type="password" name="old" />
</div>
</div><!--


--><div class="form_field users_1607779937_first_name">
<label for="for_field_new"><?= l('New Password<>كلمة السر الجديدة');?> <span class="required_star">*</span></label>
<div class="input_area">
 <a id="eye_icon" class="po" onclick="showNewPassword()"> <i>visibility_off</i></a> 
<input id="for_field_new"  required type="password" name="new" />
</div>
</div><!--


--><div class="form_field users_1607779937_first_name">
<label for="for_field_confirm"><?= l('Confirm New Password<>تأكيد كلمة السر الجديدة');?> <span class="required_star">*</span></label>
<div class="input_area">
<a id="eye_icon" class="po" onclick="showConfirmPassword()"> <i>visibility_off</i></a> 
<input id="for_field_confirm"  required type="password" name="confirm" />
</div>
</div><!--


	-->
    
<input  type="submit" value="<?= l('Save<>حفظ')?>" class="btn"/>
</form>
<div> 

<div id="c_success" class="hidden">
<?= l('Your password changed successfully.<>تم تغيير كلمة السر بنجاح')?>
	
</div>

	   </div>

<script>

function c_success(data,params){
	hide('c_users_1607779937');
	show('c_success');
}
</script>

 <script>
function showOldPassword() {
  var x = document.getElementById("for_field_old");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function showNewPassword() {
  var x = document.getElementById("for_field_new");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


function showConfirmPassword() {
  var x = document.getElementById("for_field_confirm");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>


    
<?php
}else{
   goP();
}