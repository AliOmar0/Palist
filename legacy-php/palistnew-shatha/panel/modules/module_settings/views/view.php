<?php 
$id=check_get_id();
$_form_resp=db('module_settings','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('module_settings','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="module_settings_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="module_settings"><!--

		--><div class="view_box  module_settings_view_module_prefix  ">
<div class="view_label view_label_module_prefix"><?=l('Module Prefix<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['module_prefix'])?></div>
</div><!--

		--><div class="view_box  module_settings_view_default_column  ">
<div class="view_label view_label_default_column"><?=l('Default Column<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['default_column'])?></div>
</div><!--

		--><div class="view_box  module_settings_view_default_order  ">
<div class="view_label view_label_default_order"><?=l('Default Order<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['default_order'])?></div>
</div><!--

		--><div class="view_box  module_settings_view_items_per_page  ">
<div class="view_label view_label_items_per_page"><?=l('Items Per Page<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['items_per_page'])?></div>
</div><!--

		--><div class="view_box  module_settings_view_ml_fields  ">
<div class="view_label view_label_ml_fields"><?=l('ML Fields<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['ml_fields'])?></div>
</div><!--

		--><div class="view_box  module_settings_view_menu_field  ">
<div class="view_label view_label_menu_field"><?=l('Menu Field<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['menu_field'])?></div>
</div><!--

--></div>
<?php } ?>