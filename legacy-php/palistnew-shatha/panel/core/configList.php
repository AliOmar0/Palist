<?php
function tdd($field_name,$resp,$module){
	if($module!=NULL){
		$m=db('module_settings',"WHERE module_prefix='$module'",NULL,"LIMIT 1");
		if($m!=0 || $m!=1){
			$m=$m[0];
			$m['info']=db('modules',"WHERE module_prefix='$module'",NULL,'LIMIT 1')[0];
			$m['module_id']=$m['info']['id'];
		}
	}else return NULL;
	list($m,$main_field,$f)=moduleFields($m);
	return td($field_name,$resp,$m,false,false,$f,false);
}

function td($field_name,$resp,$m,$canDelete=false,$canEdit=false,$f=NULL,$canView=false){
	global $settings,$___empty,$langArr,$__adminSettings;
	
	switch ($f[$field_name]['type']){
		case'legion':
			
			switch($field_name){
					case'options':
					$txt='<div class="list_options_wrap nos">';
			
					if($canEdit)
						$txt.='<a href="'.urlPanel.'?module='.$m['info']['module_prefix'].'&action=edit&id='.$resp['id'].'" class="list_options po"><i class="l_mc_c">edit</i></a>';
					
					
					if($canEdit)
						$txt.='<a onClick="showPop(\'!\',\'Copy\',\'Are you sure?\',\'duplicating\',\''.$m['module_prefix'].'\', \'copy\','.$resp['id'].')" class="list_options po" title="Duplicating"><i class="l_gray_c">content_copy</i></a>';
					
					
					if($canView && file_exists(modules_dir.$m['info']['module_prefix'].'/views/view.php'))
						$txt.='<a href="'.urlPanel.'?module='.$m['info']['module_prefix'].'&action=view&id='.$resp['id'].'" class="list_options po"><i class="l_gray_c">preview</i></a>';

					if($canDelete){
						if($resp['deleted']==0)
						$txt.='<a onClick="showPop(\'!\',\'Delete\',\'Are you sure?\',\'deleting\',\''.$m['module_prefix'].'\', \'delete\','.$resp['id'].')" class="list_options po" title="Delete"><i class="l_gray_c">delete</i></a>';
						
						else
							$txt.='<a onClick="showPop(\'!\',\'Restore\',\'Are you sure?\',\'restoring\',\''.$m['module_prefix'].'\', \'restore\','.$resp['id'].')" class="list_options po" title="Restore"><i class="l_gray_c">restore_from_trash</i></a>';
					}
					
					if($canEdit)
						$txt.='<a onClick="popEdit(\''.$m['info']['module_prefix'].'\','.$resp['id'].',\'\',true)" class="list_options po" title="Pop Edit"><i class="l_gray_c">auto_fix_normal</i></a>';
					
					$url=url($m['module_prefix'],'single',$resp['id']);
					if($canView && ow('link_handler_1566934564',"module_prefix=".mid($m['module_prefix'])." AND single!=''")!=1 && $url!=url){
						$txt.='<a href="'.url($m['module_prefix'],'single',$resp['id']).'" target="_blank" class="list_options po"><i>insert_link</i></a>';
						$txt.='<a class="list_options po" onclick="c(\''.url($m['module_prefix'],'single',$m['module_prefix']=='pages_1478423482'?l($resp['slug']):$resp['id']).'\')"><i class="l_gray_c">add_link</i></a>';
					}
						
					
					
					$txt.='</div>';
					return $txt;
					
					case'select': return '<input type="checkbox" class="css-checkbox selectChecker" value="'.$resp['id'].'" id="checker'.$resp['id'].'"><label for="checker'.$resp['id'].'"></label>';
			}
			
			break;
			
			case'date':
			if($resp[$field_name]==NULL || $resp[$field_name]=='0000-00-00')return $___empty;
			return '<div class="list_date">'.($field_name=='date_created'?cleanDate($resp[$field_name],'Y-m-d').'<div class="list_date_clock">'.cleanDate($resp[$field_name],'h:i:s A').'</div>':cleanDate($resp[$field_name])).'</div>';
			
			
			case'file':
			if($resp[$field_name]==NULL)return $___empty;
			if($f[$field_name]['sub_type']=='photo'){
				if($f[$field_name]['multi_files']){
					$files=fa($resp[$field_name]);
					$txt=NULL;
					foreach($files as $file)
						$txt.='<a class="table_url" href="'.($f[$field_name]['protected_file']==0?u.$file['full_name']:protected_hasher($file['full_name'])).'" target="_blank" title="'.$file['original_name'].'">'.($f[$field_name]['protected_file']==0?pic($file['full_name'],100,95,'',false,NULL,'stackless'):picp($file['full_name'],100,95,'',false,NULL,'stackless')).'</a>';
					return $txt;
				}else{
					//beta
					 return '<div class="table_url po" onclick="popMedia(\''.($f[$field_name]['protected_file']==0?u.$resp[$field_name]:protected_hasher($resp[$field_name])).'\',\''.$f[$field_name]['sub_type'].'\')">'.($f[$field_name]['protected_file']==0?pic($resp[$field_name],100,95,'',false,'',$f[$field_name]=='icon'?'stackless':'stackless noStacklessBorder'):picp($resp[$field_name],100,95,'',false,'',$f[$field_name]=='icon'?'stackless':'stackless noStacklessBorder')).'</div>';
					
					//original
//					 return '<a class="table_url" href="'.($f[$field_name]['protected_file']==0?u.$resp[$field_name]:d.$resp[$field_name]).'" target="_blank" title="'.$resp[$field_name].'">'.($f[$field_name]['protected_file']==0?pic($resp[$field_name],100,95,'',false,'',$f[$field_name]=='icon'?'stackless':'stackless noStacklessBorder'):picp($resp[$field_name],100,95,'',false,'',$f[$field_name]=='icon'?'stackless':'stackless noStacklessBorder')).'</a>';
				}
			}
			
			else if($f[$field_name]['sub_type']=='file'){
				if($f[$field_name]['multi_files']){
					$files=fa($resp[$field_name]);
					$txt='';
					$tmp='';
					if(count($files)>0){
						$tmp=[];
						$tmp_original=[];
						foreach($files as $file){
							$tmp_thumbs[]=uimg($file['full_name'],100,95);
							$tmp_original[]=u.$file['full_name'];
							$tmp_compressed[]=uimg($file['full_name'],500,95);
						}
					}
					foreach($files as $file){
						if($f[$field_name]['protected_file']==0){
//							d($file);
							$txt.='<div class="table_url po mid" onclick="popMedia(\''.uimg($file['full_name'],500,95).'\',\''.(in_array($file['extension'],$settings['photo'])?'photo':$f[$field_name]['sub_type']).'\',\''.($tmp_thumbs==''?NULL:implode(',',$tmp_thumbs)).'\',\''.($tmp_thumbs==''?NULL:implode(',',$tmp_original)).'\',\''.($tmp_thumbs==''?NULL:implode(',',$tmp_compressed)).'\')">'.(in_array($file['extension'],$settings['photo'])?pic($file['full_name'],100,95,'',false,'',$f[$field_name]=='icon'?'stackless':'stackless noStacklessBorder'):'<picture class="listpic mid"><img src="'.fileIcon($file['full_name']).'"/></picture>').'<span class="mid"><div class=" l_f9 l_mt2">'.round(db('files_1577206823',"WHERE full_name='".$file['full_name']."'",NULL,'LIMIT 1')[0]['size'],2).' '.l('MB<>م.ب').'</div></span></div>';
						}
						else #! need work, bcoz u r handling unprotected files in the previous if statement
							$txt.='<a class="table_url" href="'.(isset($f[$field_name]['protected_file']) && $f[$field_name]['protected_file']==0?u.$file['full_name']:protected_hasher($file['full_name'])).'" target="_blank" title="'.$file['original_name'].'"><picture class="listpic mid"><img src="'.fileIcon($file['full_name']).'"/></picture><span class="mid">'.$file['original_name'].'</span></a>';
					}
					return '<div class="table_list_files">'.$txt.'</div>';
				}else{
					//beta
					 return '<a class="table_url po" onclick="popMedia(\''.($f[$field_name]['protected_file']==0?u.$resp[$field_name]:protected_hasher($resp[$field_name])).'\',\''.$f[$field_name]['sub_type'].'\')"><picture class="listpic mid"><img src="'.fileIcon($resp[$field_name]).'"/></picture><span class="mid">'.detail('files_1577206823','original_name','full_name',$resp[$field_name]).'<div class="l_tag  l_mt2">'.round(db('files_1577206823',"WHERE full_name='".$resp[$field_name]."'",NULL,'LIMIT 1')[0]['size'],2).' '.l('MB<>م.ب').'</div></span></a>';
					
//					 return '<a class="table_url" href="'.($f[$field_name]['protected_file']==0?u.$resp[$field_name]:d.$resp[$field_name]).'" target="_blank" title="'.$resp[$field_name].'"><picture class="listpic mid"><img src="'.fileIcon($resp[$field_name]).'"/></picture><span class="mid">'.detail('files_1577206823','original_name','full_name',$resp[$field_name]).'</span></a>';
				}
			}
			
//			if(gettype(unserialize($resp[$field_name]))=='array')return pic('files.png',40,100,'',false);
			
			
			break;
			
			case'url':
			if($resp[$field_name]==NULL)return $___empty;
			return '<a class="table_url" href="'.$resp[$field_name].'" target="_blank" title="'.$resp[$field_name].'"><i>link</i></a>';
			
			case'color':
			if($resp[$field_name]==NULL)return $___empty;
			return '<div title="'.l('Click to copy color hex<>اضغط لنسخ كود اللّون').'" class="table_color po" onclick="c(\''.$resp[$field_name].'\')" style="background:'.$resp[$field_name].'"></div>';

			case 'select':
			$final=select_echo($m['module_prefix'],$f[$field_name]['field_name'],$resp);
			if($f[$field_name]['sub_type']=='multi')return $final;

			$final.=(super()?'<span class="helpbox"><a class="helpbox_a" href="'.purl($f[$field_name]['select_table'],'edit',$resp[$field_name]).'" target="_blank">'.$resp[$field_name].'</a></span>':NULL);
			
			return $final;
			
			case'checkbox':
			 	return active($resp['id'],$resp[$field_name],$m['info']['module_prefix'],$field_name);
			
			
			
			case'material-icon':
				return $resp[$field_name]==''?$___empty:'<i class="list_i_col">'.$resp[$field_name].'</i>';
			
			case'location':
			if($resp[$field_name]=='')
				return '<i class="list_i_col map_list map_off_list">not_listed_location</i>';
			return '<i class="list_i_col map_list map_on_list po" onClick="showMap(\''.$resp[$field_name].'\')">place</i><span class="location_pos po" onclick="copy(this.nextElementSibling)">'.l('Copy<>نسخ').'</span><pos>'.$resp[$field_name].'</pos>';
			
			case'mobile':
				if($resp[$field_name]!='' && $resp[$field_name]!=0)
					return '<a href="tel:'.$resp[$field_name].'" title="'.l('Call<>اتصل').'"><i class="list_i_col mobile_list po mid">phone_iphone</i>
				<span class="mid">'.$resp[$field_name].'</span></a>
				<span class="location_pos po" onclick="copy(this.nextElementSibling)">'.l('Copy<>نسخ').'</span><pos>'.$resp[$field_name].'</pos>';
				else
					return $___empty;
			
			case'password':
				return '****';
			
			
			case'textarea':
				return l($resp[$field_name])==''?$___empty:'<div class="el">'.l($resp[$field_name].'</div>');
			
			
		default:
			if($field_name=='id')
				return $resp[$field_name];

			if($field_name=='social_font')
				return '<div class="social">'.$resp[$field_name].'</div>';

				// mark($f[$field_name]);
			$show_langs=true;
			if(!$__adminSettings['translations'])
				$show_langs=false;
			if(g('all_langs') && $_GET['all_langs']!=1){
				$show_langs=false;
			}
			if(($__adminSettings['translations'] && (!g('all_langs') || (g('all_langs') && $_GET['all_langs']==1))) && isset($f[$field_name]['is_ml']) && $f[$field_name]['is_ml']){
				$txt=NULL;
				foreach($langArr as $l){
					$tmp=l($resp[$field_name],$l['prefix'],false);
					$txt.='<div class="l_mb3 "><span class="in l_mc l_white_c l_f9 l_pad3 l_r3 l_mr3">'.$l['prefix'].'</span><span class=" l_wmax90 in">'.($tmp==NULL?$___empty:$tmp).'</span></div>';
					// l($resp[$field_name])==''?$___empty:l($resp[$field_name]);
					
				}
				return $txt;
			}
			return l($resp[$field_name])==''?$___empty:l($resp[$field_name]);
	}
}


