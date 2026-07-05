<?php if(!privilege('seo_custom_852526','add'))echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="seo_custom_852526"/> 
<input type="hidden" name="action" value="add"/>
<!--inputs below --> 
<div class="l_tabs l_mb20 l_white_c"><!--
--><div id="l_tab_0_btn" class="l_tab_toggler l_in l_po l_pad10 l_radtr5 l_radtl5 l_center l_dark l_active_tab" onClick="massToggle(this.id,'l_tab_toggler','l_active_tab','l_tab_0','l_tab');">

	<div class="l_in"><?=l('Basic<>أساسي')?></div>
</div><!--

--><div id="l_tab_8_btn" class="l_tab_toggler l_in l_po l_pad10 l_radtr5 l_radtl5 l_center l_dark" onClick="massToggle(this.id,'l_tab_toggler','l_active_tab','l_tab_8','l_tab');">

	<div class="l_in"><?=l('Advanced<>متقدم')?></div>
</div><!--
--></div><!--
				
				
Tab Starts
--><div id="l_tab_0" class="l_tab "><!--
	

--><div class="form_field onfour in seo_custom_852526_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>');?></label>
<div class="input_area">
<select  id="for_field_module_id" class="l_mc l_white_c" name="module_id">
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
						<?= select_echo('seo_custom_852526','module_id',$_form_resp[$_i],true);?>
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


	

--><div class="form_field onfour in seo_custom_852526_related_id" data-legion-field-type="number">
<label for="for_field_related_id"><?=l('Related ID<>');?></label>
<div class="input_area">
<input id="for_field_related_id"  type="number"  data-l_module="seo_custom_852526" name="related_id" placeholder="" value=""/>
</div>
</div><clear></clear><!--

--><div class="big_group_wrap seo_custom_852526_customseo"><div class="big_group"><?=l('Custom SEO<>تخصيص لمحركات البحث')?></div></div><!--
	

--><div class="form_field takeThree in seo_custom_852526_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('Legion automatically takes the title<>النظام يأخذ العنوان بطبيعة الحال')?></span>
</div>
</label>
<div class="input_area">
<input id="for_field_title"  type="text"  data-l_is_ml="true" data-l_module="seo_custom_852526" name="title" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in seo_custom_852526_default_language" data-legion-field-type="select">
<label for="for_field_default_language"><?=l('Default Language<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('X-Default meta tag')?></span>
</div>
</label>
<div class="input_area">
<select  id="for_field_default_language" class="l_mc l_white_c" name="default_language">
<?php 
$addition_where=NULL;

$_form_resp=db('languages_1557157519',"WHERE deleted=0   $addition_where",NULL,NULL);
			if($_form_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option> <?php } 
			else if($_form_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				else {?>
                    <option value="0"><?=l('Choose<>اختر');?></option>
					<?php 
					if($_form_resp!=1){
						for($_i=0;$_i<count($_form_resp);$_i++){?>
						<option value="<?=$_form_resp[$_i]['id']?>">
						<?= select_echo('seo_custom_852526','default_language',$_form_resp[$_i],true);?>
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


	

--><div class="form_field seo_custom_852526_description" data-legion-field-type="textarea">
<label for="for_field_description"><?=l('Description<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('Legion automatically take description<>النظام يجلب الوصف اوتوماتيكيا')?></span>
</div>
</label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="250" class="mceNoEditor " name="description"></textarea>
</div>
</div><!--


				
				
--></div><!--
Tab Ends
				
				
Tab Starts
--><div id="l_tab_8" class="l_tab hidden"><!--
	

--><div class="form_field ontwo in seo_custom_852526_meta" data-legion-field-type="textarea">
<label for="for_field_meta"><?=l('Meta<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('Add custom meta tags<>أضف ميتا مُخصصة')?></span>
</div>
</label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="250" class="mceNoEditor " name="meta"></textarea>
</div>
</div><!--


	

--><div class="form_field onfour in seo_custom_852526_type" data-legion-field-type="text">
<label for="for_field_type"><?=l('Type<>النوع');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('value of og:type, but Legion detects type automatically<>النظام يجلب النوع اوتوماتيكيا')?></span>
</div>
</label>
<div class="input_area">
<input id="for_field_type"  type="text"  data-l_module="seo_custom_852526" name="type" placeholder="" value=""/>
</div>
</div><!--


	

--><div class="form_field onfour in seo_custom_852526_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('Legion automatically detect the image<>النظام يجلب الصورة اوتوماتيكيا')?></span>
</div>
</label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('seo_custom_852526_photo',false,false)"><img src="<?=u?>photo.png"></div>
	<div class="in clearFiles po h" onclick="pvp_clear('seo_custom_852526_photo')"><i class="md-light">delete</i></div>
	<input type="hidden" name="photo"/>
	<div class="count fileName in"><?=l('Selected<>الملفات المُختارة')?> <span>0</span></div>
	
</div>
</div><!--


				
				
--></div><!--
Tab Ends-->
<!--inputs above -->
<?php } ?>