<?php
require '../../panel/core/config.php';
header('Content-Type: application/json');
//die();
//json(false,4,$_POST);
/*
Important functions for APIs
fc, filler, completer, d, r, uploadProcessor, checkPassword, sms, e, fl, drop,htmll()
*/
//json(false);
//tester();
//		tester(print_r($_POST,true));

//mark($_POST);
$_adminUsers=[1,3];
$user_token=e('user_token');
$user_id=user_id();

//these APIs do NOT require login
$arr=array('social_login','login','page','drops','signup','logout','posts','social','stats','testUpdate','forgotPassword','marketplace');

if($user_id==0 && !in_array($_POST['api'],$arr)){
	if(!($_POST['api']=='posts' && $_POST['sub']=='list')){
		if(!($_POST['api']=='posts' && $_POST['sub']=='single'))
//			json(false,1000);
			json(true,1,1);
	}
} 
 

$_testing=$_config['testing']; 
$_testing_version=$_config['testing_version'];

$default_limit=200;
$originalOffset=i('offset')?e('offset'):NULL;
$limit=!i('offset') || $_POST['offset']==0 ? 'LIMIT '.$default_limit : "LIMIT ".$originalOffset.",$default_limit";
//$search=!isset($_POST['search']) || $_POST['search']=='' ? NULL: " AND name LIKE '%".escape($_POST['search'])."%'";


//if(i('fresh_start')){
//	
//}

if(!isset($_POST['api']))
	json(false);

