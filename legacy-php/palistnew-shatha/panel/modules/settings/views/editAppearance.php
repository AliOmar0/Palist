<?php if(!privilege('settings','editAppearance'))echo $noPermission;else{?>
<form id="settings" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="action" value="editAppearance"/> 
<input type="hidden" name="module" value="settings"/> 


<!--inputs below -->
<!--
	
	
--><div class="form_field onfour in  settings_appearance_1642270332_main_color">
<label for="for_field_main_color"><?= l('Main Color<>');?></label>
<div class="input_area">
<input id="for_field_main_color"  type="color" name="main_color" placeholder="<?= l('Main Color<>');?>" value="<?= htmlspecialchars($settings['main_color']) ?>"/>
</div>
</div><!--


	
	
--><div class="form_field onfour in  settings_appearance_1642270332_sub_main_color">
<label for="for_field_sub_main_color"><?= l('Sub Menu Color<>');?></label>
<div class="input_area">
<input id="for_field_sub_main_color"  type="color" name="sub_menu_color" placeholder="<?= l('Sub Main Color<>');?>" value="<?= htmlspecialchars($settings['sub_menu_color']) ?>"/>
</div>
</div><!--

--><div class="form_field onfour in  settings_appearance_1642270332_html_background_color">
	<label for="for_field_html_background_color"><?= l('HTML Background Color<>');?></label>
	<div class="input_area">
	<input id="for_field_html_background_color"  type="color" name="html_background_color" placeholder="<?= l('HTML Background Color<>');?>" value="<?= htmlspecialchars($settings['html_background_color']) ?>"/>
	</div>
</div><!--


	
	
--><div class="form_field  settings_appearance_1642270332_Images">
<label for="for_field_Images"></label>
<div class="input_area">
<div class="group"><?= l('Images<>');?></div>
</div>
</div><!--


	
	
--><div class="form_field onfour in  settings_appearance_1642270332_logo">
<label for="for_field_logo"><?= l('Logo<>');?></label>
<div class="input_area">
<div class="pointer pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('settings_appearance_1642270332_logo',false,false)"><img src="<?= uploads_link.($settings['logo']=='' ? 'photo.png' : img($settings['logo'],200,100));  ?>" /></div>
	<div class="in clearFiles pointer <?= $settings['logo']=='' ? 'hidden':'' ?>" onclick="pvp_clear('settings_appearance_1642270332_logo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="logo" value="<?= $settings['logo']?>"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span><?= $settings['logo']=='' ? 0:count(explode(',',$settings['logo'])) ?></span><div class="fileFullname"><?= detail('files_1577206823','original_name','full_name',$settings['logo'])?></div></div>
	
</div>
</div><!--


	
	
--><div class="form_field onfour in  settings_appearance_1642270332_fav">
<label for="for_field_fav"><?= l('Fav<>');?></label>
<div class="input_area">
<div class="pointer pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('settings_appearance_1642270332_fav',false,false)"><img src="<?= uploads_link.($settings['fav']=='' ? 'photo.png' : img($settings['fav'],200,100));  ?>" /></div>
	<div class="in clearFiles pointer <?= $settings['fav']=='' ? 'hidden':'' ?>" onclick="pvp_clear('settings_appearance_1642270332_fav')"><i class="md-light">delete</i></div>
	<input type="hidden" name="fav" value="<?= $settings['fav']?>"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span><?= $settings['fav']=='' ? 0:count(explode(',',$settings['fav'])) ?></span><div class="fileFullname"><?= detail('files_1577206823','original_name','full_name',$settings['fav'])?></div></div>
	
</div>
</div><!--


	--><div class="form_field onfour in  settings_appearance_1642270332_fav_dark">
<label for="for_field_fav_darkv"><?= l('Fav Dark<>');?></label>
<div class="input_area">
<div class="pointer pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('settings_appearance_1642270332_fav_dark',false,false)"><img src="<?= uploads_link.($settings['fav_dark']=='' ? 'photo.png' : img($settings['fav_dark'],200,100));  ?>" /></div>
	<div class="in clearFiles pointer <?= $settings['fav_dark']=='' ? 'hidden':'' ?>" onclick="pvp_clear('settings_appearance_1642270332_fav_dark')"><i class="md-light">delete</i></div>
	<input type="hidden" name="fav_dark" value="<?= $settings['fav_dark']?>"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span><?= $settings['fav_dark']=='' ? 0:count(explode(',',$settings['fav_dark'])) ?></span><div class="fileFullname"><?= detail('files_1577206823','original_name','full_name',$settings['fav_dark'])?></div></div>
	
</div>
</div><!--

	
--><div class="form_field onfour in  settings_appearance_1642270332_facebook">
<label for="for_field_facebook"><?= l('Facebook<>');?></label>
<div class="input_area">
<div class="pointer pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('settings_appearance_1642270332_facebook',false,false)"><img src="<?= uploads_link.($settings['facebook']=='' ? 'photo.png' : img($settings['facebook'],200,100));  ?>" /></div>
	<div class="in clearFiles pointer <?= $settings['facebook']=='' ? 'hidden':'' ?>" onclick="pvp_clear('settings_appearance_1642270332_facebook')"><i class="md-light">delete</i></div>
	<input type="hidden" name="facebook" value="<?= $settings['facebook']?>"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span><?= $settings['facebook']=='' ? 0:count(explode(',',$settings['facebook'])) ?></span><div class="fileFullname"><?= detail('files_1577206823','original_name','full_name',$settings['facebook'])?></div></div>
	
</div>
</div><!--

-->
	<div class="form_field onfour in  settings_appearance_1642270332_login">
<label for="for_field_login"><?= l('Login Background<>');?></label>
<div class="input_area">
<div class="pointer pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('settings_appearance_1642270332_login',false,false)"><img src="<?= uploads_link.($settings['login']=='' ? 'photo.png' : img($settings['login'],200,100));  ?>" /></div>
	<div class="in clearFiles pointer <?= $settings['login']=='' ? 'hidden':'' ?>" onclick="pvp_clear('settings_appearance_1642270332_login')"><i class="md-light">delete</i></div>
	<input type="hidden" name="login" value="<?= $settings['login']?>"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span><?= $settings['login']=='' ? 0:count(explode(',',$settings['login'])) ?></span><div class="fileFullname"><?= detail('files_1577206823','original_name','full_name',$settings['login'])?></div></div>
	
</div>
</div>
	
	
<!--inputs above -->
	
	
</form>
<?php }?>

