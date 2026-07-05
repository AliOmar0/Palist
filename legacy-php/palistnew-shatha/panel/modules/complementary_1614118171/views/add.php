<?php if(!privilege('complementary_1614118171','add'))echo $noPermission;else{?>
<form  id="complementary_1614118171" autocomplete="off" action="" onsubmit="return submitter(this,'<?php if(isset($controllerURL))echo $controllerURL;else echo urlPanel;?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="complementary_1614118171"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	
	
--><div class="form_field ontwo in complementary_1614118171_mother_module_prefix">
<label for="for_field_mother_module_prefix"><?=l('Mother Module Prefix<>البرمجية');?></label>
<div class="input_area">
<select id="for_field_mother_module_prefix" class="main_color_bg whiteFont" name="mother_module_prefix">
<?php 
$addition_where=NULL;

$resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($resp==0)  {?><option value="0" selected>Error</option> <?php } 
			else if($resp==1) {?><option value="0" selected><?=l('Choose<>اختر');?></option> <?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>

				    <?php for($i=0;$i<count($resp);$i++){?>
				    <option value="<?=$resp[$i]['id']?>">
                    
                        <?php 
                   
                    $echoFields='module_name';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($resp[$i][$x[$e]]); 
                        }
                        }
                        ?>


                    </option>
                    
<?php 
				}//for
			}//else
			unset($resp);
?>
			</select>
			
</div>
</div><!--


	
	
--><div class="form_field ontwo in complementary_1614118171_mother_id">
<label for="for_field_mother_id"><?=l('Mother ID<>رقم معرف البرمجية الرئيسية');?></label>
<div class="input_area">
<input id="for_field_mother_id"  type="number"  data-legion-module="complementary_1614118171" name="mother_id" placeholder="<?=l('Mother ID<>رقم معرف البرمجية الرئيسية');?>" value=""/>
</div>
</div><!--


	
	
--><div class="form_field ontwo in complementary_1614118171_child_module_prefix">
<label for="for_field_child_module_prefix"><?=l('Child Module Prefix<>البرمجية التابعة');?></label>
<div class="input_area">
<select id="for_field_child_module_prefix" class="main_color_bg whiteFont" name="child_module_prefix">
<?php 
$addition_where=NULL;

$resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($resp==0)  {?><option value="0" selected>Error</option> <?php } 
			else if($resp==1) {?><option value="0" selected><?=l('Choose<>اختر');?></option> <?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>

				    <?php for($i=0;$i<count($resp);$i++){?>
				    <option value="<?=$resp[$i]['id']?>">
                    
                        <?php 
                   
                    $echoFields='module_name';
                    $x=explode(',',$echoFields);
                    for($e=0;$e<count($x);$e++){
                        
                        if($x[$e]=='-')echo ' -';
                        else {
                            if($e!=0)echo ' ';
                            echo l($resp[$i][$x[$e]]); 
                        }
                        }
                        ?>


                    </option>
                    
<?php 
				}//for
			}//else
			unset($resp);
?>
			</select>
			
</div>
</div><!--


	
	
--><div class="form_field ontwo in complementary_1614118171_child_id">
<label for="for_field_child_id"><?=l('Child ID<>رقم معرف البرمجية التابعة');?></label>
<div class="input_area">
<input id="for_field_child_id"  type="number"  data-legion-module="complementary_1614118171" name="child_id" placeholder="<?=l('Child ID<>رقم معرف البرمجية التابعة');?>" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>