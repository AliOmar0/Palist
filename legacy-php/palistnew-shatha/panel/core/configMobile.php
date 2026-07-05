<?php
//ProVision
if(file_exists(__DIR__.'/../../comp/vendor/autoload.php'))
	require __DIR__.'/../../comp/vendor/autoload.php';
use Google\Client;
	

function players($user_id,$module_prefix){
	$playerz=db('tokens',"WHERE user_id='$user_id' AND module_prefix='$module_prefix' AND !deleted AND player_id!=''",NULL,NULL,'player_id,language');
//	if($playerz==1)return NULL;
	//if($playerz==0 || $playerz==1)return;
	$players=array();
	$languages=array();
	if($playerz!=1){
		for($i=0;$i<count($playerz);$i++){
			$players[]=$playerz[$i]['player_id']; 
			$languages[]=$playerz[$i]['language']; 
		}
	}

	
	return ['player_ids'=>$players,'languages'=>$languages];
}


//send push
function getAccessToken() {
    $client = new Client();
    $client->setAuthConfig(cd.'custom_files/custom_private/'.connection('firebase_file_name'));
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->useApplicationDefaultCredentials();
    $token = $client->fetchAccessTokenWithAssertion();
    // m($token);
    return $token['access_token'];
}
        
        
/**
 * In order to use PSN with FCM, you need to do these steps:
 * 1. Open SSH, go to /home/accountname/public_html/
 * 2. Create folder named: comp, command: mkdir comp
 * 3. command: cd comp
 * 4. command: composer require google/apiclient
 * 5. Go to firebase project, Project Settings>Service accounts>Generate new private key
 * 6. Uplaod the file to custom/custom_files/custom_private/
 * 7. In connections module, write the full filename including extension in the "Firebase File Name", for example: xxx_xxxx.json, click save
 * 8. Make sure the cloud messaging is enabled in firebase>project settings>cloud messaging
 * 9. Thats it, enjoy complexity of Google!
 * IMPORTANT NOTE:
 * by default, the custom_private folder is banned to be accessed by anyone except the server itself, its blocked by .htaccess INSIDE custom_private folder
 */
function psn($title,$msg,$players_array=NULL,$data=NULL,$record=true,$silent=false){
	global $langArr;
	
	if(function_exists('badgeCount') && $players_array!=NULL){
		$badge=badgeCount($players_array[0],$players_array[1])+($record?1:0);
	}else
		$badge=0;
	
	
	
	$msgs=[];
	$msg=cs($msg);
	$title=cs($title);
	
	#OneSignal //no longer maintain
	if(connection('onesignal_app_id')!=''){
		$url="https://onesignal.com/api/v1/notifications";
		$app_id=connection('onesignal_app_id');
		$secret=connection('onesignal_app_secret_key');
		$auth="Authorization: Basic ".$secret;
		
		if($players_array!=NULL){
			$players=players($players_array[0],$players_array[1]);
			if(empty($players['player_ids']))return false;
			foreach($players['player_ids'] as $key=>$p){
				$lang_prefix=langFromID($players['languages'][$key])['prefix'];
				$msgs[]=array(
					'app_id' => $app_id,
					'include_player_ids'=>[$p],
					'data' =>$data, 
					'contents' =>array($lang_prefix=>l($msg,$lang_prefix)),
					'headings' =>array($lang_prefix=>l($title,$lang_prefix))
				);
			}
		}else{
			$msgs[]=array( 
				'app_id' => $app_id,
				'included_segments'=>["Active Users", "Inactive Users"],
				'data' =>$data, 
				'contents' => array('ar'=>l($msg,'ar'),'en'=>l($msg,'en')),
				'headings' =>array('ar'=>l($title,'ar'),'en'=>l($title,'en'))
			);
		}
	
	#FCM
	}else if(connection('firebase_file_name')!=''){
		// d('hi');
		// return;
		$tmp=json_decode(file_get_contents(cd.'custom_files/custom_private/'.connection('firebase_file_name')),true);
		// m($tmp);
		$url="https://fcm.googleapis.com/v1/projects/".$tmp['project_id']."/messages:send";

		$auth="Authorization: Bearer ".getAccessToken();
		
		if($players_array!=NULL){
			$players=players($players_array[0],$players_array[1]);
			if(empty($players['player_ids']))return false;
			foreach($players['player_ids'] as $key=>$p){
				$lang_prefix=langFromID($players['languages'][$key])['prefix'];
                
				$msgs[]=[
                    'message'=>[
                        'token'=>$p,
                        'notification'=>array(
                            'title'=> l($title,$lang_prefix),
                            'body'=> l($msg,$lang_prefix),
                            
                            // 'badge'=>$badge
                            ),
                        'data'=>[
							'subdata'=>json_encode($data)
						],
                        // 'android'=>[
                        //     'notification'=>[
                        //         // 'sound'=>'notification.mp3',
                        //         // 'title'=> l($title,$lang_prefix),
                        //         // 'body'=> l($msg,$lang_prefix),
                        //     ]
                        // ]
                    ]
                ];
			}
		}else{
			foreach($langArr as $l){
				if(l($title,$l['prefix'])=='')continue;
				$msgs[]=[
						'message'=>[
							"topic"=> $l['prefix'],
							'notification'=>array(
									'title'=> l($title,$l['prefix']),
									'body'=> l($msg,$l['prefix']),
									// 'sound'=>'notification.mp3'
							),
							'data'=>[
								'subdata'=>json_encode($data)
							],
						]
				];
			}
		}
		
	}else return false;
	
		
	
	if($record){
		$tmp=$_POST;
		$_POST['user']=$players_array==NULL?0:$players_array[0];
		$_POST['module_prefix']=$players_array==NULL?0:mid($players_array[1]);
		$_POST['title']=$title;
		$_POST['message']=$msg;
		$_POST['extra']=$data==NULL?'':json_encode($data);
		$last_psn_id=r('psn_1627841195');
		$_POST=$tmp;
		
//		d('bye');
	}
	
//	dd();
	
	if(!empty($msgs)){
		for($i=0;$i<count($msgs);$i++){
			if($record){
				if($data==NULL){
                    if(connection('firebase_file_name')!= ''){}
					    // $msgs[$i]['message']['data']=['psn_id'=>$last_psn_id];
                    else
                        $msgs[$i]['data']=['psn_id'=>$last_psn_id];
				}else if(isset($msgs[$i]['data']) && is_array($msgs[$i]['data'])){
                    if(connection('firebase_file_name')!= ''){}
                        // $msgs[$i]['message']['data']=array_merge($msgs[$i]['data'],['psn_id'=>$last_psn_id]);
                    else
                        $msgs[$i]['data']=array_merge($msgs[$i]['data'],['psn_id'=>$last_psn_id]);
                }	
			}
//			if(!$record && $players_array!=NULL){
//				$msgs[$i]['notification']['badge']=badgeCount($players_array[0],$players_array[1]);
//			}
			
			$fields = json_encode($msgs[$i]);		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type: application/json; charset=utf-8",
				$auth
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			curl_close($ch);
			// m($msgs[$i]);
			// m($response);
			
			if(isset(json_decode($response)->errors))return false;
			else {
//				return true;
				// d($response);
			}
//			dd();
		}//for
	}//if !empty msgs
	
}

