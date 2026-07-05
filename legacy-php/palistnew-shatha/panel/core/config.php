<?php
header('Content-type: text/html; charset=utf-8');

//db connect
require 'conn.php';
dbs("SET sql_mode = ''");

// mysqli_close($conn);

// try{
// 	$conn=new PDO(
// 		"mysql:
// 		host='localhost';
// 		dbname=".$dbName, 
// 		$dbUser,
// 		$dbPassword 
// 	);
// 	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// }
// catch(PDOException $e){
// 	m("Connection failed: ".$credentials['database'].' : '.$e->getMessage());
// 	die('DB connection failed! [db='.$credentials['database'].']');
// }



// Check connection
if (!$conn) json(false,9);
//define legion version
define("main_version",'4');
define("sub_version",'0');
define("version",main_version.'.'.sub_version);

require 'legion.php';
require 'classes/DB.php';
require 'configPanel.php';
require 'configMobile.php';
require 'configWeb.php';
require 'configFiles.php';

session_begin();


//mysqli_query($conn,"SET GLOBAL event_scheduler = ON");
mysqli_set_charset($conn,db('settings',"WHERE id=1",NULL,"LIMIT 1")[0]['charset']);

$settings=db('settings',"WHERE id=1",NULL,"LIMIT 1")[0];

// set the default timezone to use
date_default_timezone_set($settings['timezone']);


$admin_add_id=isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
$date_created=$date_modified=date("Y-m-d H:i:s");



//proccess string arrays to arrays in settigns
$settings['photo']=explode(",",$settings['photo']);
$settings['file']=explode(",",$settings['file']);




//language array one query
$langArr=db('languages_1557157519',NULL,"ORDER BY id ASC",NULL,'id,title,direction,prefix,language_name,active');



function connection($field){
	return db('connections_1565698558',"WHERE id=1",NULL,"LIMIT 1",$field)[0][$field];
}

// USER Auth [Start]
//======================================================================

//-----------------------------------------------------
//  keys
//-----------------------------------------------------
define('cpanel_folder',$settings['cpanel_folder']);
define('is_replit', getenv('REPL_ID')!==false || getenv('REPLIT_DEV_DOMAIN')!==false);
// Local dev (e.g. `php -S ... router.php` on Windows/macOS/Linux) serves the app
// from the project root with root-relative URLs, exactly like the Replit setup.
// LEGION_LOCAL opts into that same web-root behavior instead of the cPanel layout.
define('is_local', getenv('LEGION_LOCAL')!==false);
define('is_webroot', is_replit || is_local);
if(is_webroot){
        // Served from the project/workspace root, not a cPanel
        // /home/<user>/public_html/<folder> layout. Compute the filesystem
        // paths from this file's actual location and serve at the web root.
        define('cms_folder','');
        define('root',str_replace('\\','/',dirname(__DIR__,2)).'/');
        define('public_html',root);
}elseif(PHP_OS_FAMILY=='Windows'){
        define('cms_folder',basename(dirname(__DIR__,2)).'/');
        define('root',str_replace('\\','/',dirname(__DIR__,3)).'/');
        define('public_html',root);
}else{
        define('cms_folder',$settings['cms_folder']);
        define('root','/home/'.cpanel_folder.'/');
        define('public_html',root.'public_html/');#modify
}

if(is_webroot){
        // Behind a proxy / local server the public host is provided per-request;
        // derive URLs from it so links work in preview, deployment and locally.
        define('http_protocol', is_local ? 'http://' : 'https://');
        define('main_url',isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:(getenv('REPLIT_DEV_DOMAIN')?:$settings['main_url']));
}else{
        define('http_protocol',($settings['http']==0 ? "http://": "https://"));
        define('main_url',($settings['www']==0?NULL:'www.').$settings['main_url']);
}
define('panelFolderName','panel/');
define('cms_url',($settings['cms_folder']==''?main_url:main_url.'/'.$settings['cms_folder']));
//-----------------------------------------------------
//  DIRS
//-----------------------------------------------------
//define cms dir
define('cms_dir',public_html.cms_folder);

//define panel dir
define("panel_dir",cms_dir.panelFolderName);

//define custom dir
define("custom_dir",panel_dir.'custom/');
define("cd",panel_dir.'custom/');

define("custom_links_dir",panel_dir.'custom/custom_links/');
define("cld",panel_dir.'custom/custom_links/');

//define modules dir
define("modules_dir",panel_dir.'modules/');

//define  uploads dir
define("target_dir",cms_dir.'uploads/');
define("_protected",cms_dir.'uploads/protected/');
define("u_dir",cms_dir.'uploads/');

//define error dir
// define("error_log_path",$settings['custom_errorlog_path']==NULL?'/home/'.cpanel_folder.'/logs/':$settings['custom_errorlog_path']);
define("error_log_path",$settings['custom_errorlog_path']==NULL?(cms_folder==''?root:cms_dir):root.$settings['custom_errorlog_path']);

// define("error_log_path",root);


//define core dir
define("core_dir",panel_dir.'core/');

//define where to backup  DIR
define("backup_dir",cms_dir.'backups/');

//define where to resources  DIR
define("res_dir",cms_dir.'res/');

//define where to front resources  DIR
define("fres_dir",res_dir.'front/');

//define where to panel resources  DIR
define("pres_dir",res_dir.'back/');

//define mailer.php
define("mailer",panel_dir.'mailer.php');

define('nicetable',cms_dir.'plugins/nicetable.php');

define('imagine',cms_dir.'plugins/imagine.php');

define('comments',cms_dir.'plugins/comments.php');

//-----------------------------------------------------
//  URLS
//-----------------------------------------------------
//base url
// On Replit the screenshot/preview browser may load the page from a different
// origin than the public dev domain, so absolute asset URLs become unreachable.
// Emit root-relative URLs (empty base) so every asset/link resolves against the
// origin that actually served the page, in both preview and deployment.
define("urlBase",is_webroot?"":http_protocol.main_url);

//define url
define("url",urlBase.'/'.cms_folder);

//define viewable for user url
define("uploads_link",url.'uploads/');
define("u",url.'uploads/');
define("d",url.'legion_download.php?file=');

//define Panel url
define("urlPanel",url.panelFolderName);

//define modules URL
define("modules_url",urlPanel.'modules/');

//define where to backup folder URL
define("backup_url",url.'backups/');

//define custom URL
define("custom_url",urlPanel.'custom/');
define("c",urlPanel.'custom/');

//define custom link URL
define("custom_links",custom_url.'custom_links/');
define("cl",custom_links);

//define where to resources URL
define("res",url.'res/');

//define where to front resources URL
define("fres",res.'front/');

//define where to panel resources URL
define("pres",res.'back/');


//-----------------------------------------------------
//  Others
//-----------------------------------------------------
// define author for SEO
define("author",$settings['author']);


