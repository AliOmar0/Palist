<?php

if($action=='edit' && isset(o('link_handler_1566934564',mid($module),'module_prefix')[0]['single']) && priv($module,$action) && priv('seo_custom_852526',$action)){
	$escaped_id=escape($_GET['id']);
	$custom_seo=db('seo_custom_852526',"WHERE !deleted AND module_id=".mid($module)." AND related_id=".$escaped_id,NULL,'LIMIT 1');
	if($custom_seo==1){
		$tmp=$_POST;
		$_POST=[
			'module_id'=>mid($module),
			'related_id'=>$escaped_id
		];
		$_POST['internal']=true;
		co('seo_custom_852526');
		$custom_seo_id=r('seo_custom_852526');
		$_POST=$tmp;
	}else{
		$custom_seo_id=$custom_seo[0]['id'];
	}

	?>
	<!-- <div class="l_btn l_po" onclick="popEdit('seo_custom_852526','<?=$custom_seo_id?>')">Custom SEO</div>  -->
	
	<?php
	$tmp=$_GET;
	$_GET=['id'=>$custom_seo_id];
	$arr=['module_id'=>mid($module),'related_id'=>$escaped_id,'type'=>NULL,'default_language'=>NULL,'photo'=>NULL];
	foreach ($arr as $key=>$value){
		${'seo_custom_852526_'.$key}=false;
		echo '<input type="hidden" form="seo_custom_852526" name="'.$key.'" value="'.($arr[$key]==NULL?$custom_seo[0][$key]:$value).'"/>';
	}
	require modules_dir.'seo_custom_852526/views/edit.php';
	echo '<input type="submit" class="l_btn " form="seo_custom_852526" value="'.l('Save SEO<>احفظ التخصيص').'"/>';
	$_GET=$tmp;
	
}
elseif($module=='admins'){
if($action=='add' && privilege('admins','add')){?>
<div class="working_area">
<div class="l_nicebox">
<label class="mid"><?=l('Roles<>الصلاحيات')?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('If nothing checked, it means this user has access on nothing<>اذا لم تحدد الصلاحية، يعني انه المستخدم لا يملكها')?></span>
</div>
</label>
<div class="l_btn l_btn_small mid l_grass l_white_c" onclick="$('.check_all.green').click()"><?=l('Check All<>تحديد الجميع')?></div>
<?php if(super()){?>
	<div class="l_btn l_btn_small mid l_violet l_white_c" onclick="$('.check_all.green').not('.check_all_core').click()"><?=l('Check All but Core<>تحديد الجميع ما عدا الرئيسية')?></div>
<?php }?>
<div class="l_btn l_btn_small mid l_lava l_white_c" onclick="$('.check_all.red').click()"><?=l('Uncheck All<>الغاء تحديد الجميع')?></div>

<div class="input_area">

	<?php 
	$resp=db('modules');
	for($i=0;$i<count($resp);$i++){
		if(!privilege($resp[$i]['module_prefix']))continue;
		$rules=explode(',',$resp[$i]['models']);
	?>

    
    <div class="permissions" id="check_<?php echo $resp[$i]['module_prefix'] ?>">
        
<div class="check_row">
<div class="check_row_title"><?php echo l($resp[$i]['module_name']);?></div>
     <div class="checkers po">
<span class="check_all  green <?=$resp[$i]['core']?'check_all_core':NULL?>" onClick="check_all('check_<?php echo $resp[$i]['module_prefix'] ?>');"><i>done_all</i></span>
<span class="check_all  red" onClick="uncheck_all('check_<?php echo $resp[$i]['module_prefix'] ?>');"><i>clear</i></span>
</div>
    
	<?php for($j=0;$j<count($rules);$j++){
		if($rules[$j]=='usage')continue;
		if(!privilege($resp[$i]['module_prefix'],$rules[$j]))continue;
	?>
    <div class="form_field noselect">
		<div class="input_area">
            <input form="admins" type="checkbox" value="<?php echo $resp[$i]['module_prefix'].','.$rules[$j]?>" name="roles[]" class="css-checkbox" id="<?php echo $resp[$i]['module_prefix'].'__'.$rules[$j]?>">
            <label for="<?php echo $resp[$i]['module_prefix'].'__'.$rules[$j]?>"><?php echo $rules[$j]?></label>
		</div>
	</div>
    
    
	<?php }?>
</div>
	</div>

	<?php } ?></div>
</div></div><?php }
	
	else if($action=='edit' && privilege('admins','edit')){
		if(super() || $_SESSION['user_id']!=$id){?>
		<div class="working_area">
<div class=" l_nicebox">
<label class="mid"><?=l('Roles<>الصلاحيات')?>
<div class="help">
	<i>help_outline</i>
	<span><?=l('If nothing checked, it means this user has access on nothing<>اذا لم تحدد الصلاحية، يعني انه المستخدم لا يملكها')?></span>
</div>
</label>

<div class="l_btn l_btn_small mid l_grass l_white_c" onclick="$('.check_all.green').click()"><?=l('Check All<>تحديد الجميع')?></div>
<?php if(super()){?>
	<div class="l_btn l_btn_small mid l_violet l_white_c" onclick="$('.check_all.green').not('.check_all_core').click()"><?=l('Check All but Core<>تحديد الجميع ما عدا الرئيسية')?></div>
<?php }?>
<div class="l_btn l_btn_small mid l_lava l_white_c" onclick="$('.check_all.red').click()"><?=l('Uncheck All<>الغاء تحديد الجميع')?></div>

<div class="input_area">

	<?php
	$resp=db('modules');		
	for($i=0;$i<count($resp);$i++){
		if(!privilege($resp[$i]['module_prefix']))continue;
		$rules=explode(',',$resp[$i]['models']);
	?>


    <div class="permissions" id="check_<?php echo $resp[$i]['module_prefix'] ?>">
<div class="check_row">
<div class="check_row_title"><?php echo l($resp[$i]['module_name'])?></div>
     <div class="checkers po">
<span class="check_all  green <?=$resp[$i]['core']?'check_all_core':NULL?>" onClick="check_all('check_<?php echo $resp[$i]['module_prefix'] ?>');"><i>done_all</i></span>
<span class="check_all  red" onClick="uncheck_all('check_<?php echo $resp[$i]['module_prefix'] ?>');"><i>clear</i></span>
</div>
	<?php for($j=0;$j<count($rules);$j++){
		if($rules[$j]=='usage')continue;
		if(!privilege($resp[$i]['module_prefix'],$rules[$j]))continue;
	?>

    <div class="form_field noselect">
		<div class="input_area">
            <input form="admins" type="checkbox" value="<?php echo $resp[$i]['module_prefix'].','.$rules[$j]?>" name="roles[]" class="css-checkbox" id="<?php echo $resp[$i]['module_prefix'].'__'.$rules[$j]?>"  <?php if(privilege($resp[$i]['module_prefix'],$rules[$j],$id,true))echo 'checked'?>>
            <label for="<?php echo $resp[$i]['module_prefix'].'__'.$rules[$j]?>"><?php echo $rules[$j]?></label>
		</div>
	</div>
    
    
	<?php }?>
</div>
	</div>

	<?php } ?></div>
</div></div><?php }}

}

