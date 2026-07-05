<?php
$resp=docurl('https://legioncms.com/api/1.0/',array('api'=>'sub_build','main_version'=>main_version,'sub_version'=>sub_version,'website_link'=>cms_url,'history'=>true,'limit'=>10),true);
//pre($resp);
if($resp['data']['this_website']==NULL || $resp['data']['this_website']['id']<$resp['data']['last_push']['id'])
	$color='red';
else if($resp['data']['this_website']['id']>$resp['data']['last_push']['id'])
	$color='brown';

else if($resp['data']['this_website']['id']==$resp['data']['last_push']['id'])
	$color='green';
?>
<table class="filling">
	<thead>
		<tr>
			<th class="th_title" colspan="3"><?=l('Builds Comparison<>مقارنة الإصدارات')?></th>
		</tr>
		<tr>
			<th><?=l('This Sub Build<>الاصدار الحالي')?></th>
			<th><?=l('Last Sub Build<>اخر إصدار')?></th>
			<th><?=l('Compering To<>مقارنةً بـِ')?></th>
		</tr>
	</thead>
	
	<tbody>
		<tr>
			<td style="background:<?=$color?>;color:white;"><?=$resp['data']['this_website']['id']?></td>
			<td><?=$resp['data']['last_push']['id']?></td>
			<td><?=$resp['data']['last_push']['website_name']?></td>
		</tr>
	</tbody>
</table>


<m10></m10>

<form autocomplete="off" id="push_update" action="" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
	<input type="hidden" value="" name="e"/>
	<input type="hidden" name="updater" value="true"/>
	
	<div class="mid  nos">
		<input class="mid l_reset_input" type="radio" onchange="update_radio_change(this)" name="updater_type" value="push_updater" id="push_updater"/>
		<label class="pointer mid" for="push_updater"><?=l('Push<>ارسال')?></label>
	</div>
	
	<div class="mid  nos">
		<input class="l_reset_input mid" type="radio" onchange="update_radio_change(this)" name="updater_type" value="pull_updater" id="pull_updater" onc/>
		<label class="pointer mid" for="pull_updater"><?=l('Pull<>سحب')?></label>
	</div>
	
	<div class="mid  nos" id="_general_updates_input" style="display:none">
	<input type="checkbox" id="_general_updates" class="css-checkbox" name="general_updates" checked="" value="1">
		<label for="_general_updates">General Updates</label>
	</div>
	
	<div class="mid  nos" id="_security_updates_input" style="display:none">
	<input type="checkbox" id="_security_updates" class="css-checkbox" name="security_updates" value="1">
		<label for="_security_updates">Security Updates</label>
	</div>
	
	
	<div class="mid " id="_content_input" style="display:none">
		<ul class="editable" contenteditable="true" onKeyUp="content_updated(this)">
			<ul class="content_list" >
				<li></li>
			</ul>
		</ul>
	<textarea id="_content" name="content" placeholder="Whats new.." class="hidden"></textarea>
		
	</div>
	

	

	<input type="number" name="google_auth_code" id="google_auth_code_field" class="l_input mid" placeholder="Google Auth" style="display:none;"/>

	<input id="updater_btn" type="submit" style="display:none;" class=" l_btn mid" value="<?=l('Process<>تنفيذ')?>"/>		
</form>

<script>
	function content_updated(elem){
		$('#_content').val($(elem).html());
	}
	function update_radio_change(elem){
		var t=50;
		if($(elem).val()=='push_updater'){
			$('#_general_updates_input').show(t);
			$('#_security_updates_input').delay(t).show(t);
			$('#_content_input').delay(t*2).show(t);
			$('#google_auth_code_field').delay(t*3).show(t);
			$('#updater_btn').delay(t*4).show(t);
			
		}else if($(elem).val()=='pull_updater'){
			$('#_general_updates_input,#_security_updates_input,#_content_input').hide(t);
			$('#google_auth_code_field').delay(t).show(t);
			$('#updater_btn').delay(t*2).show(t);
		}
		
		}
</script>

<m20></m20>
<table class="filling">
	<thead>
		<tr>
			<th class="th_title" colspan="5"><?=l('Version History<>تاريخ الإصدارات')?></th>
		</tr>
		<tr>
			<th><?=l('Build<>الاصدار')?></th>
			<th><?=l('Type<>النوع')?></th>
			<th><?=l('Website<>الموقع')?></th>
			<th><?=l('Timestamp<>الوقت')?></th>
			<th><?=l('Changes')?></th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach($resp['data']['history'] as $h){?>
		<tr>
			<td><?=$h['id']?></td>
			<td class="<?=$h['update_type']=='push'?'push_update':'pull_update'?>"><i class="mid"><?=$h['update_type']=='push'?'arrow_circle_up':'keyboard_arrow_down'?></i><span class="mid"><?=$h['update_type']?></span></td>
			<td><?=$h['website_name']?></td>
			<td><?=($h['time_stamp'])?></td>
			<td class="_updater_changes">
				<?php if($h['general_updates']){?><i class="general_updates_icon mid">tips_and_updates</i><?php }?>
				<?php if($h['security_updates']){?><i class="security_updates_icon mid">verified_user</i><?php }?>
				<div class="_updater_content mid"><?=$h['content']?></div>
			</td>
		</tr>
		
		<?php }?>
	</tbody>
</table>


<script>
	function done(){
		$('#google_auth_code_field').val('');
		$('#updater_btn,#google_auth_code_field').hide(50);
		$('input[name=updater_type]').each(function(){
			$(this).prop('checked', false);
		});
	}
	
	
	
	
</script>