<?php
//ProVision
function clearCache($echo=true){
	global $settings,$insidePanel;
	if($insidePanel===true){
		if($settings['clear_cache_panel']==0)return;
	}else{
		if($settings['clear_cache']==0)return;
	}
	
	if($echo)
		echo '?clearCache=ProVisionIsBest_'.rand();
	else return '?clearCache=ProVisionIsBest_'.rand();
}

function urlp($slug){
	return url('pages_1478423482','single',$slug);
}

function pn($slug){
	return l(oneSlug('pages_1478423482',$slug,'title')[0]['title']);
}

function purl($mod,$action='list',$id=0){
	switch($action){
			case'list':
				return urlPanel.'?module='.$mod.'&action='.$action;
			break;
			case'add':
				return urlPanel.'?module='.$mod.'&action=add';
			break;
			case'edit':case'view':
				return urlPanel.'?module='.$mod.'&action='.$action.'&id='.$id;
			break;
		default:return NULL;
	}
	
}

function device($d){
	switch($d){
		case 1:return 'Web';
		case 2:return 'Apple';
		case 3:return 'Android';
		default:return 'NA';
	}
}

function processNotification($noti,$return_data=false,$user_id=0){
		$action_type=detail('module_actions','type','id',$noti['action_id']);
		$mod=o('modules',$noti['module_id'])[0];

	$class=$noti['seen']==0?'unseen_notification':'';
	$onmouse=$noti['seen']==0?'onmouseover="return sub({\'seen_notification\':true,\'id\':'.$noti['id'].',\'e\':\'\'},false,true)"':'';
	
	$href=NULL;
	
	if($noti['custom_link']!=NULL)
		$href='href="'.$noti['custom_link'].'"';


	if($href==NULL && priv($mod['module_prefix'],'edit',($user_id==0?$_SESSION['user_id']:$user_id)))
	$href='href="'.purl($mod['module_prefix'],'edit',$noti['related_id']).'"';



	$note='<li id="notification_'.$noti['id'].'" data-notification-id="'.$noti['id'].'" class="'.$class.'" '.$onmouse.'>';
	$note.="<a $href>";
	$note.='<i>'.mi($mod['module_prefix']).'</i>';
//	d(l($noti['custom_title']));
		if(l($noti['custom_title'])==''){
			if($action_type=='add')
				$txt="New: ".l($mod['module_name'],'en')."<>جديد".l($mod['module_name'],'ar')."";
			elseif($action_type=='edit')
				$txt="Edit: ".l($mod['module_name'],'en')."<>تعديل".l($mod['module_name'],'ar')."";
			else
				$txt=NULL;
			}else $txt=$noti['custom_title'];
	
	$note.=l($txt);
	$note.=($noti['related_id']==0?NULL:'<div class="_noti_related_id mid">'.$noti['related_id'].'</div>').'</a>';
	$note.='</li>';
	
	if($return_data)
		return ['title'=>$txt,'href'=>$href];
	return $note;
}

function csv(array &$array,$file_name=NULL,$fieldNamesArr=NULL)
{	
	if($file_name==NULL)$file_name=rand();
	trash(panel_dir.'exported/');
	indexer(panel_dir.'exported/');
	
	if(count($array)==0)return NULL;
		
	$df=fopen(panel_dir.'exported/'.$file_name.'.csv','w');
	fwrite($df, pack("CCC",0xef,0xbb,0xbf)); 
	
	if($fieldNamesArr==NULL)
		fputcsv($df, array_keys($array[0]));
	else
		fputcsv($df,$fieldNamesArr);
	
	foreach ($array as $row) {
	  fputcsv($df, $row);
	}
	fclose($df);
	return $file_name.'.csv';
}



