<?php 
$id=check_get_id();
	$_form_resp=db('join_us_8367','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('join_us_8367','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="join_us_8367"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  join_us_8367_major" data-legion-field-type="select">
<label for="for_field_major"><?=l('Major<>التخصص');?> <span class="required_star">*</span></label>
<div class="input_area">

<select  required id="for_field_major" class="main_color_bg whiteFont" name="major">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('majors_8367',"WHERE deleted=0    $addition_where",NULL,NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="" <?=(0==$_form_resp[0]['major']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					$echoFields='title';
					$x=explode(',',$echoFields);
					if($_form_sub_resp!=1){
						for($j=0;$j<count($_form_sub_resp);$j++){?>
						<option <?=($_form_sub_resp[$j]['id']==$_form_resp[0]['major'] ? 'selected' : ''); ?> class="main_color_bg whiteFont" value="<?=$_form_sub_resp[$j]['id']?>"><?php 
							for($e=0;$e<count($x);$e++){
								if($x[$e]=='-')echo ' -';
								else {
									if($e!=0)echo ' ';
									echo l($_form_sub_resp[$j][$x[$e]]); 
								}
							}
						?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
			
</div>
</div><!--


	

--><div class="form_field  join_us_8367_cv" data-legion-field-type="file">
<label for="for_field_cv"><?=l('Cv<>السيرة الذاتية');?> <span class="required_star">*</span></label>
<div class="input_area">
<img class="po" onclick="browseFile(this)" src="<?=($_form_resp[0]['cv']==""?u.'file.png':u.'filepicked.png')?>"/>
			<?php $rand_id="cv_".rand();?>
			<input req id="input_<?=$rand_id?>"   type="file" class="hidden" name="cv[]"  legionType="file" onchange="loadFile(event,this,'<?=$rand_id?>')"/>
<div><label></label><div class="in " id="<?=$rand_id?>">
			
	<?php
		if($_form_resp[0]['cv']!=NULL){
			?>
		<div class="fileName"><a target="_blank" href="<?=u.$_form_resp[0]['cv'];?>"><?=$_form_resp[0]['cv'];?></a></div>
<?php } ?>

</div></div>

	<label></label><div id="clear-input_<?=$rand_id?>" class="<?=($_form_resp[0]['cv']==NULL ? 'hidden':'in')?> clearFiles po" onClick="clearFiles('cv','<?=$rand_id?>')"><i class="md-light">delete</i></div>

			
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>