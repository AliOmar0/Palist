<script>
		var url="<?=url?>";
		var uploads_link="<?=u?>";
		var u="<?=u?>";
		var urlPanel="<?=urlPanel?>";
		var curr='<?=curr()?>';
		var langArr=<?=json_encode($langArr)?>;
	</script>
	
	<style>
		@font-face {
			font-display:swap;
			font-family: 'social';
			font-style: normal;
			font-weight: 400;
			src: url(<?= pres?>fonts/social.ttf) format('truetype');
		}

		@font-face {
		  font-family: 'Material Icons';
		  font-style: normal;
		  font-weight: 400;
		  src: url(<?=pres.'fonts/material-icons.woff2'?>) format('woff2');
		} 
	</style>
	<!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
	
	
	<script src="<?= pres?>js/jquery3.7.1.min.js<?php clearCache();?>"></script>

	<?php if(!isset($modern)){?>
	<link rel="stylesheet" type="text/css" href="<?= pres;?>css/legacy.css<?php clearCache();?>"/>
	<?php }?>
	<link rel="stylesheet" type="text/css" href="<?= pres;?>css/reset.css<?php clearCache();?>"/>
	<link rel="stylesheet" type="text/css" href="<?= pres;?>css/legion_responsive.css<?php clearCache();?>"/>
	<link rel="stylesheet" type="text/css" href="<?= pres?>css/sharedCSS.css<?php clearCache();?>"/>
	<link rel="stylesheet" type="text/css" href="<?= pres?>css/colors.css<?php clearCache();?>"/>
	<?php if(direction()=='rtl'){?>
<link rel="stylesheet" type="text/css" href="<?= pres?>css/sharedCSS_RTL.css<?php clearCache();?>"/>
	<?php }?>