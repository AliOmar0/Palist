<?php
require('core/config.php');

//dp();
$module=i('module')?e('module'):'';
$action=i('action')?e('action'):'';

#!check controller that all actions here are inclusive, becuase some if statements here put action value in $_POST['module']
if(isset($_POST['module']) && $_POST['module']=='entries_log_8503' && !super()){
	$fmi=1;
	$__email='omar@provision.ps';
	$__notification_title='Entry Log Manipulation';
	$__username='Super';
	$__notification="User Module: {$_SESSION['module_id']}   User ID: {$_SESSION['user_id']}   From: ".json_encode((isset($_POST['id'])?o('entries_log_8503',$_POST['id'])[0]:'Seems mass action'))."   To/_POST: ".json_encode($_POST);
	include mailer;
}


if($module=='comments' && $action=='add'){
	$_POST['commenter_module']=$_SESSION['module_id'];
	$_POST['commenter_id']=$_SESSION['user_id'];
}

require custom_dir.'custom_controller.php';

 
//special type, login exceptional,outside the system
if(isset($_POST['type']) && $_POST['type']=='login'){
        require(core_dir.'modules/loginModel.php');
		die();
	}

else if(isset($_GET['viewMod'])){
	$module=isset($_GET['viewMod']) ? eg('viewMod'):NULL;
	$action='edit';
	if($module!=NULL){
	$m=db('module_settings',"WHERE module_prefix='$module'",NULL,"LIMIT 1");
		if($m!=0 || $m!=1){
			$m=$m[0];
	$m['info']=db('modules',"WHERE module_prefix='$module'",NULL,'LIMIT 1')[0];
	$m['module_id']=$m['info']['id'];
		}


	if($action!=NULL && isset($m['module_id']))
		$actionDetails=db('module_actions',"WHERE module_id='".$m['module_id']."' AND type='$action'",NULL,'LIMIT 1')[0];
	
	if(db('module_fields',"WHERE module_id='".mid($module)."' AND type='location'")!=1)$mapHere=true;else $mapHere=false;
		
	if(!privilege($module, $action) && !($module=='admins' && $action=='edit' && $_SESSION['user_id']==$_GET['id']))die(l('No permission<>ليس من صلاحياتك'));
	
	
//	include modules_dir.$_GET['viewMod'].'/views/edit.php';
		 require_once core_dir.'modules/bread.php';
		 require_once modules_dir.$module.'/views/'.$action.'.php';
		require_once core_dir.'preViewFormEnd.php';
        if (detail('modules','ml','module_prefix',$module)==true && $action!='usage') {
            echo "<script>
			var ml_supp_input_names=".json_encode(explode(',',$m['ml_fields'])).";</script>";
            require panel_dir.'core/modules/lang.php';
        }
		
		if($mapHere)include_once core_dir.'modules/map.php';
        echo '</div>';
		
//	echo'<input type="submit" class="btn" value="'.l('Save<>حفظ').'" form="'.$_GET['viewMod'].'"/>';
//	echo'<input type="hidden" name="force_refresh" value="true" form="'.$_GET['viewMod'].'"/>';
	die();
}
	die(l('No permission<>ليس من صلاحياتك'));
}


else if(isset($_GET['addMod'])){
	include modules_dir.$_GET['addMod'].'/views/add.php';
//	if(g('viewMod'))
		echo'<input type="submit" class="btn" value="'.l('Save<>حفظ').'" form="'.$_GET['viewMod'].'"/>';
//	if(g('viewMod'))
		echo'<input type="hidden" name="force_refresh" value="true" form="'.$_GET['viewMod'].'"/>';
	die();
}

else if(g('imagine') && logged()){
	$_GET['imagine']=end(explode('/',$_GET['imagine']));
	include imagine;
//	if(g('viewMod'))
//		echo'<input type="submit" class="btn" value="'.l('Save<>حفظ').'" form="'.$_GET['viewMod'].'"/>';
//	if(g('viewMod'))
//		echo'<input type="hidden" name="force_refresh" value="true" form="'.$_GET['viewMod'].'"/>';
	die();
}


else if(isset($_POST['type']) && $_POST['type']=='select' && isset($_POST['whereKey'])){
	$_POST['db']=e('db');
	

	if((detail('modules','external_access','module_prefix',$_POST['db'])==0 && !privilege($_POST['db'],'list')) && !super())json(false,66);
	$_POST['fields']=e('fields');
	$whereKey=e('whereKey');
	$whereValue=e('whereValue');
	$data=db($_POST['db'],"WHERE $whereKey='$whereValue' AND deleted=0",NULL,NULL,'id,'.$_POST['fields']);
	//legacy start
	if(i('selectNameToRefresh'))
		$selector="select[name^='".$_POST['selectNameToRefresh']."']";
	else
	//legacy end
		$selector=$_POST['selector'];
	
//	d($data);
	if($data==0)json(false,3);
	if($data==1)json(true,1,1,NULL,array('js'=>'reload_options','selector'=>$selector));
	else{
		$exploded=explode(',',$_POST['fields']);
		for($i=0;$i<count($exploded);$i++){
			for($j=0;$j<count($data);$j++){
				$data[$j][$exploded[$i]]=l($data[$j][$exploded[$i]]);
			}
	}
		$arr=array('js'=>'reload_options','selector'=>$selector,'echoValue'=>$_POST['fields']);
		
		$arr['currentValue']=i('currentValue')?$_POST['currentValue']:NULL;
		$arr['clear']=i('clear')?$_POST['clear']:true;
		
		json(true,1,$data,NULL,$arr);
	}
	
	 json(false,3);
	}






if(!logged()) json(true,2,NULL,NULL,array('url'=>urlPanel,'js'=>'redirect'));

/*
************************************************************
************************************************************
************************************************************
************** Stricted for logged as admins ***************
************************************************************
************************************************************
************************************************************
************************************************************
*/

