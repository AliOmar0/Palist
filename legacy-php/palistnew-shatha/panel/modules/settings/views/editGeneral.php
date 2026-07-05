<?php if(!privilege('settings','editGeneral'))echo $noPermission;else{?>
<form id="settings" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="action" value="editGeneral"/> 
<input type="hidden" name="module" value="settings"/> 


<!--inputs below -->
<div class="form_field">
<label>Website Name</label>
		<div class="input_area">
<input required class="main_color_border" name="site_name" type="text" value="<?php echo $settings['site_name']?>"/>
</div>
</div>


	<div class="form_field">
<label>Website Shortname (manifest)</label>
			<div class="input_area">
<input required class="main_color_border" name="site_short_name" type="text" value="<?php echo $settings['site_short_name']?>"/>
</div>
	</div>


		<div class="form_field">
<label>Website Description</label>
				<div class="input_area">
<textarea  class="main_color_border mceNoEditor" name="site_desc"><?php echo $settings['site_desc']?></textarea>
</div>
	</div>


		<div class="form_field">
<label>Emails From
<div class="help">
	<i>help_outline</i>
	<span>Recommended no-reply@domain.com</span>
</div>
</label>
				<div class="input_area">
<input required class="main_color_border" name="default_from" type="text" value="<?php echo $settings['default_from']?>"/>
</div>
	</div>


		<div class="form_field">
<label>Emails Replyto
<div class="help">
	<i>help_outline</i>
	<span>usually info@domain.com</span>
	</div>
</label>
		<div class="input_area">
<input required class="main_color_border" name="default_replyto" type="text" value="<?php echo $settings['default_replyto']?>"/>
</div></div>
	<!--inputs above -->
</form>
<?php } ?>