function getter($type=NULL,$column=NULL,$sort='DESC'){
	global $m;
	$listOriginal='?module='.$m['module_prefix'].'&action=list';
	
	$txt=NULL;
	$keys=array_keys($_GET);
	switch($type){
		case'sorter'://keeps everything but sort and column
			$txt='?table_column='.$column.'&table_sort='.$sort;
			
			for($i=0;$i<count($keys);$i++){
				if($keys[$i]!='table_sort' && $keys[$i]!='table_column' && $keys[$i]!='page_num')
					$txt.="&".$keys[$i].'='.$_GET[$keys[$i]];
				}
			
			break;
			
			case'pager'://keeps everything but page_num & offset
			
			for($i=0;$i<count($keys);$i++){
				if($keys[$i]!='page_num'){
					if($txt==NULL)$txt='?';else $txt.='&';
					$txt.=$keys[$i].'='.$_GET[$keys[$i]];
					}
				}
			
			break;
			
			case'trash':
			$txt=$listOriginal.'&table_trash=1';
			break;
			
		case 'trashRespect':
			if(g('table_trash') && $_GET['table_trash']==1)
				$txt=$listOriginal.'&table_trash=1';
			else $txt=$listOriginal;
			break;
			
		default: $txt=$listOriginal;
			}
	return urlPanel.$txt;
	
}

