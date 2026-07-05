<?php if(!privilege('psn_1627841195','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="psn_1627841195"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<!--
	

--><div class="form_field psn_1627841195_user" data-legion-field-type="text">
<label for="for_field_user"><?=l('User<>المستخدم');?></label>
<div class="input_area">
<input id="for_field_user"  type="text"  data-l_module="psn_1627841195" name="user" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field psn_1627841195_module_prefix" data-legion-field-type="select">
<label for="for_field_module_prefix"><?=l('Module Prefix<>نوع المستخدم');?></label>
<div class="input_area">
<select  id="for_field_module_prefix" class="l_mc l_white_c" name="module_prefix">
<?php 
$addition_where=NULL;

$_form_resp=db('modules',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>">
						<?= select_echo('psn_1627841195','module_prefix',$_form_resp[$_i],true);?>
						</option>
						
						<?php 
							}//for
						}
					}//else
					unset($_form_resp);
					?>
			</select>
</div>
</div><!--


	

--><div class="form_field psn_1627841195_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?></label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-l_is_ml="true" data-l_module="psn_1627841195" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field psn_1627841195_message" data-legion-field-type="text">
<label for="for_field_message"><?=l('Message<>الرسالة');?></label>
<div class="input_area">
<input id="for_field_message"  type="text"  data-l_is_ml="true" data-l_module="psn_1627841195" name="message" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field psn_1627841195_seen" data-legion-field-type="checkbox">
<label for="for_field_seen"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input   class="css-checkbox" type="checkbox" name="seen"  id="<?=$rand='a'.rand(); ?>" />
			<label for="<?=$rand?>"><?=l('Seen<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field psn_1627841195_extra" data-legion-field-type="text">
<label for="for_field_extra"><?=l('Extra<>اضافات');?></label>
<div class="input_area">
<input id="for_field_extra"  type="text"  data-l_module="psn_1627841195" name="extra" placeholder="" value=""/>
</div>
</div><!--

-->
<!--inputs above -->
<?php } ?>