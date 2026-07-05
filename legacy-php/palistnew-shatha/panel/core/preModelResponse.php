<?php
if(isset($module) && $module=='admins'){
	if(isset($_POST['roles'])){
		if($action=='edit'){
			$which_id=$id;
			if(($action=='edit' && privilege('admins','edit')) && (super() || $_SESSION['user_id']!=$id)){
				mysqli_query($conn,"DELETE FROM privileges_1565709771 WHERE user_id='$which_id'");
			}
		}else $which_id=$prime_last_id;

		if(isset($_POST['roles'])){
			if(($action=='add' && privilege('admins','add')) || (($action=='edit' && privilege('admins','edit')) && (super() || $_SESSION['user_id']!=$id))){
				for($i=0;$i<count($_POST['roles']);$i++){
					$role=escape($_POST['roles'][$i]);
					$role=explode(',',$role);
					 if(!privilege($role[0],$role[1]))continue;
					mysqli_query($conn,"INSERT INTO privileges_1565709771 (module_name, type_name, user_id) VALUES ('".$role[0]."','".$role[1]."','$which_id')");

				}
			}
		}

		require mailer;
	}
}

else if(isset($module) && $module=='fonts_1582219344'){
	fonts();
}

else if(isset($module) && $module=='bulk_push_notification_1633289547' && $action=='add'){
	psn($title,$message);
}


else if(isset($module) && $module=='bulk_sms_1652425418' && $action=='add'){
	$field=db('module_fields',"WHERE id='".e('mobile_field')."'");
	if($field!=1 && $field!=0){
		$mobiles=db(one('modules',e('module_prefix'))[0]['module_prefix'],"WHERE deleted=0 AND ".$field[0]['field_name']."!=0",NULL,NULL,'mobile');
		if($mobiles!=1 && $mobiles!=0){
			$msg=l($_POST['message']);
			foreach($mobiles as $mobile){
				sms($mobile['mobile'],$msg);
			}
		}
	}
	
}

else if(isset($module) && $module=='color_palette_1645099749'){
	colors();
}

else if(isset($module) && $module=='link_handler_1566934564' && super()){
	$_POST['internal']=true;
	
    require modules_dir.'settings/models/reset_htaccess.php';
}

elseif(i('updateListRow')){
	require custom_dir.'custom_list.php';
	require core_dir.'configList.php';
	if($_module!=NULL){
		$m=db('module_settings',"WHERE module_prefix='$_module'",NULL,"LIMIT 1");
		if($m!=0 || $m!=1){
			$m=$m[0];
			$m['info']=db('modules',"WHERE module_prefix='$_module'",NULL,'LIMIT 1')[0];
			$m['module_id']=$m['info']['id'];
		}

		#1 fields from module_fields
		list($m,$main_field,$f)=moduleFields($m);
		//d($m);

		#2 permission
		$canDelete=privilege($m['module_prefix'],'delete');
		$canEdit=privilege($m['module_prefix'],'edit');
		$canView=privilege($m['module_prefix'],'view');
		$canView=true;

		$tr='<tr id="tr_'.$id.'">';
		
		for($j=0;$j<count($main_field);$j++){
			
			$tr.='<td>'.td($main_field[$j],o($_module,$id)[0],$m,$canDelete,$canEdit,$f,$canView).'</td>';
			
		}
//		dd('hi');
		$tr.='</tr>';
		
		json(true,1,NULL,NULL,['js'=>'updateListRow','id'=>$id,'tr'=>$tr]);
	}
}

elseif(i('cluster_modules')){
	
	if(is_array($_POST['cluster_modules']) && !empty($_POST['cluster_modules'])){
		$cluster_original_post=$tmp=$_POST;
		
		$post_keys=array_keys($cluster_original_post);
		foreach($cluster_original_post['cluster_modules'] as $j => $cluster_module){
			
			if($cluster_original_post['cluster_actions'][$j]=='edit'){
				$cluster_resp=db($cluster_module,"WHERE !deleted AND related_id=".$cluster_original_post['id']);

				if($cluster_resp!=1){
					foreach($cluster_resp as $r){
						if(isset($cluster_original_post['cluster_'.$cluster_module.'_id'])){
							if(!in_array($r['id'],$cluster_original_post['cluster_'.$cluster_module.'_id']))
								del($cluster_module,$r['id']);
						}else
							del($cluster_module,$r['id']);
					}
				}
			}

			$cluster_post=[];
			
			foreach($post_keys as $key){
				if(str_contains($key,'cluster_'.$cluster_module)){
					$clean_key=str_replace('cluster_'.$cluster_module.'_','',$key);
					$cluster_post[$clean_key]=$cluster_original_post[$key];
					$counter=count($cluster_post[$clean_key]);
				}
			}
			
			$_POST=[];
			
			$cluster_keys=array_keys($cluster_post);
			if(!empty($cluster_keys)){
				for($i=0;$i<$counter;$i++){
					foreach($cluster_keys as $cluster_key){
						$_POST[$cluster_key]=$cluster_post[$cluster_key][$i];
					}
					if($cluster_original_post['cluster_actions'][$j]=='edit'){
						$_POST['related_id']=$cluster_original_post['id'];

						if(!i('id') || $_POST['id']=='')
							$cluster_action='add';
						else
							$cluster_action='edit';
					}else{
						$cluster_action='add';
						$_POST['related_id']=$last_id;
					}

					
					r($cluster_module,$cluster_action);
				}
			}
		}
		$_POST=$tmp;
	}
}


##focus
include panel_dir.'notify.php';

//entries logger
if(isset($_POST['module']) && isset($_POST['action'])){
	$__el_module=$_POST['module'];
	$__el_action=$_POST['action'];

	if($action=='edit')
		$__el_id=$id;
	elseif($action=='add')
		$__el_id=$prime_last_id;
	else
		$__el_id=0;

	if(!isset($__entry_logger[$__el_module.'-'.$__el_action.'-'.$__el_id])){
		if(!isset($__entry_logger)){
			$__entry_logger=[];
		}

		if($module!='entries_log_8503'){
			$__entry_logger[$__el_module.'-'.$__el_action.'-'.$__el_id]=true;
		}

		$__tmp=$_POST;
		$_POST=[
			'entry_module'=>mid($__el_module),
			'entry_id'=>$__el_id,
			'user_module'=>$_SESSION['module_id'],
			'user_id'=>$_SESSION['user_id'],
			'action'=>$__el_action
		];
		co('entries_log_8503');
		r('entries_log_8503');
		$_POST=$__tmp;

	}
}
//entries logger