function tableOrder(){
	if(isset($_GET['table_column']) && isset($_GET['table_sort'])){
		return "ORDER BY ".escape($_GET['table_column']).' '.escape($_GET['table_sort']);
	}
	
	return NULL;
}

function table_search_field($field_name,$f,$minimal=false){
	// pre($field_name);
//	d($f[$field_name]);

	if(!isset($f[$field_name]))return NULL;
	switch ($f[$field_name]['type']){
		case'text':case'url':
			if(isset($f[$field_name]['field_name']))
			return '<div class="form_field in">'.
($minimal?NULL:'<label>'.l($f[$field_name]['label']).'</label>').'
<div class="input_area">
	<input type="'.$f[$field_name]['type'].'" name="'.$field_name.'" data-search-list="true" value="'.(isset($_GET[$field_name])?$_GET[$field_name]:'').'" style="direction: '.direction().';">
</div>
</div>';
            else return NULL;

			case'checkbox':
				if(isset($f[$field_name]['field_name']))
			return '<div class="form_field in l_padr17">'.($minimal?NULL:'<label for="__list_search_checkbox_id_'.$f[$field_name]['field_name'].'">'.l($f[$field_name]['label']).'</label>').'
<div class="input_area">
	<input class="css-checkbox" id="__list_search_checkbox_id_'.$f[$field_name]['field_name'].'" type="'.$f[$field_name]['type'].'" name="'.$field_name.'" data-search-list="true" '.(isset($_GET[$field_name])?'checked':'').'/>
	<label for="__list_search_checkbox_id_'.$f[$field_name]['field_name'].'"></label>
	
	
</div>
</div>';

			
			case'number':case'date':
				if(isset($f[$field_name]['field_name']))
				return '<div class="form_field in">'.
($minimal?NULL:'<div>
<label class="in">'.l($f[$field_name]['label']).'</label>').(!isset($_GET['wide_search']) || (isset($_GET['wide_search']) && $_GET['wide_search']=='false')?'
<div class="__list_search_signs in nos">

	<div class="l_btn_light in '.(isset($_GET[$field_name.'_sign']) && ($_GET[$field_name.'_sign']=='=' || $_GET[$field_name.'_sign']=='') || !isset($_GET[$field_name.'_sign'])?'l_btn_light_active':'').'" onclick="__list_search_sign(this)" data-l-list-search-sign="=">=</div>


	<div class="l_btn_light in '.(isset($_GET[$field_name.'_sign']) && $_GET[$field_name.'_sign']=='!='?'l_btn_light_active':'').'" onclick="__list_search_sign(this)" data-l-list-search-sign="!=">&ne;</div>

	

	<div class="l_btn_light in '.(isset($_GET[$field_name.'_sign']) && $_GET[$field_name.'_sign']=='>'?'l_btn_light_active':'').'" onclick="__list_search_sign(this)" data-l-list-search-sign=">">></div>

	<div class="l_btn_light in '.(isset($_GET[$field_name.'_sign']) && $_GET[$field_name.'_sign']=='>='?'l_btn_light_active':'').'" onclick="__list_search_sign(this)" data-l-list-search-sign=">=">&ge;</div>

	<div class="l_btn_light in '.(isset($_GET[$field_name.'_sign']) && $_GET[$field_name.'_sign']=='<'?'l_btn_light_active':'').'" onclick="__list_search_sign(this)" data-l-list-search-sign="<"><</div>

	<div class="l_btn_light in '.(isset($_GET[$field_name.'_sign']) && $_GET[$field_name.'_sign']=='<='?'l_btn_light_active':'').'" onclick="__list_search_sign(this)" data-l-list-search-sign="<=">&le;</div>

	<input type="hidden" name="'.$field_name.'_sign" value="'.(isset($_GET[$field_name.'_sign'])?$_GET[$field_name.'_sign']:'').'"/>
</div>':'').'
</div>
<div class="input_area">
	<input type="'.$f[$field_name]['type'].'" name="'.$field_name.'" data-search-list="true" value="'.(isset($_GET[$field_name])?$_GET[$field_name]:'').'" style="direction: '.direction().';">
</div>
</div>';

			case'select':?>
			 <div class="form_field  in">
<?php if(!$minimal){?><label><?= l($f[$field_name]['label']);?></label><?php }?>
<div class="input_area">
<select class="main_color_bg whiteFont" data-search-list="true" name="<?=$field_name;?>">
<?php 
$sub_resp=db($f[$field_name]['select_table'],"WHERE !deleted");
			if($sub_resp==0){?><option value="0" selected><?=l('Error<>يوجد خلل')?></option> <?php } 
			else if($sub_resp==1) {?><option value="0" selected><?= l('Choose<>اختر');?></option> <?php } 
				 else { ?>
				 <option value="" <?=(isset($_GET[$field_name]) && 0==$_GET[$field_name] ? 'selected' : ''); ?>><?= l('All<>الكل');?></option>
				<?php
				for($j=0;$j<count($sub_resp);$j++){?>
				<option <?=(isset($_GET[$field_name]) && $sub_resp[$j]['id']==$_GET[$field_name] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?= $sub_resp[$j]['id']?>">
                     <?php echo select_echo(dim($f[$field_name]['module_id']),$field_name,$sub_resp[$j],true);?>
    </option>
<?php 
				}//for
			}//else
			unset($sub_resp);
?>
			</select>
</div>
</div>
<?php
			return;
			break;
			
		default:return NULL;
	}
	
}

function tableWhere($m){
	// $first_field=true;
	
	if(isset($_GET['table_trash']) && $_GET['table_trash']==1)$where="WHERE deleted";
	else $where="WHERE !deleted";
	
	if(g('id') && $_GET['id']!=''){
		$sign='=';
		if(g('id_sign') && $_GET['id_sign']!=''){
			$sign=eg(html_entity_decode('id_sign'));

			if(!in_array($sign,['=','!=','>','>=','<','<=']))
				$sign='=';
		}

		$where.=" AND id".$sign.eg('id');
	}
	
	if(isset($_GET['search_is_on'])){
		for($i=0;$i<count($m['fields']);$i++){
			// if($m['fields'][$i]['field_name']=='id')echo 'hi';
			
			if($m['fields'][$i]['main']==0)continue;

			if(!isset($_GET[$m['fields'][$i]['field_name']]) || $_GET[$m['fields'][$i]['field_name']]=='')continue;
			

			

			$where.=' AND ';

			if($m['fields'][$i]['type']=='select' && $m['fields'][$i]['sub_type']=='multi'){
				$where.='id IN ((SELECT mother_id FROM complementary_1614118171 WHERE mother_module_prefix='.mid($m['module_prefix']).' AND child_module_prefix='.mid($m['fields'][$i]['select_table']).' AND child_id='.eg($m['fields'][$i]['field_name']).'))';
			}
			else{
				if(isset($_GET['wide_search']) && $_GET['wide_search']=='true')$where.=$m['fields'][$i]['field_name']." LIKE '%".eg($m['fields'][$i]['field_name'])."%'";

				else{
					

					$sign='=';
					if(g($m['fields'][$i]['field_name'].'_sign') && $_GET[$m['fields'][$i]['field_name'].'_sign']!=''){
						$sign=eg(html_entity_decode($m['fields'][$i]['field_name'].'_sign'));

						if(!in_array($sign,['=','!=','>','>=','<','<=']))
							$sign='=';
					}


					

					$right=eg($m['fields'][$i]['field_name']);
					if($m['fields'][$i]['type']=='checkbox'){
						if(g($m['fields'][$i]['field_name']))
							$right=$_GET[$m['fields'][$i]['field_name']]=='on'?1:0;
					}
					// if($m['fields'][$i]['type']=='date')
					// 	$right='DATE('.$right.')';

					$left=$m['fields'][$i]['field_name'];
					if($m['fields'][$i]['type']=='date')
						$left='DATE('.$m['fields'][$i]['field_name'].')';

					$where.=$left.$sign."'".$right."'";
				}
			}
		}
	}

	return $where;
}


function tableLimit($m,$offset){
	return "LIMIT $offset,".$m['items_per_page'];
}