//define Secret Key for Login
define("secret_key",'bahaGotInvolvedInShitBcozHedidntlistentoOmar7times'.$settings['site_name']);
//echo secret_key;
//rights text
define('rights_txt',"
ProVision Co.
-------------
This web application design and development by ProVision Co.

All source files, presentable or core, graphics and layout are owned/controlled by ProVision, and no one, entity or individual, can use/modify/destribute at anytime or to anywhere without a written approval from ProVision.

This website/web app is based on LegionCMS engine, which is a MVC platform built completely from scratch by ProVision's team.

-We know that you like this code, if you are interested joining our team, dont hesitate sending your CV to us.
--------------
Omar Shamali
https://provision.ps
");


//infile rights
define("rights","<!--".rights_txt."-->");
//======================================================================
// Keys [End]



if(logged()){
//one timer userinfo
$userInfoArr=userInfo();
$__admiSettings=$__adminSettings=o('admin_settings',$_SESSION['user_id'],'admin')[0];
}

	

$didCheckSuperAdmin=false;
$isSuperAdmin=false;
function super(){
        global $isSuperAdmin,$didCheckSuperAdmin;
        if($didCheckSuperAdmin!=NULL)return $isSuperAdmin;
        
        global $userInfoArr;
        
        if(isset($userInfoArr['restricted']) && $userInfoArr['restricted']=='1'){
                $isSuperAdmin=true;
                $didCheckSuperAdmin=true;
                return true;
        }
        
        $didCheckSuperAdmin=true;
        $isSuperAdmin=false;
        return false;
}

//legacy
function superAdmin(){
        return super();
}



//get fronts language values, for translation usage on frontend
//$fronts=array();
//function f($key,$echo=false){
//      global $fronts;
//    if(empty($fronts)){
//       $resp=db('front_language_1504458842'); 
//              if($resp!=1){
//                for($i=0;$i<count($resp);$i++){
//                        $fronts[$resp[$i]['front_key']]=$resp[$i]['front_value'];
//                      }
//        }
//              }
//      
//      if(!isset($fronts[$key]))return NULL;
//      
//     if($echo)echo l($fronts[$key]);
//        else return l($fronts[$key]);
//
//}

// Module Functions [Start]
//======================================================================

//-----------------------------------------------------
//  Entry logger
//-----------------------------------------------------

function el($entry_module,$entry_id=NULL,$action='unknown',$remark=''){
	global $conn,$admin_add_id,$date_created,$date_modified;
	if(file_exists(modules_dir.'entries_log_8503/models/add.php')){
		$__tmp=$_POST;
		$_POST=[
			'entry_module'=>mid($entry_module),
			'entry_id'=>$entry_id==NULL?0:$entry_id,
			'user_module'=>$_SESSION['module_id'],
			'user_id'=>$_SESSION['user_id'],
			'action'=>$action,
			'remark'=>$remark
		];
		// r('entries_log_8503');
		$_POST['internal']=true;
		co('entries_log_8503');
		include modules_dir.'entries_log_8503/models/add.php';
		$_POST=$__tmp;
	}
}


//-----------------------------------------------------
//  Delete
//-----------------------------------------------------
function delete($module_prefix,$boolean=false){
        if(!privilege($module_prefix,'delete'))die('No permission to delete.');
        global $conn,$settings,$langArr;
        #validate we have an id
        $id=check_get_id('post');
        #extra validation some cant delete
        if(detail($module_prefix,'restricted','id',$id) && !super())json(false,10);

        switch($module_prefix){
                case 'admins':
                        //clean all
                        mysqli_query($conn,"DELETE FROM privileges_1565709771 WHERE user_id='$id'");
                break;

                case'fonts_1582219344':
                        fonts();
                break;

                case'link_handler_1566934564':
                        $_POST['internal']=true;
                        require modules_dir.'settings/models/reset_htaccess.php';
                break;

                case'color_palette_1645099749':
                        $_POST['internal']=true;
                        require modules_dir.'settings/models/reset_ui.php';
                break;

        
                        #files_1577206823 already deletes similar files in floodTrash
                        
                default:
                        break;
        }

        #redirect and execute
        if(!mysqli_query($conn,"UPDATE $module_prefix SET deleted='1' WHERE id='$id' LIMIT 1"))
        {
                if($boolean)return false;
                json(false,3);
        }
        else{
                el($module_prefix,$id,'delete');
                if($boolean)return true;
                json(true,4,NULL,NULL,array('url'=>urlPanel.'?module='.$module_prefix."&action=list",'js'=>'redirect'));
                }
}


function del($module,$id){
        dbs("UPDATE $module SET deleted=1 WHERE id=$id LIMIT 1");
}

function restore($module,$id){
        $res=dbs("UPDATE ".escape($module)." SET deleted=0 WHERE id=".escape($id)." LIMIT 1");
        if($res==0)return false;
        else {
                el($module,$id,'restore');
                return true;
        }
}

//======================================================================
// Module Functions [End]

function r($module_prefix,$action='add',$internal=true){
        global $conn,$admin_add_id,$date_created,$settings,$date_modified;
        if($internal)$_POST['internal']=true;
//      if($action=='edit')$_POST['id']=$_POST['']
        require modules_dir.$module_prefix.'/models/'.$action.'.php';
        if($action=='add')return $last_id;
        elseif($action=='edit' && i('id'))return $_POST['id'];
}



function i($key){return isset($_POST[$key]);}
function g($key){return isset($_GET[$key]);}


function v($module_prefix,$action='add',$form=true){
        require modules_dir.$module_prefix.'/views/'.$action.(!$form?'NoForm':NULL).'.php';
}



function j($js_function='refresh',$error_code=1,$response=true){
        return json($response,$error_code,NULL,NULL,array('js'=>$js_function));
}

function jx($extra,$error_code=2,$response=true){
        return json($response,$error_code,NULL,NULL,$extra);
}

function jr($url=url){
        return json(true,1,NULL,NULL,array('js'=>'redirect','url'=>$url));
}

function lead(){
        $_POST['user']=$_SESSION['user_id'];
}

//json data,params only
function jd($data=NULL,$extra=NULL){
        return json(true,1,$data,NULL,$extra);
}


function json($response=true,$error_code=1,$data=NULL,$custom_error_desc=NULL,$extra=NULL,$return=false){
        global $conn,$settings,$last_id;
        
        $resp=array();
        if(mysqli_errno($conn)==1062){
                // mark(mysqli_error($conn));
                $error_code=68;
                preg_match_all("/('[^'\\\\]*(?:\\\\.[^'\\\\]*)*')/", mysqli_error($conn),$token);
                if(isset($token[0][1])){
                        $field=str_replace("'",'',$token[0][1]);
                        $tmp=o('module_fields',$field,'field_name');
                        if($tmp!=1){
                                $custom_error_desc=l($tmp[0]['label']).' '.l('already exists<>موجود، لا يمكن التكرار');
                        }
                }
        }

        if(isset($_POST['internal']) && $_POST['internal']==true && $response==true){
                unset($_POST['internal']);
                $_POST['global']=array('response'=>$response,'error_code'=>$error_code,'data'=>$data,'custom_error_desc'=>$custom_error_desc,'additional'=>isset($additional)?$additional:NULL);
                return true;
        }


        if(isset($_POST['_d']) && isset($_POST['_a'])){
                $_app=o('apps_1552305519',e('_a'));
                if($_app!=1){
                        $_app=$_app[0];
                        if($_POST['_d']==3){
                                if($_POST['_v']<$_app['android_version']){
                                        $resp['_update']=true;
                                        $resp['_update_title']=l('App Update is Required<>يجب تحديث التطبيق');
                                        $resp['_update_subtitle']=l('Update via play store<>حدث من خلال متجر بلاي');
                                        $resp['_update_btn']=l('Update<>حدّث');
                                        $resp['_store_update_link']='market://details?id='.$_app['android_store_id'];
                                        $resp['_store_id']=$_app['android_store_id'];
                                        }
                                }
                        elseif($_POST['_d']==2){
                                if($_POST['_v']<$_app['apple_version']){
                                        $resp['_update']=true;
                                        $resp['_update_title']=l('App Update is Required<>يجب تحديث التطبيق');
                                        $resp['_update_subtitle']=l('Update via app store<>حدث من خلال متجر ابل');
                                        $resp['_update_btn']=l('Update<>حدّث');
//                                      $resp['_store_update_link']='itms-apps://itunes.apple.com/app/'.$_app['apple_store_id'];
                                        $resp['_store_id']=$_app['apple_store_id'];
                                        }
                                }
                }
        }




        $resp['response']= $response;
        $resp['code']=$error_code;

        if($error_code!=1){
                if($error_code==1000){
                        $resp['_logout']=true;
                        $resp['desc']=l('Your session has ended<>تم انهاء فترة الدخول');
                        $resp['alert_icon']='Warning';
                }else{
                        $error=db('error_1528374155',"WHERE id='$error_code' AND deleted='0'",NULL,'LIMIT 1','error_desc,die,icon');
                        if($error!=1){
                                $resp['desc']=$custom_error_desc==NULL?l($error[0]['error_desc']):$custom_error_desc;
                                if($error[0]['die']==1)$resp['die']=true;
                                if($error[0]['icon']!='' && $error[0]['icon']!='Logo')$resp['alert_icon']=$error[0]['icon'];
                        }
                }
        }

        if($data!=NULL)$resp['data']=$data;

        
        if($extra!=NULL && !isset($_POST['noAdditionalJSON']))$resp['extra']=$extra;
        if(isset($_POST['force_refresh']) && $response!=false)$resp['extra']=array('js'=>'refresh');
        if(isset($_POST['force_redirect']) && $response==true){
                $_POST['force_redirect']=str_replace('last_id',$last_id,$_POST['force_redirect']);
                $resp['extra']=array('js'=>'redirect','url'=>$_POST['force_redirect']);
        }
        if(isset($_POST['force_unredirect']) && $response==true)unset($resp['extra']);

        if(isset($_POST['js'])){
                
                if(!isset($resp['extra']))
                        $resp['extra']=array();
                
                ## no real usage for additional_arr
                
                $resp['extra']['js']=$_POST['js'];
                if(isset($_POST['last_id']))$resp['extra']['last_id']=$last_id;
                if(isset($_POST['x'])){
                        foreach ($_POST['x'] as $key => $value) {
                                $resp['extra'][$key]=$value;
                        }
                }

        }


//      if(isset($_POST['blockremover']))$resp['extra']=array('js'=>'blockremover','blockremover'=>$_POST['blockremover']);
        if($settings['debug']==true){
                $resp['debug']=['post'=>$_POST,'mysql_error_code'=>mysqli_errno($conn),'mysql_erro_desc'=>mysqli_error($conn),'session'=>$_SESSION];
        }

        if($return)
                return json_encode($resp);
        
        die(json_encode($resp));
}

function escape($para){
        global $conn;
        return  isset($para)?mysqli_real_escape_string($conn,$para):NULL;
}

function e($para){
        global $conn;
        return isset($_POST[$para])?mysqli_real_escape_string($conn,$_POST[$para]):NULL;
}

function eg($para){
        global $conn;
        return isset($_GET[$para])?mysqli_real_escape_string($conn,$_GET[$para]):NULL;
}


function privilege($module,$privilege=NULL,$user_id=NULL,$forEditAdmin=false){
    global $settings;
//      return true;
        global $passOnce;
        if($passOnce==true)return true;
        
        if($module=='menu_items_1564508835')$module='menu_1564508145';

        #if super admin
        if(!logged())die('Your session has expired, login again');
        if(super() && $forEditAdmin==false)return true;
        if($module=='admins' && $privilege=='edit' && (isset($_POST['id']) && $_SESSION['user_id']==$_POST['id']))return true;
    
    
         if($settings['custom_system'])
     {
         $permit=groupPermit($module);
    if($permit['group']==true)return $permit['response'];
     }

        if($user_id==NULL)$user_id=$_SESSION['user_id'];//json(false,3);
        if($privilege!=NULL)$privilege=" AND type_name='$privilege'";
        if($privilege=='delete') return false;
        if(gc('privileges_1565709771',"WHERE module_name='$module' $privilege AND user_id='$user_id'")>0)return true;
        return false;

}

function priv($module,$privilege=NULL,$user_id=NULL){
        if(super() || db('privileges_1565709771',"WHERE module_name='$module' AND type_name='$privilege' AND user_id='$user_id'")!=1)return true;
        return false;
}


function groupPermit($module){
    global $userPermissionArray;
    if(in_array($module,$userPermissionArray))
        return array('group'=>true,'response'=>true);

    else return array('group'=>false);
}


function user_id(){
        if(logged())return $_SESSION['user_id'];
        if(isset($_POST['user_token']))$_POST['_t']=$_POST['user_token'];//legacy
        if(isset($_POST['_t']) && $_POST['_t']!='0'){
                $resp=db('tokens',"WHERE token='".e('_t')."' AND !deleted",NULL,"LIMIT 1");
                if($resp==0 || $resp==1)json(false,1000);
                else {
                        $_SESSION['user_id']=$resp[0]['user_id'];
                        $_SESSION['module_id']=mid($resp[0]['module_prefix']);
                        return $resp[0]['user_id'];
                }
        }

        return 0;
}

function uid(){
        if(isset($_POST['user_token']) && $_POST['user_token']!='0'){
                $resp=db('tokens',"WHERE token='".e('user_token')."'",NULL,"LIMIT 1");

                if($resp==0 || $resp==1 || db($resp[0]['module_prefix'],"WHERE id='".$resp[0]['user_id']."'",NULL,'LIMIT 1')==1)return 0;
                else return $resp[0]['user_id'];
        }

return 0;
}


//user will never get a link from protected_hasher if he is not privileged to, because, in every API, you test the login and what user can access, so generating a hash and a link is not itself the security, the security occurs before calling this function. That is theoritically, but practicly there is security checks and more cusotmization can go inside can_download_protected() u create in custom_config
function protected_hasher($original_file_name,$requested_file_version=NULL,$user_id=NULL,$user_module=NULL,$device=NULL,$version=NULL){
        // if($requested_file_version==NULL)
        //      return d.$original_file_name;
        // else
        //      return d.$requested_file_version;

        $ip=$_SERVER['REMOTE_ADDR'];

        if($original_file_name==NULL)return NULL;
        
        if($user_id==NULL){
                if(!isset($_SESSION['user_id']))return NULL;
                $user_id=$_SESSION['user_id'];
                $user_module=$_SESSION['module_id'];
        }

        if($device==NULL){
                if(isset($_POST['_d']))
                        $device=$_POST['_d'];
                elseif(isset($_POST['device']))
                        $device=$_POST['device'];
        }
        
        if($version==NULL){
                if(isset($_POST['_v']))
                        $version=$_POST['_v'];
                elseif(isset($_POST['version']))
                        $version=$_POST['version'];
        }
        

        $hash=hash_hmac('sha256',$user_id.$user_module.$original_file_name.$device.$version.$ip,uniqid());
        
        $tmp=$_POST;
        $_POST=[
                'file_name'=>$original_file_name,
                'ip'=>$ip,
                'device'=>$device,
                'version'=>$version,
                'user'=>$user_id,
                'user_module'=>$user_module,
                'hash'=>$hash,
                'requested_file_version'=>$requested_file_version
        ];
        co('protected_files_hash_863024');
        r('protected_files_hash_863024');
        $_POST=$tmp;
        // return d.$hash.'&requested_file_version='.$requested_file_version;

        if($requested_file_version==NULL)
                return d.$original_file_name.'&h='.$hash;
        else
                return d.$requested_file_version.'&h='.$hash;
}

function protected_unhasher(){          

        if($_GET['file']!='' && $_GET['file']!=NULL && strpos($_GET['file'],'../')===false){
                $protected_file_hash=$_GET['file'];
                $x=explode('H',$protected_file_hash);
                if($x!=false){
                        if(count($x)==1){
                                $original_file_name=$x[0];
                        }elseif(count($x)>1){
                                $original_file_name=$x[1];
                        }
                        $y=explode('.',$original_file_name);
                        
                        if($y==false || count($y)>1){
                                $ext=$y[1];
                                $file=o('files_1577206823',$y[0],'name');
                                if($file!=1 && $file!=0){
                                        if(count($x)==1)
                                                $file[0]['_path']=_protected.$file[0]['full_name'];
                                        elseif(count($x)>1)
                                                $file[0]['_path']=_protected.$x[0].'H'.$file[0]['name'].'.'.$ext;

                                        #0 if admin
                                        if(logged())
                                                return $file[0];
                                        #1 if owner, go ahead
                                        if(isset($_SESSION['user_id']) && $_SESSION['module_id']){
                                                if($file[0]['uploader_user_id']==$_SESSION['user_id']){
                                                        if($file[0]['uploader_module_prefix']==$_SESSION['module_id']){
                                                                return $file[0];
                                                        }
                                                }
                                        }
                                        #2 if custom function approves
                                        if(function_exists('can_download_protected')){
                                                return can_download_protected($file[0]);
                                        }
                                }
                        }
                }
        }
        
        return false;
        // if($protected_file_hash==NULL)return false;
        // $protected_file_hash=escape($protected_file_hash);
        // $db=o('protected_files_hash_863024',$protected_file_hash,'hash');
        // if($db==1 || $db==0)return false;
        // if($db[0]['ip']!=$_SERVER['REMOTE_ADDR'])return false;
        // dbs('DELETE FROM protected_files_hash_863024 WHERE id='.$db[0]['id']);
        // return $db[0];
}



//function front_privilege($module){
//
//      global $original_edit_id,$allowed_seeker,$allowed_org,$clustering;
//
//      if($clustering===true)$clustering=false;return true;#safe bcoz cluster.php defines the id
//
//$account_details=db('accounts_1567783705',"WHERE id='".$_SESSION['user_id']."'",NULL,'LIMIT 1')[0];
//$account_module=detail('modules','module_prefix','id',$account_details['profile_module']);
//
//      if($account_details['profile_module']==359){
//      if(
//      in_array($module,$allowed_seeker)
//   && (($original_edit_id==$account_details['profile_id'] && $module=='seeker_profile_1567195370')
//         ||
//         (isset($_POST['seeker_profile']) && $_POST['seeker_profile']==$account_details['profile_id'])
//        )
//)return true;
//      }
//
//
//
//      else if($account_details['profile_module']==375){
//      if(
//      in_array($module,$allowed_org)
// //  && $original_edit_id==$account_details['profile_id']
//)return true;
//
//      }
//
//      return false;
//
//
//}




function returnUrl(){   
        global $module,$action,$last_id,$this_last_id;
        if($action=='add')$thisAction='edit';
        if($action=='floodTrash')$thisAction='list';
        if(isset($_POST['andNew']))return urlPanel.'?module='.$module.'&action=add';

        return urlPanel.'?module='.$module.(isset($thisAction)?'&action='.$thisAction:NULL).($this_last_id!=NULL?'&id='.$this_last_id:'&id='.$last_id);
}


//session start
function session_begin()
{

    if (!isset($_SESSION)){
        if(!@session_start())
                        @session_regenerate_id(false);
        }


}


function yt($resp,$field='youtube_link',$id=''){
        global $settings;
        #cleanLink
        $link=cleanYT($resp[$field]);
        
        #return
        return "<iframe id=\"$id\" title=\"".$settings['site_name']."\" width=\"100%\" height=\"100%\"  src=\"$link?rel=0&enablejsapi=1\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>";
}



function cleanYT($url) {
        if($url=='' || $url==NULL)return $url;
        parse_str( parse_url( $url,PHP_URL_QUERY ),$my_array_of_vars );
        return 'https://www.youtube.com/embed/'.$my_array_of_vars['v'];    
}

function slug($type,$slug,$lang=false){
        if($lang==true)$lang='/'.curr();
        else $lang="";
        return url.$type.'/'.urlencode($slug).$lang;
}

function yt_img($url){
        
        $video_id = explode("?v=",$url);
        $video_id = $video_id[1];
        return "http://img.youtube.com/vi/".$video_id."/maxresdefault.jpg";
        
}


function summery($text,$limit) {
        $words=preg_split('/\s+/',$text);
         $count=count(preg_split('/\s+/',$text));
      if ($count > $limit) {
                  $text=NULL;
          for($i=0;$i<$limit;$i++)
                          $text.=$words[$i].' ';
                  $text.='...';
      }
      return $text;
    }

function cleanDate($date,$format=NULL){
        try {
                $dt = new DateTime($date);
                } catch (Exception $e) {
                return $date;
        }
                if($format==NULL)$format='Y-m-d';
                return $dt->format($format);

}



function comp($mother,$mother_id,$child){
        $mother=mid($mother);
        $child=mid($child);
        $resp=db('complementary_1614118171',"WHERE mother_module_prefix='$mother' AND mother_id='$mother_id' AND child_module_prefix='$child'");
        return $resp;
}


function com($mother_module,$mother_id=NULL,$child_module=NULL,$child_id=NULL){
        $where=NULL;
        if($mother_id!=NULL)$where.=" AND mother_id='$mother_id'";
        if($child_module!=NULL)$where.=" AND child_module_prefix='".mid($child_module)."'";
        if($child_id!=NULL)$where.=" AND child_id='$child_id'";
        $resp=db('complementary_1614118171',"WHERE mother_module_prefix='".mid($mother_module)."' $where");
        return $resp;
}

function commer($resp,$module=NULL){
        if($resp==1 || $resp==NULL)return $resp;
        if($module==NULL){
                global $_m;
                if(!isset($_m) || $_m==NULL)return $resp;
                $module=$_m;
        }
        $fields=db('module_fields',"WHERE module_id='".mid($module)."'");
//      d($fields);
        if($fields!=1){
                foreach($fields as $f){
                        $x=explode(',',$f['select_field']);
//                      d($x);
                        if($f['type']=='password'){
                                foreach($resp as &$r){
                                        unset($r[$f['field_name']]);
                                }
                                continue;
                        }
                        elseif($f['type']=='select' && $f['sub_type']!='multi'){
                                foreach($resp as &$r){
                                        if(!isset($r[$f['field_name']]))continue;
                                        for($i=0;$i<count($x);$i++){
                                                if($x[$i]=='-')$sep=' '.$x[$i];
                                                else if(isset($x[$i-1]) && $x[$i-1]!='')$sep=' ';
                                                else $sep=NULL;
                                                if(!isset($r[$f['field_name'].'_value']))$r[$f['field_name'].'_value']=NULL;
                                                $r[$f['field_name'].'_value'].=$sep.l(detail($f['select_table'],$x[$i],'id',$r[$f['field_name']]));
                                        }
                                }
                        }
                        elseif($f['sub_type']=='multi'){
                                foreach($resp as &$r){
                                        if(!isset($r[$f['field_name']]))continue;
                                        $r['_'.$f['field_name']]=1;
                                        $tmp=com($module,$r['id'],$f['select_table']);
                                        $res=array();
                                        $r[$f['field_name']]=NULL;
                                        foreach($tmp as $t){
                                                $tmpa=o($f['select_table'],$t['child_id'],'id','id,'.$f['select_field'])[0];
                                                $tmpa[$f['select_field']]=l($tmpa[$f['select_field']]);
                                                $res[]=$tmpa;
                                                $r[$f['field_name']].=$tmpa[$f['select_field']].',';

                                        }
                                        $r['_'.$f['field_name']]=$res;
                                        $r[$f['field_name']]=rtrim($r[$f['field_name']],',');
                                }
                        }
                }
        }
        return $resp;
}
//function respComp(){
//      $tmp=comp($mother,$mother_id,$child);
//      if($tmp==1 || $tmp==0)return $tmp;
//      
//      foreach($tmp as $t);
//      
//}

function echoComp($comp,$module,$select='title'){       
        $str=NULL;
        if(isset($comp) && !empty($comp) && is_array($comp) && count($comp)>0){
                for($i=0;$i<count($comp);$i++){
                        if($i!=0)$str.= ',';
                        $str.= l(detail($module,$select,'id',$comp[$i]['child_id']));
                }
        }
        return $str;
}
                


//language////////////
//get current language
function curr(){
        global $settings,$langArr;

        if(isset($_GET['lang']))$lang=$_GET['lang'];
        else if(isset($_POST['lang']))$lang=$_POST['lang'];
        else $lang=NULL;

        //check if there is a lang
        
        if($lang!=NULL) return jsEscape(escape($lang));
        else if(logged() && strpos($_SERVER['REQUEST_URI'],panelFolderName) !== false){
                $key = array_search(userInfo()['language_id'],array_column($langArr,'id'));
                return $langArr[$key]['prefix'];
        }
    
        //if not in the link,get default lang
        elseif($_SERVER['REQUEST_URI'])
                {
                        
                        $curr_lang=explode('/',$_SERVER['REQUEST_URI']);
                        if($settings['cms_folder']==NULL)
                                $curr_lang=$curr_lang[1];
                        else
                                $curr_lang=$curr_lang[2];
                        
        

                        $key = array_search($curr_lang,array_column($langArr,'prefix'));

                        if($key!==false)
                                return $langArr[$key]['prefix'];
                }
        //else return default
        $key=array_search($settings["language"],array_column($langArr,'id'));
        return $langArr[$key]['prefix'];
}

function currid(){
        global $langArr;
        $key=array_search(curr(),array_column($langArr,'prefix'));
        return $langArr[$key]['id'];
}
function get_curr_language(){//legacy
        return curr();
}

$actual_link=http_protocol.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

// m($_SERVER['REQUEST_URI']);
$noLangLink=rtrim($actual_link,curr().'/');
        
//get current language direction
function get_lang_direction(){//legacy
        return direction();
}

function switch_link_lang($lang_prefix){
        global $settings;
        $txt=url;
        $uri=$_SERVER['REQUEST_URI'];
        $uri=ltrim($uri,'/');
        $uri=str_replace($settings['cms_folder'],'',$uri);
        if($uri!=NULL)
                $uri=str_replace(curr().'/','',$uri);
        
        

        $txt.=$lang_prefix."/".$uri;
        return $txt;
}

function direction(){
        global $langArr;
        $key=array_search(curr(),array_column($langArr,'prefix'));
        return $langArr[$key]['direction'];
}

function langFromID($id){
        global $langArr;
        $key=array_search($id,array_column($langArr,'id'));
        
        return $key==false?$langArr[0]:$langArr[$key];
}

function sl($multidata,$neededPrefix=NULL){
        if($multidata==NULL)return $multidata;
        return strip_tags(l($multidata,$neededPrefix));
}
//filter content based on language
function l($multidata,$neededPrefix=NULL,$returnDefaultIfEmpty=true){
        if($multidata==NULL)return $multidata;
        global $langArr;
        if($neededPrefix==NULL)$neededPrefix=curr();
        $multidata=explode('<>',$multidata);
        $lang_result=$langArr;
        //in case l applied on NOTlingual input, or if there is no <>, fresh data.
        if(count($multidata)<=1 && $neededPrefix==curr()){
                
                #! commented for testing, expected big issues
                // return $returnDefaultIfEmpty?$multidata[0]:NULL;
                return $multidata[0];
        }
        for($i=0;$i<count($lang_result);$i++){
//              d($neededPrefix);
                if($lang_result[$i]['prefix']==$neededPrefix){
                        if(isset($multidata[$i]) && $multidata[$i]!='')
                                return $multidata[$i];
                        
                        else {
                                
                                #! commented for testing purposes, as i dont know why i coded such line!
                                // else
                                if($returnDefaultIfEmpty && isset($multidata[$i+1]) && $multidata[$i+1]!='')return $multidata[$i+1];

                                if($returnDefaultIfEmpty)
                                        return $multidata[0];
                                
                                else return NULL;
                                
                        }
                }
        }
}

//language////////////

function id(){
        global $conn;
        if(!isset($_POST['id']))json(false);
        if($_POST['id']==0)json(false);
        return mysqli_real_escape_string($conn,$_POST['id']);
}

function check_get_id($method='get'){
        global $conn;
        if($method=='get'){
                if(!isset($_GET['id']) || $_GET['id']==NULL)die('Wrong ID');
                return mysqli_real_escape_string($conn,$_GET['id']);
        }
        else {
                if(!isset($_POST['id']) || $_POST['id']==NULL)json(false,12);
                return mysqli_real_escape_string($conn,$_POST['id']);
        }
}

function elapse($datetime,$full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = (array)$now->diff($ago);

    $diff['w'] = floor($diff['d'] / 7);
    $diff['d'] -= $diff['w'] * 7;

    $string = array(
        'y' => l('year<>سنة'),
        'm' => l('month<>شهر'),
        'w' => l('week<>اسبوع'),
        'd' => l('day<>يوم'),
        'h' => l('hour<>ساعة'),
        'i' => l('minute<>دقيقة'),
        's' => l('second<>ثانية')
    );
    foreach ($string as $k => &$v) {
        if ($diff[$k]) {
            $v = $diff[$k] . ' ' . $v . ($diff[$k] > 1 ? l('s<> ') : '');
        } else {
            unset($string[$k]);
        }
    }

    if(!$full)$string = array_slice($string,0,1);
    return $string?l(' <> منذ ').implode(', ',$string).(l(' ago<> ')):l('just now<>الان');
}

function rand_color(){
    return '#'.str_pad(dechex(mt_rand(0,0xFFFFFF)),6,'0',STR_PAD_LEFT);
}

//retreive from database
function one($module,$value,$fields='*'){
        return db($module,"WHERE deleted=0 AND id=$value",NULL,'LIMIT 1',$fields);
}

function oneSlug($module,$value,$fields='*'){
        return db($module,"WHERE deleted=0 AND slug='$value'",NULL,'LIMIT 1',$fields);
}

function o($module,$value,$key='id',$fields='*',$echoStatement=false){
        return db($module,"WHERE deleted=0 AND $key='$value'",NULL,'LIMIT 1',$fields,$echoStatement);
}

//All Where not deleted
function aw($module,$where=NULL,$fields='*'){
        $tmp=db($module,"WHERE deleted=0 ".($where==NULL?NULL:' AND '.$where),NULL,NULL,$fields);
        return $tmp;
}

//One Where not deleted
function ow($module,$where=NULL,$fields='*'){
        $tmp=db($module,"WHERE deleted=0 ".($where==NULL?NULL:' AND '.$where),NULL,'LIMIT 1',$fields);
        if($tmp==1)
                return 1;
        return $tmp[0];
}

function relative($module,$value,$key='id',$fields='*'){
        return db($module,"WHERE deleted=0 AND $key='$value'",NULL,NULL,$fields);
}

// $db_counter=0;
// $db_mods=[];
function db($from,$where=NULL,$order="id DESC",$limit=NULL,$fieldsToSelect="*",$echoStatement=false,$params=[]){
        // m($from);
        // m($where);
        // m($order);
        global $langArr;
        // ,$db_counter,$db_mods
        
        if($from=='languages_1557157519' && $where==NULL && isset($langArr))return $langArr;
        
        // $db_counter++;
        // if(!isset($db_mods[$from]))$db_mods[]=$from;

        $db=new DB($from);
        if($where!=NULL){
                $where=str_replace('where','',strtolower($where));
                $db->where=$where;
        }
        // if($order!=NULL){
                if($order==NULL)
                        $db->order='id DESC';
                else{
                $order=str_replace(['order by'],'',strtolower($order));
                // $order=str_replace('ORDER','',$order);
                // $order=str_replace('BY','',$order);
                // $order=str_replace('by','',$order);
                // d($order);
                // if($order!='')
                
                        $db->order=$order;
                }
                // m($db->order);
        // }
        // else{
        //      $db->order='id DESC';
        // }
        // m($db);
        $db->params=$params;
        $db->limit=$limit;
        $db->fields=$fieldsToSelect;
        $db->process();
        if($db->count>0)return $db->data;
        elseif($db->count==0)return 1;
        else return 0;
}

function dbs($statment){
        global $conn;
        $resp=array();
        try{
                $result=mysqli_query($conn,$statment);
                if($result==false)throw new Exception(mysqli_error($conn));
        }catch (Exception $e){
                mark($statment,'<div class="l_purple_c">MSQL Statement: </div>','<div class="l_mb3"></div>');
                mark($e->getMessage(),'<div class="l_lava_c">MSQL Error: </div>','<div class="l_mb3"></div>');
                // echo 'Error!';
                return 0;
        }

        if($result===false)return 0;
        else if(!isset($result->num_rows) || $result->num_rows<=0)return 1;
        else{
                while($row=mysqli_fetch_assoc($result)){$resp[]=$row;}
                return $resp;
                }
}

function dbl($from,$where=NULL,$order="ORDER BY id DESC",$limit=NULL,$fieldsToSelect="*"){
        return fl(db($from,$where,$order,$limit,$fieldsToSelect));
}

function rand_string($length=7){
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"),0,$length-1).rand(1,9);
}

function checkPassword($pwd){
    if(strlen($pwd)<7)json(false,17);
    if(!preg_match("#[0-9]+#",$pwd))json(false,18);
    if(!preg_match("#[a-zA-Z]+#",$pwd))json(false,19);
}

##must fix error numbers as they differ between websites
function checkUsername($username,$return=false){
        
//      if(!(bool)preg_match('/^[a-z\d_]{6,30}$/i',$username)){
        if(!(bool)preg_match('/^[\w]{6,30}$/i',$username)){
                if($return)return false;
                else json(false,99);
        }
        if($return)return true;
}

function whereStatement($whereArr){
        if(empty($whereArr))return NULL;
        else
        {
                $whereString="WHERE";
                for($i=0;$i<count($whereArr);$i++){
                        $whereString=$whereString." ".$whereArr[$i]['dbName']."='".$whereArr[$i]['value']."' &&";
                }
                return rtrim($whereString,'&&');
        }
}

function gc($tableName,$where=NULL){
        global $conn;
        $result=mysqli_query($conn,"SELECT COUNT(1) FROM $tableName $where");
        if($result===false)return 0;
        return (int)mysqli_fetch_assoc($result)["COUNT(1)"];
}

function getCount($tableName,$where=NULL){
        return gc($tableName,$where);
}

function sum($tableName,$where=NULL,$col=NULL){
        global $conn;
        $result=mysqli_query($conn,"SELECT SUM($col) FROM $tableName $where");
        if($result===false)return 0;
        $res=mysqli_fetch_assoc($result);
        if($res["SUM($col)"]==NULL)return 0;
        return $res["SUM($col)"];
}

//fix of hash_equals
if(!function_exists('hash_equals'))
{
    function hash_equals($str1,$str2)
    {
        if(strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}



function unescape($string) {
    $characters = array('x00','n','r','\\','\'','"','x1a');
    $o_chars = array("\x00","\n","\r","\\","'","\"","\x1a");
    for ($i = 0; $i < strlen($string); $i++) {
        if (substr($string,$i,1) == '\\') {
            foreach ($characters as $index => $char) {
                if ($i <= strlen($string) - strlen($char) && substr($string,$i + 1,strlen($char)) == $char) {
                    $string = substr_replace($string,$o_chars[$index],$i,strlen($char) + 1);
                    break;
                }
            }
        }
    }
    return $string;
}

//generates a token
function RandomToken($length = 32){
    if(!isset($length) || intval($length) <= 8 ){
      $length = 32;
    }
    if (function_exists('random_bytes')) {
        return bin2hex(random_bytes($length));
    }
    if (function_exists('mcrypt_create_iv')) {
        return bin2hex(mcrypt_create_iv($length,MCRYPT_DEV_URANDOM));
    }
    if (function_exists('openssl_random_pseudo_bytes')) {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}


function textLength($text,$min=25,$max=1000){
        if(strlen($text)<$min)
                json(false,3,NULL,l("Content must be at least $min characters<>المحتوى يجب ان يكون $min على الاٌقل"));
        
        if(strlen($text)>$max)
                json(false,3,NULL,l("Content must be maximum $max characters<>المحتوى يجب ان يكون $max على الأكثر"));
}


//get one field
function detail($table,$field,$key,$value){
        $key=escape($key);
        $value=escape($value);
    $resp=db($table,"WHERE $key='$value'",NULL,'LIMIT 1');
        if($resp==1)return NULL;
    // if($resp!=NULL && $resp!=1){
                $tmp=db($table,"WHERE $key='$value'",NULL,'LIMIT 1')[0];
                if(isset($tmp[$field]))return $tmp[$field];
        // }
        
    return NULL;
}


function api($fields=[],$version='1.0'){
        $arr=['_v'=>1000,'lang'=>curr(),'_d'=>1];
        $fields=array_merge($fields,$arr);
        return docurl(url.'api/'.$version.'/',$fields,true);
}

function docurl($link,$fields=NULL,$post=false,$fullresponse=true,$json=false,$headers=NULL){
//      d($fields);
        if($fields!=NULL)$fields=$json ? json_encode($fields) : http_build_query($fields);
        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$link.(!$post?'?'.$fields:NULL));
        if($json)curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json","charset:utf-8"));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_HEADER,FALSE);
        if($post)curl_setopt($ch,CURLOPT_POST,TRUE);
        else{
                curl_setopt($ch,CURLOPT_POST,FALSE);
                curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'GET');
                }
                
        if($post)
                curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);
//      else
//              curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        
//      d($fields);
        if($headers!=NULL)
                curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);

//      d(curl_getinfo($ch));
        $response = curl_exec($ch);
        curl_close($ch);
//      d($fields);
// m($response);
        
//      d($fields);
//      dd($response);

        if(!$response)return false;

        $response=json_decode($response,true);
        if($fullresponse)return $response;
        else {return true;}

}

