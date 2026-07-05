<?php 
if(!isset($embed_app)){
	$_GET['mobile']=true;
	require 'header.php';
	}
$_app=o('apps_1552305519',1);
if($_app==1){
	echo '<div id="app_download_error">'.l('Contact ProVision to fix the app configuration<>تواصل مع بروفجن لإصلاح اعدادات التطبيق').'</div>';
}else{
	$_app=$_app[0];
	if(!isset($embed_app)){
?>
<div id="app_download_wrap">
	
	<?php }?>
	<div class="par">
		<div class="ch">
			<div id="app_download_cont">
				<?php if(!isset($embed_app)){?>
				<a href="<?= url.'index.php?lang='.curr()?>" title="<?= l($settings['site_short_name'])?>" class="app_download_logo mid">
					<?= pic($settings['logo'],600,100,l($settings['site_short_name']),true,'downa_logo_pic')?>
				</a>
				<?php }?>

				<div class="app_download_title"><?=isset($custom_action_txt)?$custom_action_txt:l('Get '.l($settings['site_short_name']).' App<>
				نزّل تطبيق '.l($settings['site_short_name']))?></div>

				<?php if((!g('device') || (g('device') && $_GET['device']=='all') || (g('device') && $_GET['device']=='ios')) && $_app['apple_store_id']!='' && $_app['ios_active']){?>
					<a href="https://apps.apple.com/us/app/provision/id<?=$_app['apple_store_id']?>?l=<?=curr()?>" id="__ios_app_btn" onclick="gtagSendEvent('<?='https://apps.apple.com/us/app/provision/id'.$_app['apple_store_id'].'?l='.curr()?>','app_store_install_page')" title="<?=l('Download '.l($settings['site_short_name']).' on iOS<> تنزيل تطبيق '.l($settings['site_short_name']).' على ابل')?>" class="app_download_btn">
						<?php pic($_app['ios_download_image']==''?'download_ios.png':$_app['ios_download_image'],400,100,l($settings['site_short_name']),true,NULL,'app_download_btn_img')?>
					</a>
				<?php }?>

				<?php if((!g('device') || (g('device') && $_GET['device']=='all') || (g('device') && $_GET['device']=='android')) && $_app['android_store_id']!='' && $_app['android_active']){?>
				<a href="https://play.google.com/store/apps/details?id=<?=$_app['android_store_id']?>" id="__android_app_btn"  onclick="gtagSendEvent('<?='https://play.google.com/store/apps/details?id='.$_app['apple_store_id']?>','play_store_install_page')" title="<?=l('Download '.l($settings['site_short_name']).' on Android<> تنزيل تطبيق '.l($settings['site_short_name']).' على الاندرويد')?>" class="app_download_btn">
					<?php pic($_app['ios_download_image']==''?'download_android.png':$_app['android_download_image'],400,100,l($settings['site_short_name']),true,NULL,'app_download_btn_img')?>
				</a>
				<?php }?>
				<?php if(!isset($embed_app)){include 'legion_share.php';}?>
			</div>
		</div>	
	</div>
	<?php if(!isset($embed_app)){?>
</div>
<?php }?>
<?php 
	
	 }


?>


<style>
	<?php if(!isset($embed_app)){?>
	mh{display: none;}
	body{font-family: verdana}
	<?php }else{?>

	
	<?php }?>
	
</style>
<script>
  // Helper function to delay opening a URL until a gtag event is sent.
  // Call it in response to an action that should navigate to a URL.
  function gtagSendEvent(url,event_name) {
    gtag('event', event_name);
    return false;
  }

  function getOS() {
  const userAgent = window.navigator.userAgent,
      platform = window.navigator?.userAgentData?.platform || window.navigator.platform,
      macosPlatforms = ['macOS', 'Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
      windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
      iosPlatforms = ['iPhone', 'iPad', 'iPod'];
  let os = null;

  if (macosPlatforms.indexOf(platform) !== -1) {
    os = 'Mac OS';
  } else if (iosPlatforms.indexOf(platform) !== -1) {
    os = 'iOS';
  } else if (windowsPlatforms.indexOf(platform) !== -1) {
    os = 'Windows';
  } else if (/Android/.test(userAgent)) {
    os = 'Android';
  } else if (/Linux/.test(platform)) {
    os = 'Linux';
  }

  return os;
}
<?php if(!isset($embed_app)){?>
	(function() {
	res=getOS();
	//   alert(res);
		if(res=='Android'){
			<?php if((!g('device') || (g('device') && $_GET['device']=='all') || (g('device') && $_GET['device']=='android')) && $_app['android_store_id']!='' && $_app['android_active']){?>
				//__android_app_btn
				document.getElementById('__android_app_btn').click();
				// window.location="https://play.google.com/store/apps/details?id=<?=$_app['android_store_id']?>";
			<?php }?>
		}else if(res=='iOS'){
			<?php if((!g('device') || (g('device') && $_GET['device']=='all') || (g('device') && $_GET['device']=='ios')) && $_app['apple_store_id']!='' && $_app['ios_active']){?>
				//__ios_app_btn
				document.getElementById('__ios_app_btn').click();
				// widnow.location="https://apps.apple.com/us/app/provision/id<?=$_app['apple_store_id']?>?l=<?=curr()?>";
			<?php }?>
		}
	})();
	</script>
<?php }?>

<?php 

if(!isset($embed_app)){
	require 'footer.php';
}