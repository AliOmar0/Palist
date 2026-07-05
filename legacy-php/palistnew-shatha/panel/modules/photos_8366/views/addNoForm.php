<?php if(!privilege('photos_8366','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="photos_8366"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field photos_8366_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('photos_8366_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po hidden" onclick="pvp_clear('photos_8366_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


	

--><div class="form_field photos_8366_album_category" data-legion-field-type="select">
<label for="for_field_album_category"><?=l('Album Category<>');?> <span class="required_star">*</span></label>
<div class="input_area">
<select  required id="for_field_album_category" class="main_color_bg whiteFont" name="album_category">
<?php 
$addition_where=NULL;

$_form_resp=db('photos_library__8366',"WHERE deleted=0   $addition_where",NULL,NULL);
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

-->
<!--inputs above -->
<?php } ?>