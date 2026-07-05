<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('link_handler_1566934564','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('link_handler_1566934564','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="link_handler_1566934564" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="link_handler_1566934564"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><div class="form_field  link_handler_1566934564_module_prefix" data-legion-field-type="select">
<label for="for_field_module_prefix"><?=l('Module Prefix<>البرمجيّة');?></label>
<div class="input_area">
<select  class="l_mc l_white_c" name="module_prefix" onChange="reloadSelect('module_fields','label','module_id',this.value,'<?=$_form_resp[0]['single_title'] ?>','single_title');reloadSelect('module_fields','label','module_id',this.value,'<?=$_form_resp[0]['single_description'] ?>','single_description');reloadSelect('module_fields','label','module_id',this.value,'<?=$_form_resp[0]['single_photo'] ?>','single_photo');reloadSelect('module_fields','label','module_id',this.value,'<?=$_form_resp[0]['single_title_alternative'] ?>','single_title_alternative');reloadSelect('module_fields','label','module_id',this.value,'<?=$_form_resp[0]['single_alternative'] ?>','single_alternative');reloadSelect('module_fields','label','module_id',this.value,'<?=$_form_resp[0]['publish_date_field'] ?>','publish_date_field');reloadSelect('module_fields','label','module_id',this.value,'<?=$_form_resp[0]['single_photo_description'] ?>','single_photo_description');">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['module_prefix']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['module_prefix'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('link_handler_1566934564','module_prefix',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--


	

--><div class="form_field onthree in  link_handler_1566934564_all_entries" data-legion-field-type="text">
<label for="for_field_all_entries"><?=l('All Entries<>كل المُدخلات');?></label>
<div class="input_area">
<input id="for_field_all_entries"  type="text" name="all_entries" data-l_module="link_handler_1566934564" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['all_entries']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onthree in  link_handler_1566934564_single" data-legion-field-type="text">
<label for="for_field_single"><?=l('Single<>مُدخل مٌفرد');?></label>
<div class="input_area">
<input id="for_field_single"  type="text" name="single" data-l_module="link_handler_1566934564" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['single']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onthree in  link_handler_1566934564_custom" data-legion-field-type="text">
<label for="for_field_custom"><?=l('Custom<>خصخصة');?></label>
<div class="input_area">
<input id="for_field_custom"  type="text" name="custom" data-l_module="link_handler_1566934564" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['custom']) ?>"/>
</div>
</div><!--

--><div class="big_group_wrap link_handler_1566934564_singlemeta"><div class="big_group"><?=l('Single Meta<>معلومات المشاركة لمُدخّل مُفرد')?></div></div><!--
	

--><div class="form_field onfour in  link_handler_1566934564_single_title" data-legion-field-type="select">
<label for="for_field_single_title"><?=l('Single Title<>عنوان المُدخّل');?></label>
<div class="input_area">

<select  id="for_field_single_title" class="l_mc l_white_c" name="single_title">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['module_prefix']."'   $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['single_title']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['single_title'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('link_handler_1566934564','single_title',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--


	

--><div class="form_field onfour in  link_handler_1566934564_single_description" data-legion-field-type="select">
<label for="for_field_single_description"><?=l('Single Description<>وصف المُدخّل');?></label>
<div class="input_area">

<select  id="for_field_single_description" class="l_mc l_white_c" name="single_description">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['module_prefix']."'   $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['single_description']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['single_description'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('link_handler_1566934564','single_description',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--


	

--><div class="form_field onfour in  link_handler_1566934564_publish_date_field" data-legion-field-type="select">
<label for="for_field_publish_date_field"><?=l('Publish Date Field<>');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('default date created')?></span>
</div>
</label>
<div class="input_area">

<select  id="for_field_publish_date_field" class="l_mc l_white_c" name="publish_date_field">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['module_prefix']."'   $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['publish_date_field']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['publish_date_field'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('link_handler_1566934564','publish_date_field',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--


	

--><div class="form_field onfour in  link_handler_1566934564_single_photo" data-legion-field-type="select">
<label for="for_field_single_photo"><?=l('Single Photo<>صورة المُدخَل');?></label>
<div class="input_area">

<select  id="for_field_single_photo" class="l_mc l_white_c" name="single_photo">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['module_prefix']."'   $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['single_photo']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['single_photo'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('link_handler_1566934564','single_photo',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--


	

--><div class="form_field onfour in  link_handler_1566934564_single_title_alternative" data-legion-field-type="select">
<label for="for_field_single_title_alternative"><?=l('Single Title Alternative<>');?></label>
<div class="input_area">

<select  id="for_field_single_title_alternative" class="l_mc l_white_c" name="single_title_alternative">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['module_prefix']."'   $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['single_title_alternative']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['single_title_alternative'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('link_handler_1566934564','single_title_alternative',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--


	

--><div class="form_field onfour in  link_handler_1566934564_single_alternative" data-legion-field-type="select">
<label for="for_field_single_alternative"><?=l('Single Description Alternative<>');?></label>
<div class="input_area">

<select  id="for_field_single_alternative" class="l_mc l_white_c" name="single_alternative">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['module_prefix']."'   $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['single_alternative']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['single_alternative'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('link_handler_1566934564','single_alternative',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><!--


	

--><div class="form_field onfour in  link_handler_1566934564_single_photo_description" data-legion-field-type="select">
<label for="for_field_single_photo_description"><?=l('Single Photo Description<>');?></label>
<div class="input_area">

<select  id="for_field_single_photo_description" class="l_mc l_white_c" name="single_photo_description">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('module_fields',"WHERE deleted=0  AND module_id='".$_form_resp[0]['module_prefix']."'   $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['single_photo_description']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['single_photo_description'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('link_handler_1566934564','single_photo_description',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><clear></clear><!--


	

--><div class="form_field onfour in  link_handler_1566934564_single_title_prefix" data-legion-field-type="text">
<label for="for_field_single_title_prefix"><?=l('Single Title Prefix<>');?></label>
<div class="input_area">
<input id="for_field_single_title_prefix"  type="text" name="single_title_prefix" data-l_is_ml="true" data-l_module="link_handler_1566934564" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['single_title_prefix']) ?>"/>
</div>
</div><!--

--><div class="big_group_wrap link_handler_1566934564_allentriesmeta"><div class="big_group"><?=l('All Entries Meta<>معلومات المشاركة لجميع المدخلات')?></div></div><!--
	

--><div class="form_field onfour in  link_handler_1566934564_all_entries_title" data-legion-field-type="text">
<label for="for_field_all_entries_title"><?=l('All Entries Title<>عنوان جميع المدخلات');?></label>
<div class="input_area">
<input id="for_field_all_entries_title"  type="text" name="all_entries_title" data-l_is_ml="true" data-l_module="link_handler_1566934564" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['all_entries_title']) ?>"/>
</div>
</div><!--


	

--><div class="form_field onfour in  link_handler_1566934564_robot_index" data-legion-field-type="checkbox">
<label for="for_field_robot_index"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['robot_index']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="robot_index" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Robot Index<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field onfour in  link_handler_1566934564_robot_follow" data-legion-field-type="checkbox">
<label for="for_field_robot_follow"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['robot_follow']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="robot_follow" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('Robot Follow<>');?></label></div></div></div>
</div>
</div><!--


	

--><div class="form_field onfour in  link_handler_1566934564_all_entries_photo" data-legion-field-type="file">
<label for="for_field_all_entries_photo"><?=l('All Entries Photo<>صورة جميع المدخلات');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('link_handler_1566934564_all_entries_photo',false,false)"><img src="<?=u.($_form_resp[0]['all_entries_photo']=='' ? 'photo.png' : img($_form_resp[0]['all_entries_photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['all_entries_photo']=='' ? 'h':'' ?>" onclick="pvp_clear('link_handler_1566934564_all_entries_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="all_entries_photo" value="<?=$_form_resp[0]['all_entries_photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['all_entries_photo']=='' ? 0:count(explode(',',$_form_resp[0]['all_entries_photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['all_entries_photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['all_entries_photo'])?></a></div>
	
	
	
</div>
</div><!--


	

--><div class="form_field  link_handler_1566934564_all_entries_description" data-legion-field-type="textarea">
<label for="for_field_all_entries_description"><?=l('All Entries Description<>وصف جميع المدخلات');?></label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="0"  class="" name="all_entries_description"><?=htmlentities($_form_resp[0]['all_entries_description'])?></textarea>
</div>
</div><!--

-->
<!--inputs above -->
</form>
<?php } ?>