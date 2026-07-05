<?php
//make sure no empty fields
if(    
!isset($_POST['main_color']) || $_POST['main_color']==""
||
	!isset($_POST['sub_menu_color']) || $_POST['sub_menu_color']==""
||
	!isset($_POST['logo'])||
		!isset($_POST['fav'])||
		!isset($_POST['facebook'])
	
) json(false,4);

/**************************************************/
//real escape to use with DB
$main_color=mysqli_real_escape_string($conn,$_POST['main_color']);
$sub_menu_color=mysqli_real_escape_string($conn,$_POST['sub_menu_color']);

$html_background_color=mysqli_real_escape_string($conn,$_POST['html_background_color']);


	
$logo=escape($_POST['logo']);
$fav=escape($_POST['fav']);
$fav_dark=escape($_POST['fav_dark']);
$facebook=escape($_POST['facebook']);
$login=escape($_POST['login']);
	
	

if(!mysqli_query($conn,"UPDATE settings SET main_color='$main_color',sub_menu_color='$sub_menu_color',html_background_color='$html_background_color',logo='$logo',fav='$fav',fav_dark='$fav_dark',facebook='$facebook',login='$login',admin_modify_id='$admin_add_id',date_modified='$date_modified' WHERE id='1' LIMIT 1")) json(false,3);



colors();
manifestJson();
if($settings['uc']==1)underConstruction();
else deleteUnderConstruction();

json(true,2,NULL,NULL,['js'=>'refresh']);