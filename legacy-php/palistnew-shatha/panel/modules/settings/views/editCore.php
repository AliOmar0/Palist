<?php if(!privilege('settings','editCore'))echo $noPermission;else{?>

<form id="settings" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="action" value="editCore"/> 
<input type="hidden" name="module" value="settings"/> 

<!--inputs below -->

<div class="form_field">
<label>Main URL
<div class="help">
	<i>help_outline</i>
	<span>without http:// and  without '/'</span>
</div>
</label>
<div class="input_area">
<input required class="main_color_border" name="main_url" type="text" value="<?php echo $settings['main_url']?>"/>
</div>
</div>

<div class="form_field in ontwo">
<label>cPanel Folder</label>
<div class="input_area">
<input required class="main_color_border" name="cpanel_folder" type="text" value="<?php echo $settings['cpanel_folder']?>"/>
</div>
</div><!--

--><div class="form_field in ontwo">
<label>CMS Folder<div class="help">
	<i>help_outline</i>
	<span>default empty, its if you have the cms not in the public_html</span>
</div>
</label>
<div class="input_area">
<input class="main_color_border" name="cms_folder" placeholder="leave empty if its as default" type="text" value="<?php echo $settings['cms_folder']?>"/>
</div>
</div>


<div class="form_field  in ontwo">
<label>DB Charset</label>
<div class="input_area">
<input required class="main_color_border" name="charset" type="text" value="<?php echo $settings['charset']?>"/>
</div>
</div><!--

	
--><div class="form_field  in ontwo">
<label>PHP Timezone</label>
<div class="input_area">
<input required class="main_color_border" name="timezone" type="text" value="<?php echo $settings['timezone']?>"/>
</div>
</div>
	
	
	
<div class="form_field in ontwo">
<label>Allowed Photo Extentions</label>
<div class="input_area">
<input required class="main_color_border" name="photo" type="text" value="<?php
	$string=NULL;
	foreach($settings['photo'] as $value){
		$string=$string.$value.',';
	}
	echo rtrim($string,',');
	unset($string);																		
	?>"/>
</div>
</div><!--

--><div class="form_field in ontwo">
<label>Allowed Files Extentions</label>
<div class="input_area">
<input required class="main_color_border" name="file" type="text" value="<?php
   $string=NULL;
	foreach($settings['file'] as $value){
		$string=$string.$value.',';
	}
	echo rtrim($string,',');
 ?>"/>
</div>
</div>



	<div class="form_field in ontwo">
<label>Visibilty on Search Engines</label>
<div class="input_area">
<select name="visibility"  class="main_color_border">
	<option class="main_color_bg whiteFont" <?=($settings['visibility']==0 ? ' selected ' : '') ?> value="0">NOINDEX,NOFOLLOW</option>
	<option  class="main_color_bg whiteFont" <?=($settings['visibility']==1 ? ' selected ' : '') ?> value="1">INDEX,FOLLOW</option>
</select>
</div>
</div><!--
	
	
--><div class="form_field in ontwo">
<label>HTTP Protocol</label>
<div class="input_area">
<select name="http" class="main_color_border">
	<option class="main_color_bg whiteFont" <?=($settings['http']==0 ? ' selected ' : '') ?> value="0">HTTP</option>
	<option class="main_color_bg whiteFont" <?=($settings['http']==1 ? ' selected ' : '') ?> value="1">HTTPS</option>
</select>
</div>
</div>


	
	
	<div class="form_field in ontwo">
<label>WWW Protocol</label>
<div class="input_area">
<select name="www" class="main_color_border">
	<option class="main_color_bg whiteFont" <?=($settings['www']==0?' selected ':'')?> value="0">Off</option>
	<option class="main_color_bg whiteFont" <?=($settings['www']==1?' selected ':'')?> value="1">On</option>
</select>
</div>
</div><!--
	
	
--><div class="form_field in ontwo">
<label>Custom Error Log Path</label>
<div class="input_area">
<input required class="main_color_border" name="custom_errorlog_path" type="text" value="<?=$settings['custom_errorlog_path']?>"/>
</div>
</div>
	
	
	
	
<div class="form_field in ontwo">
<label>Max File Size (in bytes) - knowing that: post_max_size = <?= ini_get('post_max_size');?>, upload_max_filesize = <?= ini_get('upload_max_filesize');?></label>
<div class="input_area">
<input required class="main_color_border" name="max_upload_size" type="number" value="<?=$settings['max_upload_size']?>"/>
</div>
</div>


<div class="form_field in ontwo">
<label>Author</label>
<div class="input_area">
<input required class="main_color_border" name="author" type="text" value="<?=$settings['author']?>"/>
</div>
</div>
	


<div class="form_field noselect">
<div class="input_area">
<input type="checkbox" id="debug" class="css-checkbox" name="debug" <?php if($settings['debug']==1)echo 'checked';?> />
	<label for="debug">Debug Mode</label>

</div>
</div>
	
	
	

	
	
	
<div class="form_field noselect">
<div class="input_area">
<input type="checkbox" id="clear_cache" class="css-checkbox" name="clear_cache" <?php if($settings['clear_cache']==1)echo 'checked';?> />
	<label for="clear_cache">Clear CSS & JS Cache</label>

</div>
</div>
	
	
	
		
<div class="form_field noselect">
<div class="input_area">
<input type="checkbox" id="clear_cache_panel" class="css-checkbox" name="clear_cache_panel" <?php if($settings['clear_cache_panel']==1)echo 'checked';?> />
	<label for="clear_cache_panel">Clear CSS & JS Cache for Panel</label>

</div>
</div>


<div class="form_field noselect">
<div class="input_area">
<input type="checkbox" id="legacy_mode" class="css-checkbox" name="legacy_mode" <?php if($settings['legacy_mode']==1)echo 'checked';?> />
	<label for="legacy_mode">Legacy Mode</label>
</div>
</div>
	

<div class="form_field noselect">
<div class="input_area">
<input type="checkbox" id="aos_animation" class="css-checkbox" name="aos_animation" <?php if($settings['aos_animation']==1)echo 'checked';?> />
	<label for="aos_animation">AOS Animation</label>
</div>
</div>

	
	
	
<div class="form_field noselect">
<div class="input_area">
<input type="checkbox" id="uc" class="css-checkbox" name="uc" <?php if($settings['uc']==1)echo 'checked';?> />
	<label for="uc">Under Construction Mode</label>

</div>
</div>
	
<div class="form_field noselect">
<div class="input_area">
<input type="checkbox" id="exec_time" class="css-checkbox" name="exec_time" <?php if($settings['exec_time']==1)echo 'checked';?> />
<label for="exec_time">Show PHP Execution Time</label>
</div>
</div>
	
	
	
<div class="form_field noselect">
<div class="input_area">
<input type="checkbox" id="custom_system" class="css-checkbox" name="custom_system" <?php if($settings['custom_system']==1)echo 'checked';?> />
<label for="custom_system">Custom System</label>
</div>
</div>
	
	
	
<div class="form_field noselect">
<div class="input_area">
<input type="checkbox" id="auto_lang" class="css-checkbox" name="auto_lang" <?php if($settings['auto_lang']==1)echo 'checked';?> />
<label for="auto_lang">Auto Detect Home Page Language</label>
</div>
</div>
	
	
	


<div class="form_field">
<label>Main Language</label> 
<div class="input_area">

<select name="language">
<?php 
$sub_resp=db('languages_1557157519','WHERE deleted=0',NULL,NULL);
			if($sub_resp==0)  {?><option value="0" selected>Error</option> <?php } 
			else if($sub_resp==1) {?><option value="0" selected>None</option> <?php } 
				else { for($j=0;$j<count($sub_resp);$j++){?>
				<option <?php echo($sub_resp[$j]['id']==$settings['language'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?php echo $sub_resp[$j]['id']?>"><?php echo $sub_resp[$j]['title']; ?></option>
<?php 
				}//for
			}//else
			unset($sub_resp);
?>
			</select>
			
</div>
</div>
	
	
	
	
	<div class="form_field">
<label>Are you Sure? (form check)</label>
<div class="input_area">
<select name="are_you_sure" class="main_color_border">
	<option  class="main_color_bg whiteFont" <?php echo ($settings['are_you_sure']==0 ? ' selected ' : '') ?> value="0">Disable</option>
	<option  class="main_color_bg whiteFont" <?php echo ($settings['are_you_sure']==1 ? ' selected ' : '') ?> value="1">Enable</option>
</select>
</div>
</div>
	
	
	
	
	
	
	<div id="needs">
		EasyApache/Server Enviroment needed:
		<br><br>
		
			Mod Security / CMC Rules / modsec<br>
		<br>210230<br>
		212340<br>
		212620<br>
		212890<br>
		212740<br>
		<br><br>
		
		
		AlmaLinux
		<br><br>
		Apache > 2.4.54 (must be cPanel current version of apache)
		<br><br>
		
		Apache Modules Apache: mod_http2
				<br>
				<br>

		 PHP Versions : <php8 class="1"></php8>
				<br>
				<br>
		
		 PHP Extensions: php83-php-curl,php83-php-gd,php83-php-zip
		
		<br><br>
		Not easy apache but needed:
		ImageMagick, 
		
		<br><br>
		Better to have
		<br>
		ffmpeg (not available on easyapache)
		
		<br><br>
		PHP INI: allow_url_fopen, file_uploads, max_execution_time = 180, max_input_time = 180, max_input_vars = 3000, memory_limit = 1024M, post_max_size = 50M, session.gc_maxlifetime = 1440, upload_max_filesize = 50M,
		max_file_uploads = 100,
		output_compression enabled (preferred)

		<br><br>
		Apache Config Include Editor: 
		<br>Strict-Transport-Security (HSTS)
		<br>PHP handler must be suphp NOT fpm

		<br><br>
		MySQL: disable strict mode

		<br>

		<br>
		<br>
		<br>
		<br>
		Server environment needed is:
		<br>PHP 8.3.10
		<br>PHP INI: allow_url_fopen, file_uploads, max_execution_time = 180, max_input_time = 180, max_input_vars = 3000, memory_limit = 1024M, post_max_size = 50M, session.gc_maxlifetime = 1440, upload_max_filesize = 50M, max_file_uploads = 100, output_compression
		<br>PHP libraries: standard packages + php83-php-curl,php83-php-gd,php83-php-zip,ImageMagick,php83-php-xml
		<br>
		<br>

		<br>Apache>2.4.54
		<br>Apache mod: mod_http2Config 
		<br>Enable: Strict-Transport-Security (HSTS)
		<br>PHP handler: suphp
		<br>
		<br>
		<br>MySQL: 10.11.9-MariaDB
		<br>Database client version: libmysql - mysqlnd 8.3.9
		<br>MySQL: disable strict mode 
		<br>

<br>Other needs:
<br>Valid SSL
<br>Backup solution
<br>Firewall software

		
	</div>
<!--inputs above -->
</form>
<?php } ?>