#! check privlege, maybe?
if(i('stats_check')){
	$res=[];
	$x=explode(',',$_POST['ids']);
	$y=explode(',',$_POST['box_ids']);
	
	if($x!=false){
		foreach($x as $key=>$id){
			$_stats_big_arr=s_item_data($id);
			if($_stats_big_arr['grand_total']>0 && !empty($_stats_big_arr) && $_stats_big_arr['analytics'][0]['item']['type']=='Chart'){
				$res[]=['type'=>$_stats_big_arr['analytics'][0]['item']['type'],'id'=>$id,'box_id'=>$y[$key],'data'=>$_stats_big_arr['analytics'],'labels'=>$_stats_big_arr['analytics'][0]['labels']];
			}elseif($_stats_big_arr['analytics'][0]['item']['type']=='Count'){
				$res[]=['type'=>$_stats_big_arr['analytics'][0]['item']['type'],'id'=>$id,'box_id'=>$y[$key],'data'=>$_stats_big_arr['analytics']];
			}
		}
	}
	
	json(1,1,$res);
}

elseif(i('load_stat_box')){
	json(true,1,sb(e('load_stat_box')));
}

elseif(i('action') && $_POST['action']=='delete_all'){
	$module=e('module');
	$resp=db($module);
	if($resp!=1){
		for($i=0;$i<count($resp);$i++){
			$_POST['id']=$resp[$i]['id'];
			if(!delete($module,true))json(false,71);
			}
	}

	if($module=='fonts_1582219344')
		fonts();

	elseif($module=='link_handler_1566934564'){
		$_POST['internal']=true;
		require modules_dir.'settings/models/reset_htaccess.php';
	}elseif($module=='color_palette_1645099749'){
		$_POST['internal']=true;
		require modules_dir.'settings/models/reset_ui.php';
	}
	
	j();
	
}

elseif(i('get_error_files_list') && super()){
	$logs=array();
	$new_folder_path= new RecursiveDirectoryIterator(error_log_path);
	foreach(new RecursiveIteratorIterator($new_folder_path) as $file)
	{				
		if(strpos($file,'error_log') || strpos($file,'error.log')){
			$__size=filesize($file);
			$d=date ("d-m-Y H:i:s", filemtime($file));
			$logs[]=array(
			'name'=>str_replace(root,'',$file),
			'date'=>$d,
			'elapse'=>elapse($d),
			'size'=>mb($__size,($__size>1000000?'M':'K'),1).' '.($__size>1000000?'MB':'KB')
			);
		}//if
	}//for
	if(empty($logs)){
		$logs=1;
	}else{
		
		usort($logs,function($a,$b){
			return $b['date']<=>$a['date'];
		});
	}

	json(true,1,$logs);
}

elseif(i('error_log_content') && super()){
	$__errors=NULL;
	if(file_exists(root.$_POST['error_log_content'])){
		$__errors=file_get_contents(root.$_POST['error_log_content']);
		// d($__errors);
	}
	
	json(true,1,print_r($__errors,true));
}

elseif(i("error_log_handle") && super()){
	if($_POST['error_log_handle']=='del' && isset($_POST['dir']) && file_exists(root.$_POST['dir'])){
		trash(root.$_POST['dir']);
	}
	
	elseif($_POST['error_log_handle']=='mop' && isset($_POST['dir']) && file_exists(root.$_POST['dir'])){
		$f=fopen(root.$_POST['dir'],'w');
		fwrite($f,'');
		fclose($f);
	}
	
	elseif($_POST['error_log_handle']=='mopAllErrors'){
		$new_folder_path= new RecursiveDirectoryIterator(error_log_path);
		foreach(new RecursiveIteratorIterator($new_folder_path) as $file)
		{		
			if(strpos($file,'error_log') || strpos($file,'error.log')){
				$f=fopen($file,'w');
				fwrite($f,'');
				fclose($f);
			}//if
		}//for
	}
	j();
}