function remaining($to=NULL,$from=NULL){
if($from==NULL)$from=new DateTime('midnight');
else $from=new DateTime($from);
        //current date or any date
  $to = new DateTime($to);   //Future date
  $diff = $to->diff($from)->format("%a");  //find difference
  $days = intval($diff);   //rounding days
  return $days;
}




//-----------------------------------------------------
// Login Checking
//-----------------------------------------------------

function logged($module_id=1){
        if($module_id==1)$module_id=mid('admins');
        #check SESSION #1
        if(isset($_SESSION['user_id']) && $_SESSION['module_id']==$module_id)return true;

        #check cookie #2
        return checkLoginCookie($module_id);
}
function isLogged($module_id=1){
        return logged($module_id);
}


//check the cookie
function checkLoginCookie($requested_module_id) {

        global $conn;
        #1 check
    if(!isset($_COOKIE['legion']))return false;

        #2 validate
    list ($user_id,$token,$module_id,$hash) = explode(':',$_COOKIE['legion']);
    if (!hash_equals(hash_hmac('sha256',$user_id . ':' . $token. ':' . $module_id,secret_key),$hash))return false;
    $user_id=escape($user_id);
    $module_id=escape($module_id);


        #3 check the user with DB
    $resp=db("cookies_1565697908","WHERE user_id='$user_id' AND module_id='$module_id'",NULL);
        if($resp==0 || $resp==1)return false;
        for($i=0;$i<count($resp);$i++){

                #compare tokens
        if (hash_equals($resp[$i]['token'],$token) && $requested_module_id==$module_id) {

            logUserIn($user_id,$module_id);
                        return true;
        }
    }

        #cookie is invalid
        return false;
}