function xls(array &$array,$file_name=NULL,$fieldNamesArr=NULL)
{
	global $settings,$created_date;
	if($file_name==NULL)$file_name=rand();
	trash(panel_dir.'exported/');
	indexer(panel_dir.'exported/');
	
   if(count($array)==0)return NULL;
	
	if($fieldNamesArr==NULL)
		$fieldNamesArr=array_keys($array[0]);
	
		
	$df=fopen(panel_dir.'exported/'.$file_name.'.xls', 'w');
	fwrite($df, pack("CCC",0xef,0xbb,0xbf)); 
	
	$default='<tr><th style="background:orange;color:black;" colspan="'.count($fieldNamesArr).'">'.l('Programmed by ProVision<>برمجة شركة بروفجن').' - www.provision.ps - Legion Engine V.'.version.'</th></tr>';
	
	$default.='<tr><th style="background:black;color:white;" colspan="'.count($fieldNamesArr).'">'.l('File from:<>الملف من').' '.l($settings['site_name']).' - '.url.'</th></tr>';

	$default.='<tr><th style="background:gray;color:white;" colspan="'.count($fieldNamesArr).'">'.l('Creation Date: ').cleanDate($created_date).'</th></tr>';
	
	$txt='<table style="direction:'.direction().';"><thead>'.$default.'<tr>';
	foreach($fieldNamesArr as $a){
		$txt.='<th style="border:1px solid black;">'.$a.'</th>';
	}
	$txt.='</tr></thead><tbody>';
	
	foreach($array as $a){
			$txt.='<tr>';
				foreach($a as $s){
					if(!str_starts_with($s,'<td'))$s='<td style="border:1px solid gray;mso-number-format:\'\@\';">'.$s.'</td>';
					$txt.=$s;
					
				}
			$txt.='</tr>';
		}
	
	$txt.='</tbody></table>';
//	d($txt);

	fwrite($df,$txt);
	fclose($df);
	return $file_name.'.xls';
}




// USER Auth [Start] for mobile used only - currently
//======================================================================

function userToken($user_id,$old_token=NULL,$module_prefix=NULL){
	global $conn,$date_created;
	
	$token= hash('whirlpool', $user_id.rand(), false); 
	
	//insert new token
	$_POST['user_id']=$user_id;
	$_POST['token']=$token;
	$_POST['module_prefix']=$module_prefix;
	$_POST['language']=currid();
	$_POST['app_version']=isset($_POST['_v'])?$_POST['_v']:'';
	co('tokens');
	r('tokens');	
	return $token;
}

//-----------------------------------------------------
//  Login
//-----------------------------------------------------

//login the user, set cookie #1
function logUserIn($user_id,$module_id){
	
	$_SESSION['user_id']=$user_id;
	$_SESSION['module_id']=$module_id;
	
	if(isset($_POST['rememberme']))setInCookie($user_id,$module_id);
}

//set cookie #2
function setInCookie($user_id,$module_id) {
	global $settings,$conn;
    $token = RandomToken(); 
	
	$browser=serialize(getBrowser());
	$browser_name=getBrowser()['name'];
	if(!mysqli_query($conn,"INSERT INTO cookies_1565697908 (user_id,token,browser,module_id,browser_name) VALUES ('$user_id','$token','$browser','$module_id','$browser_name')"))json(false,3);
	
    $cookie = $user_id . ':' . $token . ':' . $module_id;
    $hash = hash_hmac('sha256', $cookie, secret_key);
    $cookie .= ':' . $hash;
	    
    setcookie('legion', $cookie,time()+86400*30,'/',$settings['main_url'],$settings['http'],true);
}




function cl($code,$index){
	return l(c($code,$index));
}

function c($code,$index){
	$tmp=db('control_1566842582',"WHERE code='$code'",NULL,'LIMIT 1');
	if($tmp==1)return NULL;
	return $tmp[0][$index];
}

function parental($module,$parent_field,$id,$select_echo='title',$selected=NULL){
global $parental_sign;
	
	
     $resp=db($module,"WHERE deleted=0 AND $parent_field='".$id."'","ORDER BY $select_echo ASC",NULL,"id,$select_echo");
    if($resp!=1 && $resp!=0){
		$parental_sign++;
		$or=$parental_sign;
		for($k=0;$k<$parental_sign;$k++)$sign_text.='&nbsp;&nbsp;&nbsp;';
		
        for($i=0;$i<count($resp);$i++){?>
           <option  <?php echo($resp[$i]['id']==$selected ? 'selected' : ''); ?>  value="<?php echo $resp[$i]['id']?>"><?php echo $sign_text.l($resp[$i][$select_echo]);?></option>
          <?php if(parental($module,$parent_field,$resp[$i]['id'],$select_echo,$selected)==false){$parental_sign=$or;};                                               
   }
                            
 }else return false;
	
}



