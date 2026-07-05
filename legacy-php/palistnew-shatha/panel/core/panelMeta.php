<?php
	//default delimeter
	$delim=' | ';
	//default array
	$meta_array=array(
		'sep'=>' | ',
		'title'=>l('Panel<>لوحة').' '.l($settings['site_short_name']), 
		'site_name'=>l($settings['site_name']),
		'image'=>u.$settings['facebook'],
		'desc'=>"The control panel for ".l($settings['site_name'])." developed by ProVision",
		'author'=>$settings['author'],
		'url'=>url,
		'user_name'=>'ProVision',
		'image_width'=>1300,
		'image_height'=>630,
		'delimiter'=>' | '
	
	);
	
if($module!=''){
	$meta_array['title'].=$meta_array['delimiter'].l($m['info']['module_name']);
}
elseif(isset($title)){
	$meta_array['title'].=$meta_array['delimiter'].l($title);
}
?>
<title><?= $meta_array['title']?></title>
<meta name="robot" content="noindex,nofollow">

<link rel="shortcut icon" href="<?=u.img($settings['fav'],32,100)?>" id="no-preference-scheme-icon"  media="(prefers-color-scheme: no-preference)">
<?php if($settings['fav_dark']!=''){?>
<link rel="shortcut icon" href="<?=u.img($settings['fav'],32,100)?>" id="light-scheme-icon"  media="(prefers-color-scheme: light)">
<link rel="shortcut icon" href="<?=u.img($settings['fav_dark'],32,100)?>" id="dark-scheme-icon"  media="(prefers-color-scheme: dark)">
<?php }?>

<meta name="description" content="<?= $meta_array['desc']; ?>">
<meta name="generator" content="ProVision"/>
<meta name="author" content="<?= $meta_array['author'] ?>">

<meta property="og:url" content="<?= $meta_array['url'];?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= $meta_array['title']?>">
<meta property="og:image" content="<?= url.$meta_array['image'];?>">
<meta property="og:description" content="<?= $meta_array['desc']; ?>">
<meta property="og:site_name" content="<?= $meta_array['title'] ?>"/>
<meta property="article:author" content="<?= $meta_array['user_name'] ?>"/>

<meta name="twitter:card" content="summery">
<meta name="twitter:site" content="@<?= $meta_array['title'] ?>">
<meta name="twitter:creator" content="@<?= $meta_array['author'] ?>">
<meta name="twitter:title" content="<?= $meta_array['title']?>">
<meta name="twitter:description" content="<?= $meta_array['desc']; ?>">
<meta name="twitter:image" content="<?= url.$meta_array['image'];?>">
<meta name="twitter:url" content="<?= $meta_array['url'];?>"/>