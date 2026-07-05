

<?php
if(isLogged(mid($_user))){?>


<div class="edit_join_form">
    
<?php
     echo form($_join_request,'j_editProfile');
    $_GET['id']=$_SESSION['user_id'];
    $passOnce=true;
    v($_join_request,'edit',false);
    ?>

</div>

<input type="submit" value="<?= l('Save<>حفظ')?>" class="btn"/>
</form>
</div>


</div> 


<script>
    $('.<?=$_join_request?>_password,.<?=$_join_request?>_order_number,.<?=$_join_request?>_active').hide();
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



