<?php 
$time_start = microtime(true);
$insidePanel=true;
require'core/config.php';
$module=isset($_GET['module']) ? escape($_GET['module']):NULL;
$action=isset($_GET['action']) ? escape($_GET['action']): NULL;
if($module!=NULL){
$m=db('module_settings',"WHERE module_prefix='$module'",NULL,"LIMIT 1");
    if($m!=0 || $m!=1){
        $m=$m[0];
$m['info']=db('modules',"WHERE module_prefix='$module'",NULL,'LIMIT 1')[0];
$m['module_id']=$m['info']['id'];
    }


	if($action!=NULL && isset($m['module_id'])){
		$tmp=db('module_actions',"WHERE module_id='".$m['module_id']."' AND type='$action'",NULL,'LIMIT 1');
		if($tmp!=1)
			$actionDetails=$tmp[0];
	}
		
}
?>
<!--
This website is made by ProVision, custom CMS (LegionCMS) built purly from scratch by ProVision team.
www.provision.ps
-->
<!DOCTYPE html>
<html dir="<?=direction();?>" lang="<?= curr();?>">
<head>
<base href="<?= urlPanel;?>" />
<?php require 'core/panelMeta.php';?>
<?php require panel_dir.'sharedHeader.php'?>
<link rel="stylesheet" href="<?= pres?>css/main.css<?php clearCache();?>" /> 
<link rel="stylesheet" href="<?= pres?>css/mce.css<?php clearCache();?>" /> 
<link rel="stylesheet" href="<?= pres?>css/responsive.css<?php clearCache();?>" /> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?= urlPanel.'custom/custom_style.css'?><?php clearCache();?>" /> 
<script src="<?= pres?>js/submitter.js<?php clearCache();?>"></script>
<script src="<?= pres?>js/responser.js<?php clearCache();?>"></script>
<script src="<?= pres?>js/functions.js<?php clearCache();?>"></script>
</head>
<body class="<?php if(isset($userInfoArr) && $userInfoArr['dark_mode'])echo'dark';?>">
<div id="roller" class="hidden" class="main_color_bg">
	<img id="rolling_img" class="mid" src="<?=u.'loading.gif'?>"/>
<div id="rolling_msg" class="mid"></div>
	<div id="percentage_upload_box">
		<div id="percentage_upload_text"></div>
		<div id="percentage_upload_filler"></div>
	</div>
</div>
	
<div id="general_msg_area" style="display:none" class="hidden"></div>
	
<?php
if(!logged()){$_SESSION['goto']=$_SERVER['REQUEST_URI'];require panel_dir.'login.php';die();}
if(isset($userInfoArr) && $userInfoArr['menu_style']=='Icon'){?>
<link rel="stylesheet" id="menuCssFile"  href="<?= pres.'css/menu.css'?><?php clearCache();?>" /> 
<?php }
// if(isset($userInfoArr) && $userInfoArr['dark_mode']){
	?>
	<link rel="stylesheet" class="darkCssFile"  href="<?= pres.'css/dark.css'?><?php clearCache();?>" /> 
<?php 
// }
?>

	<div class="big_wrap">
		
		<nav class="noselect in">
		<div id="top_nav">
			<div class="legion_options">
				<div class="legion_option" id="menuLayoutOptionsWrap">

	<div class="menu_layout po legion_option_btn <?=($userInfoArr['menu_style']=='List' ? 'hidden':'');?>" id="icon_name" onClick="changeMenuLayout(this,'List');return submitter(null,urlPanel,'working',{ 'type' : 'menu_style', 'menu_style' : 'List'},'post',false);">
		<i>view_list</i>
	</div>
	
	<div class="menu_layout po legion_option_btn <?=($userInfoArr['menu_style']=='Icon' ? 'hidden':'');?>" id="icon_only" onClick="changeMenuLayout(this,'Icon');return submitter(null,urlPanel,'working',{ 'type' : 'menu_style', 'menu_style' : 'Icon'},'post',false);">
		<i>more_vert</i>
	
