<?php

$api_token=escape("o[ignwqefeqff31r2r1'13..'rDfq1c11d4fervrwrv@132EFEEZefe3");
if(!mysqli_query($conn,"UPDATE settings SET main_color='#efb827',html_background_color='#FFFFFF',login_background='',logo='default_logo.png',fav='default_fav.png',fav_dark='default_fav.png',timezone='Asia/Jerusalem',author='ProVision',charset='utf8',site_name='ProVision',http='1',visibility='NOINDEX,NOFOLLOW',site_desc=NULL,default_from='no-reply@".$settings['main_url']."',default_replyto='no-reply@".$settings['main_url']."',api_token='$api_token',auto_lang=0,are_you_sure=0,language=1,sub_menu_color='#feffff',photo='png,jpg,gif,JPEG,PNG,JPG,jpeg,webp,heic,heif',file='png,jpg,gif,jpeg,pdf,doc,docx,xls,zip,ppt,pptx,pub,mp4,mp3,wav,woff,ttf,otf,pdf,webp,heic,heif',facebook='facebook.jpg',debug='0',clear_cache_panel='0',exec_time='0',uc='0',clear_cache='1',site_short_name='ProVision',www=0,custom_errorlog_path=NULL,max_upload_size=50000000"))json(false,3);


json(true,2,NULL,'Reset (settings) table successfully');