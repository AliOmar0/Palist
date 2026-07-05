<?php 
$id=check_get_id();
$_form_resp=db('protected_files_hash_863024','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('protected_files_hash_863024','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="protected_files_hash_863024_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="protected_files_hash_863024"><!--

		--><div class="view_box  protected_files_hash_863024_view_file_name  ">
<div class="view_label view_label_file_name"><?=l('File Name<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['file_name'])?></div>
</div><!--

		--><div class="view_box  protected_files_hash_863024_view_requested_file_version  ">
<div class="view_label view_label_requested_file_version"><?=l('Requested File Version<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['requested_file_version'])?></div>
</div><!--

		--><div class="view_box  protected_files_hash_863024_view_ip  ">
<div class="view_label view_label_ip"><?=l('IP<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['ip'])?></div>
</div><!--

		--><div class="view_box  protected_files_hash_863024_view_device  ">
<div class="view_label view_label_device"><?=l('Device<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['device'])?></div>
</div><!--

		--><div class="view_box  protected_files_hash_863024_view_version  ">
<div class="view_label view_label_version"><?=l('Version<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['version'])?></div>
</div><!--

		--><div class="view_box  protected_files_hash_863024_view_user  ">
<div class="view_label view_label_user"><?=l('User<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['user'])?></div>
</div><!--

		--><div class="view_box  protected_files_hash_863024_view_user_module  ">
<div class="view_label view_label_user_module"><?=l('User Module<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['user_module'])?></div>
</div><!--

		--><div class="view_box  protected_files_hash_863024_view_hash  ">
<div class="view_label view_label_hash"><?=l('Hash<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['hash'])?></div>
</div><!--

--></div>
<?php } ?>