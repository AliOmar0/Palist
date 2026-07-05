<?php 

	

	$as_home=false;

#custom meta#
if (strpos($uri, '/search.php') !== false){
	$metaArray['title']= $metaArray['title'].$metaArray['sep'].l('Search<>البحث');
}

include cd.'custom_meta.php';

//else{
//	$as_home=true;
//}
#custom meta#
	?>

	<!--classic meta-->
	<meta content="<?= $settings['author'] ?>" name="author"/>
	<meta content="LEGION CMS - ProVision" name="engine"/>
	<meta content="<?= $legion['website_link'];?>" name="engine link"/>
	<meta name="ROBOTS" content="<?=($settings['visibility']==0 || isset($noIndex)?'NOINDEX,NOFOLLOW':'INDEX,FOLLOW')?>">
	<meta content="<?=l($metaArray['desc'])?>" name="description"/>    
	<title><?= l($metaArray['title']); ?></title>
	<link rel="shortcut icon" href="<?=u.img($settings['fav'],32,100)?>" id="no-preference-scheme-icon"  media="(prefers-color-scheme: no-preference)">
	<?php if($settings['fav_dark']!=''){?>
<link rel="shortcut icon" href="<?=u.img($settings['fav'],32,100)?>" id="light-scheme-icon"  media="(prefers-color-scheme: light)">
	<link rel="shortcut icon" href="<?=u.img($settings['fav_dark'],32,100)?>" id="dark-scheme-icon"  media="(prefers-color-scheme: dark)">
	<?php }?>
<link rel="apple-touch-icon" sizes="180x180" href="<?= u.img($settings['logo'],180,100);?>">

	<!--OG-->
	<meta property="og:image:width" content="<?= $metaArray['image_width'] ?>" />
	<meta property="og:image:height" content="<?= $metaArray['image_height'] ?>" />
	<meta property="og:title" content="<?= l($metaArray['title']) ?>"/>
	<meta property="fb:app_id" content="<?= connection('fb_app_id');?>" />
	<meta property="og:image"  content="<?= $metaArray['image'] ?>"/>
    
	<meta property="og:locale" content="<?=curr()?>" />
	<meta property="og:image:alt" content="<?=l($metaArray['desc'])?>"/>
	<meta property="og:url" content="<?=$actual_link?>"/>
	<meta property="og:site_name" content="<?=l($metaArray['site_name'])?>"/>
	<meta property="og:description" content="<?=l($metaArray['desc'])?>"/>
	<meta property="og:type" content="website"/> 

	<!--web app manifist-->
	<link rel="manifest" href="<?= url?>manifest.json">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="application-name" content="<?= l($metaArray['title']) ?>">
	<meta name="apple-mobile-web-app-title" content="<?= l($metaArray['title']) ?>">
	<meta name="theme-color" content="#f7f7f7">
	<meta name="msapplication-navbutton-color" content="#f7f7f7">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="msapplication-starturl" content="<?= url?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">