//======================================================================
// USER Auth [End]




function menuTitle($resp){
                                if(l($resp['custom_title'])!='')return l($resp['custom_title']);
                                else if($resp['item_id']==0)return l(detail('modules','module_name','module_prefix',$resp['module_prefix']));
                                return l(detail($resp['module_prefix'],$resp['module_field'],'id',$resp['item_id']));
                        }



function linker($resp){
        
                        $base=url.curr().'/';

                        if($resp['points_to_home']=='1')return $base;
                        if(l($resp['custom_link'])!='')return l($resp['custom_link']);
        
            if($resp['module_prefix']=='0')return '#';
    
                        $module_id=detail('modules','id','module_prefix',$resp['module_prefix']);
                        $slug=l(detail($resp['module_prefix'],'slug','id',$resp['item_id']));

                        $tmp=db('link_handler_1566934564',"WHERE module_prefix='$module_id'",NULL,'LIMIT 1');
        
                        $module=$tmp==1?NULL:$tmp[0];
                        if($resp['item_id']==0)$link=$base.($module==1?NULL:$module['all_entries']);
                        else $link=$base.$module['single'].'/'.($slug=='' ? $resp['item_id']:$slug);

                        return $link;

                }



function url($this_module,$module_link_type='all_entries',$slug=NULL){
        $module_id=detail('modules','id','module_prefix',$this_module);

        $module=db('link_handler_1566934564',"WHERE module_prefix='$module_id'",NULL,'LIMIT 1');
        if($module==1)return url.curr().'/';
        
        $module=$module[0];
        if($slug!=NULL)$slug='/'.l($slug);
        return url.curr().'/'.(isset($module[$module_link_type])?$module[$module_link_type]:'').$slug;
}