function dummer($field){
	if($field['field_name']=='admin_add_id' || $field['field_name']=='date_created')return;
	if($field['is_unique']=='1')return 'unique_'.rand();
		
	$loremBigEn="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
	
	$arBegin='<p dir="rtl">';
	$arEnd='</p>';
	
	$loremBigAr='خلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من عام في القدم. قام البروفيسور "ريتشارد ماك لينتوك" وهو بروفيسور اللغة اللاتينية في جامعة هامبدن-سيدني في فيرجينيا بالبحث عن أصول كلمة لاتينية غامضة في نص لوريم إيبسوم وهي "consectetur"، وخلال تتبعه لهذه الكلمة فيالأدب اللاتيني اكتشف المصدر الغير قابل للشك. فلقد اتضح أن كلمات نص لوريم إيبسوم تأتي من الأقسام من كتاب "حول أقاصي الخير والشر" للمفكر والذي كتبه في عام 45 قبل الميلاد. هذا الكتاب هو بمثابة مقالة علمية مطولة في نظرية الأخلاق، وكان له شعبية كبيرة في عصر النهضة. السطر الأول من لوريم إيبسوم " يأتي من سطر في القسم هذا الكتاب.';
	
	$enTitles=array('Lorem Ipsum is simply dummy text of the printing','Dummy text of the printing','PV Dev In Mercia and Ramallah','the leap into electronic typesetting, remaining essentially unchanged');
	
	$arTitles=array('الأدب اللاتيني الكلاسيكي منذ العام','هناك حقيقة مثبتة منذ زمن طويل','التركيز على الشكل الخارجي للنص أو شكل توضع','استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ','أحرف عوضاً عن استخدام هنا يوجد محتوى نصي');
	
	$loremBigMlNoMCE="$loremBigEn<>$loremBigAr";
	$loremBigMl="$loremBigEn<>".$arBegin.$loremBigAr.$arEnd;
	
	switch($field['type']){
			case'text':return $field['is_ml']?$enTitles[rand(0,count($enTitles)-1)].'<>'.$arTitles[rand(0,count($arTitles)-1)]:$enTitles[rand(0,count($enTitles)-1)];
			
			case'textarea':
				if($field['noMCE']=='1')return $field['is_ml'] ? $loremBigMlNoMCE:$loremBigEn;
				else return $field['is_ml'] ? $loremBigMl:$loremBigEn;
			
			case'file':
			if($field['sub_type']=='photo' && $field['protected_file']==0){
				$tmp=db('files_1577206823',"WHERE source_name='Pexels' AND type='photo' AND deleted=0","ORDER BY RAND()",'LIMIT 15');
//				d($tmp);
				if($field['multi_files']==0){
						if($tmp!=1)
							return $tmp[0]['full_name'];
						return 'facebook.jpg';
				}else{
					if($tmp!=1){
						$txt=NULL;
						foreach($tmp as $t){
							$txt.=$t['name'].',';
						}
						return rtrim($txt,',');
					}
				}
			}
			return NULL;
					
			
			case'date':
				if($field['field_name']=='publish_date')
					return date('Y-m-d', strtotime( '-'.rand(0,720).' days'));
			
				return date('Y-m-d', time());
			case'color':
				if($field['field_name']=='font_color')
					return '#ffffff';
				return rand_color();
			
			case'url':return url;
			case'checkbox':return 0;
			case'number':return rand(1,1000);
			case'select':
				$tmp=db($field['select_table'],NULL,'ORDER BY rand()','LIMIT 1');
				if($tmp==1)return 0;
				else return $tmp[0]['id'];
			case'time':return rand(8,15).':'.array(15,30,45,'00')[rand(0,3)];
			case'location':return array('31.90400648213999,35.1975251158001','31.908134752982047,35.19994317437523','31.902927323748607,35.197440448100686','31.920553879528505,35.205526770128024')[rand(0,3)];
			
			case'username':return rand_string();
			case'mobile':return '591'.rand(111111,999999);
			
		default:
//			d($field['type']);
			json(false,70);
	}
} 

function stars($rate=0,$canChange=false,$fieldName=''){
	$onchange=$canChange?' onClick="star_rate(this,\''.$fieldName.'\')"':NULL;
	
	$str='<div class="star_box">';
	if($rate>0){
		for($i=0;$i<$rate;$i++){
			$str.='<i class="full_star in nos star_item'.($canChange?' po':NULL).'"'.$onchange.'>star_rate</i>';
		}
		if(5-$rate!=0){
			for($i=0;$i<5-$rate;$i++){
				$str.='<i class="empty_star in nos star_item'.($canChange?' po':NULL).'"'.$onchange.'>star_rate</i>';
			}
		}
	}else{
		for($i=0;$i<5;$i++){
				$str.='<i class="empty_star in nos star_item'.($canChange?' po':NULL).'"'.$onchange.'>star_rate</i>';
			}
	}
	return $str.'</div>';
}



function goP($slug='signin'){
	echo '<script>window.location.href = "'.url.'page/'.$slug.'/'.curr().'";</script>';
}

function goHome($url=NULL){
	if($url==NULL)$url=url;
	echo '<script>window.location.href = "'.$url.curr().'";</script>';
}

