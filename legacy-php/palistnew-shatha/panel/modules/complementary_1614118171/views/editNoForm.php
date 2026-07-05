<?php 
$id=check_get_id();
	$resp=db('complementary_1614118171','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('complementary_1614118171','edit') || $resp==0 || $resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="complementary_1614118171"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	
	
--><div class="form_field ontwo in  complementary_1614118171_mother_module_prefix">
<label for="for_field_mother_module_prefix"><?=l('Mother Module Prefix<>البرمجية');?></label>
<div class="input_area">

<select id="for_field_mother_module_prefix" class="main_color_bg whiteFont" name="mother_module_prefix">
<?php 
$addition_where=NULL;
	
$sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($sub_resp==0)  {?><option value="0" selected>Error</option> <?php } 
			else if($sub_resp==1) {?><option value="0" selected><?=l('Choose<>اختر');?></option> <?php } 
				 else { ?>
                 <option value="0" <?=(0==$resp[0]['mother_module_prefix'] ? 'selected' : ''); ?>><?=l('Choose<>اختر');?></option>
				 
				<?php
				for($j=0;$j<count($sub_resp);$j++){?>
				<option <?=($sub_resp[$j]['id']==$resp[0]['mother_module_prefix'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?=$sub_resp[$j]['id']?>">                
                
                 <?php 
                   
                    $echoFields='module_name';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($sub_resp[$j][$x[$e]]); 
                        }
                        }
                        ?>
                </option>
                
<?php 
				}//for
			}//else 
			unset($sub_resp);
?>
			</select>
			
</div>
</div><!--


	
	
--><div class="form_field ontwo in  complementary_1614118171_mother_id">
<label for="for_field_mother_id"><?=l('Mother ID<>رقم معرف البرمجية الرئيسية');?></label>
<div class="input_area">
<input id="for_field_mother_id"  type="number" name="mother_id"   data-legion-module="complementary_1614118171" placeholder="<?=l('Mother ID<>رقم معرف البرمجية الرئيسية');?>" value="<?=htmlspecialchars($resp[0]['mother_id']) ?>"/>
</div>
</div><!--


	
	
--><div class="form_field ontwo in  complementary_1614118171_child_module_prefix">
<label for="for_field_child_module_prefix"><?=l('Child Module Prefix<>البرمجية التابعة');?></label>
<div class="input_area">

<select id="for_field_child_module_prefix" class="main_color_bg whiteFont" name="child_module_prefix">
<?php 
$addition_where=NULL;
	
$sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($sub_resp==0)  {?><option value="0" selected>Error</option> <?php } 
			else if($sub_resp==1) {?><option value="0" selected><?=l('Choose<>اختر');?></option> <?php } 
				 else { ?>
                 <option value="0" <?=(0==$resp[0]['child_module_prefix'] ? 'selected' : ''); ?>><?=l('Choose<>اختر');?></option>
				 
				<?php
				for($j=0;$j<count($sub_resp);$j++){?>
				<option <?=($sub_resp[$j]['id']==$resp[0]['child_module_prefix'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?=$sub_resp[$j]['id']?>">                
                
                 <?php 
                   
                    $echoFields='module_name';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($sub_resp[$j][$x[$e]]); 
                        }
                        }
                        ?>
                </option>
                
<?php 
				}//for
			}//else 
			unset($sub_resp);
?>
			</select>
			
</div>
</div><!--


	
	
--><div class="form_field ontwo in  complementary_1614118171_child_id">
<label for="for_field_child_id"><?=l('Child ID<>رقم معرف البرمجية التابعة');?></label>
<div class="input_area">
<input id="for_field_child_id"  type="number" name="child_id"   data-legion-module="complementary_1614118171" placeholder="<?=l('Child ID<>رقم معرف البرمجية التابعة');?>" value="<?=htmlspecialchars($resp[0]['child_id']) ?>"/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>