<?php 
$id=check_get_id();
$_form_resp=db('module_fields','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('module_fields','view') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<div id="module_fields_view_<?=$id;?>" class="viewActionDiv" data-id="<?=$id;?>" data-module="module_fields"><!--

		--><div class="view_box  module_fields_view_module_id  ">
<div class="view_label view_label_module_id"><?=l('Module ID<>')?></div>
<div class="viewValue  "><?php 
$addition_where=NULL;
$sub_resp=db('modules',"WHERE deleted=0  AND id='".$_form_resp[0]['module_id']."'  $addition_where",NULL,'LIMIT 1');
                    $echoFields='module_name';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($sub_resp[0][$x[$e]]); 
                        }
                        }
                        ?></div>
</div><!--

		--><div class="view_box  module_fields_view_field_name  ">
<div class="view_label view_label_field_name"><?=l('Field Name<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['field_name'])?></div>
</div><!--

		--><div class="view_box  module_fields_view_label  ">
<div class="view_label view_label_label"><?=l('Label<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['label'])?></div>
</div><!--

		--><div class="view_box  module_fields_view_type  ">
<div class="view_label view_label_type"><?=l('Type<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['type'])?></div>
</div><!--

		--><div class="view_box  module_fields_view_sub_type  ">
<div class="view_label view_label_sub_type"><?=l('Sub Type<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['sub_type'])?></div>
</div><!--

		--><div class="view_box  module_fields_view_sub_sub_type  ">
<div class="view_label view_label_sub_sub_type"><?=l('Sub Sub Type<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['sub_sub_type'])?></div>
</div><!--

		--><div class="view_box  module_fields_view_protected_file  ">
<div class="view_label view_label_protected_file"><?=l('Protected File<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['protected_file']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  module_fields_view_main  ">
<div class="view_label view_label_main"><?=l('Main<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['main']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  module_fields_view_select_table  ">
<div class="view_label view_label_select_table"><?=l('Select Table<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['select_table'])?></div>
</div><!--

		--><div class="view_box  module_fields_view_select_field  ">
<div class="view_label view_label_select_field"><?=l('Select Field<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['select_field'])?></div>
</div><!--

		--><div class="view_box  module_fields_view_parenter_field  ">
<div class="view_label view_label_parenter_field"><?=l('Parenter Field<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['parenter_field']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  module_fields_view_is_ml  ">
<div class="view_label view_label_is_ml"><?=l('Is ML<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['is_ml']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  module_fields_view_is_unique  ">
<div class="view_label view_label_is_unique"><?=l('Is Unique<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['is_unique']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  module_fields_view_noMCE  ">
<div class="view_label view_label_noMCE"><?=l('NoMCE<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['noMCE']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  module_fields_view_required  ">
<div class="view_label view_label_required"><?=l('Required<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['required']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  module_fields_view_multi_files  ">
<div class="view_label view_label_multi_files"><?=l('Multi Files<>')?></div>
<div class="viewValue  checkboxView "><i><?=$_form_resp[0]['multi_files']?'done':'close'?></i></div>
</div><!--

		--><div class="view_box  module_fields_view_visibility_matrix  ">
<div class="view_label view_label_visibility_matrix"><?=l('Visibility Matrix<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['visibility_matrix'])?></div>
</div><!--

		--><div class="view_box  module_fields_view_db_default  ">
<div class="view_label view_label_db_default"><?=l('DB Default<>')?></div>
<div class="viewValue  "><?=l($_form_resp[0]['db_default'])?></div>
</div><!--

--></div>
<?php } ?>