else if($module=='pages_1478423482' && !super()){?>
	<script>
		$('.pages_1478423482_advanced_settings,.pages_1478423482_additional_file,.pages_1478423482_signin_required,.pages_1478423482_with_share_functionality,.pages_1478423482_with_messenger').hide();
	</script>
<?php }


else if($module=='control_1566842582' && $action=='edit' && super()){
?>

<script>
	var m='control_1566842582';
	var code=$('input[name="code"]').val();
	$('input[name="code"]').keyup(function(){
		code=$(this).val();
	});
	
	$('.'+m+'_title').find('label').append('<div class="label_extension label_btn po copy_theme mid" onclick="control_copier(\'title\')"><?=l('Copy<>نسخ')?> CL</div>');
	$('.'+m+'_text').find('label').append('<div class="label_extension label_btn po copy_theme mid" onclick="control_copier(\'text\')"><?=l('Copy<>نسخ')?> CL</div>');
	$('.'+m+'_formatted_text').find('label').append('<div class="label_extension label_btn po copy_theme mid" onclick="control_copier(\'formatted_text\')"><?=l('Copy<>نسخ')?> CL</div>');
	$('.'+m+'_code').find('label').append('<div class="label_extension label_btn po copy_theme mid" onclick="c(code)"><?=l('Copy<>نسخ')?></div>');
	$('.'+m+'_photo').find('label').append('<div class="label_extension label_btn po copy_theme mid" onclick="control_copier(\'photo\')"><?=l('Copy<>نسخ')?> Picture</div>');
	$('.'+m+'_file').find('label').append('<div class="label_extension label_btn po copy_theme mid" onclick="control_copier(\'file\')"><?=l('Copy<>نسخ')?> File</div>');
	
	$('.'+m+'_active').find('label').eq(0).append('<div class="label_extension label_btn po copy_theme mid" onclick="control_copier(\'active\')"><?=l('Copy<>نسخ')?> Active</div>');
	
	$('.'+m+'_color').find('label').append('<div class="label_extension label_btn po copy_theme mid" onclick="control_copier(\'color\')"><?=l('Copy<>نسخ')?> Color</div>');

	
	
	function control_copier(field){
		if(field=='photo')
			c("<\?php pic(c('"+code+"','photo'),400,100,NULL,true,'"+code+"_photo')?>");
		
		else if(field=='file')
			c("<\?= u.c('"+code+"','file')?>");
		
		else if(field=='active')
			c("boolval(c('"+code+"','"+field+"'))");
		
		else if(field=='color')
			c("<\?=c('"+code+"','"+field+"')?>");
		
		else
			c("<\?=cl('"+code+"','"+field+"')?>");
	}

</script>


<?php }

