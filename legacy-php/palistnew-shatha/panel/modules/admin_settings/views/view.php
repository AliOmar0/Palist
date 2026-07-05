<?php 
$id=check_get_id();
$_form_resp=db('admin_settings','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('admin_settings','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="admin_settings_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="admin_settings"><!--

		--><div class="view_box  admin_settings_view_admin  ">
<div class="view_label view_label_admin"><?=l('Admin<>المدير')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('admins',"WHERE deleted=0  AND id='".$_form_resp[0]['admin']."'  $addition_where",NULL,'LIMIT 1');
					echo select_echo('admin_settings','admin',$sub_resp[0],true);
                        ?></div>
</div><!--

		--><div class="view_box  admin_settings_view_status_report  ">
<div class="view_label view_label_status_report"><?=l('Status Report<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['status_report']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  admin_settings_view_storage  ">
<div class="view_label view_label_storage"><?=l('Storage<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['storage']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  admin_settings_view_datetime  ">
<div class="view_label view_label_datetime"><?=l('Datetime<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['datetime']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  admin_settings_view_todo  ">
<div class="view_label view_label_todo"><?=l('Todo<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['todo']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  admin_settings_view_app_links  ">
<div class="view_label view_label_app_links"><?=l('App Links<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['app_links']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  admin_settings_view_grid_dashboard  ">
<div class="view_label view_label_grid_dashboard"><?=l('Grid Dashboard<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['grid_dashboard']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  admin_settings_view_colors_palette  ">
<div class="view_label view_label_colors_palette"><?=l('Colors Palette<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['colors_palette']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  admin_settings_view_translations  ">
<div class="view_label view_label_translations"><?=l('Translations<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['translations']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  admin_settings_view_front_control_options  ">
<div class="view_label view_label_front_control_options"><?=l('Front Control Options<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['front_control_options']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  admin_settings_view_sitemap_info  ">
<div class="view_label view_label_sitemap_info"><?=l('Sitemap Info<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['sitemap_info']?'done':'close'?></i></div>
</div><!--

--></div>
<?php } ?>