function rgb2html($r, $g=-1, $b=-1){
	if(is_array($r) && sizeof($r)==3)
		list($r,$g,$b)=$r;

	$r=intval($r); 
	$g=intval($g);
	$b=intval($b);

	$r=dechex($r<0?0:($r>255?255:$r));
	$g=dechex($g<0?0:($g>255?255:$g));
	$b=dechex($b<0?0:($b>255?255:$b));

	$color=(strlen($r)<2?'0':'').$r;
	$color.=(strlen($g)<2?'0':'').$g;
	$color.=(strlen($b)<2?'0':'').$b;
	return '#'.$color;
}
		
function hexToRgb($hex,$alpha=false) {
   $hex      = str_replace('#', '', $hex);
   $length   = strlen($hex);
   $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
   $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
   $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
   if($alpha){
      $rgb['a']=$alpha;
   }
   return $rgb;
}

function alphaHex($alpha=100){
	if($alpha>100)$alpha=100;
	$alpha_arr = array(100 => 'FF', 99 => 'FC', 98 => 'FA', 97 => 'F7', 96 => 'F5', 95 => 'F2', 94 => 'F0', 93 => 'ED', 92 => 'EB', 91 => 'E8', 90 => 'E6', 89 => 'E3', 88 => 'E0', 87 => 'DE', 86 => 'DB', 85 => 'D9', 84 => 'D6', 83 => 'D4', 82 => 'D1', 81 => 'CF', 80 => 'CC', 79 => 'C9', 78 => 'C7', 77 => 'C4', 76 => 'C2', 75 => 'BF', 74 => 'BD', 73 => 'BA', 72 => 'B8', 71 => 'B5', 70 => 'B3', 69 => 'B0', 68 => 'AD', 67 => 'AB', 66 => 'A8', 65 => 'A6', 64 => 'A3', 63 => 'A1', 62 => '9E', 61 => '9C', 60 => '99', 59 => '96', 58 => '94', 57 => '91', 56 => '8F', 55 => '8C', 54 => '8A', 53 => '87', 52 => '85', 51 => '82', 50 => '80', 49 => '7D', 48 => '7A', 47 => '78', 46 => '75', 45 => '73', 44 => '70', 43 => '6E', 42 => '6B', 41 => '69', 40 => '66', 39 => '63', 38 => '61', 37 => '5E', 36 => '5C', 35 => '59', 34 => '57', 33 => '54', 32 => '52', 31 => '4F', 30 => '4D', 29 => '4A', 28 => '47', 27 => '45', 26 => '42', 25 => '40', 24 => '3D', 23 => '3B', 22 => '38', 21 => '36', 20 => '33', 19 => '30', 18 => '2E', 17 => '2B', 16 => '29', 15 => '26', 14 => '24', 13 => '21', 12 => '1F', 11 => '1C', 10 => '1A', 9 => '17', 8 => '14', 7 => '12', 6 => '0F', 5 => '0D', 4 => '0A', 3 => '08', 2 => '05', 1 => '03', 0 => '00');
	return $alpha_arr[$alpha];
}
function colorRange($a=NULL,$steps=5,$b=NULL,$alpha=NULL){
	global $settings;
	  
	if($a==NULL)$a=$settings['main_color'];
	if($b==NULL)$b='000000';

	$steps--;
	$a=hexToRgb($a);
	$b=hexToRgb($b);
	$step=array();
	$result=array();

	// Prepare steps
	foreach(array('r','g','b') as $color){
		$step[$color]=($b[$color]-$a[$color])/$steps;
	}

	for($i=0;$i<=$steps;$i++){
		$tmp=array();
		foreach(array('r','g','b') as $color){
			$tmp[$color]=$a[$color]+floor($step[$color]*$i);
		}
		$result[]=rgb2html($tmp['r'],$tmp['g'],$tmp['b']).($alpha==NULL?NULL:alphaHex($alpha));
	}
	return $result;
}

//legacy
function colorz($steps=3){
	return colorRange(NULL,NULL,$steps);
}

function state($value){ 
	if($value){
		return '<i class="indic_i green">done</i>';
	}else{
		return '<i class="indic_i red">clear</i>';
	}
}


function stater($value){
	return state(!$value);
}


