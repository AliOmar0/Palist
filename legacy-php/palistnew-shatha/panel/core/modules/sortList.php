
<div id="sort_list_wrap" style="display:none;">
	
	<div class="close_sort_list_wrap po in" onclick="$('#sort_list_wrap').hide()">Close</div>
	
<form action="" onsubmit="return submitter(this,urlPanel);" method="post" enctype="multipart/form-data">
<input type="hidden" value="" name="e"/>
<input type="hidden" name="action" value="sort_entries"/> 
<input type="hidden" name="module" value="<?=$module?>"/> 
	
<ol class="sortable" id="sort_list_ol">

</ol>
	
	<div id="sort_options">
		<div class="sort_option po">
			<input id="clear_sort_all" class="mid" type="checkbox" name="clear_sort_all"/>
			<label for="clear_sort_all" class="mid w80">Set all other entries order after these.</label>
		</div>
	
		</div>
	
<input type="submit" class="btn main_color_bg" value="<?=l('Save<>حفظ')?>"/>		
</form>
</div>


<script>
	function sort_entries(){
		$('#sort_list_ol').html('');

		if(getSelectedIds().length==0){
			$('.filling tbody tr').each(function(){
				$('#sort_list_ol').append($('#sample_sort_ol').html());
				$('#sort_list_ol li').last().find('input').val($(this).find('td:nth-child(2)').html());
				$('#sort_list_ol li').last().find('span').html($(this).find('td:nth-child(4)').html()+' '+$(this).find('td:nth-child(5)').html());
			});
		}else{
			$(getSelectedIds()).each(function(){
				$('#sort_list_ol').append($('#sample_sort_ol').html());
				$('#sort_list_ol li').last().find('input').val($('#tr_'+this).find('td:nth-child(2)').html());
				$('#sort_list_ol li').last().find('span').html($('#tr_'+this).find('td:nth-child(4)').html()+' '+$('#tr_'+this).find('td:nth-child(5)').html());
			});
		}
		
		$('#sort_list_wrap').show(100);
	}
	</script>
	
<div class="hidden" id="sample_sort_ol">
	<li class="list_sort_box noselect">
		<div class="list_sort">
			<input  type="hidden" name="id[]" value=""/>
		<span></span>
		</div>
		<i>gamepad</i>
	</li>
</div>