function urls(&$id,&$this_module){
        return url($this_module,'single',$id);
}


function datex($normalDate){
        $dateValue = strtotime($normalDate);
        $arr=array();
        $arr['day']=date("d",$dateValue);
        $arr['month']=date("F",$dateValue);
        $arr['year']=date("Y",$dateValue);
        return $arr;
}

function ar($string){
        $find = array ("Sat","Sun","Mon","Tue","Wed" ,"Thu","Fri","November");
    $replace = array ("السبت","الأحد","الإثنين","الثلاثاء","الأربعاء","الخميس","الجمعة",'نوفمبر');
    $ar_day_format = date('D'); // The Current Day
    $ar_day = str_replace($find,$replace,$string);
        return $ar_day;
}


// USER info [Start]
//======================================================================

function userInfo(){
        global $userInfoArr;

        if(!isset($userInfoArr)){
        $resp=db('admins',"WHERE id='".$_SESSION['user_id']."'",NULL,"LIMIT 1","first_name,last_name,menu_style,photo,username,language_id,restricted,dark_mode");
        if($resp==0 || $resp==1)$userInfoArr=false;
        else $userInfoArr=$resp[0];
        }


        return $userInfoArr;
}
//======================================================================
// USER info [End]

function module_id($module){
    return detail('modules','id','module_prefix',$module);
}


