<div id="preBread" class="nos">
	<div id="preBreadNavBtns" style="display:none;" class="nos mid">
		<div class="mid">
			<div class="po mid" onclick="scrollPanel()"><i>expand_less</i></div>
			<div class="po mid" onclick="scrollPanel('end')"><i>expand_more</i></div>
		</div>
	</div>
	
	<div id="dark_switch" class="mid">
		<label class="switch po">
			<input type="checkbox" <?=isset($userInfoArr) && $userInfoArr['dark_mode']?'checked':NULL?> onChange="darkMode(this)" class="l_reset_input">
			<span class="slider round"></span>
			<div class="dark_switch_i dark_switch_sun"><i>light_mode</i></div>
			<div class="dark_switch_i dark_switch_moon"><i>dark_mode</i></div>
		</label>
	</div>

	
	<?php if(privilege('uploader_1585790561','add')){?>
	<div id="preBreadSettingsBtn" class="mid po">
		<i class="mid"  onClick="$('#uploadFast').slideToggle(150)">backup</i>
		<div id="uploadFast" class="prebread_pop" style="display:none">
			<?=form('uploadFastForm','uploadFast')?>
				<input type="file" name="file[]"/>
				<input name="js" type="hidden" value="uploadFastCallback"/>

			<div id="uploadFastResp">
			</div>
			<script>
				function uploadFastCallback(data){
					$('#uploadFastResp').html(data);
					 $("#uploadFast")[0].reset();
				}
			</script>
			<?=endForm(l('Upload<>ارفع'))?>
		</div>
	</div>
	
	<?php }
	
	if(super()){
	$tmp=db('menu_1564508145',NULL,'ORDER BY id ASC','LIMIT 1');
	if($tmp!=1){
	?>
	
	<a class="mid" title="<?=l('Error Logs<>أخطاء النظام')?>" href="<?=urlPanel?>?module=menu_1564508145&action=edit&id=<?=$tmp[0]['id']?>">
		 <i class="mid">menu</i>
	</a>
	
	<?php }?>
	
	
	<div id="preBreadSettingsBtn" class="mid po">
		<i class="mid" onClick="$('#qr').slideToggle(150)">qr_code_2</i>
		<div id="qr" class="prebread_pop" style="display:none">
			<?=form('qrForm','qr')?>
			<input type="hidden" name="js" value="qrCallback"/>
				<input type="text" name="title" placeholder="Title"/>
				<input type="text" name="value" placeholder="Value"/>
				<input type="text" name="hash_origin" placeholder="v1" />
				<input type="color" name="color">
				<input type="number" name="dimension" value="500" />

			<div id="qrResp">
			</div>
			<script>
				function qrCallback(data){
					$('#qrResp').html(data);
					 $("#qrForm")[0].reset();
				}
			</script>
			<?=
		endForm(l('Generate<>افعل'))
			?>
		</div>
	</div>
	
	
	
	
	<a target="_blank" class="mid" title="<?=l('Error Logs<>أخطاء النظام')?>" href="<?=urlPanel?>?module=settings&action=errorLogs">
		 <i class="mid">warning</i>
	</a>

	
	
	<div id="preBreadSettingsBtn" class="mid po" onClick="toggle('preBreadSettingsMenu')">
		<i class="mid">settings</i>
	</div>
	
	
	<a class="mid" title="<?=l('Update<>تحديث')?>" href="<?=urlPanel?>?module=settings&action=updater">
		 <i class="mid">sync_alt</i>
	</a>

	
	
	<ul id="preBreadSettingsMenu" class="hidden">
		<?php $__resp=db('module_actions',"WHERE module_id=6","ORDER BY id ASC");
				foreach($__resp as $__r){?>
				<li><a class="<?php if($action==$__r['type'])echo 'main_color_font whitebg'?>" title="<?=l($__r['title'])?>" href="<?=urlPanel.'?module=settings&action='.$__r['type']?>"><i><?=$__r['icon']?></i><span class="menu_span"><?=l($__r['title'])?></span></a></li>
		<?php }?>
	</ul>

	
	
	
	<?php }?>
</div>

<script>
$(function(){
	$("#preBreadNavBtns").show(300);
});
	
function scrollPanel(where='start'){

	if(where!='start'){
		$(".working_area")[0].scrollIntoView({
		behavior: "smooth", // or "auto" or "instant"
		block: where // or "end"
		});
	}

    else if($('#wrap').length){
        $('html,body').animate({
            scrollTop: $('#wrap').offset().top
        },200);
        return false;
    }
}
</script>