</div>
			</div>
	<div class="legion_option simple_txt">
		<div class="legion_option_btn po"><a href="<?= url;?>" title="Go to Website" target="_blank"><?=l('Website<>الموقع')?></a></div>
	</div>
					
					
					<div class="legion_option simple_txt">
		<div class="legion_option_btn po"><a href="<?= urlPanel;?>" title="Go to Website"><?=l('Panel<>اللوحة')?></a></div>
	</div>
			
				
				
				<?php
					$resp=db('web_notifications_1644647708',"WHERE user_module='".$_SESSION['module_id']."' AND user='".$_SESSION['user_id']."' AND deleted=0",NULL,'LIMIT 20');
			
			$count=0;
			if($resp!=1){
				foreach($resp as $r){
					if($r['seen']==0)
						$count++;
				}
				}
			
					?>
				
				<script>
					var last_notification_id = <?=$resp==1 || $resp==0?0:$resp[0]['id']?>;
				</script>
				
				
				<div class="legion_option simple_txt">
		<div class="legion_option_btn po" id="notification_btn" onClick="toggle('notifications_wrap')"><i class="<?=$count==0?'':'noti_icon_gold'?>"><?=$count==0?'notifications_none':'notifications_active'?></i><noti_counter><?=$count==0?'':$count?></noti_counter></div>
					
					
					<div id="notifications_wrap" class="hidden">
						<ul>
					<?php if($resp==1 && $resp!=0){?>
						<div id="no_notifications"><i class="mid">notifications_paused</i><span class="mid"><?=l('No notifications<>لا يوجد اشعارات')?></span></div>
						
						<?php }else{
							foreach($resp as $noti){
							echo processNotification($noti);}
						}?>
							
							</ul>
					</div>
					
	</div>
				
				
			</div>
			<div id="profile">
			<a id="profile_pic" class="mid"  href="<?= urlPanel?>?module=admins&action=edit&id=<?= $_SESSION['user_id']?>" title="Edit Profile"><?php pic($userInfoArr['photo'],50,100,$userInfoArr['first_name'],true,NULL,'mid');?>
				<div id="username" class="mid"><?= $userInfoArr['first_name'] =='' ? $userInfoArr['username'] : $userInfoArr['first_name'];?></div>
				</a><!--
				--><a class="logout mid" href="<?= urlPanel?>logout.php"><span class="mid"><?=l('Logout<>تسجيل خروج')?></span></a>
			</div>
			
				<div class="legion_options">
		
		
					
	<div class="legion_option">
<div class="legion_option_btn po">
		<a class="legion mid" target="_blank" href="<?= $legion['provision']['website_link']?>" title="<?= $legion['by']?> <?= $legion['name'] ?> - <?= $legion['provision']['name'] ?>">
			<img width="66px" height="28.333333px" class="mid" src="<?= $legion['resources']['logo_medium_dark'] ?>" alt="<?=$legion['name'];?>"/>
		</a>

		<a class="legion_version_wrap mid" target="_blank" href="<?=$legion['website_link']?>" title="<?= $legion['name'] ?> - <?= l('Changelog<>معلومات الاصدارات')?>">
			<span class="legion_version_span mid"><?=version?></span>
		</a>
	</div>
</div>
	

					
					
</div>
				
</div><!--top nav-->
<mhp></mhp>