else if(($module=='XXXpages_1478423482' || $module=='tester_1565720578') && $action=='edit'){ #!and privilieged?! i dont know, since the model itself has privilege check

	if(super())require core_dir.'modules/meepo.php'; 

}

else if($module=='statistics_box_8324' && $action=='edit'){ #!and privilieged?! i dont know, since the model itself has privilege check
	require core_dir.'modules/statistics_box.php';
}


else if(($module=='bulk_sms_1652425418' || $module=='bulk_push_notification_1633289547') && $action=='add'){
?>
<script>
	$('#bread_save').html('<i>send</i>'+l('Send & Save<>أرسل واحفظ'));
	$('#bread_save_new').html('<i>send</i>'+l('Send & Save New<>أرسل واحفظ وجديد'));
</script>
<?php
}

else if($module=='menu_1564508145' && $action=='edit' && privilege('menu_1564508145','edit')){
?>
	<div class="working_area">
		<div class="l_nicebox">
	
	<form id="menu_items_1564508835" class="in ontwo pr20" autocomplete="off" action="" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
		<input type="hidden" value="" name="e"/>
		<input type="hidden" name="module" value="menu_items_1564508835"/>
		<input type="hidden" name="action" value="add_in_menu"/>
		<input type="hidden" value="<?php echo $_GET['id'];?>" name="menu_key"/>
		<input type="hidden" value="<?php echo 0;?>" name="sub_of"/>
		<input type="hidden" value="<?php echo 100;?>" name="order_num"/>

		<!--inputs below -->
		<div id="menu_items">
			<div id="add_new_menu_item">

				<div id="add_new_menu_item_sec_head" class="add_new_menu_item_label mid">
					<?=l('Add New Menu Item<>أضف على القائمة')?>
				</div>

				<div class="mid hidden po" id="back_to_add_menu" onClick="menu_item_form_mode('add')"><?=l('Back<>رجوع')?></div>
				
				<clear></clear>
				<div class="form_field">
					<label>
		<?=l('Choose Module<>اختر البرمجية')?>
		</label>
					<div class="input_area">
				
					<select onChange="getItems()" id="module_selector" name="module_prefix">
						<?php 
		$resp=db('module_settings','WHERE menu_field!=""',NULL,NULL,'module_prefix,menu_field');
                                                                               ?>
                        <option data-menu_field="0" value="0"><?php echo l('None<>غير محدد');?></option>
                        <?php
				for($i=0;$i<count($resp);$i++){?>
						<option data-menu_field="<?php echo $resp[$i]['menu_field'];?>" value="<?php echo $resp[$i]['module_prefix'];?>">
							<?php echo l(detail('modules','module_name','module_prefix',$resp[$i]['module_prefix']));?>
						</option>
						<?php }
		?>
					</select>
						</div>
				</div><!--




				--><div class="form_field">
					<label>
		<?=l('Choose Item<>اختر مُدخَلاً')?>
		</label>
				
		<div class="input_area">
			<select id="items_select" name="item_id">
                 <option data-menu_field="0" value="0"><?php echo l('None<>غير محدد');?></option>
			</select>
				</div>
				
				</div>


			<div class="form_field mid ontwo">
					<label>Custom Title</label>
					<div class="input_area"><input type="text" name="custom_title" placeholder="Custom Title" value=""/>
					</div>
				</div><!--




				--><div class="form_field mid ontwo">
					<label>Custom Link</label>
					<div class="input_area"><input type="text" name="custom_link" placeholder="Custom Link" value=""/>
					</div>
				</div><!--




				--><div class="form_field mid ontwo">
					
					<div class="input_area"><input class="css-checkbox" type="checkbox" name="open_new_window" id="1704967969"/>
						<label for="1704967969">Open New Window</label>
					</div>
				</div><!--


		--><div class="form_field mid ontwo">
							
							<div class="input_area"><input class="css-checkbox" type="checkbox" name="points_to_home" id="17049679695"/>
								<label for="17049679695">Points to Home</label>
							</div>
						</div><!--
		-->


		<input class="b" type="submit" value="<?=l('Add<>أضف')?>"/>
		</div></div>
	</form><!--
	

--><div class="in ontwo">


	<div class="add_new_menu_item_label">
		<?=l('Items In This Menu<>القائمة')?>
	</div>

	<div class="clear-withborder"></div>
	<div id="menu_items_wrap">
		<div id="sortable_wrap">
			<!--		-->

			<form id="the_sorting_items" action="" onsubmit="makeParents();return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
				<input type="hidden" value="" name="e"/>
				<input type="hidden" name="action" value="sort_menu_items"/>

				<ol class="sortable" id="sortable_div">
					<?php
					$resp = db( 'menu_items_1564508835', 'WHERE menu_key=' . escape( $_GET[ 'id' ] ) . ' AND deleted=0 AND sub_of=0', 'ORDER BY order_num ASC', NULL, 'id,custom_title,custom_link,open_new_window,module_prefix,item_id,module_field,order_num,sub_of,menu_key' );
					if ( $resp == 0 )echo 'error';
					else if($resp==1)echo 'No Data';
					else{
						for($i=0;$i<count($resp);$i++){
							?>
					<li class="module_item move noselect" data-menu_items_module_id="<?=$resp[$i]['id'];?>">
						<div class="ui-sortable-handle module_item_elem">
							<input class="displayNone" type="number" name="sort_menu_item[]" value="<?=$resp[$i]['id'];?>">
							<?php  echo menuTitle($resp[$i]);?>
						</div>
						
						<div class="menu_item_options">
							<div onclick="menu_item_edit(<?=$resp[$i]['id']?>)" class="menu_item_option mid po"><i>edit</i></div>

							<a onclick="return submitter(null,urlPanel,'deleting',{'module':'','action':'delete_menu_item','id':'<?=$resp[$i]['id'];?>','e':''},'post',false);" class="menu_item_option mid po"><i>delete</i></a>

							<i class="menu_item_option mid po">gamepad</i>
							
						</div>

						<?php
						$respo=db('menu_items_1564508835','WHERE menu_key='.escape($_GET['id']).' AND deleted=0 AND sub_of='.$resp[$i]['id'],'ORDER BY order_num ASC',NULL,'id,custom_title,custom_link,open_new_window,module_prefix,item_id,module_field,order_num,sub_of,menu_key');
						if ( $respo != 1 ) {
							?>
						<ol>
							<?php for($j=0;$j<count($respo);$j++){?>
							<li class="module_item move noselect" data-menu_items_module_id="<?=$respo[$j]['id']?>">
								<div class="ui-sortable-handle module_item_elem">
									<input class="displayNone" type="number" name="sort_menu_item[]" value="<?=$respo[$j]['id']?>">
									<?=menuTitle($respo[$j])?>
								</div>
							
								
								
						<div class="menu_item_options">
							<div onclick="menu_item_edit(<?=$respo[$j]['id']?>)" class="menu_item_option mid po"><i>edit</i></div>

							<a onclick="return submitter(null,urlPanel,'deleting',{'module':'','action':'delete_menu_item','id':'<?php echo $respo[$j]['id'];?>','e':''},'post',false);" class="menu_item_option mid po"><i>delete</i></a>

							<i class="menu_item_option mid po">gamepad</i>
							
						</div>
								
									
								
								
								
								
								
								<?php
						$respoa=db('menu_items_1564508835','WHERE menu_key='.escape($_GET['id']).' AND deleted=0 AND sub_of='.$respo[$j]['id'],'ORDER BY order_num ASC',NULL,'id,custom_title,custom_link,open_new_window,module_prefix,item_id,module_field,order_num,sub_of,menu_key');
						if($respoa!=1){
							?>
						<ol>
							<?php for($ja=0;$ja<count($respoa);$ja++){?>
							<li class="module_item move noselect" data-menu_items_module_id="<?php echo $respoa[$ja]['id'];?>">
								<div class="ui-sortable-handle module_item_elem">
									<input class="displayNone" type="number" name="sort_menu_item[]" value="<?php echo $respoa[$ja]['id'];?>">
									<?php  echo menuTitle($respoa[$ja]);?>
								</div>
								
						<div class="menu_item_options">
							
							<div onclick="menu_item_edit(<?=$respoa[$ja]['id']?>)" class="menu_item_option mid po"><i>edit</i></div>

							<a onclick="return submitter(null,urlPanel,'deleting',{'module':'','action':'delete_menu_item','id':'<?php echo $respoa[$ja]['id'];?>','e':''},'post',false);" class="menu_item_option mid po"><i>delete</i></a>

							<i class="menu_item_option mid po">gamepad</i>
							
						</div>

								<?php }?>
						</ol>
						<?php }?>
								
								

								<?php }?>
						</ol>
						<?php }
									  ?>
						</li>

						<?php 
							}//for
						}//else
						unset($resp);?>

				</ol>


				<div id="holderForMakeParents">

				</div>


			</form>
			<script>
			function sort_save(){
				menu_item_form_mode('add');
				$('#the_sorting_items').submit();
			}
				
				function menu_item_edit(id){
					sub({'menu_item_get':id});
				}
				
				function menu_item_form_mode(mode){
					var form=$('#menu_items_1564508835');
					if(mode=='edit'){
					$('#add_new_menu_item_sec_head').css('background','var(--greenG)');
						
					$('#add_new_menu_item_sec_head').html(l('Modify Menu Item<>تعديل بند في القائمة'));
						
					$(form).find('[type=submit]').css('background','var(--greenG)').val(l('Update<>تحديث'));
					
						show('back_to_add_menu');
						
					}else if(mode=='add'){
						hide('back_to_add_menu');
						$('#add_new_menu_item_sec_head').html(l('Add New Menu Item<>أضف على القائمة'));
						
						$('#add_new_menu_item_sec_head').css('background','orange');
						
						$(form).find('[type=submit]').css('background','var(--mainColor)').val(l('Add<>أضف'));
						
						$(form).find('[name=sub_of]').val(0);

					
					$(form).find('[name=order_num]').val(100);
						
						$(form).find('[name=custom_title]').val('');
					
					$(form).find('[name=custom_link]').val('');
						
						
						
						
						
						if($(form).find('[name=points_to_home]').is(':checked')){
						
					$(form).find('[name=points_to_home]').closest('.input_area').find('label').trigger('click');
					}
					
					
					if($(form).find('[name=open_new_window]').is(':checked')){
						
					$(form).find('[name=open_new_window]').closest('.input_area').find('label').trigger('click');
					}
						
						
						
						
					$('[name=module_prefix]').val(0);
					$('[name=module_prefix]').trigger('change');
					
				
						
						
					}
					

					$(function(){
						afterLoadNewData();
					});
				}
				
				function menu_item_get_callback(data,params){
					menu_item_form_mode('edit');
					var form=$('#menu_items_1564508835');
					$(form).find('[name=custom_title]').val(params['data']['custom_title']);
					
					$(form).find('[name=custom_link]').val(params['data']['custom_link']);

					
					$(form).find('[name=sub_of]').val(params['data']['sub_of']);

					
					$(form).find('[name=order_num]').val(params['data']['order_num']);

					
					$(form).find('[name=action]').val('edit_in_menu');
					$(form).append('<input type="hidden" name="id" value="'+params['data']['id']+'"/>');
					

					$('[name=module_prefix]').val(params['data']['module_prefix']);
					$('[name=module_prefix]').trigger('change');
					
					 setTimeout(
					function() {
					 $('[name=item_id]').val(params['data']['item_id']);
									$('[name=item_id]').trigger('change');
					}, 300);

					
					

						
						
					if($(form).find('[name=points_to_home]').is(':checked')!=params['data']['points_to_home']){
						
					$(form).find('[name=points_to_home]').closest('.input_area').find('label').trigger('click');
					}
					
					
					if($(form).find('[name=open_new_window]').is(':checked')!=params['data']['open_new_window']){
						
					$(form).find('[name=open_new_window]').closest('.input_area').find('label').trigger('click');
					}
					
					$(function(){
						afterLoadNewData();
					});

				}
			</script>
		</div>
	</div>



	</div>

	<script>
		var forceSpecificForm = 'add_in_menu';
		var module_selector = document.getElementById( "module_selector" );
		var selectItem = document.getElementById( 'items_select' );
		var option = null;

		function getItems() {
			option = module_selector.options[ module_selector.selectedIndex ];
            selectItem.innerHTML = '';
            
            if(option.value=='0'){
                selectItem.innerHTML='<option data-menu_field="0" value="0"><?php echo l('None<>غير محدد');?></option>';
                $( selectItem ).change();
                return;
            }
			
			submitter( null, urlPanel, 'loading', {
				'action': 'get_menu_items',
				'module_prefix': option.value
			}, 'post', false );

		}

		function itemRefresher(data,params){
			txt='<option value="0"><?=l('All Items<>كل المدخلات')?></option>';
			for(i=0;i<data.length;i++){
				txt +="<option value=\""+data[i]['id']+"\">"+data[i][option.getAttribute('data-menu_field')]+"</option>";
			}
			selectItem.innerHTML=txt;
			selectItem.selectedIndex=0;
			selectItem.options[0].selected=true;
			$(selectItem).change();
		}


		function makeParents() {
			var the_sorting_items=document.getElementById( 'the_sorting_items' );
			var menu_items_sorting_items=the_sorting_items.querySelectorAll( '.module_item' );
			var holderForMakeParents=document.getElementById( 'holderForMakeParents' );
			holderForMakeParents.innerHTML='';
			for(i=0;i<menu_items_sorting_items.length;i++){
				if ( menu_items_sorting_items[i].parentElement.nodeName == 'OL' && menu_items_sorting_items[ i ].parentElement.parentElement.nodeName=='LI'){
					$(holderForMakeParents).append('<input type="hidden" name="sorting_item_id[]" value="'+menu_items_sorting_items[i].getAttribute('data-menu_items_module_id')+'#'+menu_items_sorting_items[i].parentElement.parentElement.getAttribute('data-menu_items_module_id')+'">');
				}
			}
		}
	</script>

	<?php
	$m=db('module_settings',"WHERE module_prefix='menu_items_1564508835'",NULL,"LIMIT 1")[0];
	echo "<script>
			var ml_supp_input_names=".json_encode(explode(',',$m[ 'ml_fields'])).";</script>";
	
	
			require panel_dir.'core/modules/lang.php';

	echo '</div></div></div>';
	}
	
	
	else if($module=='uploader_1585790561' && $action=='edit'){?>

<?php if($resp[0]['photo']!=''){?>
	<div class="links_uploader">
		<div class="links_uploader_sec">HTML</div>
		<div class="link_uploader copier  po" onclick="copy(this);"><?= $resp[0]['photo']?></div>
		<div class="link_uploader copier  po" onclick="copy(this);"><?= u.$resp[0]['photo']?></div>
		
		<div class="links_uploader_sec">PHP</div>
		<div class="link_uploader copier  po" onclick="copy(this);">&lt;?= pic('<?= $resp[0]['photo']?>',600,100,$settings['site_name'])?></div>
		<div class="link_uploader copier  po" onclick="copy(this);">&lt;?= u.img('<?= $resp[0]['photo']?>',600,100)?></div>
	</div>
<?php }?>


<?php if($resp[0]['file']!=''){?>
	<div class="links_uploader">
		<div class="links_uploader_sec">HTML</div>
		<div class="link_uploader copier  po" onclick="copy(this);"><?= $resp[0]['file']?></div>
		<div class="link_uploader copier  po" onclick="copy(this);"><?= u.$resp[0]['file']?></div>
	</div>
<?php }?>


<?php }?>




