<?php
block();
//make sure no empty fields
if(    
!isset($_POST['username']) || $_POST['username']=="" ||
!isset($_POST['password']) || $_POST['password']==""
)json(false,4);

$username=escape($_POST['username']);
$password=escape($_POST['password']);

$resp=db('admins',"WHERE username='$username' AND deleted='0'",NULL,"LIMIT 1",'id,username,password');
if($resp==0)json(false,3);
else if($resp==1)json(false,23);

if(password_verify($password, $resp[0]['password'])){ 
	logUserIn($resp[0]['id'],mid('admins'));
	
	$_POST['module_prefix']=mid('admins');
	$_POST['user_id']=$resp[0]['id'];
	$_POST['remark']='Login<>دخول';
	$_POST['ip']=isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:NULL;
	$_POST['browser']=isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:NULL;
	$_POST['referer']=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:NULL;
	$_POST['browser_language']=isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])?$_SERVER['HTTP_ACCEPT_LANGUAGE']:NULL;
	completer('access_history');
	r('access_history');
	
	$to_url=urlPanel;
	if(isset($_SESSION['goto'])){
		if(str_starts_with($_SESSION['goto'],'?module=')){
			if(strpos('action=',$_SESSION['goto'])!=false)
				$to_url=$_SESSION['goto'];
		}
	}

	
	json(true,2,NULL,NULL,array('url'=>$to_url,'js'=>'redirect'));
}

json(false,23);