function field_html($_module,$_field,$curr=NULL){
	$field=ow('module_fields',"module_id=".mid($_module)." AND field_name='$_field'");
	// d($field);
	if($field==1)return NULL;

	$txt=NULL;

	$class=$_module.'_'.$field['field_name'];
	$unique_class=$class.rand();

	switch($field['type']){
		case'select':
			
			if($field['sub_sub_type']=='grid'){
				
				$_fellow=db($field['select_table']);
				
				if($_fellow!=1){
					$txt.='<div class="l_grid_select">
					<div class="form_field  '.$class.'" data-legion-field-type="select">
					<label for="for_field_status">'.l($field['label']).'</label>
					<div class="input_area">
					';
					$txt.='<input type="hidden" id="'.$unique_class.'" name="'.$_field.'" value="'.$curr.'"/>';
					foreach($_fellow as $f){
						$txt.='<div data-l_field_value="'.$f['id'].'" data-l_field_name="'.$_field.'" class="l_btn l_btn_small l_select_grid_item l_mr5 l_mb10 l_f12 in l_gray '.$unique_class.($curr==$f['id']?' l_btn_active':NULL).'" onclick="$(\'#'.$unique_class.'\').val(\''.$f['id'].'\');mass(this,\''.$unique_class.'\')">'.l($f[$field['select_field']]).'</div>';
					}
					$txt.='</div></div></div>';
				}
			}
			break;
	}

	// d($txt);
	return $txt;
}



function s_b_where($_stats_field,$r){
	$_stats_wheres=[];
	$count=1;
	for($i=2;$i<6;$i++){
		if(isset($r['dataset_'.$i.'_free_where']) && $r['dataset_'.$i.'_free_where']!=NULL)
			$count++;
	}
//	dd($count);
	
	for($i=0;$i<$count;$i++){
//		$state='!deleted';
		switch($r['dataset_'.($i+1).'_state']){
			case'Not Deleted':$state='!deleted';break;
			case'Deleted':$state='deleted';break;
			case'Both':$state="1=1";break;
			default:$state='!deleted';break;
		}

		if(isset($_SESSION['user_id']))
			$user_id=$_SESSION['user_id'];

		$free_where=$r['free_where'];
		if($r['free_where']!=NULL){

			$free_where=str_replace('$\\','$',$r['free_where']);
			$free_where=str_replace('$user_id',$user_id,$free_where);
			// $free_where=eval($free_where);
		}
		
		// $free_where="user={$\_SESSION['user_id']}";
		
		// 
		$_stats_where="WHERE $state $free_where";
		// echo $_stats_where;
		
		// $am="WAKA WAKA $omar";
		// echo $am;

		if($r['compare_sign']!='' && $r['compared_value']!=''){
			$simple_stats_where=' AND '.$_stats_field[0]['field_name'].$r['compare_sign'].$r['compared_value'];
			}
		else $simple_stats_where=NULL;

		$_stats_where.=$simple_stats_where;

		if($r['type']=='Chart'){
			if($r['vs_time'])
				$_stats_where.=' AND mintime + INTERVAL seq.seq DAY = date('.dim($r['module_prefix']).'.date_created)';
		}

		if($r['dataset_'.($i+1).'_free_where']!=NULL){
			$_stats_where.=$r['dataset_'.($i+1).'_free_where'];
		}
		
		$_stats_wheres[]=$_stats_where;
	}

	
	
	return $_stats_wheres;
}

