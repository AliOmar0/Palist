<?php if(isset($_form_resp))$old_form_resp=$_form_resp;?>

<input type="hidden" form="<?=$cluster['parent_module']?>" name="cluster_modules[]" value="<?=$cluster['module']?>"/>

<input type="hidden" form="<?=$cluster['parent_module']?>" name="cluster_actions[]" value="<?=$cluster['action']?>"/>

<div id="cluster_wrap_<?=$cluster['module']?>">
	<?php if($cluster['action']=='edit'){
		$cluster_resp=db($cluster['module'],"WHERE !deleted AND related_id=".eg('id'),"ORDER BY id ASC");
		$old_get=$_GET;
		
		if($cluster_resp!=1){
			foreach($cluster_resp as $r){
				echo '<div class="cluster_box cluster_box_tofix">';
					$_GET['id']=$r['id'];
					include modules_dir.$cluster['module'].'/views/editNoForm.php';
				echo '</div>';
			}
				

		}
		$_GET=$old_get;
	}?>
	<div id="cluster_add_btn_<?=$cluster['module']?>" class="l_btn l_btn_small l_ml20 l_grass" onclick="cluster_add('<?=$cluster['module']?>')">+ <?=l('Add<>أضف')?></div>
	<div class="l_mb10"></div>
</div>

<div id="cluster_form_sample_<?=$cluster['module']?>" class="h">
	<div class="cluster_box">
			<div class="l_mr5 mid">
				<div class="l_btn l_btn_small l_lava l_white_c" onclick="cluster_delete(this)">X</div>
			</div><!--
			--><div id="cluster_form_<?=$cluster['module']?>" class="w90 mid">
			<?php include modules_dir.$cluster['module'].'/views/addNoForm.php';?>
		</div>
	</div>
</div>

<script>

	$(function(){
		$('body').append($('#cluster_form_sample_<?=$cluster['module']?>'));
		$('.<?=$cluster['module'].'_'.$cluster['hide_field']?>').hide();
		$('#cluster_form_sample_<?=$cluster['module']?> [name]').each(function(){
			$(this).attr('name','cluster_<?=$cluster['module']?>_'+$(this).attr('name')+'[]');
		});
		
		<?php if($cluster['action']=='add'){?>
			cluster_add('<?=$cluster['module']?>');
		<?php }else{?>
			$('#cluster_wrap_<?=$cluster['module']?> .cluster_box_tofix').each(function(){
				tmp=$(this).html();
				$(this).html($('#cluster_form_sample_<?=$cluster['module']?> .cluster_box').clone());
				$(this).find('#cluster_form_<?=$cluster['module']?>').html(tmp);

				$(this).find('[name]').each(function(){
					$(this).attr('name','cluster_<?=$cluster['module']?>_'+$(this).attr('name')+'[]');
				});

				$(this).find('.select2').remove();
				$(this).find('select').select2();
				
			});
		<?php }?>
	});

	function cluster_add(mod){
		tmp = $('#cluster_form_sample_'+mod).find('.cluster_box').clone();
		$(tmp).attr('cluster_box_id',ran());
		$('#cluster_add_btn_'+mod).before(tmp);
		$("#cluster_wrap_"+mod).find('.select2').remove();
		$("#cluster_wrap_"+mod).find('select').select2();
	}

	function cluster_delete(elem){
		$(elem).closest('.cluster_box').remove();
	}

</script>

<?php if(isset($old_form_resp))$_form_resp=$old_form_resp;?>