function fonts($erase=false){
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
                url(../../../uploads/".$elem['file'].") format('".fontFormat($elem['file'])."');
}
";
        }
                }
        if($erase)$txt='';
        indexer(fres_dir.'css/','fonts','css',$txt);
}

function fontFormat($filename){
        $extension=strtolower(end(explode('.',$filename)));
        switch($extension){
                        case'otf':return 'opentype';
                        case'woff':return 'woff';
                default:return 'truetype';
        }
}
        

function distance($lat1,$lon1,$lat2,$lon2,$unit='K') {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

function fileIcon($fileName){
//      dd($fileName);
        $ext=explode('.',$fileName);
        $ext=end($ext);
        if($ext=='docx')$ext='doc';
        elseif($ext=='geojson')$ext='json';
        else if($ext=='xls')$ext='xlsx';
        if(file_exists(pres_dir.'imgs/'.$ext.'.png')){
                $img=$ext.'.png';
        }else $img='unknown.png';
        
        return pres.'imgs/'.$img;
}

function icon($ext='unknown'){
        if(file_exists(pres_dir.'imgs/'.$ext.'.png')){
                $img=$ext.'.png';
        }else $img='unknown.png';
        
        return pres.'imgs/'.$img;
}


function mn($module_prefix){
        return l(db('modules',"WHERE module_prefix='$module_prefix'",NULL,"LIMIT 1")[0]['module_name']);
}


function mi($module_prefix){
        return db('modules',"WHERE module_prefix='$module_prefix'",NULL,"LIMIT 1")[0]['main_icon'];
        
}

//legacy
function micon($module_prefix){
        return mi($module_prefix);
}



function validateFields($module,$_action=NULL){
        global $action,$settings;
        if($_action!=NULL)$action=$_action;
        $_fields=db('module_fields',"WHERE module_id='".mid($module)."'","ORDER BY id ASC");
        foreach($_fields as $_field){
                //custom validation
                if($_field['type']=='username'){
                        checkUsername($_POST[$_field['field_name']]);
                }
                
                //field fixer
                if($_field['type']=='mobile'){
                        $_POST[$_field['field_name']]=fixPhone($_POST[$_field['field_name']]);
                }
                
                if($_field['type']=='number'){
                        $_POST[$_field['field_name']]=engNum($_POST[$_field['field_name']]);
                }
                //validtion based on requirment
                if($_field['required']==0)continue;
                if($_field['type']=='password' && (!isset($action) || $action=='edit'))continue;
                if($_field['type']=='file'){
                        if($_field['sub_sub_type']=='classic_file'){
                                if(!isset($action))continue;
                                if($action=='edit')continue; //check if its not there or deleted it to tell him its required
                                if($action=='add' && (!isset($_FILES[$_field['field_name']]['name'][0]) || $_FILES[$_field['field_name']]['name'][0]==NULL))
                                        json(false,3,NULL,l($_field['label']).' '.l('is required<>إجباري'));
                                else 
                                        continue;
                        }
                }
                if($_field['type']=='select' && i($_field['field_name'])){
                        if($_POST[$_field['field_name']]==0 || $_POST[$_field['field_name']]==NULL){
                                json(false,3,NULL,l($_field['label']).' '.l('is required<>إجباري'));
                        }
                }
                
                if(!i($_field['field_name']) || $_POST[$_field['field_name']]=='' || ($_field['is_ml'] && $_POST[$_field['field_name']]=='<><>')){
                        json(false,3,NULL,l($_field['label']).' '.l('is required<>إجباري'));
                }
        }

}


function form($id=NULL,$custom_input='custom_input',$classes=NULL){
        $txt='<form id="'.($id==NULL?'auto_form':$id).'" class="'.$classes.'" autocomplete="off" action="" onsubmit="return submitter(this,\''.urlPanel.'\');" method="post" enctype="multipart/form-data">
        <input type="hidden" value="" name="e">
        <input type="hidden" name="'.$custom_input.'" value="true">';

        return $txt;
}


function formAPI($id=NULL,$custom_input='custom_input',$classes=NULL){
        $txt='<form id="'.($id==NULL?'auto_form':$id).'" class="'.$classes.'" autocomplete="off" action="" onsubmit="return submitter(this,\''.url.'api/1.0/\');" method="post" enctype="multipart/form-data">
        <input type="hidden" value="" name="e">
        <input type="hidden" name="'.$custom_input.'" value="true">';

        return $txt;
}


function endform($btn_title=NULL){
        return '<input class="l_btn" type="submit" value="'.($btn_title==NULL?l('Save<>حفظ'):$btn_title).'">
        </form>';
}

function ff($module,$btn_title=NULL,$addFields=NULL,$hideFields=NULL,$mode='add'){

        global $passOnce;
        echo form($module,$module);
        $passOnce=true;
        v($module,$mode,false);
        if($addFields!=NULL){
                foreach($addFields as $a){
                        echo '<input type="hidden" name="'.$a.'" value="true"/>';
                }
        }
        if($hideFields!=NULL){
                foreach($hideFields as $h){
                        echo "<script>$('.".$module."_".$h."').hide();</script>";
                }
        }
        echo endform($btn_title);
}

function ffh($module,$btn_title=NULL,$addFields=NULL,$hideFields=NULL,$mode='add'){
        global $passOnce;
        echo form($module,$module,'hidden');
        $passOnce=true;
        v($module,$mode,false);
        if($addFields!=NULL){
                foreach($addFields as $a){
                        echo '<input type="hidden" name="'.$a.'" value="true"/>';
                }
        }
        if($hideFields!=NULL){
                foreach($hideFields as $h){
                        echo "<script>$('.".$module."_".$h."').hide();</script>";
                }
        }
        echo endform($btn_title);
}


function ffhAPI($module,$btn_title=NULL,$moreInputs=NULL){
        global $passOnce;
        echo formAPI($module,$module,'hidden');
        if($moreInputs!=NULL &&  is_array($moreInputs)){
                $keys=array_keys($moreInputs);
                foreach($keys as $key){
                        echo '<input type="hidden" name="'.$key.'" value="'.$moreInputs[$key].'"/>';
                }
        }
        $passOnce=true;
        v($module,'add',false);
        echo endform($btn_title);
}



function u(){
        global $user_id;
        $_POST['user']=$user_id;
}

function filler($module,$id=NULL){
        
        $_POST=NULL;
        $module_id=detail('modules','id','module_prefix',$module);
        $module_fields = db('module_fields',"WHERE module_id='$module_id'");
        
        if($id!=NULL)
                $resp=db($module,"WHERE id=$id")[0];
        
        foreach($module_fields as $field){
                if($id==NULL){
                        if($field['type']=='checkbox')continue;
                        else
                                $_POST[$field['field_name']]='';
                        }
                else
                        $_POST[$field['field_name']]=$resp[$field['field_name']];
        }
}



#! who uses this?
function cod($module,$id=NULL){
        $_lang=$_POST['lang'];
        $module_id=detail('modules','id','module_prefix',$module);
        $module_fields = db('module_fields',"WHERE module_id='$module_id'");
        
        if($id!=NULL){
                $resp=db($module,"WHERE id=$id")[0];
                $_POST['id']=$resp['id'];
                }
        
        foreach($module_fields as $field){
                if($field['type']=='password'){
                        continue;
                }
                if($id==NULL){
                        if($field['type']=='checkbox')continue;
                        else
                                $_POST[$field['field_name']]='';
                        }
                else
                        $_POST[$field['field_name']]=$resp[$field['field_name']];
        }
        $_POST['lang']=$_lang;
}


function co($module,$id=NULL,$where_field='id'){
        $module_fields=db('module_fields',"WHERE module_id=".mid($module));
        
        if($id!=NULL){
                $resp=db($module,"WHERE $where_field=$id")[0];
                $_POST['id']=$resp['id'];
        }
        
        foreach($module_fields as $field){
                if(isset($_POST[$field['field_name']])){
                        continue;
                }
                if($field['type']=='password'){
                        continue;
                }
                if($id==NULL){
                        if($field['db_default']!=''){
                                        $_POST[$field['field_name']]=$field['db_default'];
                                        continue;
                        }
                        if($field['type']=='checkbox')
                                continue;
                        else
                                $_POST[$field['field_name']]='';
                }
                else{
                        if($field['type']=='select' && $field['sub_type']=='multi'){
                                $tmp=com($module,$_POST['id'],$field['select_table']);
                                if($tmp!=1){
                                        $_POST[$field['field_name']]=[];
                                        foreach($tmp as $t){
                                                $_POST[$field['field_name']][]=$t['child_id'];
                                        }
                                }
                        }
                        elseif($field['type']=='checkbox' && ($resp[$field['field_name']]=='0' || $resp[$field['field_name']]=='1')){
                                // if($_POST['id']>29208)m('omar');
                                $_POST[$field['field_name']]=$resp[$field['field_name']];
                        }
                        else{
                                        $_POST[$field['field_name']]=$resp[$field['field_name']]==NULL?'':$resp[$field['field_name']];
                        }
                }
        }
}

//same as r, but respects complemntary (multi select)
function rc($module_prefix,$action='add',$internal=true){
        global $conn,$admin_add_id,$date_created,$settings,$date_modified;
        if($internal)$_POST['internal']=true;
//      if($action=='edit')$_POST['id']=$_POST['']
        if($action=='edit'){
                $multi_select=db('module_fields',"WHERE !deleted AND module_id=".mid($module_prefix)." AND type='select' AND sub_type='multi'");

                if($multi_select!=1){
                        foreach($multi_select as $mul){
                                $tmp=com($module_prefix,$_POST['id'],$mul['select_table']);
                                if($tmp!=1){
                                        $_POST[$mul['field_name']]=[];
                                        foreach($tmp as $t){
                                                $_POST[$mul['field_name']][]=$mul['child_id'];
                                        }
                                }
                        }
                }
        }

        require modules_dir.$module_prefix.'/models/'.$action.'.php';
        if($action=='add')return $last_id;
        elseif($action=='edit' && i('id'))return $_POST['id'];
}





function completer($module,$id=NULL){
        
        return co($module,$id);
}

function d($var='here_'){
        var_dump($var==='here_'?'here_'.rand(1,99):$var);
}

function dr(){
        global $resp;
        if(isset($resp))
                var_dump($resp);
        else
                var_dump(NULL);
}


function dq($return=false){
        global $conn;
        if($return)return mysqli_error($conn);
        else var_dump(mysqli_error($conn));
}


function dd($var='here_'){
        var_dump($var==='here_'?'here_'.rand(1,99):$var);
        die();
}

function dp(){
        var_dump($_POST);
}

function dpd(){
        var_dump($_POST);
        die();
}

function pre($var){
        echo '<pre style="background:white;color:black;direction:ltr;">'.print_r($var,true).'</pre>';
}




function drop($module,$field='title',$add=NULL,$order="ORDER BY id ASC",$where=NULL){
        $resp=db($module,$where,$order,NULL,'id,'.$field.($add==NULL?NULL:','.$add));
        return fl($resp,$field);
}

function drop_ml($module,$field='title',$add=NULL,$order="ORDER BY id ASC",$where=NULL){
        $resp=db($module,$where,$order,NULL,'id,'.$field.($add==NULL?NULL:','.$add));
        foreach($resp as &$r){
                $r[$field.'_ml']=$r[$field];
        }
        return fl($resp,$field);
}

//clean a DB array as languages
function fl($resp,$field='title'){
        if($resp==1 || $resp==0)return $resp;
        for($i=0;$i<count($resp);$i++){
                $resp[$i][$field]=l($resp[$i][$field]);
        }
        return $resp;
}


function fla($resp,$fields=NULL){
        if($fields==NULL)$fields=array('title');
        if($resp==1 || $resp==0)return $resp;
        for($i=0;$i<count($resp);$i++){
                foreach($fields as $f){
                        $resp[$i][$f]=l($resp[$i][$f]);
                }
                
        }
        return $resp;
}

function jsEscape($str) {
        if($str==NULL)return NULL;
        return htmlentities($str);
    $output = '';
    $str = str_split($str);
    for($i=0;$i<count($str);$i++) {
        $chrNum = ord($str[$i]);
        $chr = $str[$i];
        if($chrNum === 226) {
            if(isset($str[$i+1]) && ord($str[$i+1]) === 128) {
                if(isset($str[$i+2]) && ord($str[$i+2]) === 168) {
                    $output .= '\u2028';
                    $i += 2;
                    continue;
                }
                if(isset($str[$i+2]) && ord($str[$i+2]) === 169) {
                    $output .= '\u2029';
                    $i += 2;
                    continue;
                }
            }
        }
        switch($chr) {
            case "'":
            case '"':
            case "\n";
            case "\r";
            case "&";
            case "\\";
            case "<":
            case ">":
                $output .= sprintf("\\u%04x", $chrNum);
            break;
            default:
                $output .= $str[$i];
            break;
    }
    }
    return $output;
}


function fca($resp,$arr,$compress=true){
        $tmp=$resp;
        if($resp==1 || !is_array($resp) || count($resp)<=0)return $resp;
        for($i=0;$i<count($tmp);$i++){
                $tmp[$i]=fc($tmp[$i],$arr,$compress);
        }
        return $tmp;
}

function fcfull($resp,$arr){
        return fc($resp,$arr,false);
}

function fcafull($resp,$arr,$compress=true){
        $tmp=$resp;
        if($resp==1 || !is_array($resp) || count($resp)<=0)return $resp;
        for($i=0;$i<count($tmp);$i++){
                $tmp[$i]=fcfull($tmp[$i],$arr,$compress);
        }
        return $tmp;
}

function fc($resp,$arr,$compress=true,$force_width=NULL){

        if($resp==1)return $resp;
        if($force_width!=NULL)$destination_width=$force_width;
        else $destination_width=i('_d')?500:1000;
        foreach($arr as $column){
                if(!isset($resp[$column]) || $resp[$column]=='')continue;
                $resp['_'.$column]=$resp[$column];
                
                if(file_exists(target_dir.$resp[$column]) || file_exists(_protected.$resp[$column])){
                        $file=db('files_1577206823',"WHERE full_name='".$resp[$column]."'",NULL,'LIMIT 1','type,full_name,name,width,height,average_color,protected_file');
                        if($file==1){
                                $is_protected=0;
                        }else $is_protected=$file[0]['protected_file'];

                        $generated_file_name=$compress?img($resp[$column],$destination_width,100,protected:$is_protected):$resp[$column];
                        $generated_file_name_thumbnail=$compress?img($resp[$column],200,100,protected:$is_protected):$resp[$column];

                        $resp[$column]=array(
                                'url'=>urlencode(($is_protected?protected_hasher($resp[$column],$generated_file_name):u.$generated_file_name)),
                                'thumbnail_url'=>urlencode(($is_protected?protected_hasher($resp[$column],$generated_file_name_thumbnail):u.$generated_file_name_thumbnail)),
                                'name'=>$resp[$column],
                                'generated_file_name'=>$generated_file_name,
                                'generated_file_name_thumbnail'=>$generated_file_name_thumbnail
                                );
                        if($file!=1){
                                $file=$file[0];
//                              $resp[$column]['url']=urlencode(u.img($file['full_name'],$destination_width,100));
                                $resp[$column]['type']=$file['type'];
//                              $resp[$column]['thumbnail_url']=urlencode(u.img($file['full_name'],200,100));
                                $resp[$column]['name']=$file['name'];
                                $resp[$column]['filename']=$file['full_name'];
                                $resp[$column]['avg_color']=$file['average_color'];
                                $resp[$column]['width']=$file['width'];
                                $resp[$column]['height']=$file['height'];
                                }
                        }
                else{
                        $x=explode(',',$resp[$column]);
                        if($x!=false && !empty($x)){
                                $resp[$column]=array();
                                        foreach($x as $file){
                                                $file=db('files_1577206823',"WHERE name='$file'",NULL,'LIMIT 1','type,full_name,name,width,height,average_color,protected_file');
                                                if($file==1)continue;
                                                $file=$file[0];

                                                $generated_file_name=$compress?img($file['full_name'],$destination_width,100,protected:$file['protected_file']):$file['full_name'];
                                                $generated_file_name_thumbnail=$compress?img($file['full_name'],200,100,protected:$file['protected_file']):$file['full_name'];

                                                $resp[$column][]=array(
                                                        'url'=>urlencode($file['protected_file']?protected_hasher($resp[$column],$generated_file_name):u.$generated_file_name),
                                                        'type'=>$file['type'],
                                                        'thumbnail_url'=>urlencode($file['protected_file']?protected_hasher($resp[$column],$generated_file_name_thumbnail):u.$generated_file_name_thumbnail),
                                                        'name'=>$file['name'],
                                                        'filename'=>$file['full_name'],
                                                        'avg_color'=>$file['average_color'],
                                                        'width'=>$file['width'],
                                                        'height'=>$file['height'],
                                                        'generated_file_name'=>$generated_file_name,
                                                        'generated_file_name_thumbnail'=>$generated_file_name_thumbnail
                                                );
                                        }
                        }
                }
        }
        return $resp;
}

function escapeJavaScriptText($string) 
{ 
    return str_replace("\n",'\n',str_replace('"','\"',addcslashes(str_replace("\r",'',(string)$string),"\0..\37'\\"))); 
} 


function code($from=1000,$to=9999){
        return rand($from,$to);
}


function mid($modulePrefix){
        return detail('modules','id','module_prefix',$modulePrefix);
}

function dim($module_id){
        return detail('modules','module_prefix','id',$module_id);
}

//legacy
function moduleID($modulePrefix){
        return mid($modulePrefix);
}




function r_copy($src,$dst) {
        if(!file_exists($src))
                @mkdir($src);
        
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                r_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
} 

function unsetter($arr=NULL){
        if($arr==NULL)unset($_POST);
        else if(!is_array($arr)){
                unset($_POST[$arr]);
        }
        else{
                foreach($arr as $a){
                        unset($_POST[$a]);
                }
        }
}


function clean($string) {
   $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function str_contains_arr($haystack,array $needles) {
        
    foreach ($needles as $needle) {
        if (str_contains($haystack,$needle) === true) {
            return true;
        }
    }
    return false;
}

function logout(){
        $_SESSION['user_id']='';
        unset($_SESSION['user_id']);
        unset($_SESSION['module_id']);
        unset($_SESSION['user_token']);

        session_unset();
        session_destroy();
        
}

function filter_code($txt){
        global $settings,$legion,$hash_array,$glo;
        $match=getContents($txt,'#','#');
        if(!empty($match)){
                for($i=0;$i<count($match);$i++){ 
                        if(isset($hash_array[$match[$i]]) && $hash_array[$match[$i]]!=NULL)$txt=str_replace('#'.$match[$i].'#',l(eval('return '.$hash_array[$match[$i]].';')),$txt);
                        if(isset($glo[$match[$i]]) && $glo[$match[$i]]!=NULL)$txt=str_replace('#'.$match[$i].'#',l($glo[$match[$i]]),$txt);
                }
        }
        
        if($txt!=NULL){
                $txt=str_replace('\n','<br>',$txt);
                $txt=str_replace('\r','',$txt);
        }
        
        return $txt;
}

function fil($txt=NULL){
return $txt;
        #!getcontents get wrong, for example #3131313;omarphone=#qefefq
        $match=getContents($txt,'#','#');
        for($i=0;$i<count($match);$i++){ 
                $tmp=db('statistics_box_8324',"WHERE shortname='".$match[$i]."'");
                if($tmp!=1)
                        $txt=str_replace('#'.$match[$i].'#',sb($tmp,false),$txt);
        }
        return $txt;
}

//Display None
function dn($return=false){
        $html='style="display:none"';
        if($return)return $html;
        echo $html;
}

function l_loading(){
        $html='<div class="l_loading"><div class="par"><div class="ch"><img id="rolling_img" class="mid" alt="Legion loading" loading="lazy" src="'.u.'loading.gif"/></div></div></div>';
        // if($return)return $html;
        return $html;
}

function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}


function tester($raw_post=NULL,$specific_data=NULL){
        $tmp=$_POST;
        $_POST['raw_post']=$raw_post==NULL?'':$raw_post;
        $_POST['specific_data']=$specific_data==NULL?'':$specific_data;
        r('tester_1565720578');
        $_POST=$tmp;
}

function cs($str){
        $str=str_replace(array("\\n\\r", "\\n","\\n\\n", "\\r"), "", $str);
        $str=rtrim($str);
        $str=trim($str);
        return $str;
}


function imploder($resp){
        return "'".implode("','",$resp)."'";
}



function imp($resp){
        return "'".implode("','",$resp)."'";
}



function mark($stuff='just marking',$before=NULL,$after=NULL){
        $debug_backtrace=debug_backtrace();
        $debug_arr=NULL;
        if($debug_backtrace!=null && count($debug_backtrace)>0){
                        foreach($debug_backtrace as $deb){
                                        // $debug_arr=' <span class="l_grass_c">'.__FILE__.' '.__LINE__.'</span>';
                                        $debug_arr='<pre class="l_grass_c l_lh12 l_f10"><div class="l_po" onclick="$(this).parent().find(\'.__error_expandable\').slideToggle()">Expand</div><div class="__error_expandable" style="display:none">'.var_export($deb,true).'</div></pre>';
                        }
        }
        error_log("\n<div class=\"l_purple_c l_f10\">[LEGION MARK]</div>".$before.var_export($stuff,true).$after.$debug_arr);
}

function m($stuff,$before=NULL,$after=NULL){
        mark($stuff,$before,$after);
}




function str_containsa(string $haystack, array $needles){
    foreach ($needles as $needle){
       if (str_contains($haystack, $needle)){
           return true;
       }
    }
    return false;
}


class Resp{

        public $resp;
        
        function __construct($resp=NULL)
        {
                $this->resp=$resp;
        }

        /**
         *return: imploded from array_column
         */
        public $imp_zero=false;
        function imp($column='id'){
                
                if($this->imp_zero && $this->resp==1){
                        return 0;
                }
                
                if($this->resp==1)return NULL;
                return implode(',',array_column($this->resp,$column));
        }

}

function process_selected_modern_multi($mother_module,$child_module,$field_name,$id){
        $txt=NULL;

        $for_field_products=com($mother_module,$id,$child_module);
        if($for_field_products!=1){
                foreach($for_field_products as $_child){
                        $_child_info=o($child_module,$_child['child_id']);
                        if($_child_info==1)continue;
                        $_child_title=select_echo($mother_module,$field_name,$_child_info[0],true);

                        $txt.='<div id="l_chosen_'.rand().'" data-l-select-id="for_field_'.$field_name.'" data-l-chosen-val="'.$_child['child_id'].'" class="l_chosen in l_tag l_f13 l_m5"><i class="l_lava_c mid po" onclick="l_multi_select_delete(this)">delete</i><span class="mid l_ml5 l_mr5">'.$_child_title.'</span><div class="l_chosen_counter"></div><input type="hidden" name="'.$field_name.'[]" value="'.$_child['child_id'].'"/></div>';
                        
                        $txt.='<script>$(function(){l_multi_select_colorize("for_field_'.$field_name.'",'.$_child['child_id'].');});</script>';
                }
        }

        return $txt;
                                
}

$___select_echo_arr=[];
$___empty='<div class="empty_string nos">'.l('Empty<>فارغ').'</div>';
function select_echo($module,$field_name,$resp,$same=false){
        // return true;
        global $___select_echo_arr,$___empty;
        if(in_array($module.$field_name,$___select_echo_arr)){
                $parent_field=$___select_echo_arr['parent_field'];
                if($parent_field==1)return 'NA';
                $x=$___select_echo_arr['x'];
                $__mod_fields_tmp=$___select_echo_arr['__mod_fields'];
        }else{
                $parent_field=ow('module_fields',"module_id=".mid($module)." AND field_name='$field_name'");
                
                $___select_echo_arr[$module.$field_name]=['parent_field'=>$parent_field];


                $__mod_fields_tmp=aw('module_fields',"module_id=".mid($parent_field['select_table']));
                if($__mod_fields_tmp==1){$__mod_fields=1;}
                else{
                        // mark($__mod_fields_tmp);
                        $__mod_fields=[];
                        foreach($__mod_fields_tmp as $_mod_field){
                                $__mod_fields[$_mod_field['field_name']]=$_mod_field;
                        }
                }
                $___select_echo_arr[$module.$field_name]['__mod_fields']=$__mod_fields;

                if($parent_field==1)return 'NA';
                $x=explode(',',$parent_field['select_field']);
                $___select_echo_arr[$module.$field_name]['x']=$x;
        }
        // mark($x);

        $final=NULL;
        // return $final;
        
        // d($x);
        // if($parent_field['sub_type']=='multi'){
                // $tmp=comp($module,$resp['id'],$parent_field['select_table']);
                // // mark($module);
                // if($tmp==1)return $___empty;
                // else{
                        // foreach($tmp as $t){
                        //       for($i=0;$i<count($x);$i++){
                        //              if($x[$i]=='-')$sep=' '.$x[$i];else $sep=' ';
                        //              $final.='<div class="in list_comp_item">'.$sep.l(detail($parent_field['select_table'],$x[$i],'id',$t['child_id'])).'</div>';
                        //      }
                        // }
                        // return $final==NULL?$___empty:$final;
                // }
        // }

        for($i=0;$i<count($x);$i++){
                if($x[$i]=='-'){
                        $__to_add='/';
                        if(isset($x[$i-1]) && $x[$i-1]!='')$__to_add=' '.$__to_add;
                        if(isset($x[$i+1]) && $x[$i+1]!='')$__to_add=' '.$__to_add.' ';
                        if($final==NULL)$__to_add=NULL;
                }

                elseif($x[$i]=='--'){
                        // $__mod_fields=ow('module_fields',"module_id=".mid($parent_field['select_table'])." AND field_name='".$x[$i+1]."'");


                        if($__mod_fields!=1){
                                if($same){
                                        $__to_add=l(detail($__mod_fields[$x[$i+1]]['select_table'],'title','id',$resp[$x[$i+1]]));
                                }
                                else
                                        $__to_add=l(detail($__mod_fields[$x[$i+1]]['select_table'],'title','id',detail($parent_field['select_table'],$x[$i+1],'id',$resp[$field_name])));
                        }               
                        else
                                $__to_add=NULL;
                        $i++;
                        
                }
                
                else{
                        // mark($__mod_fields[$x[$i]]['type']);
                        if($same){
                                // if(isset($__mod_fields[$x[$i]]['type']) && $__mod_fields[$x[$i]]['type']=='color')
                                //      $__to_add='omar'.'<span style="color:'.$resp[$x[$i]].'">'.$resp[$x[$i]].'</span>';
                                // else{
                                        // if(isset($__mod_fields[$x[$i]]['is_ml']) && $__mod_fields[$x[$i]]['is_ml'])
                                                if(isset($resp[$x[$i]]))
                                                        $__to_add=l($resp[$x[$i]]);
                                                else
                                                        $__to_add=NULL;
                                        // else
                                        //      $__to_add=$resp[$x[$i]];
                                // }
                        }
                                
                        else{
                                if(isset($resp[$field_name]))
                                        $__to_add=l(detail($parent_field['select_table'],$x[$i],'id',$resp[$field_name]));
                                else
                                        $__to_add=NULL;
                        }

                        if(isset($x[$i-1]) && $x[$i-1]!='' && $__to_add!=NULL)$__to_add=' '.$__to_add;
                }
                $final.=$__to_add;
        }
        // d($final);
        if($final==NULL)return $___empty;
        return $final;
}



$noPermission='<div class="working_area"><i class="mid l_lava_c">do_not_disturb_on</i><span class="mid l_mr5 l_ml5">'.l('You do not have privilege<>لا تمتلك الصلاحية').'</span></div>';


if(!logged()){
        if(isset($_POST)){
                foreach($_POST as $key=>$value){
                        if(!is_array($_POST[$key]))
                                $_POST[$key]=htmlspecialchars($_POST[$key]);
                }
        }

        if(isset($_GET)){
                foreach($_GET as $key=>$value){
                        if(!is_array($_GET[$key]))
                                $_GET[$key]=htmlspecialchars($_GET[$key]);
                }
        }
}

require panel_dir.'custom/custom_config.php';