function s_item_data($id){
	$r=o('statistics_8324',$id);

	if($r!=1){
		$r=$r[0];
		$_stats_big_arr=[];
		$_stats_field=o('module_fields',$r['module_field']);
		$_stats_wheres=s_b_where($_stats_field,$r);
		// d($_stats_wheres);
		//Count one shot, return and thats it
		if($r['type']=='Count'){

			$tmp=gc(dim($r['module_prefix']),$_stats_wheres[0]);
//			
			return ['analytics'=>[['data'=>NULL,'total'=>$tmp,'item'=>$r]],'grand_total'=>$tmp];
		}
		elseif($r['type']=='Chart'){
			$labels=[];
			$colors=[];$borders=[];//check note at the end of the function
			foreach($_stats_wheres as $key=>$w){
				// d($w);
				$_stats_data=[];
				$total=0;
				
				if($r['vs_time']){
					// $start=microtime(true);
					// m(start())
					$_stats_resp=dbs('SELECT DATE_FORMAT(mintime + INTERVAL seq.seq DAY,"%m-%d") AS title, (select count(*)
									from '.dim($r['module_prefix']).'
									'.$w.'
								   ) as _counter
							  FROM (
									SELECT MIN(DATE("'.date('Y-m-d',strtotime('-'.$r['days'].' day',strtotime(date('Y-m-d')))).'")) AS mintime,
										   MAX(DATE("'.date('Y-m-d').'")) AS maxtime
									  FROM '.dim($r['module_prefix']).'
								   ) AS minmax
							  JOIN seq_0_to_999999 AS seq ON seq.seq <= TIMESTAMPDIFF(DAY,mintime,maxtime)');
							//   m('where: '.$w.' module: '.dim($r['module_prefix']).' Duration: '.microtime(true)-$start);
						foreach($_stats_resp as $t){
							$_stats_data[]=$t['_counter'];
							$total+=$t['_counter'];
							if($key==0)
								$labels[]=$t['title'];
						}
					}
					else{
						//get resp of specific field
						$_stats_resp=db(dim($r['module_prefix']),$w,NULL,NULL,$_stats_field[0]['field_name']);
						// d($w);
						// dq();
						// d($_stats_resp);
						#!if resp==1?
						//get the fellow module items
						
//						if($r['id']==29)
//							mark($_stats_resp);
						if($_stats_field[0]['select_table']==NULL){//then i suppose its different where statements to be combined in one chart, thus the labels will be the dataet_$i_label, and the values hould be the counters	
							$_no_fellow=true;
							$labels[]=l($r['dataset_'.($key+1).'_label']);
							$colors[]=$r['dataset_'.($key+1).'_color'].alphaHex($r['dataset_'.($key+1).'_opacity']);
							$borders[]=$r['dataset_'.($key+1).'_color'].alphaHex($r['dataset_'.($key+1).'_opacity']+40);
							$total=$_stats_data[]=count($_stats_resp);
						}else{ //if the module_field seems not to be a drop down
							$_fellow=db($_stats_field[0]['select_table']);
							foreach($_fellow as $f){
								$_stats_keys[$f['id']]=array_merge($f,['_counter'=>0]);
							}
							//count
							foreach($_stats_resp as $s){
								#!the ones set to zero add them to NA
								$_stats_keys[$s[$_stats_field[0]['field_name']]]['_counter']++;
							}

							$tmp=[];
							foreach($_stats_keys as $sel){
								if((!isset($sel['title']) || $sel['title']==NULL) || ($r['hide_zeros']=='1' && $sel['_counter']==0))continue;
								$_stats_data[]=$sel['_counter'];
								$tmp[]=$sel;
								$total+=$sel['_counter'];
							}

							if($key==0){
								foreach($tmp as $s){
									$labels[]=l($s['title']).' '.round($s['_counter']/$total*100,1).'%';
								}
							}
						}
					}
				
				$_stats_big_arr[]=['data'=>$_stats_data,'total'=>$total,'item'=>$r,'labels'=>$labels];
			}
			$grand_total=0;
			foreach($_stats_big_arr as $a){
				$grand_total+=$a['total'];
			}
			
			if(isset($_no_fellow)){//then i suppose its different where statements to be combined in one chart, thus the labels will be the dataet_$i_label, and the values hould be the counters, which already done up, but here we shall combine them, as multiple datasets is not right for one chart needed
				$tmp=['data'=>[],'total'=>$grand_total,'item'=>$r,'labels'=>$labels,'colors'=>$colors,'borders'=>$borders];//used to force colors for charts which do NOT point to a dropdown module_field and has multiple where statements (datasets)
				foreach($_stats_big_arr as $a){
					$tmp['data'][]=$a['total'];
				}
				$_stats_big_arr=[$tmp];
			}
			return ['analytics'=>$_stats_big_arr,'grand_total'=>$grand_total];
		}
	}
	
}

