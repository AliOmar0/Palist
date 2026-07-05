<?php
require custom_dir.'custom_list.php';
require core_dir.'configList.php';

#1 fields from module_fields
list($m,$main_field,$f)=moduleFields($m);
$m['items_per_page_original']=$m['items_per_page'];
//d($m);

#2 permission
$canDelete=privilege($m['module_prefix'],'delete');
$canEdit=privilege($m['module_prefix'],'edit');
$canView=privilege($m['module_prefix'],'view');
$canView=true;

#3 default sort
if(!isset($_GET['table_column']))$_GET['table_column']=$m['default_column'];
if(!isset($_GET['table_sort']))$_GET['table_sort']=$m['default_order'];
?>

<div id="bread" class="noselect">
	<div id="module_title" class="mid">
		<i class="mid"><?=$m['info']['main_icon'];?></i>
		<span class="mid"><?=l($m['info']['module_name']);?></span>
	</div>
	
	<?php if(isset($_GET['search_is_on'])){$actionDetails['title']='Search View<>بحث';}?>
	

	<div id="curr_view" class="mid">
		<?=isset($actionDetails['title'])?l($actionDetails['title']):NULL?>
	
</div>
	
	<div id="list_stats" class="mid">
		<?php if(!isset($_GET['table_trash'])){?>
		<i class="mid bread_stat_icon"><?= isset($_GET['search_is_on'])?'query_stats':'timeline'?></i>
			<a><span class="mid list_numba"><?=gc($m['module_prefix'],tableWhere($m));?></span><span class="list_count_hint">
				<?= isset($_GET['search_is_on'])?l('search results<>نتيجة بحث'):l('total entries<>عدد المدخلات')?>
			</span></a>
		<?php }
		
		
			

		if(!isset($_GET['search_is_on'])){
		$trashCount=gc($m['module_prefix'],"WHERE deleted='1'");
		if($trashCount>0 || (isset($_GET['table_trash']) && $_GET['table_trash']==1)){?>
			<i class=" mid bread_del_icon">delete</i>
			<a title="Show Trash" href="<?=getter('trash');?>"><span class="mid list_numba"><?=$trashCount;?></span><span class="list_count_hint"><?=$trashCount==1 ? 'entry':'entries'; ?> <?=l('in trash<>في سلة المحذوفات')?></span></a>
		
			<?php if(isset($_GET['table_trash']) && $_GET['table_trash']==1){?>
			<div onclick="showPop('!','Empty Trash','Are you sure?','Permenant Deleting','<?=$module;?>','floodTrash')" class="l_btn l_btn_small l_red  po" title="Empty The Trash (unreversable!)"><i class="mid l_btn_i">delete_sweep</i><span class="mid"><?=l('Empty Trash<>افراغ السلّة');?></span></div>
		
			<div class="l_btn l_btn_small l_grass" onclick="href('<?=getter()?>')" title="<?=l('Exit Trash<>الخروج من السلّة')?>"><i class="mid l_btn_i">eject</i><span class="mid"><?=l('Exit Trash<>الخروج من السلّة')?></span></div>
			<?php }?>
		<?php }
		}else{?>
			<a class="l_btn l_btn_small l_grass_i  po" href="<?=getter('trashRespect')?>">
				<i class="mid l_btn_i">eject</i><span class="mid"><?=l('Exit Search<>الخروج من البحث')?></span>
			</a>
		<?php }?>
	</div>

	<?php 
	 include core_dir.'modules/below_bread.php';
	 include_once core_dir.'preBread.php';
	?>
</div>


