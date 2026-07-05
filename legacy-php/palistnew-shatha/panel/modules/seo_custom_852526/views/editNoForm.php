<?php 
$id=check_get_id();
	$_form_resp=db('seo_custom_852526','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('seo_custom_852526','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{?>
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="seo_custom_852526"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

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
	

--><?php if(!isset($seo_custom_852526_module_id)){?><div class="form_field onfour in  seo_custom_852526_module_id" data-legion-field-type="select">
<label for="for_field_module_id"><?=l('Module ID<>');?></label>
<div class="input_area">

<select  id="for_field_module_id" class="l_mc l_white_c" name="module_id">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['module_id']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['module_id'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('seo_custom_852526','module_id',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($seo_custom_852526_related_id)){?><div class="form_field onfour in  seo_custom_852526_related_id" data-legion-field-type="number">
<label for="for_field_related_id"><?=l('Related ID<>');?></label>
<div class="input_area">
<input id="for_field_related_id"  type="number" name="related_id" data-l_module="seo_custom_852526" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['related_id']) ?>"/>
</div>
</div><clear></clear><?php }?><!--
	
--><div class="big_group_wrap seo_custom_852526_customseo"><div class="big_group"><?=l('Custom SEO<>تخصيص لمحركات البحث')?></div></div><!--
	

--><?php if(!isset($seo_custom_852526_title)){?><div class="form_field takeThree in  seo_custom_852526_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('Legion automatically takes the title<>النظام يأخذ العنوان بطبيعة الحال')?></span>
</div>
</label>
<div class="input_area">
<input id="for_field_title"  type="text" name="title" data-l_is_ml="true" data-l_module="seo_custom_852526" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($seo_custom_852526_default_language)){?><div class="form_field onfour in  seo_custom_852526_default_language" data-legion-field-type="select">
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
	
$_form_sub_resp=db('languages_1557157519',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['default_language']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['default_language'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('seo_custom_852526','default_language',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($seo_custom_852526_description)){?><div class="form_field  seo_custom_852526_description" data-legion-field-type="textarea">
<label for="for_field_description"><?=l('Description<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('Legion automatically take description<>النظام يجلب الوصف اوتوماتيكيا')?></span>
</div>
</label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="250"  class="mceNoEditor " name="description"><?=htmlentities($_form_resp[0]['description'])?></textarea>
</div>
</div><?php }?><!--
	

				
				
--></div><!--
Tab Ends


Tab Starts
--><div id="l_tab_8" class="l_tab hidden"><!--
	

--><?php if(!isset($seo_custom_852526_meta)){?><div class="form_field ontwo in  seo_custom_852526_meta" data-legion-field-type="textarea">
<label for="for_field_meta"><?=l('Meta<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('Add custom meta tags<>أضف ميتا مُخصصة')?></span>
</div>
</label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="250"  class="mceNoEditor " name="meta"><?=htmlentities($_form_resp[0]['meta'])?></textarea>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($seo_custom_852526_type)){?><div class="form_field onfour in  seo_custom_852526_type" data-legion-field-type="text">
<label for="for_field_type"><?=l('Type<>النوع');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('value of og:type, but Legion detects type automatically<>النظام يجلب النوع اوتوماتيكيا')?></span>
</div>
</label>
<div class="input_area">
<input id="for_field_type"  type="text" name="type" data-l_module="seo_custom_852526" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['type']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($seo_custom_852526_photo)){?><div class="form_field onfour in  seo_custom_852526_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('Legion automatically detect the image<>النظام يجلب الصورة اوتوماتيكيا')?></span>
</div>
</label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('seo_custom_852526_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'h':'' ?>" onclick="pvp_clear('seo_custom_852526_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><?php }?><!--
	

				
				
--></div><!--
Tab Ends-->
<!--inputs above -->
<?php } ?>