switch($_POST['api']){

		case'drops':
		$countries=[];
		$ps=db('countries_1556139283',"WHERE id=169",NULL,'LIMIT 1','id,title');
		$ps[0]['title_ml']=$ps[0]['title'];
		$ps[0]['title']=l($ps[0]['title']);
		
		$countries=array_merge($ps,drop_ml('countries_1556139283')); 
		
//		array_unshift($countries,$ps);
			json(true,1,array(
				'sizes'=>drop_ml('sizes_8311'),
//				'categories'=>fca(drop_ml('posts_categories_8319','title','icon'),['icon']),
				'categories'=>drop_ml('posts_categories_8319','title','icon'),
				'colors'=>drop_ml('colors_8314','title','color'),
				'countries'=>$countries,
				'contact'=>fla(db('contact_options_8316',"WHERE !deleted AND id!=10",NULL,NULL,'id,title,tip'),['title','tip']),
				'currencies'=>fl(drop('currencies_8320','title','symbol,shortname',"ORDER BY order_number ASC"),'shortname')
			));
		break;
		
		
	case 'page':
		if(i('id') && $_POST['id']!=""  && $_POST['id']!=0){
			$id=id();
			$and="id='$id'";
			}
		else{
			$slug=e('slug');
			$and="slug='$slug'";
		}
		
		$resp=db('pages_1478423482',"WHERE deleted='0' AND $and",NULL,"LIMIT 1",'title,content,photo');
		if ($resp==0)json(false,3);
		else if($resp==1)json(true,1);
		$resp=$resp[0];
		
		$photo=NULL;
		if($resp['photo']!=NULL){
			$photo='<div id="top_photo" '.bg($resp['photo'],600).'></div><style>#top_photo{width:100%;height:30vh}</style>';
		}
		
		$resp['photo']=$resp['photo']==NULL?'':urlencode(u.img($resp['photo'],800,100));
		$resp['title']=l($resp['title']);
		
		
		$resp['content']=$photo.html(l($resp['content']));
		json(true,1,$resp);
		break;
		
		
	case'lang':
			co($_users,$user_id);
			$_POST['language']=currid();
			r($_users,'edit');
		
			$tmp=o('tokens',$user_token,'token');
		if($tmp!=1){
			co('tokens',$tmp[0]['id']);
			$_POST['language']=currid();
			r('tokens','edit');
		}
			
		
			json();
		break;
		
		case'social':
			json(true,1,db('social_links_1643648756',NULL,'ORDER BY order_number ASC'));
		break;
		
		case'change_username':
		$tmp=o($_users,$user_id);
		if($tmp[0]['username']==$_POST['new_username'])json(false,118);
		
			checkUsername($_POST['new_username']);
		
			$_POST['username']=$_POST['new_username'];
			co($_users,$user_id);
			$_POST['id']=$user_id;
			$_POST['user']=$user_id;
			r($_users,'edit');

			$_POST['from_username']=$tmp[0]['username'];
			$_POST['to_username']=$_POST['new_username'];
				
			r('username_changes_8326');
			json(true,117);
		break;
		
	case'signup':
			$_POST['language']=currid();
			co($_users);
			unset($_POST['email_verified']);
//			$code=$_POST['code']=code(111111,999999);
//			$username=$_POST['username'];
//			$email=$_POST['email'];
//			$_POST['module']=$_users;//notifier
//			$_POST['action']='add';//notifier
			
			
			$last_id=r($_users);
			$token=userToken($last_id,NULL,$_users);
			
			for($__u=0;$__u<count($_adminUsers);$__u++){
				psn('New User',($_POST['first_name']!=''?$_POST['first_name'].' '.$_POST['last_name'].' - ':NULL).$_POST['username'],[$_adminUsers[$__u],$_users],['unilink'=>url($_users,'single',$last_id)]);
			}
			
//			$fmi=4;
//			include mailer;
//			json(true,1,array('user_token'=>$token,'_user_id'=>$last_id,'shouldVerify'=>true,'verify_msg'=>l("We sent you a code to your email $email, check in the inbox and spam/junk box, please.<>لقد ارسلنا رقم التفعيل على بريدك الالكتروني $email ، تفقد صندوق الوارد او صندوق الرسائل العشوائية")));
			json(true,1,array('user_token'=>$token,'_user_id'=>$last_id));
		
		break;
		
		case'verifyEmail':
			$tmp=db($_users,"WHERE !deleted AND id=$user_id AND code='".e('code')."'");
			if($tmp==1)json(false,111);
			co($_users,$tmp[0]['id']);
			$_POST['email_verified']=1;
			r($_users,'edit');
			json(true,112);
		break;
		
		case'resendEmailCode':

			cod($_users,$user_id);
			if($_POST['email_verified'])json();
		
			$code=$_POST['code']=code(111111,999999);
			$email=$_POST['email'];
			$username=$_POST['username'];
			r($_users,'edit');
			$fmi=4;
			include mailer;
		
			if(i('late_verify')){
				json(true,1,array('shouldVerify'=>true,'verify_msg'=>l("We sent you a code to your email $email, check in the inbox and spam/junk box, please.<>لقد ارسلنا رقم التفعيل على بريدك الالكتروني $email ، تفقد صندوق الوارد او صندوق الرسائل العشوائية")));
			}
			json(true,113);
		break;
		
		case'forgotPassword':
			$tmp=db($_users,"WHERE !deleted AND username='".e('username')."'");
			if($tmp==1)json(false,88);
			$new_password=rand_string(9);
			$username=$tmp[0]['username'];
			$email=$tmp[0]['email'];
			$obfuscate_email=obfuscate_email($email);
			$password=password_hash($new_password,PASSWORD_DEFAULT);
			
			$fmi=5;
			include mailer;
		
			if(dbs("UPDATE $_users SET password='$password' WHERE id={$tmp[0]['id']} LIMIT 1")==0)json(false,3);
			if(dbs("DELETE FROM tokens WHERE user_id={$tmp[0]['id']}  AND module_prefix='$_users'")==0)json(false,3);
		
		$reset_msg=l("We sent you a new password to your email $obfuscate_email, check in the inbox and spam/junk box, please.<>لقد ارسلنا  كلمة مرور جديدة على بريدك الالكتروني $obfuscate_email ، تفقد صندوق الوارد او صندوق الرسائل العشوائية");
			json(true,1,array('reset_msg'=>$reset_msg));
		
		break;
		
//		case'uploader':
//			$res=uploadProcessor('files',false,true);
//			json(true,1,$res);
//		break;
		
		case'logout':
			$player_id=e('player_id');
			if(!mysqli_query($conn,"DELETE FROM tokens WHERE token='$user_token' AND user_id='$user_id'"))json(false,3);
			logout();
			json();
		break;
		
		
		case'login':
		
			$username=e('username');
		  	$resp=db($_users,"WHERE username='$username' AND !deleted",NULL,"LIMIT 1",'id,password,email_verified');
			if($resp!=1){
				$password=e('password');
				if($password=="")json(false,23);
				if(password_verify($password,$resp[0]['password'])){
					$token=userToken($resp[0]['id'],NULL,$_users);
					
					dbs("UPDATE $_users SET language='".currid()."' WHERE id={$resp[0]['id']}");
//					if(!$resp[0]['email_verified']){
//						cod($_users,$resp[0]['id']);
////						dp();
//						$code=$_POST['code']=code(111111,999999);
//						$email=$_POST['email'];
//						$username=$_POST['username'];
//						r($_users,'edit');
//						$fmi=4;
//						include mailer;
//						
//						json(true,1,array('user_token'=>$token,'_user_id'=>$resp[0]['id'],'shouldVerify'=>true,'verify_msg'=>l("We sent you a code to your email $email, check in the inbox and spam/junk box, please.<>لقد ارسلنا رقم التفعيل على بريدك الالكتروني $email ، تفقد صندوق الوارد او صندوق الرسائل العشوائية")));
//					}else
					
					
						json(true,1,array('user_token'=>$token,'_user_id'=>$resp[0]['id']),NULL,user_missing($resp[0]['id']));
				}
			}
		json(false,23);
		break;
		
	
		
		
		case 'social_login':
			if(!i('sub'))json(false,116);
			switch($_POST['sub']){
				case'facebook':
					if($_POST['facebook_id']=='' || $_POST['fb_token']=='')json(false,116);
					$respo=json_decode(file_get_contents('https://graph.facebook.com/v15.0/'.$_POST['facebook_id'].'/?fields=email,name,id,first_name,last_name,picture&access_token='.$_POST['fb_token']),true);
					#!triple check if they bypass this we are in deep shit
//					mysqli_query($conn,"INSERT INTO tester_1565720578 (raw_post) VALUES ('".print_r($_POST,true)."')");
//					mysqli_query($conn,"INSERT INTO tester_1565720578 (raw_post) VALUES ('".print_r($respo,true)."')");
					if(isset($respo['error']) || $respo=='' || !isset($respo['id']) || $respo['id']==NULL || $respo==false)json(false,116);
					$resp=db($_users,"WHERE facebook_id='".escape($respo['id'])."'",NULL,"LIMIT 1");
//					$social_photo=isset($respo['picture']['data']['url']) && $respo['picture']['data']['url']!=NULL?$respo['picture']['data']['url']:NULL;
					$_photo=json_decode(file_get_contents('https://graph.facebook.com/v15.0/'.$_POST['facebook_id'].'/picture?width=1000&redirect=0&access_token='.$_POST['fb_token']),true);
//					mysqli_query($conn,"INSERT INTO tester_1565720578 (raw_post) VALUES ('".print_r('https://graph.facebook.com/v15.0/'.$_POST['facebook_id'].'/picture?width=1000&access_token='.$_POST['fb_token'],true)."')");
//					mysqli_query($conn,"INSERT INTO tester_1565720578 (raw_post) VALUES ('".print_r($_photo,true)."')");
					if($_photo!=false && !isset($_photo['error']) && $_photo!='' && isset($_photo['data']['url']) && $_photo['data']['url']!=NULL){
						$social_photo=$_photo['data']['url'];
					}else
						$social_photo=isset($respo['picture']['data']['url']) && $respo['picture']['data']['url']!=NULL?$respo['picture']['data']['url']:NULL;
					$social_first_name=isset($respo['first_name']) && $respo['first_name']!=NULL?escape($respo['first_name']):'';
					$social_last_name=isset($respo['last_name']) && $respo['last_name']!=NULL?escape($respo['last_name']):'';
					$social_email_verified=1;
					$social_id_db_name='facebook_id';
					$social_username=$social_id=escape($respo['id']);#!tefalsafesh
				break;
					
				case'google':
					if($_POST['google_token']=='')json(false,116);
					$respo=json_decode(file_get_contents("https://www.googleapis.com/oauth2/v3/userinfo?access_token=".$_POST['google_token']),true);
//					tester(print_r($_POST,true));
//					tester(print_r($respo,true));
					#!triple check if they bypass this we are in deep shit
					if(isset($respo['error']) || $respo=='' || $respo==false || !isset($respo['sub']) || $respo['sub']==NULL)json(false,116);
					$resp=db($_users,"WHERE google_id='".escape($respo['sub'])."'",NULL,"LIMIT 1");
					$social_photo=isset($respo['picture']) && $respo['picture']!=NULL?$respo['picture']:NULL;
					$social_first_name=isset($respo['given_name']) && $respo['given_name']!=NULL?escape($respo['given_name']):NULL;
					$social_last_name=isset($respo['family_name']) && $respo['family_name']!=NULL?escape($respo['family_name']):NULL;
					$social_email_verified=$respo['email_verified']==true?1:0;
					$social_id_db_name='google_id';
					$social_username=$social_id=escape($respo['sub']);#!tefalsafesh
				break;
					  
				case'apple':
					if($_POST['apple_id']=='' || $_POST['apple_token']=='')json(false,116);
//					mysqli_query($conn,"INSERT INTO tester_1565720578 (raw_post) VALUES ('".print_r($tmp,true)."')");
					$respo=json_decode(file_get_contents("https://queenandqueens.com/comp/apple.php?identityToken=".$_POST['apple_token']),true);
//					mysqli_query($conn,"INSERT INTO tester_1565720578 (raw_post) VALUES ('".print_r($respo['_instance'],true)."')");
					#!triple check if they bypass this we are in deep shit
					if(isset($respo['error']) || $respo=='' || $respo==false || !isset($respo['_instance']['sub']) || $respo['_instance']['sub']==NULL)json(false,116);
					$respo=$respo['_instance'];
					$resp=db($_users,"WHERE apple_id='".escape($respo['sub'])."'",NULL,"LIMIT 1");
					$social_photo=NULL;#!apple does not provide photo of user
					$social_first_name=$_POST['first_name']!=NULL && $_POST['first_name']!=''?e('first_name'):NULL;
					$social_last_name=$_POST['last_name']!=NULL && $_POST['last_name']!=''?e('last_name'):NULL;
					$social_email_verified=$respo['email_verified']==true?1:0;
					$social_id_db_name='apple_id';
					$social_id=escape($respo['sub']);
					$social_username=slugify(explode('@',$respo['email'])[0].end(explode('.',$respo['sub'])));
				break;
					
					
				case'twitter':
					if($_POST['twitter_token']=='' || $_POST['twitter_secret']=='')json(false,116);
					$respo=json_decode(file_get_contents("https://queenandqueens.com/comp/twitter.php?oauth_token=".$_POST['twitter_token']."&oauth_token_secret=".$_POST['twitter_secret']),true);
//					mysqli_query($conn,"INSERT INTO tester_1565720578 (raw_post) VALUES ('".print_r($respo,true)."')");
					#!triple check if they bypass this we are in deep shit
					if(isset($respo['error']) || $respo=='' || $respo==false || $respo['id']==NULL)json(false,116);
					$resp=db($_users,"WHERE twitter_id='".escape($respo['id'])."'",NULL,"LIMIT 1");
					$social_photo=isset($respo['profile_image_url']) && $respo['profile_image_url']!=NULL?$respo['profile_image_url']:NULL;
					
					if(isset($respo['name']) && $respo['name']!=NULL){
						$x=explode(' ',$respo['name']);
					}
					$social_first_name=$x[0]!=NULL && $x[0]!=''?escape($x[0]):NULL;
					$social_last_name=$x[0]!=NULL && $x[1]!=''?escape($x[1]):NULL;
					$social_email_verified=$respo['verified']==true?1:0;
					$social_id_db_name='twitter_id';
					$social_id=escape($respo['id']);
					$social_username=slugify($respo['screen_name']);
					$social_extra=[['field_name'=>'twitter_username','value'=>$respo['screen_name']]];
				break;
					
					
			}
		 
			if($resp==0)json(false,116);
			
		
			 if($resp==1){
				#! handle no email
			 	if(!isset($respo['email']) || $respo['email']=='')json(false,116);
				 $tmp=o($_users,escape($respo['email']),'email');
				 if($tmp!=1 && $tmp[0]['email']==$respo['email']){
					 #!check if there is already a photo, first_name,last_name take them
					 if($tmp[0]['photo']=='' && $social_photo!=NULL){
						 $photo_fullname=fileFromLink($social_photo);
						 dbs("UPDATE $_users SET photo='$photo_fullname' WHERE id={$tmp[0]['id']}");
						 }
					 if($tmp[0]['first_name']=='' && $social_first_name!='')
						  dbs("UPDATE $_users SET first_name='".$social_first_name."' WHERE id={$tmp[0]['id']}");
					 if($tmp[0]['last_name']=='' && $social_last_name!='')
						  dbs("UPDATE $_users SET last_name='".$social_last_name."' WHERE id={$tmp[0]['id']}");
					 
//					 dbs("UPDATE $_users SET email_verified=$social_email_verified,$social_id_db_name='$social_id' WHERE id={$tmp[0]['id']}");

					 //new starts
					 $__tmp=$_POST;
					 unset($_POST);
					 co($_users,$tmp[0]['id']);
					 $_POST[$social_id_db_name]=$social_id;
					 if($social_email_verified)
						 $_POST['email_verified']=1;
					 if(isset($social_extra) && $social_extra!=NULL && is_array($social_extra)){
						 foreach($social_extra as $s){
							 if($tmp[$s['field_name']]=='')
								 $_POST[$s['field_name']]=$s['value'];
					 	}
					 }
					 
					 r($_users,'edit');
					 //new end
					 
					 $token=userToken($tmp[0]['id'],NULL,$_users);
					 json(true,1,array('user_token'=>$token,'_user_id'=>$tmp[0]['id'],'account'=>'new_connection'),NULL,user_missing($tmp[0]['id']));
				 }
		
				 #!forcing country
				$_POST['country']=169;
				$_POST['language']=currid();
				$_POST['first_name']=$social_first_name;
				$_POST['last_name']=$social_last_name;
				$_POST['email']=$respo['email'];
				$_POST['email_verified']=$social_email_verified;

				 if(isset($social_extra) && $social_extra!=NULL && is_array($social_extra)){
					 foreach($social_extra as $s){
						 $_POST[$s['field_name']]=$s['value'];
					 }
				 }
				 
				$_POST[$social_id_db_name]=$social_id;
				 $gen_username=NULL;
				 if($_POST['first_name']!='')$gen_username.=slugify($_POST['first_name']);
				 if($_POST['last_name']!='')$gen_username.=slugify($_POST['last_name']);
				 $gen_username.=rand(11,99);
				 if(checkUsername($gen_username,true)){
					 if(o($_users,$gen_username,'username')==1){
						 $_POST['username']=$gen_username;
					 }else{
						 $_POST['username']=$social_username;
					 }
						 
				 }else{
					 $_POST['username']=$social_username;
				 }
					 
				 #!prompt to put password
				 $_POST['password']=rand_string(9);
				 
				co($_users);
//				$_POST['module']=$_users;//notifier
//				$_POST['action']='add';//notifier
				$last_id=r($_users);
				 
				 
				 for($__u=0;$__u<count($_adminUsers);$__u++){
					psn('New '.$_POST['sub'],($_POST['first_name']!=''?$_POST['first_name'].' '.$_POST['last_name'].' - ':NULL).$_POST['username'],[$_adminUsers[$__u],$_users],['unilink'=>url($_users,'single',$last_id)]);
					}
				 
				 
				 if($social_photo!=NULL){
					$photo_fullname=fileFromLink($social_photo);
					dbs("UPDATE $_users SET photo='$photo_fullname' WHERE id=$last_id");
				 }
					 
				$token=userToken($last_id,NULL,$_users);

				json(true,1,array('user_token'=>$token,'_user_id'=>$last_id,'account'=>'new'),NULL,user_missing($last_id,true));
			}
			elseif($resp[0]['deleted'])json(false,107);
			else{
				if($resp[0]['photo']=='' && $social_photo!=NULL){
					$photo_fullname=fileFromLink($social_photo);
					dbs("UPDATE $_users SET photo='$photo_fullname' WHERE id={$resp[0]['id']}");
				 }
				 if($resp[0]['first_name']=='' && $social_first_name!='')
					  dbs("UPDATE $_users SET first_name='$social_first_name' WHERE id={$resp[0]['id']}");
				 if($resp[0]['last_name']=='' && $social_last_name!='')
					  dbs("UPDATE $_users SET last_name='$social_last_name' WHERE id={$resp[0]['id']}");
				
				dbs("UPDATE $_users SET language='".currid()."' WHERE id={$resp[0]['id']}");
				$token=userToken($resp[0]['id'],NULL,$_users);
				json(true,1,array('user_token'=>$token,'_user_id'=>$resp[0]['id'],'account'=>'old'),NULL,user_missing($resp[0]['id']));
			}
		
		json(false,116);

		break;
		
		
		
		
		
		case'deleteAccount':
			dbs("UPDATE $_users SET deleted=1 WHERE id=$user_id LIMIT 1");
			$tokens=db('tokens',"WHERE module_prefix='$_users' AND user_id=$user_id");
			if($tokens!=1){
				foreach($tokens as $t){
					del('tokens',$t['id']);
				}
			}
			logout();
			json(true,107);
		break;
		
		
		

		case'accountInfo':
			$tmp=db($_users,"WHERE id=$user_id",NULL,'LIMIT 1','username,first_name,last_name,photo,country,email,mobile,email_verified');
			if($_testing && i('_v') && $_POST['_v']==$_testing_version){
				if($_POST['lang']=='en'){
					
					if($user_id==58){
						$tmp[0]['first_name']='Christina';
						$tmp[0]['last_name']='Habash';
					}elseif($user_id==59){
						$tmp[0]['first_name']='Katie';
						$tmp[0]['last_name']='Shamali';
					}
				}elseif($_POST['lang']=='ar'){
					
					if($user_id==58){
						$tmp[0]['first_name']='كريستينا';
						$tmp[0]['last_name']='حبش';
					}elseif($user_id==59){
						
						$tmp[0]['first_name']='كيتي';
						$tmp[0]['last_name']='شمالي';
					}
				}
			}
		
			if($tmp[0]['first_name']!='')
				$tmp[0]['hello_extra']=$tmp[0]['first_name'];
			else
				$tmp[0]['hello_extra']=$tmp[0]['username'];
		
		
			$tmp[0]['name']=$tmp[0]['first_name']==''?NULL:$tmp[0]['first_name'].' '.$tmp[0]['last_name'];
			$tmp[0]["username_label"]='@'.$tmp[0]["username"];
		
			if($tmp[0]['photo']=='')$tmp[0]['photo']=$_config['default_profile_picture'];
			$tmp=fc($tmp[0],['photo']);
			json(true,1,$tmp);
		break;
	
		
		case'editprofile':
			$resp=o($_users,$user_id);
			if($_POST['email']!=$resp[0]['email']){
				$_POST['email_verified']=0;
			}
				
		
			co($_users,$user_id);
			r($_users,'edit');
		
			if($_POST['email']!=$resp[0]['email']){
					co($_users,$resp[0]['id']);
					$code=$_POST['code']=code(111111,999999);
					$email=$_POST['email'];
					$username=$_POST['username'];
					r($_users,'edit');
					$fmi=4;
					include mailer;
					json(true,1,array('shouldVerify'=>true,'verify_msg'=>l("We sent you a code to your email $email, check in the inbox and spam/junk box, please.<>لقد ارسلنا رقم التفعيل على بريدك الالكتروني $email ، تفقد صندوق الوارد او صندوق الرسائل العشوائية")));
				}
		
		
			json();
		break;
		
		
		case'changePassword':
			$old=e('old');
			$resp=db($_users,"WHERE id='$user_id' AND deleted='0'",NULL,"LIMIT 1",'password');

			if(!password_verify($old,$resp[0]['password']))json(false,109);
		
			$new=e('new');
			if(password_verify($new,$resp[0]['password']))json(false,114);
			checkPassword($new);
		
			$confirm=e('confirm');
			if($new!=$confirm)json(false,110);
		
		
		
			$password=password_hash($new,PASSWORD_DEFAULT);

			if(dbs("UPDATE $_users SET password='$password' WHERE id='$user_id' LIMIT 1")==0)json(false,3);
			if(dbs("DELETE FROM tokens WHERE user_id='$user_id' AND token!='$user_token' AND module_prefix='$_users'")==0)json(false,3);


			json(true,2);
		break;
		
		
		
		
		

 
        case'posts':
            $_POST['user']=$user_id;
            $_m='posts_8319';

            switch($_POST['sub']){
                case'add':
//					mark($_POST);
					//temprary solution for multiposting also #!
					if($_POST['_d']=='Android' && $_POST['app_v']<=1.0){
						if(db($_m,"WHERE !deleted AND user=$user_id AND sell_price='".e('sell_price')."' AND rent_price='".e('rent_price')."' AND wear_count='".e('wear_count')."' AND date_created>=NOW() - INTERVAL 1 MINUTE",NULL,'LIMIT 1')!=1)json(true,1);
						}
					
					if($_POST['rent_out'] && !is_numeric($_POST['rent_price']) && $_POST['rent_price']<=0)json(false,100);
					if($_POST['sell'] && !is_numeric($_POST['sell_price']) && $_POST['sell_price']<=0)json(false,101);
					
//					
					
					if((!$_POST['rent_out'] && !$_POST['sell']) || ($_POST['rent_price']==0 && $_POST['sell_price']==0))json(false,108);
                    co($_m);
					$_POST['published']=1;
					$_POST['status']=$_config['default_post_status'];
                    $last_id=r($_m,'add');
					
					for($__u=0;$__u<count($_adminUsers);$__u++){
						psn('New Post','by '.o($_users,$user_id)[0]['username'],[$_adminUsers[$__u],$_users],['unilink'=>url($_m,'single',$last_id)]);
					}
										
					$tmp=db('user_contact_8316',"WHERE user=$user_id AND !deleted AND active");
					if($tmp==1){
						json(true,103);
					}
					
					if($_POST['status']==1)
						json(true,106);
					elseif($_POST['status']==2)
						json(true,105);
					
                break;

                case'delete':
                    mysqli_query($conn,"UPDATE $_m SET deleted=1 WHERE id='".e('id')."' AND user=$user_id LIMIT 1");
                break;

                case'list':
//					json(true,103,1);
					$ads=true;
					$user=NULL;
					$status=" AND $_posts.status=2";
					if(i('for_user')){
						if($_POST['for_user']==-1){//me
							$status=NULL;
							$user="AND $_posts.user=".$user_id;
							$profile=userPublic($user_id);
							$ads=false;
							}
						else if($_POST['for_user']>0){//other
							$user="AND $_posts.user=".e('for_user');
							$profile=userPublic(e('for_user'));
							$ads=false;
						}
					}
					
					//all
					$_search=NULL;
					if(i('category') && $_POST['category']!=0)
						$_search.=" AND $_posts.category=".e('category');
					
					if(i('size') && $_POST['size']!=0)
						$_search.=" AND $_posts.size=".e('size');
					
					if(i('color') && $_POST['color']!=0)
						$_search.=" AND $_posts.color=".e('color');
					
					if(i('country_id') && $_POST['country_id']!=0)
						$_search.=" AND $_users.country=".e('country_id');
					
					if(i('looking') && $_POST['looking']=='1')$_search.=" AND $_posts.rent_out";
 					else if(i('looking') && $_POST['looking']=='2')$_search.=" AND $_posts.sell";
					
					
					if($_testing && i('_v') && $_POST['_v']==$_testing_version){
						$status=" AND $_posts.status=5";
					}

					$posts=db($_posts,"INNER JOIN $_users ON $_posts.user=$_users.id WHERE  !$_posts.deleted AND $_posts.files!='' AND $_posts.published AND !$_users.deleted $status $user $_search","ORDER BY $_posts.id DESC",$limit,"$_posts.*");
//					mark($_search);
					if($posts==1 && i('country_id') && $_POST['country_id']!=0 && !i('looking')){
						$status=" AND $_posts.status=5";
						$_search=NULL;
						$posts=db($_posts,"INNER JOIN $_users ON $_posts.user=$_users.id WHERE !$_posts.deleted AND $_posts.files!='' AND $_posts.published AND !$_users.deleted $status","ORDER BY $_posts.id DESC",$limit,"$_posts.*");
					}
					
					
					$posts=postsP($posts);

					if(i('view_style') && $_POST['view_style'] && $_POST['view_style']=='grid'){

					}elseif($ads){
						$posts=ads($posts);
					}
//					d(count($posts));
                    json(true,1,$posts,NULL,['count'=>$posts==1?0:count($posts),'profile'=>isset($profile)?$profile:NULL]);
                break;
					


                case'edit':
                    $id=e('id');
                    if(db($_m,"WHERE id=$id AND user=$user_id")==1)json(false,88);
                    co($_m,$id);
                    r($_m,'edit');
                break;
					
				case'unpublish':
                    $id=e('id');
                    if(db($_m,"WHERE id=$id AND user=$user_id")==1)json(false,88);
					$_POST=NULL;
                    co($_m,$id);
					$_POST['published']=0;
                    r($_m,'edit');
                break;
					
				case'single':
//					$posts=db($_m,"WHERE !deleted AND files!=''  AND status=2 AND published AND id=".e('id'),NULL,'LIMIT 1');
					
					$posts=db($_posts,"INNER JOIN $_users ON $_posts.user=$_users.id WHERE $_posts.id=".e('id')."  AND $_posts.status=2  AND !$_posts.deleted AND $_posts.files!='' AND $_posts.published AND !$_users.deleted","ORDER BY $_posts.id DESC","LIMIT 1","$_posts.*");
//					mark($posts);
//					dq();
					if($posts==1)json(false);
					
					$posts=postsP($posts);
                    json(true,1,$posts,NULL,['count'=>$posts==1?0:count($posts)]);
                break;
            }
        json(); 
        break;
        

		
		

 
        case'likes':
            $_POST['user']=$user_id;
            $_m='likes_8315';

            switch($_POST['sub']){
					case'like':
						$post=e('post');
						$the_post=o('posts_8319',$post);
						if($the_post==1)json(false,102);
					
						$tmp=db($_m,"WHERE post=$post AND user=$user_id");
						if($tmp==1){
							r($_m,'add');
							psnLike($post,$the_post[0]['user']);
							json(true,1,['bool'=>true]);
						}else{
							if($tmp[0]['deleted']){//
								restore($_m,$tmp[0]['id']);
								psnLike($post,$the_post[0]['user']);
								json(true,1,['bool'=>true]);
							}elseif(!i('force') || (i('force') && $_POST['force']=='false')){
								del($_m,$tmp[0]['id']);
								json(true,1,['bool'=>false]);
							}
						}
					json();
					break;
            }
        break;
		
		
		  case'saved':
            $_POST['user']=$user_id;
            $_m='saved_8315';

            switch($_POST['sub']){
					case'save':
						$post=e('post');
						$the_post=o('posts_8319',$post);
						if($the_post==1)json(false,102);
					
						$tmp=db($_m,"WHERE post=$post AND user=$user_id");
						if($tmp==1){
							r($_m,'add');
							psnSave($post,$the_post[0]['user']);
							json(true,1,['bool'=>true]);
						}else{
							if($tmp[0]['deleted']){
								restore($_m,$tmp[0]['id']);
								psnSave($post,$the_post[0]['user']);
								json(true,1,['bool'=>true]);
							}else{
								del($_m,$tmp[0]['id']);
								json(true,1,['bool'=>false]);
							}
						}
					json();
					break;
					
					case'list':
//					mark($_POST);
					$tmp=db($_m,"WHERE !deleted AND user=$user_id");
					if($tmp==1)json(true,1,$tmp);
					$res=[];
					foreach($tmp as $t){
						$res[]=$t['post'];
					}
					
					$posts=db('posts_8319',"WHERE deleted=0  AND status=2 AND files!='' AND published AND id IN (".implode(',',$res).")",NULL,$limit);
					$posts=postsP($posts);
                    json(true,1,$posts,NULL,['count'=>$posts==1?0:count($posts)]);
					break;
            }
        break;
        

		
		


 
        case'user_contact':
            $_POST['user']=$user_id;
            $_m='user_contact_8316';

            switch($_POST['sub']){
                case'add':
					$_POST['value']=engNum($_POST['value']);
                    co($_m);
					
                    r($_m,'add');
                break;

                case'delete':
                    mysqli_query($conn,"UPDATE $_m SET deleted=1 WHERE id='".e('id')."' AND user=$user_id LIMIT 1");
                break;

                case'list':
					$resp=commer(db($_m,"WHERE user=$user_id AND deleted=0",NULL,$limit));
					if($resp!=1){
						foreach($resp as &$r){
							$option=o('contact_options_8316',$r['contact_option']);
							$r['link']=urlencode(l($option[0]['link_template']).$r['value']);
						}
						}
                    json(true,1,$resp);
                break;

                case'edit':
                    $id=e('id');
                    if(db($_m,"WHERE id=$id AND user=$user_id")==1)json(false,88);
					$_POST['value']=engNum($_POST['value']);
                    co($_m,$id);
                    r($_m,'edit');
                break;
            }
        json();
        break;
        

		
        
		

 
        case'bug_report':
            $_POST['user']=$user_id;
            $_m='bug_report_8317';

            switch($_POST['sub']){
                case'add':
                    co($_m);
					$_POST['status']=1;
                    r($_m,'add');
					json(true,104);
                break;


            }
        json();
        break;
        

		

 
        case'stats':
            $_POST['user']=$user_id;
            $_m='stats_8319';

            switch($_POST['sub']){
                case'add':
					if(i('data_type')){
						if($_POST['data_type']=='installs'){
							co($_m);
							r($_m,'add');
						}
						else{
							if($_POST['data_type']=='ad')$_mod='ads_8319';
							elseif($_POST['data_type']=='post')$_mod=$_posts;
							elseif($_POST['data_type']=='user')$_mod=$_users;
							$_POST['module_prefix']=mid($_mod);
							$tmp=o($_mod,e('related_id'));

							if(i('extra_data_type') && $_POST['extra_data_type']=='contact'){
								$_POST['extra_module']=mid('contact_options_8316');
							}

							if($tmp!=1 && $tmp!=0){
								if((isset($tmp[0]['status']) && $tmp[0]['status']!=2) || (isset($tmp[0]['published']) && !$tmp[0]['published']) || $tmp[0]['deleted'])
									$_POST['remark']='Tries';
								if($_POST['data_type']=='user'){
									if($tmp[0]['id']==$user_id)json();
								}else{
									if($tmp[0]['user']==$user_id && $_POST['type']!=4)json();
									if($_POST['type']==4)psnShare(e('related_id'),$tmp[0]['user']);
//									if($_POST['data_type']=='post' && $_POST['type'])
								}
								co($_m);
								r($_m,'add');
//								if(isset($pusher)){
//									require public_html.'comp/vendor/autoload.php';
//									 $options = array(
//										'cluster' => 'eu',
//										'useTLS' => true
//									  );
//									  $pusher = new Pusher\Pusher(
//										'ac913ab50cc010eeeb02',
//										'3bd9a1b4c77f7ee7bd1e',
//										'1496198',
//										$options
//									  );
//
//									  $data['extra']['js'] = 'liveStats';
//									  $pusher->trigger('liveStats','my-event2',$data);
//								}
							}
						}
					
					}
                break;
           	 
			}
        json();
        break;
		
		
		
		
		

 
        case'marketplace':
            $_POST['user']=$user_id;
            $_m='marketplace_8323';

            switch($_POST['sub']){


                case'list':
					$for=NULL;
					if(i('for_id'))$for=" AND id=".e('for_id');
                    $resp=fla(fcafull(db($_m,"WHERE deleted=0 $for","ORDER BY order_number ASC",$limit),['photo']),['title','content','summary']);
					foreach($resp as &$r){
//						$r['content_html']=h($r['content_html']);
						$r['link']=url($_m,'single',$r['id']).'?mobile=true';
					}
                    /*
                    foreach($resp as &$r){
                    
                    }
                    */
                    json(true,1,$resp);
                break;

            }
        json();
        break;
       
 
        case'purchases':
            $_POST['user']=$user_id;
            $_m='purchases_8323';

            switch($_POST['sub']){
                case'add':
					unset($_POST['status'],$_POST['reference']);
//					dp();
                    co($_m);
					
					$tmp=json_decode($_POST['details'],true);
					$_POST['reference']=$tmp['transactionIdentifier'];
					$_POST['status']=$tmp['error']=='nil'?2:3;
//					json_encode($_POST['details']);
                    r($_m,'add');
					json(true,115);
                break;


            }
        json();
        break;
        

		


		
		
		case'chat':
		mysqli_set_charset($conn,'utf8mb4');
		switch($_POST['sub']){
				case'list':
					$rooms=array();
					$res=array();
					$resp=db($_chat,"WHERE !deleted AND (sender=$user_id OR receiver=$user_id)","ORDER BY id DESC",NULL,'DISTINCT sender,receiver');
					if($resp!=1){
						for($i=0;$i<count($resp);$i++){
							$receiver=$resp[$i]['receiver'];
							$sender=$resp[$i]['sender'];
							if((isset($rooms[$sender]) && $rooms[$sender]==$receiver) || (isset($rooms[$receiver]) && $rooms[$receiver]==$sender))continue;

							$rooms[$sender]=$receiver;
							$msg=db($_chat,"WHERE !deleted AND ( (sender=$sender AND receiver=$receiver) OR (sender=$receiver AND receiver=$sender))","ORDER BY id DESC",'LIMIT 1','sender,receiver,text,date_created,seen,time_stamp')[0];
							if($msg['sender']==$user_id)$resp[$i]['seen']=1;
							else $resp[$i]['seen']=$msg['seen'];
							$resp[$i]['_date_created']=$msg['date_created'];
							$resp[$i]['text']=$msg['text'];
							$resp[$i]['date_created']=cleanDate($msg['date_created']);
							$resp[$i]['elapse']=elapse($msg['time_stamp']);
							$resp[$i]['other']=publisher($user_id==$resp[$i]['sender'] ? $resp[$i]['receiver']:$resp[$i]['sender']);
							$res[]=$resp[$i];
						}
						
							usort($res,function($b,$a){
								if($a['_date_created']==$b['_date_created'])return 0;
								return $a['_date_created']<$b['_date_created']?-1:1;
							});
					}
				
					
					json(true,1,empty($res)?1:$res);
				break;
				
				case'add':
					$_POST['text']=cs($_POST['text']);
					$_POST['sender']=$user_id;
					r($_chat);
					$sender=publisher(e('sender'));
					psn($sender['name'],$_POST['text'],[e('receiver'),$_users],['unilink'=>url($_chat,'single',$sender['id'])],false);
					json();
				break;

			case'single':				
					$rec=e('receiver');
						$resp=db($_chat,"WHERE !deleted AND ((sender=$user_id AND receiver=$rec) OR (sender=$rec AND receiver=$user_id))","ORDER BY id ASC");
						if($resp!=1){
							for($i=0;$i<count($resp);$i++){
								if($resp[$i]['sender']==$user_id)$resp[$i]['mine']=true;
								else $resp[$i]['mine']=false;
								
								$cleaned=cleanDate($resp[$i]['date_created']);
								if($today==$cleaned){
									$resp[$i]['time']=date('h:i a',strtotime($resp[$i]['date_created']));
								}else{
									$resp[$i]['time']=cleanDate($resp[$i]['date_created']);
								}
							
								
								
							}
							if($resp!=1 && $resp[count($resp)-1]['sender']!=$user_id)mysqli_query($conn,"UPDATE $_chat SET seen=1 WHERE id='".$resp[count($resp)-1]['id']."'");
						}

					else{
						if(i('_v') && $_POST['_v']<2.0){
						$resp=[[
								"id"=> "3",
								"admin_add_id"=> "1",
								"date_created"=> "2022-10-13 21:03:27",
								"time_stamp"=> "2022-10-14 01:58:58",
								"sender"=> "1",
								"receiver"=> "3",
								"text"=> l("Welcome to Queen & Queens chat!<>أهلاً وسهلاً في محادثة كوين اند كوينز!"),
								"photo"=>'',
								"seen"=> "1",
								'time'=>l('Now<>الآن'),
								]];
							}
					}
					json(true,1,$resp);
				break;
//		
//		
				case'publicProfile':
					$resp=publisher(e('id'));
					json(true,1,$resp);
				break;
		}
		
		json();
		break;
		
		
		

 
        case'notifications':
            $_POST['user']=$user_id;
            $_m='psn_1627841195';

            switch($_POST['sub']){
//                case'add':
//                    co($_m);
//                    r($_m,'add');
//                break;

//                case'delete':
//                    mysqli_query($conn,"UPDATE $_m SET deleted=1 WHERE id='".e('id')."' AND user=$user_id LIMIT 1");
//                break;

                case'list':
                    $resp=db($_m,"WHERE !deleted AND ((module_prefix=".mid($_users)." AND user=$user_id) OR module_prefix='')",NULL,$limit);
					if($resp!=1){
						foreach($resp as &$r){
							$r['title']=l($r['title']);
							$r['message']=l($r['message']);
							$r['extra']=json_decode($r['extra'],true);
							
							if($r['module_prefix']==0){
								$tmp=db('seen_8331',"WHERE !deleted AND user_module='".mid($_users)."' AND user=$user_id AND module_prefix='".mid('psn_1627841195')."' AND related_id={$r['id']}",NULL,'LIMIT 1');
								if($tmp==1)
									$r['seen']=false;
								else
									$r['seen']=true;
							}
							
							$cleaned=cleanDate($r['date_created']);
							if($today==$cleaned){
								$r['time']=date('h:i a',strtotime($r['date_created'])).'  '.elapse($r['date_created']);
							}else{
								$r['time']=cleanDate($r['date_created']);
							}
							
						}
                    }
                    json(true,1,$resp,NULL,['badge_count'=>badgeCount($user_id,$_users)]);
                break;

                case'seen':
//					mark($_POST);
					#!users also mark public push notifications
                    $id=e('id');
					$tmp=db($_m,"WHERE id=$id");
                    if($tmp==1)json(true,1);
					
					if($tmp[0]['user']==$user_id){
						$_POST['seen']=1;
						co($_m,$id);
						r($_m,'edit');
					}elseif($tmp['module_prefix']==0){
						$tmp=db('seen_8331',"WHERE !deleted AND user_module='".mid($_users)."' AND user=$user_id AND module_prefix='".mid('psn_1627841195')."' AND related_id=$id",NULL,'LIMIT 1');
						if($tmp==1){
							$_POST=[];
							$_POST['user']=$user_id;
							$_POST['user_module']=mid($_users);
							$_POST['module_prefix']=mid('psn_1627841195');
							$_POST['related_id']=$id;
							r('seen_8331');
						}
					}
					
//					psn(NULL,NULL,[$user_id,$_users],NULL,false,true);
                break;
            }
        json();
        break;
        

		
		

		
		
	default:json(false);
}


function publisher($id){
	global $_users,$_config,$_adminUsers;
	$user=db($_users,"WHERE id='$id'",NULL,'LIMIT 1','photo,id,first_name,last_name,username')[0];
	if($user['photo']=='')$user['photo']=$_config['default_profile_picture'];
	$user=fc($user,array('photo'));
	$user['normalName']=$user['first_name']==''?$user['username']:$user['first_name'].' '.$user['last_name'];
//	if($user['company']=='')
		$user['name']=$user['normalName'];
//	else 
//		$user['name']=$user['company'];
	
	if(in_array($id,$_adminUsers)){
//		$user['name'].=' - Admin';
		$user['is_admin']=true;
	}
	
	return $user;
}
