
<div id="__stats_boxes_wrap"><?=l_loading()?></div>

<script>
	function load_stat_boxCallback(data,params){
		$('#__stats_boxes_wrap').append(data);
		checkLiveStatItems();
		$('#__stats_boxes_wrap .l_loading').hide(30);
		// p(data);
		// p("counts");
	}
</script>
<?php
$__dashboard_stat_boxes=aw('statistics_box_8324','dashboard');
if($__dashboard_stat_boxes!=1){
	echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
	echo '<script>
	$(\'#__stats_boxes_wrap\').addClass(\'l_hmin50\');
	$(function(){';
	foreach($__dashboard_stat_boxes as $___dash_stat){
		echo "sub({'load_stat_box':{$___dash_stat['id']},'js':'load_stat_boxCallback'});";
	}
	echo '});</script>';
}



$resp=db('quick_access_1563567918');
if($resp!=1){?>
<div class="blocka small_blocka" id="quick_access">
	<div class="group_wrapper">
		<div class="new_group"><?= l('Quick Access<>تنقل سريع');?></div>
	</div>
			<clear></clear><!--

<?php
	for($i=0;$i<count($resp);$i++){
		if($resp[$i]['custom_link']!=NULL){
					?>

--><a  class="quick_access_box in" href="<?=urlPanel.$resp[$i]['custom_link'];?>" title="<?=l($resp[$i]['title_of_link'])?>">
		<i class="mid"><?=$resp[$i]['main_icon']==NULL?'info':$resp[$i]['main_icon']?></i><div class="quick_access_title mid"><?= l($resp[$i]['title_of_link']);?></div>
	</a><!--


<?php
		}else{
	$module=db('modules',"WHERE module_prefix='".$resp[$i]['module_prefix']."'",NULL,'LIMIT 1','module_name,main_icon')[0];
	?>
	--><?php if(privilege($resp[$i]['module_prefix'],$resp[$i]['action_of_module'])){?><a  class="quick_access_box in" href="<?= urlPanel; ?>?module=<?= $resp[$i]['module_prefix'];?>&action=<?= $resp[$i]['action_of_module'];?>" title="<?= $resp[$i]['title_of_link'];?>">
			<i class="mid"><?= $module['main_icon'];?></i><div class="quick_access_title mid"><?= l($resp[$i]['title_of_link']);?></div>
		</a><?php }?><!--
	<?php 
	}
    }//for
	?>

--></div>
<?php
}//else
unset($resp);

$__admin_settings=o('admin_settings',$_SESSION['user_id'],'admin')[0];
	if($__admin_settings==NULL){
		$_POST['admin']=$_SESSION['user_id'];
		co('admin_settings');
		r('admin_settings');
		$__admin_settings=$_POST;
	}

$_app=db('apps_1552305519');

if(defined('legion_token')){
?>
	<div class="l_block ">
		<div class="l_bh">
			<div class="l_btn l_btn_small pon"><?=l('SMS Package<>حزمة الرسائل')?></div>
		</div>
		<div class="l_grid4">
			<div class="l_nicebox">
				<div class=""><?=l('Balance<>الرصيد')?></div>
				<div id="sms_balance" class="l_f24 l_mb10 l_mt10"><?=l('loading..<>قيد الفحص')?></div>
			</div>
		</div>
	<script>
		$(function(){
			sub({'check_sms':true,'js':'smsCheckDashboard'});
		});

		function smsCheckDashboard(data,params){
			
			$('#sms_balance').html(data['balance']);
		}
	</script>
	</div>
<?php }?>

<div class="l_block">
	<div class="l_bh">
		<div class="l_btn l_btn_small pon"><?=l('System Info<>معلومات النظام')?></div>
	</div>

	<div class="l_abs_tr5 l_f10 l_gray_c">
		<div class="mid"><?=l('Widgets<>واجهات')?></div>
		
			<div class="mid l_btn l_btn_small <?=$__admin_settings['storage']?'l_btn_active':''?>" onclick="sub({'admin_settings':1,'toggle':'storage'});$('#__dashboard_storage').slideToggle();$(this).toggleClass('l_btn_active');"><?=l('Storage<>المساحة')?></div>
		
			<?php if(super()){?>
				<div class="mid l_btn l_btn_small <?=$__admin_settings['status_report']?'l_btn_active':''?>" onclick="sub({'admin_settings':1,'toggle':'status_report'});$('#__dashboard_status_report').slideToggle();$(this).toggleClass('l_btn_active');"><?=l('Status Report<>تقرير النظام')?></div>
			<?php }?>
			
			<?php if($_app!=1){?>
				<div class="mid l_btn l_btn_small <?=$__admin_settings['app_links']?'l_btn_active':''?>" onclick="sub({'admin_settings':1,'toggle':'app_links'});$('#__dashboard_app_links').slideToggle();$(this).toggleClass('l_btn_active');"><?=l('App Links<>روابط التطبيقات')?></div>
			<?php }?>


			<div class="mid l_ml10"><?=l('Style<>شكل')?></div>
			<div class="mid l_btn l_btn_small <?=$__admin_settings['grid_dashboard']?'l_btn_active':''?>" onclick="sub({'admin_settings':1,'toggle':'grid_dashboard'});$('#__dashboard_widgets').toggleClass('l_grid2');$(this).toggleClass('l_btn_active');"><?=l('Grid<>التوزيع')?></div>

		</div>


	<div id="__dashboard_widgets" class="<?=$__admin_settings['grid_dashboard']?'l_grid2':''?>">
		<div id="__dashboard_storage" class="l_nicebox l_mtb10" <?=$__admin_settings['storage']?'':dn()?>>

		<?=l_loading()?>

		<script>
			$(function(){
				sub({'storage_disk':true,'js':'storage_diskCallback'},false,true)
			});

			function storage_diskCallback(data,params){
				$('#__dashboard_storage .l_loading').hide(30);
				$('#_root_disk').html(data['_root_disk_rounded']);

				_storage_bar=$('#_storage_bar');
				$(data['_disk_space']).each(function(i,elem){
					$(_storage_bar).append(`<div class="l_chunk l_hfull l_tip_hover `+elem['class']+` in" style="width:`+elem['width']+`%">
						<div class="l_tip">
							<div class="l_f12">`+elem['title']+`</div>
							<div class="l_f10 l_gray_c">`+elem['size']+`</div>
						</div>
					</div>`);
				});


				_storage_legend=$('#_storage_legend');
				$(data['_disk_space']).each(function(i,elem){
					$(_storage_legend).append(`<div  class="l_mr10 in">
						<div class="l_circle l_wh7  mid `+elem['class']+`"></div>
						<span class="l_f8 mid">`+elem['title']+`</span>
					</div>`);
				});

			}
		</script>
		<div class="l_grid2 l_mb10">
			<div class="l_sec_title "><?=l('Disk Space<>المساحة التخزينية')?></div>
			<div class="l_sec_title l_right"><span id="_root_disk"></span><?=' '.l('GB<>ج.ب').' '.l('of<>من').' 5 '.l('GB<>ج.ب').' '.l('used<>مستخدم')?></div>
		</div>
		<div id="_storage_bar" class="l_r5 l_s10 l_w l_h5"></div><!--
		--><div id="_storage_legend"></div>
	</div>

<?php 
if(super()){?>
	<div id="__dashboard_status_report" class="l_nicebox l_mtb10" <?=$__admin_settings['status_report']?'':dn()?>>

	<?=l_loading()?>

		<script>
			$(function(){
				sub({'status_report':true,'js':'status_reportCallback'},false,true)
			});

			function status_reportCallback(data,params){
				$('#__dashboard_status_report .l_loading').hide(30);
				$('#_status_report_count').html(data['__tests'].length);

				_status_report_bar=$('#_status_report_bar');
				$(data['__tests']).each(function(i,elem){
					$(_status_report_bar).append(`<div class="l_chunk l_hfull l_tip_hover in" style="width:`+data['__test_width']+`%;background:`+elem['color']+`">
				<div class="l_tip">
					<div class="l_f12">`+elem['title']+`</div>
					<div class="l_f10 l_gray_c">`+elem['status_words'][elem['status']]+`</div>
				</div>
			</div>`);
				});


				_status_report_legend=$('#_status_report_legend');
				$(data['__tests']).each(function(i,elem){
					$(_status_report_legend).append(`<`+(elem['link']==undefined?'div':'a')+` class="l_mr10 in" `+(elem['link']==undefined?'':'href="'.$_test['link']+'"')+`>
				<div class="l_circle l_wh7  mid" style="background:`+elem['color']+`"></div>
				<span class="l_f8 mid">`+elem['title']+`</span>
			</`+(elem['link']==undefined?'div':'a')+`>`);
				});

			}
		</script>


		<div class="l_grid2 l_mb10">
			<div class="l_sec_title "><?= l('Legion Engine Status Report<>وضع نظام الـLegion');?></div>
			<div class="l_sec_title l_right"><span id="_status_report_count"></span><?=' '.l('tests<>اختباراً').' '.l('completed<>تم تنفيذهم')?></div>
		</div>
		<div id="_status_report_bar" class="l_r5 l_s10 l_w l_h5"></div><!--
		--><div id="_status_report_legend"></div>
	</div>
<?php 
}

if($_app!=1){
	$tmp_langarr=$langArr;
	array_unshift($tmp_langarr,['id'=>0]);
	?>
	<div id="__dashboard_app_links" class="l_grid2 l_nicebox l_gray_c" <?=$__admin_settings['app_links']?'':dn()?>>
		<?php foreach($_app as $a){?>
			<div class="l_grid_span13 l_sec_title nos"><?=l('Links of app<>روابط تطبيق').': '?><span class="l_bold"><?=$a['app_name']?></span></div>
			<div class="l_nicebox l_f48 l_center l_gray_light_c po nos" onclick="$('#dashboard_app_links').slideToggle();"><i>ios</i></div>
			<div class="l_nicebox l_f48 l_center l_gray_light_c po nos" onclick="$('#dashboard_app_links').slideToggle();"><i>android</i></div>

			<div id="dashboard_app_links" class="l_grid_span13 l_grid2" <?=dn()?>>
				<div class="l_nicebox l_grid_span13 l_center">
					<div class="l_mb5">All Platforms Through Website</div>
					<clear></clear>
					<?php $tmp_link=url.'app'?>
						<div class="l_btn l_btn_small l_btn_copy mid" onClick="c('<?=$tmp_link?>')">Copy</div>
						<div class="l_btn l_btn_small mid" onClick="visit('<?=$tmp_link?>',true)">Visit</div>
						<div class="l_f9 mid"><?=$tmp_link?></div>	
				</div>
				
				<?php if($a['apple_store_id']!='' && $a['ios_active']){?>
					<div class="l_nicebox">
							<?php foreach($tmp_langarr as $l){?>
							<div>
								<div class="l_mtb5">Through Website <?=($l['id']==0?'Generic':$l['title'])?></div>	
								<div>
									<?php $tmp_link=url.'ios'.($l['id']==0?'':'/'.$l['prefix'])?>
									<div class="l_btn l_btn_small l_btn_copy  mid po " onClick="c('<?=$tmp_link?>')">Copy</div>
									<div class="l_btn l_btn_small mid" onClick="visit('<?=$tmp_link?>',true)">Visit</div>
									<div class="l_f9 mid"><?=$tmp_link?></div>
								</div>
							</div>
							<?php }?>
							<?php foreach($tmp_langarr as $l){?>
							<div>
								<div class="l_mtb5">Direct <?=($l['id']==0?'Generic':$l['title'])?></div>	
								<div>
									<?php $link='https://apps.apple.com/us/app/provision/id'.$a['apple_store_id'].($l['id']==0?'':'?l='.$l['prefix'])?>
									<div class="l_btn l_btn_small l_btn_copy  mid po " onClick="c('<?=$link?>')">Copy</div>
									<div class="l_btn l_btn_small mid" onClick="visit('<?=$link?>',true)">Visit</div>
									<div class="l_f9 mid"><?=$link?></div>
								</div>
							</div>
							<?php }?>
					</div>
				<?php }?>
				<?php if($a['android_store_id']!='' && $a['android_active']){?>
					<div class="l_nicebox">
							<?php foreach($tmp_langarr as $l){?>
							<div>
								<div class="l_mtb5">Through Website <?=($l['id']==0?'Generic':$l['title'])?></div>	
								<div>
									<?php $tmp_link=url.'android'.($l['id']==0?'':'/'.$l['prefix'])?>
									<div class="l_btn l_btn_small l_btn_copy mid po " onClick="c('<?=$tmp_link?>')">Copy</div>
									<div class="l_btn l_btn_small mid" onClick="visit('<?=$tmp_link?>',true)">Visit</div>
									<div class="l_f9 mid"><?=$tmp_link?></div>
								</div>
							</div>
							<?php }?>
							<div>
								<div class="l_mtb5">Direct Generic</div>
								<div>
									<?php $link='https://play.google.com/store/apps/details?id='.$a['android_store_id']?>
									<div class="l_btn l_btn_small l_btn_copy mid" onClick="c('<?=$link?>')">Copy</div>
									<div class="l_btn l_btn_small mid" onClick="visit('<?=$link?>',true)">Visit</div>
									<div class="l_f9 mid"><?=$link?></div>
								</div>
							</div>
					</div>
				<?php }?>
			</div>
		<?php }?>
	</div>
	<?php
	}
?>

</div>
	

<div id="dash_credit" class="l_grid2 l_imgs_medium l_mt10">
	<div class="l_nicebox">
		<img alt="LegionCMS" class="l_img_dark" src="<?= $legion['resources']['logo_medium'] ?>"/>

	<div class="legion_desc">
		<?= l("
		Legion engine design and development by ProVision LLC - Ramallah, Palestine. Which is used exclusively only for ProVision's clients.
		<>
		محرك الليجن Legion من تصميم وتطوير شركة بروفجن م.خ.م - رام الله، فلسطين
		هذا النظام فقط لزبائن شركة بروفجن
							   ");?>
		</div>

		<div class="supp_info">
		<div class="center_info_line"><i class="mid">language</i><a target="_blank" href="https://legioncms.com" class="center_info mid">https://legioncms.com</a></div>			
	</div>
	</div><!--

	--><div class="l_nicebox">
	<a href="<?=$legion['provision']['link']?>" target="_blank" title="<?=l('Go to<>اذهب الى').' '.$legion['provision']['name'];?>"><img class="l_img_dark" alt="<?=l('ProVision<>بروفجن')?>" src="<?= $legion['provision']['logo_medium'];?>" alt="<?= $legion['provision']['name'];?>"/></a>

	<div class="supp_info">
		<div class="center_info_line"><i class="mid">phone</i><div class="center_info mid bidi">+972 2 2989863</div></div>					
		<div class="center_info_line"><i class="mid">email</i><a href="mailto:info@provision.ps" class="center_info mid">info@provision.ps</a></div>
		<div class="center_info_line"><i class="mid">language</i><a target="_blank" href="https://provision.ps/en" class="center_info mid">https://provision.ps</a></div>			
		<div class="center_info_line"><i class="mid">location_on</i><div class="center_info mid">
			<?= l("
			Elite Bld. #33, 3rd floor, Masyon / Ramallah - Palestine
			<>
			عمارة اليت، رقم 33
			الماصيون، رام الله - فلسطين
				 ");?></div></div>
	</div>


	</div>
</div>
</div>