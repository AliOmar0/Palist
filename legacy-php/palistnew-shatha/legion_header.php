<?php if($settings['clear_cache']==1)header('Cache-Control: no-store, no-cache, must-revalidate');
	$indicator=isset($_GET['indicator'])?urldecode(escape($_GET['indicator'])):'';
    $uri=$_SERVER['REQUEST_URI'];
	


	$__uri_parsed=parse_url($uri);
	$__uri_parts=explode('/',$__uri_parsed['path']);
	
	$ishome=false;
	if($settings['cms_folder']==''){
		if(count($__uri_parts)>3){
			$indicator=urldecode(escape($__uri_parts[3]));
		}
	
		if(count($__uri_parts)==3 && $__uri_parts[2]==''){
			$ishome=true;
		}
	}else{

		if(count($__uri_parts)>4){
			$indicator=urldecode(escape($__uri_parts[4]));
		}
	
		if(count($__uri_parts)==4 && $__uri_parts[3]==''){
			$ishome=true;
		}
	}

	$originalMetaArray=$metaArray=[
		'sep'=>' | ',
		'title'=>l($settings['site_name']), 
		'desc'=>strip_tags(l($settings['site_desc'])), 
		'site_name'=>l($settings['site_name']),
		'image'=>u.$settings['facebook'],
		'image_width'=>1300,
		'image_height'=>630
		];
	
		include 'autoMeta.php';

?>
<!doctype html>
<html dir="<?=direction()?>" lang="<?=curr()?>"
    <?=$settings['html_background_color']==''?'':'style="background-color:'.$settings['html_background_color'].'"'?>>
<?=rights?>

<head>
    <link href="<?=fres?>css/fonts.css<?php clearCache()?>" rel="preload stylesheet" as="style">
    <BASE href="<?=url?>">
    <meta charset="UTF-8" />
    <link rel="canonical" href="<?=$actual_link?>" />
    <?php if($noLangLink==$actual_link){$__hreflang_same=true?>
    <link rel="alternate" hreflang="<?=curr()?>" href="<?=$actual_link?>" />
    <?php }
else $__hreflang_same=false;
	if(count($langArr)>1){
		foreach($langArr as $l){
			if($__hreflang_same && curr()==$l['prefix'])continue;
			if(!$l['active'])continue;?>
    <link rel="alternate" hreflang="<?=$l['prefix']?>"
        href="<?=str_replace('/'.curr().'/','/'.$l['prefix'].'/',$actual_link)?>" />
    <?php }}?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <?php require 'legion_meta.php'?>

    <!--ProVision Legion Resources-->
    <?php require panel_dir.'sharedHeader.php'?>

    <link rel="stylesheet" type="text/css" href="<?=fres?>css/provision.css<?php clearCache()?>" media="all" />
    <link rel="stylesheet" href="<?=pres?>css/mce.css<?php clearCache()?>" media="none" onload="this.media='all';" />
    <link rel="stylesheet" type="text/css" href="<?=fres?>css/main.css<?php clearCache()?>" media="all" />
    <<<<<<< HEAD <?php if(file_exists(fres_dir.'css/hero_split.css')){?><link rel="stylesheet" type="text/css"
        href="<?=fres?>css/hero_split.css<?php clearCache()?>" media="all" /><?php }?>
    =======
    >>>>>>> origin/Ali
    <?php if(file_exists(fres_dir.'css/commerce.css')){?>
    <link rel="stylesheet" type="text/css" href="<?=fres?>css/commerce.css<?php clearCache()?>" media="all" /><?php }?>
    <?php if(direction()=='rtl'){?>
    <link rel="stylesheet" type="text/css" href="<?=fres?>css/rtl.css<?php clearCache()?>" media="all" /><?php }?>

    <link rel="stylesheet" type="text/css" href="<?=fres?>css/responsive.css<?php clearCache()?>" media="all" />
    <?php if(!isset($noAOS)){?>
    <link rel="stylesheet" type="text/css" href="<?=fres?>css/aos.css<?php clearCache()?>" media="none"
        onload="this.media='all';" />
    <?php }?>
    <link rel="stylesheet" type="text/css" href="<?=pres?>css/fontawesome.min.css<?php clearCache()?>" media="none"
        onload="this.media='all';" />
    <link rel="stylesheet" type="text/css" href="<?=pres?>css/solid.min.css<?php clearCache()?>" media="none"
        onload="this.media='all';" />
    <link rel="stylesheet" type="text/css" href="<?=pres?>css/brands.min.css<?php clearCache()?>" media="none"
        onload="this.media='all';" />

    <script src="<?=fres?>js/plugins.js<?php clearCache()?>" defer></script>
    <?=connection('g_analytics')?>
    <?=connection('head_js')?>

</head>

<body>
    <?php if(super() && strpos($uri,'/post/')!==false){?>
    <div style="position:fixed;padding:20px;background:black;z-index: 999999999999;text-align:center;left:0;">
        <a target="_blank" class="l_btn"
            href="<?=urlPanel.'?module=posts_851898&action=edit&id='.$post['id']?>">Edit</a>
    </div>

    <?php }?>

    <div id="roller" class="hidden" class="main_color_bg">
        <img id="rolling_img" class="mid" alt="Legion loading" loading="lazy" src="<?=u.'loading.gif'?>" />
        <div id="rolling_msg" class="mid"></div>
        <div id="percentage_upload_box">
            <div id="percentage_upload_text"></div>
            <div id="percentage_upload_filler"></div>
        </div>
    </div>

    <div id="general_msg_area" style="display:none" class="hidden"></div>