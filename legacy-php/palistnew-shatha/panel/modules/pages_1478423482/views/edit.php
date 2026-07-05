<?php 
$original_edit_id=$id=check_get_id();
	$_form_resp=db('pages_1478423482','WHERE id=\''.$id.'\'',NULL,'LIMIT 1');
if(!privilege('pages_1478423482','edit') || $_form_resp==0 || $_form_resp==1)echo $noPermission;else{
require_once cms_dir.'plugins/tinymce/backendTinyCall.php';?>
<form id="pages_1478423482" autocomplete="off" action="" onsubmit="return submitter(this,'<?=isset($controllerURL)? $controllerURL:urlPanel?>');" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="module" value="pages_1478423482"/> 
<input type="hidden" name="action" value="edit"/> 
<input type="hidden" name="id" value="<?=$id;?>"/> 

<!--inputs below -->
<!--
	

--><?php if(!isset($pages_1478423482_title)){?><div class="form_field  pages_1478423482_title" data-legion-field-type="text">
<label for="for_field_title"><?=l('Title<>العنوان');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_title"  required type="text" name="title" data-l_is_ml="true" data-l_module="pages_1478423482" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['title']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($pages_1478423482_slug)){?><div class="form_field  pages_1478423482_slug" data-legion-field-type="text">
<label for="for_field_slug"><?=l('Slug<>كلمة تمييز الرابط');?> <span class="required_star">*</span></label>
<div class="input_area">
<input id="for_field_slug"  required type="text" name="slug" data-l_unique="true" data-l_slug="true" data-l_is_ml="true" data-l_module="pages_1478423482" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['slug']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($pages_1478423482_content)){?><div class="form_field  pages_1478423482_content" data-legion-field-type="textarea">
<label for="for_field_content"><?=l('Content<>المحتوى');?></label>
<div class="input_area">
<textarea  data-l_is_ml="true"  placeholder="" data-max_count="0"  class="" name="content"><?=htmlentities($_form_resp[0]['content'])?></textarea>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($pages_1478423482_photo)){?><div class="form_field onfour in  pages_1478423482_photo" data-legion-field-type="file">
<label for="for_field_photo"><?=l('Photo<>صورة');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="photo" data-multi="false" onclick="pvp_core('pages_1478423482_photo',false,false)"><img src="<?=u.($_form_resp[0]['photo']=='' ? 'photo.png' : img($_form_resp[0]['photo'],200,100));  ?>" /></div>
	<div class="in clearFiles po <?=$_form_resp[0]['photo']=='' ? 'h':'' ?>" onclick="pvp_clear('pages_1478423482_photo')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="photo" value="<?=$_form_resp[0]['photo']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['photo']=='' ? 0:count(explode(',',$_form_resp[0]['photo'])) ?></span>
	</div><clear></clear>
	<div class="fileName po"><a target="_blank" href="<?=u.detail('files_1577206823','full_name','full_name',$_form_resp[0]['photo'])?>"><?=detail('files_1577206823','original_name','full_name',$_form_resp[0]['photo'])?></a></div>
	
	
	
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($pages_1478423482_files)){?><div class="form_field onfour in  pages_1478423482_files" data-legion-field-type="file">
<label for="for_field_files"><?=l('Files<>الملفات');?></label>
<div class="input_area">
<div class="po pvp_chooser" data-filetype="file" data-multi="true" onclick="pvp_core('pages_1478423482_files',true,true)"><img src="<?=u?>files.png"></div>
	<div class="in clearFiles po <?=$_form_resp[0]['files']=='' ? 'h':'' ?>" onclick="pvp_clear('pages_1478423482_files')"><i class="md-light">delete</i></div>
	
	<input type="hidden" name="files" value="<?=$_form_resp[0]['files']?>"/>
	
	<div class="count fileName"><?=l('Selected<>الملفات المُختارة')?> <span><?=$_form_resp[0]['files']=='' ? 0:count(explode(',',$_form_resp[0]['files'])) ?></span>
	</div><clear></clear>
	<?php 
					$tmp=fa($_form_resp[0]['files']);
						if(is_array($tmp)){
							for($_i=0;$_i<count($tmp);$_i++){
							?>
						<div class="fileName po"><a target="_blank" href="<?=u.$tmp[$_i]['full_name'];?>"><?=$tmp[$_i]['original_name'];?></a></div>
						<?php }}?>
	
	
	
</div>
</div><?php }?><!--
	
--><div class="big_group_wrap pages_1478423482_advancedsettings"><div class="big_group"><?=l('Advanced Settings<>خصائص متقدّمة')?></div></div><!--
	

--><?php if(!isset($pages_1478423482_additional_file)){?><div class="form_field onfour in  pages_1478423482_additional_file" data-legion-field-type="text">
<label for="for_field_additional_file"><?=l('Additional File<>ملف إضافي');?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('The file path starts from root, dont add slash at the begining<>مسار الملف من المجلد الرئيسي دون وضع شحطة مائلة في البداية')?></span>
</div>
</label>
<div class="input_area">
<input id="for_field_additional_file"  type="text" name="additional_file" data-l_module="pages_1478423482" placeholder="" value="<?=htmlspecialchars($_form_resp[0]['additional_file']) ?>"/>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($pages_1478423482_signin_required)){?><div class="form_field onfour in  pages_1478423482_signin_required" data-legion-field-type="select">
<label for="for_field_signin_required"><?=l('Signin Required<>يجب ان يكون مسجلاً');?></label>
<div class="input_area">

<select  id="for_field_signin_required" class="l_mc l_white_c" name="signin_required">
<?php 
$addition_where=NULL;
	
$_form_sub_resp=db('modules',"WHERE deleted=0    $addition_where",NULL);
			if($_form_sub_resp==0){?><option value="0" selected><?=l('Error<>خطأ')?></option><?php } 
			else if($_form_sub_resp==1){?><option value="0" selected><?=l('Choose<>اختر');?></option><?php } 
				 else { ?>
                 <option value="0" <?=(0==$_form_resp[0]['signin_required']?'selected':'')?>><?=l('Choose<>اختر');?></option>
				<?php
					if($_form_sub_resp!=1){
						for($__j=0;$__j<count($_form_sub_resp);$__j++){?>
						<option <?=($_form_sub_resp[$__j]['id']==$_form_resp[0]['signin_required'] ? 'selected' : ''); ?> class="l_mc l_white_c" value="<?=$_form_sub_resp[$__j]['id']?>">
						<?= select_echo('pages_1478423482','signin_required',$_form_sub_resp[$__j],true);?></option>
						
				<?php 
						}//for
					}
				}//else 
				unset($_form_sub_resp);
				?>
			</select>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($pages_1478423482_with_share_functionality)){?><div class="form_field onfour in free_width  pages_1478423482_with_share_functionality" data-legion-field-type="checkbox">
<label for="for_field_with_share_functionality"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['with_share_functionality']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="with_share_functionality" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('With Share Functionality<>مع خاصية المشاركة');?></label></div></div></div>
</div>
</div><?php }?><!--
	

	

--><?php if(!isset($pages_1478423482_with_messenger)){?><div class="form_field onfour in free_width  pages_1478423482_with_messenger" data-legion-field-type="checkbox">
<label for="for_field_with_messenger"></label>
<div class="input_area">
<div class="check_box_wrap nos"><div class="par"><div class="ch"><input <?=($_form_resp[0]['with_messenger']==1 ? ' checked ':'');?>
 class=" css-checkbox" name="with_messenger" type="checkbox" id="<?=$rand='a'.rand(); ?>"/>
			<label for="<?=$rand ?>"><?=l('With Messenger<>مع صندوق المحادثة');?></label></div></div></div>
</div>
</div><?php }?><!--
	
-->
<!--inputs above -->
</form>
<?php } ?>