<script>
	<?php if(logged()){?>
	$(function(){
		
		$('textarea.mceNoEditor').each(function(){
//			if($(this).closest('form').attr('id')=='codes_8311')return;
			$(this).closest('.form_field').find('label').append('<div class="label_extension label_btn po lorem mid" onclick="lorem(this)"><?=l('Insert Dummy Data<>جلب نص عشوائي')?></div>');
		});

		$("input[data-l_unique='true']").each(function(){
			
			label = '.'+$(this).attr('data-l_module')+'_'+$(this).attr('name')+' label';

			$(label).append('<div class="label_extension auto_checker_indicator mid"><?=l('Live checker<>تدقيق فوري')?></div>');

			$(this).attr('onkeyup','field_checker(this)');

			
			if($("input[name='title']").length!==0 && $(this).attr('data-l_slug')=='true'){
				
				$(label).append('<div class="label_extension label_btn po slugify_title mid" onclick="slugify(\'title\',\''+$(this).attr('name')+'\')"><?=l('Convert title<>أخذ من العنوان')?></div>');

				$(label).append('<div class="label_extension label_btn po copy_theme mid" onclick="cname(\'slug\')"><?=l('Copy<>نسخ')?></div>');
				}
			}
		 );
		
	});
	

	function lorem(elem){
		en="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
		ar="هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام هنا يوجد محتوى نصي";
		
		if(typeof curr_lang=='undefined' || curr_lang==0)dummy=en;
		else if(curr_lang==1)dummy=ar;
		
		$(elem).closest('.form_field').find('textarea').val(dummy);
		
		if(typeof change_lang_values != undefined){
			change_lang_values($(elem).closest('.form_field').find('textarea')[0]);
			}
	}
	
	function field_checker(elem){
		$.post("<?=urlPanel?>controller.php",{'field_checker':true,'e':'','value':$(elem).val(),'module':$(elem).attr('data-legion-module'),'field':$(elem).attr('name'),'id':<?=isset($id)?$id:0?>}, function(data) {
			if(data['response']==false){
					$(elem).css('border','1px solid red');
				}
			 else{
				$(elem).css('border','1px solid green');
			 }
		 },'json');
	}
	
	
	function slugify(from_field,slug_field){
		 var slugger = $.post("<?=urlPanel?>controller.php",{'slugify':true,'e':'','text':$('input[name="'+from_field+'"][data-l_module]').val(),'to_class':slug_field,'module':'<?=$module?>'}, function(data) {
				if(data['response']!=false){
					$('input[name="'+slug_field+'"]').val(data['data']);
					$('input[name="'+slug_field+'"]').css('border','1px solid green');
				}
			 },'json');
	}
	
		
		$('input[name="social_font"]').each(function(){
			$(this).addClass('social');
			
			$(this).parent().parent().find('label').append('<div class="label_extension label_btn po social_chooser mid" onclick="socialSearch(\''+$(this).attr('name')+'\')"><?=l('Explore Icons<>استكشف الايقونات')?></div>');
		
		});
		
		
		function socialSearch(name){
			input =$('input[name="'+name+'"]');
			field = $(input).parent().parent();
			if($(field).find('#social_chooser_wrap').length==0){
				var txt='';
				var arr=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9','=',';',':','?','<','>','`','^'];
				for(i=0;i<arr.length;i++){
					txt+='<div class="picker_choose_char social '+($(input).val()==arr[i]?'active_social':'')+' in" onclick="pickSocial(this,\''+name+'\');return false;">'+arr[i]+'</div>';
				}

				$(field).find('.social_chooser').append('<div id="social_chooser_wrap" class="chooser_wrap">'+txt+'</div>');
			}else $(field).find('#social_chooser_wrap').toggle(30);
		}
		
		function pickSocial(elem,name){
			$('.picker_choose_char').removeClass('active_social');
			$(elem).addClass('active_social');
			field = $('input[name="'+name+'"]').parent().parent();
			$(field).find('#social_chooser_wrap').toggle(30);
			$('input[name="'+name+'"]').val($(elem).html());
			
			 if (!e) var e = window.event;
    e.cancelBubble = true;
    if (e.stopPropagation) e.stopPropagation();
			
		}
	
		
		
<?php
	}//if logged as apache_child_terminate
	
	if(isset($module)){
		
	$__matrix_fields=db('module_fields',"WHERE module_id='".mid($module)."' AND visibility_matrix!=''");
		if($__matrix_fields!=1){
			
			$__matrix=array();
			foreach($__matrix_fields as $field){
				$__matrix[$field['field_name']]=array();
				$x=explode(',',$field['visibility_matrix']);
				foreach($x as $row){
					$y=explode('-',$row);
					if(count($y)>1)
						$__matrix[$field['field_name']][]=array('value'=>$y[0],'affected_field'=>$y[1],'sign'=>isset($y[2])?$y[2]:'=');
				}
			}
			$__matrix=json_encode($__matrix);
			
?>
		
		$(function(){
			matrix=JSON.parse('<?=$__matrix?>');
			field_names=Object.keys(matrix);
			for(i=0;i<count(field_names);i++){
					input=$('[name='+field_names[i]+']:not([data-search-list])');
					matrix_father_changed(input);
					$(input).on('select2:select', function (e) {
						matrix_father_changed(this);
					});
			}
			// p(matrix);
		});
		
		
		function matrix_father_changed(elem){
			matrix_tmp=$(matrix[$(elem).attr('name')]);
			for(j=0;j<count(matrix_tmp);j++){
				end_result_show=true;
				//catch the affected/parent/input wrapper div fields
				affected=$('[name='+matrix_tmp[j]['affected_field']+']:not([data-search-list])');
				affected_div=$(affected).closest('.form_field');
				
				if(matrix_tmp[j]['sign']=='='){
					if($(elem).val()!=matrix_tmp[j]['value']){end_result_show=false;}
				}
				else if(matrix_tmp[j]['sign']=='!='){
					p(matrix_tmp[j]['affected_field'] + ': parent val:' + $(elem).val() + '  and affected val: ' + matrix_tmp[j]['value']);
					if($(elem).val()==matrix_tmp[j]['value']){end_result_show=false;}
				}
				// if($(elem).val()!=matrix_tmp[j]['value']){
				// 	$(affected).hide();
				// 	$(affected).removeClass('affected_matrix');
				// 	$(elem).val('');
				// }else if($(elem).val()==matrix_tmp[j]['value']){
				// 	$(affected).addClass('affected_matrix');
				// 	$(affected).show();
				// 	$(affected).effect("highlight",{times:1},50);
				// }

				if(end_result_show){
					$(affected_div).addClass('affected_matrix');
					$(affected_div).show();
					$(affected_div).effect("highlight",{times:1},100);
				}
				else{
					$(affected_div).hide();
					$(affected_div).removeClass('affected_matrix');
					$(affected).val('');
				}
			}
		}
		<?php }}?>
</script>

<?php include cd.'custom_preViewFormEnd.php'?>