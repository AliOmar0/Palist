<?php if(!privilege('join_us_8367','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="join_us_8367"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field join_us_8367_major" data-legion-field-type="select">
<label for="for_field_major"><?=l('Major<>التخصص');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_major" class="main_color_bg whiteFont" name="major">
<?php 
$addition_where=NULL;

$_form_resp=db('majors_8367',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value=""><?=l('Choose<>اختر');?></option>
					<?php 
					$echoFields='title';
                    $x=explode(',',$echoFields);
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>"><?php
						for($e=0;$e<count($x);$e++){
							if($x[$e]=='-')echo ' -';
							else {
								if($e!=0)echo ' ';
								echo l($_form_resp[$_i][$x[$e]]); 
							}
						 }
						 ?></option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field join_us_8367_cv" data-legion-field-type="file">
<label for="for_field_cv"><?=l('Cv<>السيرة الذاتية');?> <span class="required_star">*</span></label>
<div class="input_area">

			<img class="po" onclick="browseFile(this)" src="<?=u.'file.png';  ?>"/> 
			
			<?php $rand_id="cv_".rand();?>
			
			<input req id="input_<?=$rand_id?>"   type="file" class="hidden" name="cv[]"  legionType="file" onchange="loadFile(event,this,'<?=$rand_id?>')"/>

<div><label></label><div class="in" id="<?=$rand_id?>">
	 
</div></div> 
	<label></label><div id="clear-input_<?=$rand_id?>" class="hidden clearFiles po" onClick="clearFiles('cv','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>