function htmll($content){
	return html(l($content));
}

function h($content){
	$css="<style>
	body,html{font-family:verdana;margin:0;padding:0;max-width:100vw;height:100vh;}
	img{max-width:100%;}
	p{padding:10px;}
    #content{padding:15px;}
	* {
    -webkit-overflow-scrolling: touch;
}
	</style>
	";
	$header="<!doctype html>
<html>
<head>
	<BASE href=\"".url."\">
	<meta charset=\"UTF-8\"/>
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
	$css
	</head>
	<body>
	";
	$footer="</body></html>";
	
	return $header.'<content id="content">'.l($content).'</content>'.$footer;
	
	
}
function html($content){

	$resp=db('fonts_1582219344');
	$txt=NULL;
	if($resp!=1){
	foreach($resp as $elem){
		$txt.="
@font-face {
    font-family: '".$elem['css_name']."';
	font-display:swap;
	src:
        local('".$elem['css_name']."'),
		url(".u.$elem['file'].") format('".fontFormat($elem['file'])."');
}
";
	}
		}

	$header="
	<!doctype html>
<html>
<head>
	<BASE href=\"".url."\">
	<meta charset=\"UTF-8\"/>
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
	</head>
	<body>
	";
	$footer="</body></html>";
	$css="<style>
	body,html{margin:0;padding:0;max-width:100vw;height:100vh;}
	img{max-width:100%;}
	p{padding:10px;}
    #content{padding:15px;}
	* {
    -webkit-overflow-scrolling: touch;
}
".file_get_contents(pres_dir.'css/mce.css').$txt."

	</style>
	";
	return $header.'<div id="content" class="mce">'.l($content).'</div>'.$css.$footer;
}

function map($content){
	$header="
	<!doctype html>
<html>
<head>
	<BASE href=\"".url."\">
	<meta charset=\"UTF-8\"/>
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    
	</head>
	<body>
	";
	$footer="</body></html>";
	$css="<style>
	/*html{direction:rtl;}*/
	html,body{margin:0;padding:0;}
	body,html{max-width:100vw;height:100vh;}
	* {
    -webkit-overflow-scrolling: touch;
}
iframe{width:100%;height:100%}

	</style>
	";
	return $header.$content.$css.$footer;
}
