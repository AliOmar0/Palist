<?php


$module_id_for_notify=db('modules',"WHERE module_prefix='".e('module')."'",NULL,'LIMIT 1','id');
if($module_id_for_notify!=0 && $module_id_for_notify!=1){
	$module_id_for_notify=$module_id_for_notify[0]['id'];
	$module_action_id=db('module_actions',"WHERE module_id='$module_id_for_notify' AND type='".e('action')."'",NULL,'LIMIT 1','id');
	if($module_action_id!=0 && $module_action_id!=1){
		$module_action_id=$module_action_id[0]['id'];
		$notify=db('notifier_1644648674',"WHERE module_id='$module_id_for_notify' AND module_action='$module_action_id'",NULL,'LIMIT 1');
		
		if($notify!=0 && $notify!=1){
			$oldPOST=$_POST;
			$notify=$notify[0];
			$admins=db('admins');

			
			foreach($admins as $admin){
				$_POST=array();
//				unset($_POST['module'],$_POST['action']);
				$_POST['module_id']=$module_id_for_notify;
				$_POST['action_id']=$module_action_id;
				$_POST['related_id']=isset($prime_last_id)?$prime_last_id:(isset($id)?$id:0);
				$_POST['user_module']=mid('admins');
				$_POST['user']=$admin['id'];
				$_POST['custom_title']=$notify['title'];
				$_POST['custom_link']='';
				$last_id_for_notiy=r('web_notifications_1644647708');
			
				
//				d($admin);
				if($notify['email_notification']){
					$_noti=o('web_notifications_1644647708',$last_id_for_notiy);
//					d($_noti);
					$processed_notify=processNotification($_noti[0],true,$admin['id']);
//					d($processed_notify);
					$fmi=1;
					$__notification_title=l($processed_notify['title'],langFromID($admin['language_id'])['prefix']);
					$__username=$admin['first_name']==''?$admin['username']:$admin['first_name'];
					$__notification=l($processed_notify['title'],langFromID($admin['language_id'])['prefix']);
					if($processed_notify['href']==NULL)
						$__notification.='.';
					else
						$__notification.=l(',<>،',langFromID($admin['language_id'])['prefix']).' <a '.$processed_notify['href'].' target="_blank">'.l('check it on panel<>اذهب الى لوحة التحكم',langFromID($admin['language_id'])['prefix']).'</a>.';
					$__email=$admin['email'];
//					d($__email);
					include mailer;
//					d('here');
				}
			}
			$_POST=$oldPOST;
		}
	}
}