<div class="working_area">
	
	<?php if(super()){?>
		
	<div  class="listBtn po in <?php if(isset($_GET['search_is_on']) || (isset($_GET['table_trash']) && $_GET['table_trash']==1))echo 'hidden'?>" onClick="popSub({'e':'','module':'<?=$m['module_prefix']?>','action':'insert_test','count':$('#dum_count').val()})">
		<i class="mid l_blue_c">gesture</i>
		<span class="mid"><?=l('Insert Testing Data<>اضافة مُدخل عشوائي')?></span>
		
		<input id="dum_count" type="number" class="mid" value="4" onClick="event.stopPropagation();"/>
	</div>
	
	
	<?php }?>

	<a href="<?=urlPanel.'?module='.$m['module_prefix'].'&action=import'?>" id="table_search_btn_cont_top" class="listBtn po mid">
		<i class="mid l_sky_c">file_upload</i>
		<span class="mid"><?=l('Import<>استيراد')?></span>
	</a>
	
	<?php


			$row_count=gc($m['module_prefix'],tableWhere($m));

			if(isset($_GET['list_offset']))
				$m['items_per_page']=$_GET['list_offset'];

			$page_count=(int)ceil($row_count/$m['items_per_page']);

			if(isset($_GET['page_num']))$page_num=escape($_GET['page_num']);
				else $page_num=1;

			$offset=($page_num-1)*$m['items_per_page'];

			// pre($m);
			$resp=db($m['module_prefix'],tableWhere($m),tableOrder(),tableLimit($m,$offset));
			// d(tableWhere($m));
			// d($m['fields']);
			// echo'dab';
			// d($resp);
			if($resp==0) echo 'error';  
			else if($resp==1 && (!isset($_GET['table_trash']) || $_GET['table_trash']!=1) && (!isset($_GET['search_is_on']) || $_GET['search_is_on']!=true)){?>
				<div id="empty_data" class="nos">
					<i class="mid"><?=$m['info']['main_icon'];?></i>
					<clear></clear>
					<div class="no_resp_list"><?=l('No entries yet<>لا يوجد مدخلات.');?></div>
					<?php if(priv($module,'add')){?>
						<clear></clear>
						<a href="<?=urlPanel.'?module='.$module.'&action=add'?>" class="l_btn l_btn_small l_mt10"><?=l('Add the first record!<>أضف أوّل مُدخل!')?></a>
					<?php }?>
				</div>
			<?php }else{?>
				
<!--	<div id="table_options" class="noselect">-->
	<div id="table_search_btn_cont_top" class="listBtn po mid <?php if(isset($_GET['search_is_on']))echo 'hidden';?>" onClick="toggle('table_search_cont');">
		<i class="mid l_purple_c">search</i>
		<span class="mid"><?=l('Search<>بحث')?></span>
	</div>
	
	
	<div  class="listBtn po in" onclick="window.location.href='<?=urlPanel.'?module='.$m['module_prefix'].'&action=edit&id='?>'+$('#edit_id').val()">
		<i class="mid l_mustard_c">edit</i>
		<span class="mid"><?=l('Edit by ID:<>عدّل المعرّف:')?></span>
		
		<input id="edit_id" type="number" class="mid" value="1"  onClick="event.stopPropagation();" />
	</div>
		
		
		<div id="table_search_btn_cont_top" class="listBtn po mid <?php if(isset($_GET['table_trash']) && $_GET['table_trash']==1)echo 'hidden';?>" onclick="return submitter(null,urlPanel,'<?=l('Deleting<>جاري الحذف')?>',{ 'module' : '<?=$m['module_prefix']?>','action' : 'multi_delete','e':'','ids':getSelectedIds()},'post',false);">
		<i class="mid l_lava_c">delete</i>
		<span class="mid"><?=l('Delete Selected<>حذف المُختار')?></span>
	</div>
	
	
	<div id="table_search_btn_cont_top" class="listBtn po mid <?php if(isset($_GET['table_trash']) && $_GET['table_trash']==1)echo 'hidden';?>" onclick="return submitter(null,urlPanel,'<?=l('Copying<>جاري النسخ')?>',{ 'module' : '<?=$m['module_prefix']?>','action' : 'multi_copy','e':'','ids':getSelectedIds()},'post',false);">
		<i class="mid l_sand_c">double_arrow</i>
		<span class="mid"><?=l('Duplicate Selected<>تكرار المُختار')?></span>
	</div>
	
	
	<?php if(super()){?>
	
	<div  class="listBtn po in <?php if(isset($_GET['search_is_on']) || (isset($_GET['table_trash']) && $_GET['table_trash']==1))echo 'hidden';?>" onclick="return submitter(null,urlPanel,'<?=l('Deleting All<>جاري العمل')?>',{'module':'<?=$m['module_prefix']?>','action':'delete_all','e':''},'post',false);">
		<i class="mid l_orange_c">clear</i>
		<span class="mid"><?=l('Delete All<>حذف الجميع')?></span>
	</div>
	
		<div  class="listBtn po in <?php if(isset($_GET['search_is_on']) || (isset($_GET['table_trash']) && $_GET['table_trash']==1))echo 'hidden';?>" onclick="return submitter(null,urlPanel,'<?=l('Exporting<>جاري التصدير')?>',{'module':'<?=$m['module_prefix']?>','action':'export_csv','e':'','ids':getSelectedIds()},'post',false);">
		<i class="mid l_green_c">download</i>
		<span class="mid"><?=l('Export<>تصدير').' .csv'?></span>
	</div>
	
	<div  class="listBtn po in <?php if(isset($_GET['search_is_on']) || (isset($_GET['table_trash']) && $_GET['table_trash']==1))echo 'hidden';?>" onclick="return submitter(null,urlPanel,'<?=l('Exporting<>جاري التصدير')?>',{'module':'<?=$m['module_prefix']?>','action':'export_csv_as_db','e':'','ids':getSelectedIds()},'post',false);">
		<i class="mid l_green_c">download</i>
		<span class="mid"><?=l('Export As Database<>تصدير كما قاعدة البيانات').' .csv'?></span>
	</div>
	
	<?php }?>
	

	
	<div  class="listBtn po in <?php if(isset($_GET['search_is_on']) || (isset($_GET['table_trash']) && $_GET['table_trash']==1))echo '';?>" onclick="return submitter(null,urlPanel,'<?=l('Exporting<>جاري التصدير')?>',{'module':'<?=$m['module_prefix']?>','action':'export_xls','e':'','ids':getSelectedIds()},'post',false);">
		<i class="mid l_green_c">download</i>
		<span class="mid"><?=l('Export<>تصدير').' .xls'?></span>
	</div>
	
	<?php if(super()){?>
	
	<div  class="listBtn po in  <?php if(isset($_GET['search_is_on']) || (isset($_GET['table_trash']) && $_GET['table_trash']==1))echo 'hidden';?>" onClick="popSub({'module':'empty_table','affected_module':'<?=$m['module_prefix']?>','force_refresh':'true'},'!','Empty <?=l($m['info']['module_name'])?> Table','Are you sure? Damage will occur','Erasing');">
		<i class="mid l_red_c">rounded_corner</i>
		<span class="mid"><?=l('Empty/Truncate<>تصفير')?></span>
	</div>
	
	<div  class="listBtn po in">
		<div class="po mid" onClick="popSub({'action':'mass_change','affected_module':'<?=$m['module_prefix']?>','ids':getSelectedIds(),'mass_field':$('#mass_field').val(),'mass_value':$('#mass_value').val()},'!','Mass Change <?=l($m['info']['module_name'])?>','Are you sure? Damage will occur, CAREFUL!','Changing');">
			<i class="mid l_fuchi_c">swap_calls</i>
			<span class="mid"><?=l('Change<>تغيير')?></span>
		</div>
		
		<div class="mid">
			<select  id="mass_field" name="mass_field">
				<option><?=l('Choose<>اختر')?></option>
				<?php foreach($f as $field){
				if(!isset($field['field_name']) || in_array($field['field_name'],[NULL,'id','options']))continue;
				?>
				<option value="<?=$field['field_name']?>"><?=l($field['label'])?></option>
				<?php }?>
			</select>
		</div>
		<div class="mid">
			<input id="mass_value" type="text" name="mass_value" placeholder="<?=l('value..<>القيمة..')?>"/>
		</div>
	</div>
	
	<?php }?>

	
	<?php $_has_order=db('module_fields',"WHERE module_id='".moduleID($m['module_prefix'])."' AND field_name='order_number'")==1?false:true;
	if($_has_order){?>
	
	<div id="table_search_btn_cont_top" class="listBtn po in" onclick="sort_entries()">
		<i class="mid l_melon_c">sort</i>
		<span class="mid"><?=l('Sort<>رتب')?></span>
	</div>
	<?php }?>
	
	
	
	<div id="table_search_btn_cont_top" class="listBtn po mid  <?php if(!isset($_GET['table_trash']) || (isset($_GET['table_trash']) && $_GET['table_trash']==0))echo 'hidden';?>" onclick="return submitter(null,urlPanel,'<?=l('Restoring<>جاري الاسترجاع')?>',{ 'module' : '<?=$m['module_prefix']?>','action' : 'multi_restore','e':'','ids':getSelectedIds()},'post',false);">
		<i class="mid l_grass_c">restore_from_trash</i>
		<span class="mid"><?=l('Restore Selected<>استرجاع')?></span>
	</div>
	
	
	
	<div id="table_search_btn_cont_top" class="listBtn po mid <?php if(!isset($_GET['table_trash']) || (isset($_GET['table_trash']) && $_GET['table_trash']==0))echo 'hidden';?>" onclick="return submitter(null,urlPanel,'<?=l('Deleting<>جاري الحذف')?>',{ 'module' : '<?=$m['module_prefix']?>','action' : 'multi_delete_trash','e':'','ids':getSelectedIds()},'post',false);">
		<i class="mid l_red_c">delete</i>
		<span class="mid"><?=l('Permanently Delete Selected<>حذف المُختار للأبد')?></span>
	</div>
	
		
	
	

	
	<div id="table_search_btn_cont_top" class="listBtn mid">
		<i class="mid l_grass_c">more_horiz</i>
		<span class="mid"><?=l('Show<>أظهر')?></span>

		<a class="list_show_btn mid <?php if(!isset($_GET['list_offset']) || $_GET['list_offset']==$m['items_per_page_original'])echo 'active_list_show_btn'?>" href="<?=urlPanel.'?'.http_build_query(array_merge($_GET,array('list_offset'=>$m['items_per_page_original'])))?>"><?=$m['items_per_page_original']?></a>

		<a class="list_show_btn mid <?php if(isset($_GET['list_offset']) && $_GET['list_offset']==200)echo 'active_list_show_btn'?>" href="<?=urlPanel.'?'.http_build_query(array_merge($_GET,array('list_offset'=>200)))?>">200</a>
		
		<a class="list_show_btn mid <?php if(isset($_GET['list_offset']) && $_GET['list_offset']==500)echo 'active_list_show_btn'?>" href="<?=urlPanel.'?'.http_build_query(array_merge($_GET,array('list_offset'=>500)))?>">500</a>
		
		<a class="list_show_btn mid <?php if(isset($_GET['list_offset']) && $_GET['list_offset']==1000)echo 'active_list_show_btn'?>" href="<?=urlPanel.'?'.http_build_query(array_merge($_GET,array('list_offset'=>1000)))?>">1000</a>
	</div>


	
	<?php if(ow('module_fields',"module_id=".mid($module)." AND is_ml=1")!=1){?>
		<div id="table_search_btn_cont_top" class="listBtn mid">
			<i class="mid l_joy_c">translate</i>
			<span class="mid"><?=l('Options<>خيارات')?></span>

			<div class="list_show_btn mid po <?php if($__adminSettings['translations'] && (!g('all_langs') || (g('all_langs') && $_GET['all_langs']==1)))echo 'active_list_show_btn'?>" onclick="sub({'admin_settings':true,'toggle':'translations','force_redirect':'<?=urlPanel.'?'.http_build_query(array_merge($_GET,array('all_langs'=>($__adminSettings['translations'] && (!g('all_langs') || (g('all_langs') && $_GET['all_langs']==1)))?0:1)))?>'});"><?=l('Translations<>ترجمات')?></div>
		
		</div>
	<?php }?>
	
		
	<clear></clear>
		
		<?php require core_dir.'modules/pagination.php';?>
<clear></clear>
	
	<div id="table_search_cont" class="<?php if(!isset($_GET['search_is_on']))echo 'hidden';?>">
		<form method="get" id="search_form_table">
			<input type="submit" class="hidden"/>
			<input type="hidden" name="search_is_on" value="true"/>
			<?php 
			$keys=array_keys($_GET);
			for($i=0;$i<count($keys);$i++){
				if(in_array($keys[$i],$main_field) || $keys[$i]=='page_num' || $keys[$i]=='search_is_on'|| $keys[$i]=='wide_search')continue;
			?>
				<input type="hidden" name="<?=$keys[$i];?>" value="<?=$_GET[$keys[$i]];?>"/>
			<?php }
				
			for($i=0;$i<count($main_field);$i++){
				echo table_search_field($main_field[$i],$f);
			}?>
			
			<clear></clear>
			<div class="mid">
				<input type="submit" id="list_search_btn" class="table_search_btn_cont mid po" value="<?=l('Find<>ابحث')?>"/>
			</div>

			<div class="l_mr10 l_ml10 l_nos mid">
				<input id="wide_search" class="css-checkbox mid" <?php if(isset($_GET['wide_search']) && $_GET['wide_search']=='true')echo'checked';?> type="checkbox" name="wide_search" value="true"/>
				<label for="wide_search" class="po mid"><?=l('Wide Match<>بحث اوسع')?></label>
			</div>
				
		</form>
	</div>

	<clear></clear>
<div class="filling_wrap_scroll">
	<table class="filling">
		<thead>
			<tr>
				<?php for($i=0;$i<count($main_field);$i++){?>
					<th><?php if($main_field[$i]=='select')echo'<input id="table_all_checker" onchange="toggleCheck(this,\'td .selectChecker\')" type="checkbox" class="css-checkbox"><label for="table_all_checker"></label>';
						echo l($f[$main_field[$i]]['label']);
						if($main_field[$i]!='options' && $main_field[$i]!='select'){?>
							<a class="table_arrow <?php if($_GET['table_column']==$main_field[$i] && $_GET['table_sort']=='ASC')echo'active_table_arrow'; ?>" href="<?=getter('sorter',$main_field[$i],'ASC');?>">&#x25B2;</a><!--
						--><a class="table_arrow <?php if($_GET['table_column']==$main_field[$i] && $_GET['table_sort']=='DESC')echo'active_table_arrow'; ?>" href="<?=getter('sorter',$main_field[$i]);?>">&#x25BC;</a>
						<?php }?>
				</th>
				<?php }?>
			</tr>
		</thead>
		<tbody>
			<?php if($resp!=1 && $resp!=0){
					for($i=0;$i<count($resp);$i++){?>
					<tr id="tr_<?=$resp[$i]['id']?>">
						<?php for($j=0;$j<count($main_field);$j++){?>
							<td><?=td($main_field[$j],$resp[$i],$m,$canDelete,$canEdit,$f,$canView);?></td>
						<?php }?>
					</tr>
				<?php }} ?>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
</div>
	
	<clear></clear>
		
		<?php require core_dir.'modules/pagination.php';?>
<clear></clear>
	<?php }?>

	
	
</div>

<?php if(isset($_has_order) && $_has_order)require_once core_dir.'modules/sortList.php'?>