<div id="nav_wrap">
	<div id="nav_wrap_inner">
		<?php if(super() || $settings['custom_system']==0){?>
			<div id="search_menu_wrap"><input id="search_menu_field" type="text"  class="mid" placeholder="<?= l('search<>ابحث');?>"/></div>
			<ul id="menu">
			<?php 	
				#for bread
				$bread_sub_items=array();
				$___menu_modules=[];
				$resp=db('modules',NULL,"ORDER BY order_by");
				if($resp==0)echo 'error';
				else if($resp==1)echo 'No Data';
				else { 
					for($i=0;$i<count($resp);$i++){
						if(privilege($resp[$i]['module_prefix'])){
							$__menu_tmp_collapse=false;
							if($resp[$i]['core']){
								if(super() && !in_array($resp[$i]['module_prefix'],['settings','pages_1478423482','error_1528374155']))$__menu_tmp_collapse=true;
							}
							if($module==$resp[$i]['module_prefix']){
								$__menu_tmp_current=true;
								$__menu_tmp_collapse=false;
							}else $__menu_tmp_current=false;

							$__menu_core_tmp=['li'=>NULL,'sub'=>NULL,'core'=>$resp[$i]['core'],'current'=>$__menu_tmp_current,'collapse'=>$__menu_tmp_collapse];
							$__menu_core_tmp['li'].='<li '.($__menu_tmp_collapse?dn(true):NULL).' class="parent_menu '.($__menu_tmp_collapse?'panel_collapsed_menu ':NULL).($module==$resp[$i]['module_prefix']?'main_color_font whitebg':NULL).'">';

							$__menu_tmp_to_url=NULL;

							if($resp[$i]['is_edit_only']==0 && $resp[$i]['module_prefix']!='settings' && privilege($resp[$i]['module_prefix'],'list'))
								$__menu_tmp_to_url.=urlPanel."?module=".$resp[$i]['module_prefix']."&action=list";

							elseif(file_exists(modules_dir.$resp[$i]['module_prefix'].'/views/add.php') && privilege($resp[$i]['module_prefix'],'add'))
								$__menu_tmp_to_url.=urlPanel."?module=".$resp[$i]['module_prefix']."&action=add";

							elseif(file_exists(modules_dir.$resp[$i]['module_prefix'].'/views/edit.php') && privilege($resp[$i]['module_prefix'],'edit') && $resp[$i]['is_edit_only']==1)
								$__menu_tmp_to_url.=urlPanel."?module=".$resp[$i]['module_prefix']."&action=edit&id=1";

							elseif($resp[$i]['module_prefix']=='settings' && privilege($resp[$i]['module_prefix'],'editModule'))
								$__menu_tmp_to_url.=urlPanel."?module=".$resp[$i]['module_prefix']."&action=editModule";


							$__menu_core_tmp['li'].='<a class="po" href="'.$__menu_tmp_to_url.'">';
							$__menu_core_tmp['li'].='<i class="mid '.($resp[$i]['core']==1 && super()?'l_gold_c ':'').($resp[$i]['commerce']==1 && super()?'l_purple_c ':'').'">'.$resp[$i]['main_icon'].'</i>
							<span class="menu_span menu_search mid">'.l($resp[$i]['module_name']).'</span>';

							$__menu_core_tmp['li'].='</a>';

							if(super()){
								$__menu_core_tmp['li'].='
								<div class="menu_small_options">
									<a target="_blank" class="menu_small_btn usage po in '.($resp[$i]['module_prefix']=='settings'?'h':'').'" href="'.$legion['website_link'].'/modular/'.version.'/tweak.php?module_prefix='.$resp[$i]['module_prefix'].'&module_version='.$resp[$i]['version'].'">Tweak</a>
									
									<a class="menu_small_btn usage po in '.($resp[$i]['module_prefix']=='settings'?'h':'').' href="'.urlPanel.'?module='.$resp[$i]['module_prefix'].'&action=usage">Usage</a>
									<div class="menu_small_btn copy po in" onClick="c(\''.$resp[$i]['module_prefix'].'\')">Copy</div>
								</div>
								';
							}

							

							if($module==$resp[$i]['module_prefix']){
								

								$sub_items_arr=db('module_actions',"WHERE private=0 AND module_id='".$resp[$i]['id']."'",'ORDER by id ASC');
								if($sub_items_arr!=1){
									$__menu_core_tmp['sub'].='<ul>';
										
									for($j=0;$j<count($sub_items_arr);$j++){
										if($sub_items_arr[$j]['type']=='edit' || $sub_items_arr[$j]['type']=='view' || ($sub_items_arr[$j]['type']=='usage' && !super()))continue;
										if(privilege($resp[$i]['module_prefix'],$sub_items_arr[$j]['type'])){
											$__menu_core_tmp['sub'].='
											<li class="'.($resp[$i]['module_prefix']==$module && $action==$sub_items_arr[$j]['type'] ? 'main_color_font ':'').'"><a title="'.l($sub_items_arr[$j]['title']).'" href="'.urlPanel.'?module='.$resp[$i]['module_prefix'].'&action='.$sub_items_arr[$j]['type'].($sub_items_arr[$j]['type']=='edit' ? '&id=1':'').'"><i>'.$sub_items_arr[$j]['icon'].'</i><span  class="menu_span">'.l($sub_items_arr[$j]['title']).'</span></a></li>
											';
											#for bread
											if($module==$resp[$i]['module_prefix'])$bread_sub_items[]=$sub_items_arr[$j];
										}
									}

									$__menu_core_tmp['sub'].='</ul>';
								}

							}

							$__menu_core_tmp['li'].=$__menu_core_tmp['sub'];

							$__menu_core_tmp['li'].='</li>';
							
							$___menu_modules[]=$__menu_core_tmp;

						}//if the whole module is in the user's rules
					}//for modules select from db

					if(!empty($___menu_modules)){
						foreach($___menu_modules as $__menu){
							if($__menu['current'])
								echo($__menu['li']);
						}

						foreach($___menu_modules as $__menu){
							if($__menu['core'] && !$__menu['collapse'] && !$__menu['current'])
								echo($__menu['li']);
						}


						if(super()){
							echo '<li id="menu_collapse_wrap">
									<a class="po" onclick="$(\'.panel_collapsed_menu\').toggle();">
										<i class="mid l_sand_c ">expand_circle_down</i>
										<span class="menu_span mid">Other Core Modules</span>
									</a>
							</li>';
						}
						

						foreach($___menu_modules as $__menu){
							if($__menu['core'] && $__menu['collapse'] && !$__menu['current'])
								echo($__menu['li']);
						}
						

						
						foreach($___menu_modules as $__menu){
							if(!$__menu['core'] && !$__menu['current'])
								echo($__menu['li']);
						}
					}
				}//else of the select, that there are results
				unset($resp);?>
			</ul>
		<?php }?>
	</div>
