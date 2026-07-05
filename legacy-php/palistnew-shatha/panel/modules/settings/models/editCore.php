<?php
//make sure no empty fields

if(    
!isset($_POST['main_url']) || $_POST['main_url']=="" ||
!isset($_POST['cpanel_folder']) || $_POST['cpanel_folder']=="" ||
!isset($_POST['cms_folder']) ||
!isset($_POST['author']) || $_POST['author']=="" ||
!isset($_POST['charset']) || $_POST['charset']=="" ||
!isset($_POST['timezone']) || $_POST['timezone']=="" ||
!isset($_POST['http']) || $_POST['http']=="" ||
!isset($_POST['visibility']) || $_POST['visibility']=="" ||
!isset($_POST['are_you_sure']) || $_POST['are_you_sure']=="" ||
!isset($_POST['language']) || $_POST['language']=="" ||
!isset($_POST['photo']) || $_POST['photo']=="" ||
!isset($_POST['file']) || $_POST['file']==""

) json(false,4);


/**************************************************/
//real escape to use with DB
$main_url=e('main_url');
$photo=e('photo');
$file=e('file');
$cpanel_folder=e('cpanel_folder');
$cms_folder=e('cms_folder');
$author=e('author');
$charset=e('charset');
$timezone=e('timezone'); 
$http=e('http'); 
$visibility=e('visibility'); 
$are_you_sure=e('are_you_sure'); 
$language=e('language'); 
$custom_errorlog_path=e('custom_errorlog_path'); 
$max_upload_size=e('max_upload_size'); 

$debug=isset($_POST['debug']) ? 1:0;
$clear_cache_panel=isset($_POST['clear_cache_panel']) ? 1:0;


$exec_time=isset($_POST['exec_time']) ? 1:0;
$uc=isset($_POST['uc']) ? 1:0;
$clear_cache=isset($_POST['clear_cache']) ? 1:0;
$auto_lang=isset($_POST['auto_lang']) ? 1:0;
$custom_system=isset($_POST['custom_system']) ? 1:0;
$www=$_POST['www']==1?1:0;



if(!mysqli_query($conn,"UPDATE settings SET language='$language',visibility='$visibility',are_you_sure='$are_you_sure',main_url='$main_url',cpanel_folder='$cpanel_folder',auto_lang='$auto_lang',cms_folder='$cms_folder',author='$author',charset='$charset',timezone='$timezone',http='$http',admin_modify_id='$admin_add_id',date_modified='$date_modified',photo='$photo',file='$file',clear_cache_panel='$clear_cache_panel',debug='$debug',exec_time='$exec_time',uc='$uc',clear_cache='$clear_cache',custom_system='$custom_system',www='$www',custom_errorlog_path='$custom_errorlog_path',max_upload_size='$max_upload_size' WHERE id='1' LIMIT 1")) json(false,3);

manifestJson();
if($uc==1)underConstruction();
else deleteUnderConstruction();
$_POST['internal']=true;
	require modules_dir.'settings/models/reset_htaccess.php';
json(true,2);