function sb($id,$title=true){
	global $settings;
	$__stats=db('statistics_box_8324',"WHERE id=$id AND ids!='' AND !deleted","ORDER BY order_number ASC");
	if($__stats==1)return;
$txt='
<script>
// if(!window.Chart){
		
		// $.ajax({
		// 	url: "https://cdn.jsdelivr.net/npm/chart.js",
		// 	dataType: "script",
		// 	success: success
		//   });
		// document.write(
		// 	unescape(\'%3Cscript src="https://cdn.jsdelivr.net/npm/chart.js"%3E%3C/script%3E\')
		// );
		Mono=JSON.parse(\''.json_encode(colorRange(NULL,15,NULL,30)).'\');
//		MonoBorder=JSON.parse(\''.json_encode(colorRange(NULL,15,NULL,90)).'\');
		MonoBorder="'.$settings['main_color'].'";
		Colourful=[
                \'rgba(255, 99, 132, 0.3)\',
                \'rgba(54, 162, 235, 0.3)\',
                \'rgba(255, 206, 86, 0.3)\',
                \'rgba(75, 192, 192, 0.3)\',
                \'rgba(153, 102, 255, 0.3)\',
                \'rgba(255, 159, 64, 0.3)\'
            ];
	   ColourfulBorder=[
			\'rgba(255, 99, 132, 1)\',
			\'rgba(54, 162, 235, 1)\',
		   \'rgba(255, 206, 86, 1)\',
			\'rgba(75, 192, 192, 1)\',
		   \'rgba(153, 102, 255, 1)\',
			\'rgba(255, 159, 64, 1)\'
		];
	// }
</script>
';
foreach($__stats as $__stat){
	$txt.='
<style>'.$__stat['css'].'</style>
'.($title?'
<div class="l_block">
		<div class="l_bh">
			<div class="l_btn l_btn_small pon">'.l($__stat['title']).'</div>
		</div>
':NULL);

$_m='statistics_8324';
$txt.='
<section style="  " id="stats_wrap_'.$__stat['id'].'"  class="major_section stats_wrapper fullwidth">
<i class="_s_b_fullscreen_btn po" onclick="_s_b_fullscreen_toggle(this)">fullscreen</i>
';

$resp=db($_m,"WHERE !deleted AND id IN ({$__stat['ids']})",NULL);
if($resp==1) $txt.='<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
else { foreach($resp as $r){
$txt.='
<div data-legion-id="'.$r['id'].'" data-legion-box-id="'.$__stat['id'].'" data-l-live-stat="'.$r['live'].'" style="grid-area: grid_stats_'.$r['id'].';" class="stats_box nicebox  stats_'.$r['type'].(' '.$r['size']=='' || $r['size']=='free'?'in free':$r['size']).'">';	
		if($r['live'])$txt.='<div class="_s_live_indic"'.(super()?' onclick="popEdit(\'statistics_8324\','.$r['id'].')"':NULL).'></div>';
		if($r['type']=='Count'){
			$txt.='<div class="stats_count">
			<div class="par"><div class="ch">';
				if($r['icon']!='')$txt.='<i class="_s_b_icon mid">'.$r['icon'].'</i>';
				$txt.='<div class="stats_count_num mid">'.s_item_data($r['id'])['grand_total'].'</div>
				<div class="_stats_title">'.l($r['title']).'</div>';

				if($r['live'])$txt.='<div class="stats_delta_wrap" style="display:none"><div class="l_mr5 mid">Δ</div><div class="stats_delta_num mid">0</div></div>';

				if(l($r['subline'])!=NULL)$txt.='<div class="stats_subline">'.l($r['subline']).'</div>';

			$txt.='</div></div></div>';

		}elseif($r['type']=='Chart'){

//		list($_stats_arr,$total,$_r,$labels)=s_item_data($r['id']);
		$_stats_big_arr=s_item_data($r['id']);
			
				
		$txt.='
		
		<div class="stats_box _s_b_chart" style="">
			<canvas height="100" id="canvas_stats_'.$__stat['id'].'_'.$r['id'].'" dir="'.direction().'"></canvas>
		</div>
		
		<script>';
			
		
				
	if(!empty($_stats_big_arr) && ((!$r['hide_zeros'] || ($r['hide_zeros'] && $_stats_big_arr['grand_total']>0)))){
		
//			$arr=$_stats_arr;
		
//	$txt.='stats_'.$__stat['id'].'_'.$r['id'].'_data=['; $i=0;foreach($arr as $sel){
////			  if($i==0 && $r['type']=='Chart' && $r['chart_type']=='line')continue;#!
//		if($i!=0)$txt.=',';$txt.=$sel['_counter'];$i++;}
//		$txt.='];';
		
		//dataset starts
				

					
		foreach($_stats_big_arr['analytics'] as $key=>$analysis){
			if(isset($analysis['colors'])){
				$txt.='stats_'.$__stat['id'].'_'.$r['id'].'_custom_colors=[';
				$txt.=imploder($analysis['colors']);
				$txt.='];';
				
				$txt.='stats_'.$__stat['id'].'_'.$r['id'].'_custom_colors_borders=[';
				$txt.=imploder($analysis['borders']);
				$txt.='];';
			}
			$txt.='stats_'.$__stat['id'].'_'.$r['id'].'_dataset_'.($key+1).'={';
				
				if($r['dataset_'.($key+1).'_label']!='' && !isset($analysis['colors']))
					$txt.='label:\''.$r['dataset_'.($key+1).'_label'].'\',';
					$txt.='type: \''.$r['chart_type'].'\',';
					
				$txt.='data:['.implode(',',$analysis['data']).'],';

				if(isset($analysis['colors'])){
					$txt.="backgroundColor:".'stats_'.$__stat['id'].'_'.$r['id'].'_custom_colors'.",";
					$txt.="borderColor:".'stats_'.$__stat['id'].'_'.$r['id'].'_custom_colors_borders'.",";
				}
				elseif(count($_stats_big_arr['analytics'])>0 && $r['dataset_'.($key+1).'_color']!=NULL && $r['dataset_'.($key+1).'_free_where']!=''){
					$txt.="backgroundColor:'".$r['dataset_'.($key+1).'_color'].alphaHex($r['dataset_'.($key+1).'_opacity'])."',";
					$txt.="hoverBackgroundColor:'".$r['dataset_'.($key+1).'_color']."',";

					$txt.="borderColor:'".$r['dataset_'.($key+1).'_color'].($r['dataset_'.($key+1).'_opacity']<100?alphaHex($r['dataset_'.($key+1).'_opacity']+40):alphaHex($r['dataset_'.($key+1).'_opacity']))."',";
					$txt.="hoverBorderColor:'".$r['dataset_'.($key+1).'_color']."',";
				}else{
					$txt.='backgroundColor:'.($r['colors']==NULL?'Mono':$r['colors']).',';
					$txt.="borderColor:".($r['colors']==NULL?'Mono':$r['colors'])."Border,";
					}
					
				$txt.='borderWidth:2,borderRadius:2,hoverBorderWidth:4,hoverBorderRadius:4,';

					
			//hoverBorderWidth,hoverBorderRadius

				if($r['chart_type']=='line'){
					if($r['fill'])$txt.='fill: true,';
					$txt.='lineTension: 0.3,
							radius: 2';
				}

			$txt.='};';
			//dataset ends
		}
		$txt.='stats_'.$__stat['id'].'_'.$r['id'].'_datasets=[';
		foreach($_stats_big_arr['analytics'] as $key=>$analysis){
			$txt.='stats_'.$__stat['id'].'_'.$r['id'].'_dataset_'.($key+1).',';
		}
		$txt.='];';
		
		
		$txt.='stats_'.$__stat['id'].'_'.$r['id'].'_labels=[';
		$txt.=imploder($_stats_big_arr['analytics'][0]['labels']);
		$txt.='];';
		
		
	$txt.='var stats_'.$__stat['id'].'_'.$r['id'].'ChartInitial = new Chart(
    document.getElementById(\'canvas_stats_'.$__stat['id'].'_'.$r['id'].'\'),
    {  
	 	data: {
	  labels: '.'stats_'.$__stat['id'].'_'.$r['id'].'_labels'.',
	  datasets:  '.'stats_'.$__stat['id'].'_'.$r['id'].'_datasets'.'
	},
		
  options: {';
	 if($r['axis']!=NULL)$txt.='indexAxis:\''.$r['axis'].'\',';
	 $txt.='
	
    plugins: {
      legend: {
        position: \'top\',';
	 if(in_array($r['chart_type'],['bar','bubble','line','radar']))$txt.='display:false,';
     $txt.=' },
      title: {
        display: true,
        text: \''.l($r['title']).'\'
      },';

    $txt.='},
	maintainAspectRatio: false,
	responsive:true,
//	 height:100,

	scales: {
		  x: {
			min: 0,
			'.($r['stacked']?'stacked:true,':NULL).'
		  },
		   y: {
			min: 0,
			'.($r['stacked']?'stacked:true,':NULL).'
		  }
	},
  },}
  );';
			}//if total>0
			
			#!
//			
//			if($r['type']=='Chart' && $r['chart_type']=='line'){
//				$txt.='
//		
//  var stats_'.$__stat['id'].'_'.$r['id'].'_next = function() {
//  var data = stats_'.$__stat['id'].'_'.$r['id'].'ChartInitial.data.datasets[0].data;
//  var count = data.length;
//  data[count] = data[count - 1];
//  stats_'.$__stat['id'].'_'.$r['id'].'ChartInitial.update({duration: 0});
//  data[count] = stats_'.$__stat['id'].'_'.$r['id'].'_data[count];
//  stats_'.$__stat['id'].'_'.$r['id'].'ChartInitial.update();
//  if (count < stats_'.$__stat['id'].'_'.$r['id'].'_data.length) {
//    setTimeout(stats_'.$__stat['id'].'_'.$r['id'].'_next, 50);
//  }
//}
//setTimeout(stats_'.$__stat['id'].'_'.$r['id'].'_next, 50);
//
//		';
//				}
				
		$txt.='
		</script>';
		
			}//if chart
		
   $txt.='</div>';
    }//for
}//else
unset($resp);
$txt.='

</section><div class="l_btn l_btn_small" onclick="sub({\'stats_check\':1,\'ids\':_live_stats_ids,\'box_ids\':_live_stats_box_ids,\'js\':\'_stats_checkCallback\'},false,true);">Reload</div>
	'.($title?'</div>':NULL);

	 }
	return $txt;
   }