elseif(i('status_report')){
	$__tests=[
		[
			'title'=>l('Google Analytics<>احصائيات جووجل'),
			'status'=>(connection('g_analytics')==null?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>1
		],
		[
			'title'=>l('SSL<>شهادة الحماية'),
			'status'=>($settings['http']==0?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>1
		],
		[
			'title'=>l('Visiblity on Search Engines<>الظهور على محركات البحث'),
			'status'=>($settings['visibility']==0?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>1
		],
		[
			'title'=>l('Leave without saving?<>التنبيه عند الخروج دون حفظ'),
			'status'=>($settings['are_you_sure']==0?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>3
		],
		[
			'title'=>l('Firebase PSN<>تنبيهات الهواتف فايربيس'),
			'status'=>(connection('firebase_file_name')==''?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>3
		],
		[
			'title'=>l('OneSignal PSN<>تنبيهات الهواتف ونسجنال'),
			'status'=>(connection('onesignal_app_id')==''?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>3
		],
		[
			'title'=>l('Facebook App<>تطبيق فيسبوك'),
			'status'=>(connection('fb_app_id')==''?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>3
		],
		[
			'title'=>l('Facebook Pixel<>فيسبوك بكسل'),
			'status'=>(connection('fb_pixel')==''?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>3
		],
		[
			'title'=>l('Facebook Analytics<>احصائيات فيسبوك'),
			'status'=>(connection('fb_app_analytics')==''?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>3
		],
		[
			'title'=>l('Manifest JSON<>معلومات الموقع'),
			'status'=>(file_exists(public_html.'manifest.json')==false?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>2
		],
		[
			'title'=>l('Debug Mode<>وضعية البرمجة والصيانة'),
			'status'=>($settings['debug']==1?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>1
		],
		[
			'title'=>l('ShareThis<>نظام المشاركة'),
			'status'=>(connection('sharethis')==''?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>1
		],
		[
			'title'=>l('Under Construction<>وضعية قيد الانشاء'),
			'status'=>($settings['uc']==1?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>1
		],
		[
			'title'=>l('Site Description<>وصف الموقع'),
			'status'=>($settings['site_desc']==''?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>1
		],
		[
			'title'=>l('Clear Cache Mode<>وضعية التحديث الاجبارية'),
			'status'=>($settings['clear_cache']==1?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>1
		],
		[
			'title'=>l('Clear Cache Mode Panel<>وضعية التحديث الاجبارية للوحة التحكم'),
			'status'=>($settings['clear_cache_panel']==1?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>1
		],
		[
			'title'=>l('Facebook Chat<>محادثة الفيسبوك'),
			'status'=>(connection('facebook_page_id')==''?false:true),
			'status_words'=>['false'=>'off','true'=>'on'],
			'priority'=>3
		]
	];

	$__tests_counts=[
		'0'=>0,
		'1'=>0,
		'priorities'=>[
			'1'=>['count'=>0,'1'=>0,'0'=>0],
			'2'=>['count'=>0,'1'=>0,'0'=>0],
			'3'=>['count'=>0,'1'=>0,'0'=>0]
		]
		];

	$__test_colors=[
		'0'=>colorRange('#f54242',count($__tests),'#b00202'),
		'1'=>colorRange('#12cc28',count($__tests),'#01630d'),
		'low_priorirty'=>colorRange('#bcbcbc',count($__tests),'#898585')
	];

	foreach($__tests as  $g=>&$__test){
		$__tests_counts['priorities'][$__test['priority']]['count']++;
		$__tests_counts['priorities'][$__test['priority']][$__test['status']]++;
		$__tests_counts[$__test['status']]++;
		$__test['color']=$__test_colors[$__test['status']][$g];
		if(!$__test['status'] && $__test['priority']>1)$__test['color']=$__test_colors['low_priorirty'][$g];
		$__test['sort']=$__test['status']+($__test['status']?$__test['priority']+10:$__test['priority']-1);

		
	}

	$__test_width=100/count($__tests);
	usort($__tests,function($a,$b){if(!isset($a['sort']))return -1;return $a['sort']<=>$b['sort'];});


	json(true,1,[
		'__tests'=>$__tests,
		'__test_width'=>$__test_width

	]);
}

elseif(i('storage_disk')){
	$_root_disk=disk(root);
	// d($_root_disk);
	$_uploads=disk(target_dir)['m'];
	$_disk_space=[];

	$_disk_space[]=['title'=>l('ProVision Legion Engine<>محرك بروفجن Legion'),
		'class'=>'l_cloud',
		'parent'=>NULL,
		'size'=>disk(panel_dir)['m'],
		'sort'=>1
		];

	$_disk_space[]=['title'=>l('Videos<>مقاطع فيديو'),
		'class'=>'l_pink',
		'parent'=>target_dir,
		'sort'=>10,
		'size'=>sum('files_1577206823',"WHERE type='file' AND sub_type='video'",'size')
		];

	$_disk_space[]=['title'=>l('Photos<>الصور'),
		'class'=>'l_gold',
		'parent'=>target_dir,
		'size'=>sum('files_1577206823',"WHERE type='photo'",'size'),
		'sort'=>2
		];

	$_disk_space[]=['title'=>l('Fonts<>الخطوط'),
		'class'=>'l_sea',
		'parent'=>target_dir,
		'size'=>sum('files_1577206823',"WHERE type='font' ",'size'),
		'sort'=>10
		];

	$_disk_space[]=['title'=>l('Mail<>البريد الالكتروني'),
		'class'=>'l_sky',
		'parent'=>NULL,
		'size'=>disk(root.'mail')['m'],
		'sort'=>10
		];

	$_disk_space[]=['title'=>l('Other Uploaded Files<>ملفات مرفوعة أخرى'),
		'class'=>'l_lime',
		'parent'=>target_dir,
		'size'=>sum('files_1577206823',"WHERE type='file' AND sub_type=''",'size'),
		'sort'=>10
	];


	$__total_spaces=0;
	$__total_uploads=$_uploads;
	foreach($_disk_space as $_disk){
		if($_disk['parent']==target_dir)
			$__total_uploads-=$_disk['size'];
		$__total_spaces+=$_disk['size'];
	}

	$__total_spaces+=$__total_uploads;

	$_disk_space[]=['title'=>l('Thumbnails<>الصور المصغرة'),
		'class'=>'l_apricot',
			'size'=>$__total_uploads,
			'sort'=>3
		];


	$_trash_disk=disk(root.'.trash');
	$_disk_space[]=['title'=>l('Trash<>سلة المهملات'),
		'class'=>'l_purple',
		'size'=>$_trash_disk['m'],
	'sort'=>10
	];

	$_disk_space[]=['title'=>l('Other Files<>ملفات أخرى'),
		'class'=>'l_cloud',
		'size'=>$_root_disk['m']-$__total_spaces-$_trash_disk['m'],
	'sort'=>10
	];


	foreach($_disk_space as &$_disk){
		$_disk['width']=1+(($_disk['size']/$_root_disk['m'])*(100-(count($_disk_space)*1)));

		$_disk['size']=mb($_disk['size']*1024*1024);
		
		if($_disk['size']>=1000)
			$_disk['size']=mb($_disk['size']*1024*1024,'G',2).' '.l('GB<>ج.ب');
		elseif($_disk['size']<1)
			$_disk['size']=mb($_disk['size']*1024*1024,'K',2).' '.l('KB<>ك.ب');
		elseif($_disk['size']<1000)
			$_disk['size']=mb($_disk['size']*1024*1024,'M',2).' '.l('MB<>م.ب');
	}

	usort($_disk_space,function($a,$b){if(!isset($a['sort']))return -1;return $a['sort']<=>$b['sort'];});
			
	json(true,1,[
		'_root_disk'=>$_root_disk,
		'_root_disk_rounded'=>round($_root_disk['g'],2),
		'_disk_space'=>$_disk_space

	]);
}

elseif(i('del')){
	delete(e('del'),true);
	//already process others like link handler and fonts
	j();
}

elseif(i('canvas')){
//	dpd();
	if(!file_exists(target_dir.$_POST['filename']))json(false);
	if($_POST['canvas_field']==NULL || $_POST['filename']==NULL)json(false,4);
	
	$x=explode('.',$_POST['filename']);
	
	$img = str_replace('data:image/'.str_replace('jpg','jpeg',$x[1]).';base64,','', $_POST['canvas_field']);
//	dd($img);
	$img = str_replace(' ','+',$img);
	$data = base64_decode($img);
	
	if(!file_exists(target_dir.'original_'.$_POST['filename'])){
		if(!copy(target_dir.$_POST['filename'],target_dir.'original_'.$_POST['filename']))json(false);
		}
//	16669914071447831770
	foreach (glob(target_dir."*".$x[0]."*") as $filename) {
//		echo $filename;
		if(strpos($filename,'original_'))continue;
    	trash($filename);
	}
	$res = file_put_contents(target_dir.$_POST['filename'], $data);
	if(!$res)json(false);
	json(true,2);
}


elseif(i('uploadFast')){
	if($_FILES['file']['name'][0]==NULL)json(false,4);
	else {
		$module='uploader_1585790561';
		$file=escape(upload_file('single','file',$settings['file'],target_dir,'uploader_1585790561',false));
		json(true,1,'<div class="prebread_resp">
		<div class="prebread_item_row_sec">HTML</div>
		<div class="prebread_item_row copier po" onclick="c(\''.$file.'\');">'.$file.'</div>
		<div class="prebread_item_row copier po" onclick="c(\'/uploads/'.$file.'\');">/uploads/'.$file.'</div>
		<div class="prebread_item_row copier po" onclick="c(\''.u.$file.'\');">'.u.$file.'</div>
	</div>');
	}
	json(false);
}

elseif(i('qr')){
	$arr=[
		'cht'=>'qr',
		'chld'=>'H|0',
		'chco'=>str_replace('#','',$_POST['color']),
		'choe'=>'UTF-8',
		'chs'=>$_POST['dimension'].'x'.$_POST['dimension'],
		'chl'=>$_POST['value']];
		
		if($_POST['hash_origin']!=''){
		$_POST['hash']=hash_hmac('sha256',$_POST['hash_origin'],secret_key);
			$arr['chl'].='?hash='.$_POST['hash'];
			$_POST['value'].='?hash='.$_POST['hash'];
		}
	
	$fields=http_build_query($arr);
	$link='http://chart.apis.google.com/chart?'.$fields;
	$_POST['photo']=fileFromLink($link);
	co('codes_8311');
	$l=r('codes_8311');

	json(true,1,'<div class="prebread_resp">
		<div class="prebread_item_row_sec">HTML</div>
		<div class="prebread_item_row copier po" onclick="copy(this);">'.$_POST['photo'].'</div>

		<a target="_blank" class="prebread_item_row copier po" href="'.u.$_POST['photo'].'"><img src="'.u.$_POST['photo'].'"/></div>
	</div>');

	json(false);
}

elseif(i('menu_item_get')){
	jx(array('js'=>'menu_item_get_callback','data'=>o('menu_items_1564508835',e('menu_item_get'))[0]));
}



else if(i('action') && $_POST['action']=='export_csv'){
	$module=e('module');
	$where=NULL;
	
	if(i('ids') && $_POST['ids']!=NULL)
		$where="WHERE id IN (".e('ids').")";
	$resp=db($module,$where);
	
	$res=array();
	if($resp!=1){
		$fields=moduleFields(array('module_prefix'=>$module,'module_id'=>mid($module)))[3];
		array_unshift($fields,array('field_name'=>'id','label'=>'ID<>رقم المعرّف','type'=>'number'));
		foreach($resp as $r){
				$res[]=fieldsProcess($r,$fields,$module);
		}
		
		$field_names=array();
		foreach($fields as $f){
			$field_names[]=l($f['label']);
		}
	}

	el($module,NULL,'export_csv');
	jx(array('js'=>'exported','link'=>urlPanel.'exported/'.csv($res,mn($module).' '.cleanDate($date_created),$field_names)));
	
}


else if(i('action') && $_POST['action']=='mass_change'){
//	dp();
	// dd();
	
	if(i('ids') && $_POST['ids']!=NULL)
		$where="WHERE id IN (".e('ids').")";
	else json(false,4);
	$module=e('affected_module');
	$resp=db($module,$where);
	$tmp=$_POST;
	foreach($resp as $r){
//		$_POST=NULL;
		$_POST=[$tmp['mass_field']=>$tmp['mass_value']];
		co($module,$r['id']);
//		dp();
		r($module,'edit');
		el($module,$r['id'],'mass_change');
	}
	
	j();
//	json();
}
	
else if(i('action') && $_POST['action']=='export_csv_as_db'){
	$module=e('module');
	if(i('ids') && $_POST['ids']!=NULL)
		$where="WHERE id IN (".e('ids').")";
	else
		$where=NULL;
	$resp=db($module,$where);
	
	$res=array();
	if($resp!=1){
		$fields=moduleFields(array('module_prefix'=>$module,'module_id'=>mid($module)))[3];
		array_unshift($fields,array('field_name'=>'id','label'=>'ID<>رقم المعرّف','type'=>'number'));
		foreach($resp as $r){
				$res[]=fieldsProcess($r,$fields,$module,false,true);
		}
		
		$field_names=array();
		foreach($fields as $f){
			$field_names[]=$f['label'];
		}
	}

	

	el($module,NULL,'export_csv_as_db');

	jx(array('js'=>'exported','link'=>urlPanel.'exported/'.csv($res,mn($module).' '.cleanDate($date_created),$field_names)));
	
}



else if(i('action') && $_POST['action']=='export_xls'){
	$module=e('module');
	if(i('ids') && $_POST['ids']!=NULL)
		$where="WHERE id IN (".e('ids').")";
	$resp=db($module,$where);
	
	$res=array();
	if($resp!=1){
		$fields=moduleFields(array('module_prefix'=>$module,'module_id'=>mid($module)))[3];
		array_unshift($fields,array('field_name'=>'id','label'=>'ID<>رقم المعرّف','type'=>'number'));
		foreach($resp as $r){
			
				$res[]=fieldsProcess($r,$fields,$module,true);
		}
		
		$field_names=array();
		foreach($fields as $f){
			$field_names[]=l($f['label']);
		}
	}

	el($module,NULL,'export_xls');
	jx(array('js'=>'exported','link'=>urlPanel.'exported/'.xls($res,mn($module).' '.cleanDate($date_created).'_'.rand(),$field_names)));
	
}




else if(isset($_POST['pexel'])){
	$_m='files_1577206823';
	
	$resp=docurl($_POST['link'],NULL,false,true,false,array('Authorization:563492ad6f91700001000001533312341bfb45b7b32ae9df0e3f3e6d'));
	
	if($resp==NULL)json(false,97);
		
	if($_POST['file_type']=='photos'){
		for($i=0;$i<count($resp['photos']);$i++){
			$tmp=db($_m,"WHERE reference='".escape($resp['photos'][$i]['id'])."'",NULL,'LIMIT 1');
			if($tmp!=1){
				$resp['photos'][$i]['in_server']=true;
				$resp['photos'][$i]['server_file_info']=array(
					'url'=>u.$tmp[0]['full_name'],
					'desca'=>$tmp[0]['caption'],
					'filename'=>$tmp[0]['full_name'],
					'thumbnail_url'=>u.img($tmp[0]['full_name'],200,100),
					'originalFileName'=>$tmp[0]['original_name'],
					'name'=>$tmp[0]['original_name']
				);
			}
			else $resp['photos'][$i]['in_server']=false;
		}
	}else{
		for($i=0;$i<count($resp['videos']);$i++){
			$tmp=db($_m,"WHERE reference='".escape($resp['videos'][$i]['id'])."'",NULL,'LIMIT 1');
			if($tmp!=1){
				$resp['videos'][$i]['in_server']=true;
				$resp['videos'][$i]['server_file_info']=array(
					'url'=>u.$tmp[0]['full_name'],
					'desca'=>$tmp[0]['caption'],
					'filename'=>$tmp[0]['full_name'],
					'thumbnail_url'=>pres.'imgs/mp4.png',
					'originalFileName'=>$tmp[0]['original_name'],
					'name'=>$tmp[0]['original_name']
				);
			}
			else $resp['videos'][$i]['in_server']=false;
		}
	}
	
	
	json(true,2,$resp,NULL,array('js'=>'pexel_process'));
}

else if(isset($_POST['download_pexel'])){

	global $conn,$settings,$date_created,$admin_add_id;
	$_m='files_1577206823';
	
	$tmp=$_POST;
//	dp();
	$pexel_item=json_decode($_POST['pexel_item'],true);
	
	$content=download_content($tmp['file_type']=='photos'?$pexel_item['src']['large2x']:$pexel_item['video_files'][3]['link']);
	if($content===false)json(false,96);
	
	$x=explode('/',$pexel_item['url']);
	
	$originalName=$tmp['file_type']=='photos'?end(explode('/',$pexel_item['src']['original'])):$x[count($x)-2];
	$extension=$tmp['file_type']=='photos'?strtolower(end(explode('.',$originalName))):'mp4';
	$fileName=time().rand();
	$target_file=$fileName.'.'.$extension;
	file_put_contents(target_dir.$target_file,$content);
	
	if($tmp['file_type']=='photos')
		$picInfo=picInfo($target_file);

	
	
	
	$_POST=array();
	$_POST['full_name']=$target_file;
	$_POST['name']=$fileName;
	$_POST['original_name']=$x[count($x)-2].'.'.$extension;
	$_POST['extension']=$extension;
	$_POST['width']=$tmp['file_type']=='photos'?$picInfo['width']:$pexel_item['width'];
	$_POST['height']=$tmp['file_type']=='photos'?$picInfo['height']:$pexel_item['height'];
	$_POST['quality']=100;
	$_POST['size']=mb(filesize(target_dir.$target_file));
	$_POST['source_name']='Pexels';
	$_POST['source_link']=$pexel_item['url'];
	$_POST['reference']=$pexel_item['id'];
	$_POST['average_color']=$tmp['file_type']=='photos'?$pexel_item['avg_color']:'';
	$_POST['credit']=$tmp['file_type']=='photos'?$pexel_item['photographer']:$pexel_item['user']['name'];
	$_POST['credit_link']=$tmp['file_type']=='photos'?$pexel_item['photographer_url']:$pexel_item['user']['url'];
	$_POST['caption']=$tmp['file_type']=='photos'?$pexel_item['alt']:'';
	$_POST['type']=$tmp['file_type']=='photos'?'photo':'file';
	$_POST['sub_type']=$tmp['file_type']=='photos'?'':'video';
	$_POST['uploader_user_id']=isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$_POST['uploader_module_prefix']=isset($_SESSION['module_id'])?$_SESSION['module_id']:0;
	co($_m);
	$last_id=r($_m);

	$t=db($_m,"WHERE id='".$last_id."'",NULL,'LIMIT 1');
	
	$arr=array(
				'url'=>u.$t[0]['full_name'],
				'desca'=>$t[0]['caption'],
				'filename'=>$t[0]['full_name'],
				'thumbnail_url'=>$tmp['file_type']=='photos'?u.img($t[0]['full_name'],200,100):pres.'imgs/mp4.png',
				'originalFileName'=>$t[0]['original_name'],
				'name'=>$t[0]['original_name'],
				'reference'=>$t[0]['reference']
			);
	
	el('files_1577206823',$last_id,'download_pexel');
	json(true,2,$arr,NULL,array('js'=>'file_from_link_callback'));
}


elseif(i('field_checker')){
	$field=db('module_fields',"WHERE field_name='".e('field')."' AND module_id='".mid($_POST['module'])."'");
	if($field==1)json(false);
	
	$field=$field[0];
	$value=e('value');
	if($field['is_unique']){
		$tmp=db(e('module'),"WHERE ".$field['field_name']."='$value'",NULL,'LIMIT 1');
		if($tmp!=1 && $tmp[0]['id']!=$_POST['id'])json(false);
	}
	
	if($field['field_name']=='slug'){
		if(preg_match('/[\p{Arabic}\p{Hebrew}]/u',$value)
		  || preg_match('~[^-\w]+~',$value)
		  )json(false);
	}

	
	json();
}

elseif(isset($_POST['check_sms'])){
	if(defined('legion_token'))
		json(true,1,['balance'=>sms_balance()]);
}

else if(isset($_POST['slugify'])){
//$a=slugify(l($settings['site_short_name'],'en')==''?l($settings['site_short_name'],'en'):l($settings['site_name'],'en')).'-';
	$slug=slugify(l(e('text'),'en'));
	$tmp=db(e('module'),"WHERE ".e('to_class')."='$slug'");
	if($tmp==1)json(true,1,$slug);
	else json(true,1,$slug); //'-'.rand(1,100)
	json(false);
}



else if(isset($_POST['seen_notification'])){
	mysqli_query($conn,"UPDATE web_notifications_1644647708 SET seen=1 WHERE id='".e('id')."' AND user='".$_SESSION['user_id']."' AND user_module='".$_SESSION['module_id']."'  AND seen=0 LIMIT 1");
	
	jx(array('js'=>'mark_seen_notification','id'=>$_POST['id']));
	
}

else if(isset($_POST['checker'])){
	$engine_update=NULL;
	$sub_build_details=NULL;
	$notifications=NULL;
//json(false);
	if($_POST['check_new_version']=='true'){
		// d($_POST['check_new_version']);
		// mark($_POST['check_new_version']);
		$resp=docurl('https://legioncms.com/api/1.0/',array('api'=>'sub_build','main_version'=>main_version,'sub_version'=>sub_version,'website_link'=>cms_url),true);

		if((!isset($resp['data']['this_website']) || $resp['data']['this_website']['id']<$resp['data']['last_push']['id']) && super())
			$engine_update=array('link'=>urlPanel.'?module=settings&action=updater&lang='.curr());

		// if($_POST['got_sub_build']=='false'){
			$tmp=(!isset($resp['data']['this_website']['id']) || $resp['data']['this_website']['id']==NULL?0:$resp['data']['this_website']['id']);
			$sub_build_details=array(
				'this_sub_build'=>$tmp,
				'this_sub_build_with_dot'=>'.'.$tmp
			);
		// }
	}
	
	$tmp=db('web_notifications_1644647708',"WHERE user_module='".$_SESSION['module_id']."' AND user='".$_SESSION['user_id']."' AND id>'".e('last_notification_id')."' AND deleted=0","ORDER BY id ASC");
	if($tmp!=1 && $tmp!=0){
		$notifications=array();
		for($i=0;$i<count($tmp);$i++){
			$notifications[]=processNotification($tmp[$i]);
		}
	}
	jx(array('js'=>'checked','engine_update'=>$engine_update,'sub_build_details'=>$sub_build_details,'notifications'=>$notifications));
}


else if(isset($_POST['updater'])){
	
	
	if(!isset($_POST['updater_type']) || !isset($_POST['google_auth_code']) || $_POST['google_auth_code']=='')json(false,4);
	
	el('settings',NULL,$_POST['updater_type']);

	if($_POST['updater_type']=='pull_updater'){
		
		$res=docurl('https://legioncms.com/api/1.0/',array('api'=>'puller','google_auth_code'=>$_POST['google_auth_code'],'main_version'=>main_version,'sub_version'=>sub_version,'website_link'=>cms_url),true);
	
		$_POST['internal']=true;
		json($res['response'],$res['code']);
	

		$pre=cms_dir.'preupdater.php';
		//CUSTOM STARTS for Almanara coz of SSL error of streaming file from legioncms.com
		$arrContextOptions = array(
			"ssl" => array(
			"verify_peer" => false,
			"verify_peer_name" => false,
			)
		);  

		$context = stream_context_create($arrContextOptions);
		$contents = file_get_contents($res['data']['pre_link'],false,$context);
		$file=fopen($pre,'w');
		fwrite($file,$contents);
		fclose($file);

		include $pre;
		
		json();
	}
	
	
	
	$res=docurl('https://legioncms.com/api/1.0/',array('api'=>'prepush','google_auth_code'=>$_POST['google_auth_code'],'main_version'=>main_version,'sub_version'=>sub_version,'website_link'=>cms_url),true);

	$pre=cms_dir.'prepusher.php';
	//CUSTOM STARTS for Almanara coz of SSL error of streaming file from legioncms.com
	$arrContextOptions = array(
		"ssl" => array(
		"verify_peer" => false,
		"verify_peer_name" => false,
		)
	);  

	$context = stream_context_create($arrContextOptions);
	$contents = file_get_contents($res['data']['pre_link'],false,$context);
	$file=fopen($pre,'w');
	fwrite($file,$contents);
	fclose($file);
	include $pre;
	
	j();
}


else if(i('action') && $_POST['action']=='sort_entries'){
	$_m=e('module');
	if(isset($_POST['clear_sort_all'])){
		if(!mysqli_query($conn,"UPDATE $_m SET order_number=1000"))json(false);
	}
	
	if($_POST['id']!=NULL){
		for($i=0;$i<count($_POST['id']);$i++){
			if(!mysqli_query($conn,"UPDATE $_m SET order_number=$i WHERE id='".escape($_POST['id'][$i])."' LIMIT 1"))json(false);
		}
	}
	
	el($_m,$last_id,$_POST['action']);
	j();
}

else if(isset($_POST['module']) && $_POST['module']=='uploader'){
	require panel_dir.'uploader.php';
	json(false);
}


else if(i('action') && $_POST['action']=='floodTrash'){
		$module_prefix=escape($_POST['module']);
	
	if($module_prefix=='files_1577206823'){
		$resp=db($module_prefix,"WHERE deleted=1");
		for($i=0;$i<count($resp);$i++){
			$target_dir=$resp[$i]['protected_file']=='1'?_protected:target_dir;
			foreach (glob($target_dir."*".$resp[$i]['name'].'*') as $filename) {
				trash($filename);
			}
		}
	}
		if(mysqli_query($conn,"DELETE FROM $module_prefix WHERE deleted=1")){
			el($module_prefix,NULL,$_POST['action']);
			json(true,2,NULL,NULL,['js'=>'redirect',"url"=>returnUrl()]);
		}
		json(false);
	}


else if(isset($_POST['module']) && $_POST['module']=='active'){
        $id=id();
		$module_prefix=escape($_POST['module_prefix']);
		$booleanField=escape($_POST['booleanField']);
		if(!mysqli_query($conn,"UPDATE $module_prefix SET $booleanField=1-$booleanField WHERE id='$id' LIMIT 1"))json(false);
		el($module_prefix,$id,'active',$booleanField.' = '.o($module_prefix,$id)[0][$booleanField]);
		json(true,43,NULL,NULL,['js'=>'switchActive','id'=>$id,'boolField'=>$booleanField]);
		
	}



else if(i('type') && $_POST['type']=='menu_style'){
	require core_dir.'modules/menu_style.php';
	json(false); 
	}

else if(i('darkMode')){
	$tmp=$_POST;
	$_POST=[];
	co('admins',$_SESSION['user_id']);
	if(filter_var($tmp['darkMode'], FILTER_VALIDATE_BOOLEAN))$_POST['dark_mode']=1;
	else unset($_POST['dark_mode']);
	r('admins','edit');
	json(); 
	}

else if(i('action') && $_POST['action']=='unfoldInstalled' && super()){
	if(mysqli_query($conn,"UPDATE settings SET unfoldInstalled=1-unfoldInstalled WHERE id=1 LIMIT 1"))json(true,65);
	json(false);
	}


else if(i('module') && $_POST['module']=='empty_table' && super()){
	$affected_module=i('affected_module')?e('affected_module'):e('id');
	mail('omar@provision.ps','Empty Table - '.$settings['site_short_name'],"
Table: $affected_module
User: ".$userInfoArr['username']."
Date: $date_created
URL:".url."
"
		);
	mysqli_query($conn,"TRUNCATE TABLE $affected_module");
	el($affected_module,NULL,'empty_table');
	json(true,27);
	}

elseif(i('module') && $_POST['module']=='toggle_restrict' && super()){
	$tableName=escape($_POST['id']);
	mysqli_query($conn,"UPDATE modules SET restricted=1-restricted WHERE module_prefix='$tableName'");
	json(true,2,NULL,NULL,['js'=>'refresh']);
	}

elseif(i('module') && $_POST['module']=='toggle_external_access' && super()){
	$tableName=escape($_POST['id']);
	mysqli_query($conn,"UPDATE modules SET external_access=1-external_access WHERE module_prefix='$tableName'");
	el($tableName,NULL,'toggle_external_access');
	json(true,2,NULL,NULL,['js'=>'refresh']);
	}





elseif(i('action') && $_POST['action']=='get_menu_items'){
	$module_prefix=escape($_POST['module_prefix']);
	$resp=db('module_settings',"WHERE module_prefix='$module_prefix' AND menu_field!=''",NULL,'LIMIT 1','menu_field');
	if($resp==0 || $resp==1)json(false);
	$menu_field=$resp[0]['menu_field'];
	$resp=db($module_prefix,NULL,NULL,NULL,$menu_field.',id');
	if($resp!=1)
		for($i=0;$i<count($resp);$i++){$resp[$i][$menu_field]=l($resp[$i][$menu_field]);}
	json(true,1,$resp,NULL,['js'=>'itemRefresher']);
}


elseif(i('action') && $_POST['action']=='sort_menu_items'){
	for($i=0;$i<count($_POST['sort_menu_item']);$i++){
		$id=escape($_POST['sort_menu_item'][$i]);
		mysqli_query($conn,"UPDATE menu_items_1564508835 SET order_num='$i',sub_of='0' WHERE id='$id' LIMIT 1");
	}
	if(isset($_POST['sorting_item_id']) && is_array($_POST['sorting_item_id'])){
		for($i=0;$i<count($_POST['sorting_item_id']);$i++){
			$_POST['sorting_item_id'][$i]=escape($_POST['sorting_item_id'][$i]);
			$exploded=explode('#',$_POST['sorting_item_id'][$i]);
			mysqli_query($conn,"UPDATE menu_items_1564508835 SET sub_of='".$exploded[1]."' WHERE id='".$exploded[0]."' LIMIT 1");
		}
	}
	json(true,2);
}


elseif(i('action') && $_POST['action']=='delete_menu_item'){
	$_POST['internal']=true;
	delete('menu_items_1564508835');
	json(true,2,NULL,NULL,['js'=>'refresh']);
}

elseif(i('meepoLoad')){
	if($_POST['meepoLoad']==0)
		$resp=db('meepo_1646265283',NULL,NULL,NULL,'id,title');
	else
		$resp=db('meepo_1646265283',"WHERE !deleted AND id=".e('meepoLoad'));

	if($resp!=1)fla($resp);
	json(true,1,$resp);
}


elseif(i('admin_settings')){
	co('admin_settings',$_SESSION['user_id'],'admin');
	$_POST[$_POST['toggle']]=1-(int)$_POST[$_POST['toggle']];
	r('admin_settings','edit');
	json(true,2);
}


//check if empty field is not empty or set
if (!isset($_POST['e']) || $_POST['e'] != "") json(false,8);
//validate type


if (!isset($_POST['module']) || $_POST['module']==NULL || !i('action') || $_POST['action']==NULL)json(false,8);
$module=escape($_POST['module']);
$action=escape($_POST['action']);


if($action=='restore'){
	if(privilege($module,'delete') && restore($module,$_POST['id'])){
		if($module=='fonts_1582219344')
		fonts();

		elseif($module=='link_handler_1566934564'){
			$_POST['internal']=true;
			require modules_dir.'settings/models/reset_htaccess.php';
		}elseif($module=='color_palette_1645099749'){
			$_POST['internal']=true;
			require modules_dir.'settings/models/reset_ui.php';
		}
		j();
	}
	json(false);
}

elseif($action=='multi_restore' && privilege($module,'delete')){
	$_POST['ids']=explode(',',$_POST['ids']);
	for($i=0;$i<count($_POST['ids']);$i++){
		if(!restore($module,$_POST['ids'][$i]))json(false,72);
	}
	if($module=='fonts_1582219344')
		fonts();

	elseif($module=='link_handler_1566934564'){
		$_POST['internal']=true;
		require modules_dir.'settings/models/reset_htaccess.php';
	}elseif($module=='color_palette_1645099749'){
		$_POST['internal']=true;
		require modules_dir.'settings/models/reset_ui.php';
	}
	j();
}



else if($action=='multi_delete_trash'){
	if(privilege($module,'edit')){
		$_POST['ids']=explode(',',$_POST['ids']);
		for($i=0;$i<count($_POST['ids']);$i++){
			el($module,$_POST['ids'][$i],$action);
			if(!mysqli_query($conn,"DELETE FROM $module WHERE id='".escape($_POST['ids'][$i])."' LIMIT 1"))json(false,72);
		}
		if($module=='fonts_1582219344')
		fonts();

		elseif($module=='link_handler_1566934564'){
			$_POST['internal']=true;
			require modules_dir.'settings/models/reset_htaccess.php';
		}elseif($module=='color_palette_1645099749'){
			$_POST['internal']=true;
			require modules_dir.'settings/models/reset_ui.php';
		}
		j();

		}
	json(false);
}


else if($action=='add_in_menu'){
	$_POST['module_field']=detail('module_settings','menu_field','module_prefix',e('module_prefix'));
    if($_POST['module_field']==NULL)$_POST['module_field']='NA';
	$action=$_POST['action']='add';
	$_POST['force_refresh']=true;
}


else if($action=='edit_in_menu'){
	$_POST['module_field']=detail('module_settings','menu_field','module_prefix',e('module_prefix'));
    if($_POST['module_field']==NULL)$_POST['module_field']='NA';
	$action=$_POST['action']='edit';
	$_POST['force_refresh']=true;
}




else if($action=='insert_test' && privilege($module,'add')){
	
	$module_id=detail('modules','id','module_prefix',$module);
	
	$module_fields=db('module_fields',"WHERE module_id='$module_id'");
	
	for($i=0;$i<(int)$_POST['count'];$i++){
		foreach($module_fields as $field){
			$_POST[$field['field_name']]=dummer($field);
		}

		completer($module);
		r($module);
	}

	el($module,NULL,'insert_test');
	
	j();
}

else if($action=='multi_delete'){#delete function tests privilege, dont worry 
	$_POST['ids']=explode(',',$_POST['ids']);
	for($i=0;$i<count($_POST['ids']);$i++){
		$_POST['id']=$_POST['ids'][$i];
		if(!delete($module,true))json(false,71);
	}
	if($module=='fonts_1582219344')
		fonts();
	elseif($module=='link_handler_1566934564'){
		$_POST['internal']=true;
		require modules_dir.'settings/models/reset_htaccess.php';
	}elseif($module=='color_palette_1645099749'){
		$_POST['internal']=true;
		require modules_dir.'settings/models/reset_ui.php';
	}

	
	
	j();
}


else if($action=='multi_copy' && privilege($module,'add')){
	$module_id=detail('modules','id','module_prefix',$module);
	$ids=explode(',',$_POST['ids']);
	$last_id=intval(db($module,"WHERE id!=''",NULL,'LIMIT 1','id')[0]['id']);
	

	
	for($i=0;$i<count($ids);$i++){
		$last_id++;
	$f=NULL;
	$resp=db($module,"WHERE id='".$ids[$i]."'",NULL,'LIMIT 1')[0];
		if($resp==NULL)json(false,98);
	$keys= array_keys($resp);
	for($j=0;$j<count($keys);$j++){
		if($keys[$j]=='id')$resp[$keys[$j]]=$last_id;
		$f.="'".escape($resp[$keys[$j]])."',";
	}
		$f=rtrim($f,',');
		if(!mysqli_query($conn,"INSERT INTO $module VALUES ($f)"))json(false,3);
		}
	
	el($module,NULL,'multi_copy');
	j();
}



elseif($action=='copy' && privilege($module,'add')){
	$module_id=detail('modules','id','module_prefix',$module);
	$last_id=intval(db($module,"WHERE id!=''",NULL,'LIMIT 1','id')[0]['id']);
	
	$last_id++;
	$f=NULL;
	$resp=db($module,"WHERE id='".e('id')."'",NULL,'LIMIT 1')[0];
	$keys=array_keys($resp);
	for($j=0;$j<count($keys);$j++){
		if($keys[$j]=='id')$resp[$keys[$j]]=$last_id;
		$f.="'".escape($resp[$keys[$j]])."',";
	}
		$f=rtrim($f,',');
		if(!mysqli_query($conn,"INSERT INTO $module VALUES ($f)"))json(false,3);
	
		el($module,$_POST['id'],'copy','expected new id = '.$last_id);
	j();
}


elseif($action=='import' && privilege($module,'add')){
	include_once modules_dir.'settings/models/'.$action.'.php';
	el($module,NULL,'import');
	json();
}



if(privilege($module,$action)){
	if($action=='delete'){delete($module);}
	else if($action=='list'){
		require_once core_dir.'modules/listSub.php';
		$m=db('module_settings',"WHERE module_prefix='$module'",NULL,"LIMIT 1");
		if($m==0 || $m==1)die('couldnt get module settings, contact ProVision');
		}
	
	else{
		if($module=='settings')el('settings',NULL,$action,'try');
		include_once modules_dir.$module.'/models/'.$action.'.php';
	}
}
json(false,3);