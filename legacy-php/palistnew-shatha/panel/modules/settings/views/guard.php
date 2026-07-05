<?php if(!privilege('settings','guard'))echo $noPermission;else{?>
<div class="form_field">
<label>Hard Reset Modules to Core</label>
<div class="input_area">
	<div class="explainer mid">Delete all uncore modules</div>
	<div onClick="showPop('!','Reset','Are you sure?','Resetting','settings','reset_modules')" class="l_btn mid" title="Reset">Reset</div>
	</div>
</div>

<div class="form_field">
<label>Reset Custom Folder</label>
<div class="input_area">
	<div class="explainer mid">Delete the the whole folder, create it and mandatory files again</div>
	<div onClick="showPop('!','Reset Custom Folder','Are you sure?','Cleaning Custom Folder','settings','reset_custom_folder')" class="l_btn mid" title="Reset Custom Folder">Clean</div>
	</div>
</div>

<div class="form_field">
<label>Reset HTACCESS & regenerate AutoMeta</label>
<div class="input_area">
	<div class="explainer mid">Delete the current htaccess, and make a new one from default; also regenerate autoMeta</div>
	<div onClick="showPop('!','Reset HTACCESS','Are you sure?','Creating New HTACCESS','settings','reset_htaccess')" class="l_btn mid" title="Reset HTACCESS">Reset & Regenerate</div>
	</div>
</div>

<div class="form_field">
<label>Reset uploads, delete fonts.css, empty uploader module..etc</label>
<div class="input_area">
	<div class="explainer mid">Delete all files in uploads folder except the defaults</div>
	<div onClick="showPop('!','Reset UPLOADS','Are you sure?','Resetting Uploads','settings','reset_uploads')" class="l_btn mid" title="Reset HTACCESS">Reset</div>
	</div>
</div>

<div class="form_field">
<label>Reset Settings Table</label>
<div class="input_area">
	<div class="explainer mid">ProVision logos, English language, reply emails..etc</div>
	<div onClick="showPop('!','Reset SETTINGS','Are you sure?','Resetting Settings','settings','reset_default_settings')" class="l_btn mid" title="Reset Settings">Reset</div>
	</div>
</div>

<div class="form_field">
<label>Reset Connections Table</label>
<div class="input_area">
	<div class="explainer mid">Set all to empty fields</div>
	<div onClick="showPop('!','Reset connections','Are you sure?','Resetting Connections','settings','reset_connections')" class="l_btn mid" title="Reset Connections">Reset</div>
	</div>
</div>

<div class="form_field">
<label>Reset UI</label>
<div class="input_area">
	<div class="explainer mid">colors, manifest.json...etc</div>
	<div onClick="showPop('!','Reset','Are you sure?','Resetting','settings','reset_ui')" class="l_btn mid" title="Reset">Reset</div>
	</div>
</div>

<div class="form_field">
<label>Reset Admins</label>
<div class="input_area">
	<div class="explainer mid">delete all admins except ProVision Support, truncate all privileges..</div>
	<div onClick="showPop('!','Reset','Are you sure?','Resetting','settings','reset_admins')" class="l_btn mid" title="Reset">Reset</div>
	</div>
</div>

<div class="form_field">
<label>Truncate Core Modules to Initial State</label>
<div class="input_area">
	<div class="explainer mid">Menu items, PSN, Cookies..etc</div>
	<div onClick="showPop('!','Truncate','Are you sure?','Resetting','settings','reset_truncate')" class="l_btn mid" title="Reset">Truncate</div>
	</div>
</div>

<div class="form_field">
<label>Fixer</label>
<div class="input_area">
	<div class="explainer mid">It solves some warnings, errors, mainly caused by system updates. Safe to be clicked anytime.</div>
	<div onClick="sub({'module':'settings','action':'fix','e':''})" class="l_btn mid" title="Reset">Fix</div>
	</div>
</div>
	
<?php } ?>
															  