</div>
			
			
			
			
 <audio id="notification_sound" class="hidden">
  <source src="<?=u?>notification.mp3" type="audio/mpeg">
</audio> 
	
 <script> 
	// window.addEventListener("load", function(){
	// 	 $(".parent_menu").mouseover(function() { 
	// 		 if ( $(this).offset().top > ($(window).scrollTop() + $(window).height() - 100) ){
	// 			 $(this).find('ul').addClass('menuFarBottom');
	// 		 }
	// 		 else $(this).find('ul').removeClass('menuFarBottom');
	// 	 }); 
	// }, false);
			 
			var got_sub_build=false;
	 		var loading_whatUpdates=false;
			 $(function(){
				 whatUpdates(true);
				 setInterval(function() { 
					 whatUpdates();
				 }, 5000);
			 });
	
			 function whatUpdates(check_new_version=false){
				 if(!loading_whatUpdates){
					 loading_whatUpdates = true;
					 sub({'checker':true,'e':'','check_new_version':check_new_version,'last_notification_id':last_notification_id,},false,true);
				 }
			 }
//	 
			 
			 function checked(data,params){
				 if(params['engine_update']!=null && params['engine_update']!='' && $('#update_link').length==0){
					 $('.legion_version_wrap').after('<a class="mid" id="update_link" href="'+params['engine_update']['link']+'"><?=l('Update<>تحديث')?></a>');
				 }
				 
				 if(!got_sub_build){
					  $('.legion_version_span').html($('.legion_version_span').html()+params['sub_build_details']['this_sub_build_with_dot']);
					 got_sub_build=true;
				 }
				 
				 
				  if(params['notifications']!=null && params['notifications']!=''){

					  $('#no_notifications').remove();
					  document.getElementById("notification_sound").play();
					  $(params['notifications']).each(function(){
						  $('#notifications_wrap ul').prepend(this);
					  });
					  
					  last_notification_id=$(params['notifications'][params['notifications'].length-1]).attr("data-notification-id");
					  refresh_notifications();
				  }
				 
				 loading_whatUpdates=false;
				 
			 }
			 
			//  $(function(){
			// 	 var curr_menu=$('li.parent_menu.main_color_font.whitebg');
			// 	 $(curr_menu).hide();
			// 	 $('#menu').prepend(curr_menu);
			// 	 $(curr_menu).show();
			//  }); 


		</script>
			
	</nav><!--
		
--><div id="wrap" class="in">