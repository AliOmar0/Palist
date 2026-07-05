<?php
//make sure no empty fields
if(    
!isset($_POST['site_name']) || $_POST['site_name']=="" ||
!isset($_POST['site_short_name']) || $_POST['site_short_name']=="" ||
!isset($_POST['default_from']) || $_POST['default_from']=="" ||
!isset($_POST['default_replyto']) || $_POST['default_replyto']=="" ||
!isset($_POST['site_desc'])
) json(false,4);

/**************************************************/
//real escape to use with DB
$site_name=mysqli_real_escape_string($conn,$_POST['site_name']);
$site_short_name=mysqli_real_escape_string($conn,$_POST['site_short_name']);
$default_from=mysqli_real_escape_string($conn,$_POST['default_from']);
$default_replyto=mysqli_real_escape_string($conn,$_POST['default_replyto']);
$site_desc=mysqli_real_escape_string($conn,$_POST['site_desc']);

	
if(!mysqli_query($conn,"UPDATE settings SET site_name='$site_name',site_short_name='$site_short_name',default_from='$default_from',default_replyto='$default_replyto',site_desc='$site_desc',admin_modify_id='$admin_add_id',date_modified='$date_modified' WHERE id='1' LIMIT 1")) json(false,3);

manifestJson();
if($settings['uc']==1)underConstruction();

json(true,2);