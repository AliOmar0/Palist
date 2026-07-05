<?php $__m='statistics_8324';?>
<m10></m10>
<div class="blocka">
	<div class="group_wrapper">
		<div class="new_group"><?=l('Statistics Elements<>الاحصائيات المعرفة')?></div>
	</div>
<section id="_statistics_wrap"  class="major_section w1200">
	<div onClick="popAdd('statistics_8324',[])" class="b in"><?=l('Make Stat<>عرف احصائية')?></div>
	<m10></m10>
<!--<?php
$_resp=db($__m,NULL,'ORDER BY order_number ASC');
if($_resp==1) echo '<div class="no_data">'.l('No Data<>لا مُدخلات').'</div>';
else { for($_i=0;$_i<count($_resp);$_i++){
$_s_b_color=rand_color();
?>
--><div onClick="popEdit('<?=$__m?>',<?=$_resp[$_i]['id']?>)" class="_statistics_box nicebox in po" data-legion-id="<?=$_resp[$_i]['id']?>" draggable="true" ondragstart="onDragStart(event,this)" ondragover="onDragOverDisallow(event)" ondragleave="onDragLeave(event)">
	
	<div class="_s_b_quatro" style="border:2px solid <?=$_s_b_color?>" >
	</div>
        <h2 class="_statistics_title"><?=l($_resp[$_i]['title']);?></h2>
        <i class="_statistics_type" >
	<?php if($_resp[$_i]['type']=='Chart'){?>
<?php
			switch($_resp[$_i]['chart_type']){
					case'bar':echo $_resp[$_i]['axis']=='y'?'align_horizontal_left':'bar_chart';break;
					case'pie':echo'pie_chart';break;
					case'doughnut':echo'data_usage';break;
					case'bubble':echo'bubble_chart';break;
					case'line':echo'show_chart';break;
					case'polarArea':echo'area_chart';break;
					case'radar':echo'radar';break;
					case'scatter':echo'scatter_plot';break;
				default:echo $_resp[$_i]['chart_type'];
			}
			?>
	<?php }else echo 'tag'?>
	</i>
        <h2 class="_stats_subline"><?=l($_resp[$_i]['subline']);?></h2>
    	<div class="_s_box_state"></div>
       
    </div><!--
<?php 
    }//for
}//else
unset($_resp);?>
-->
</section>
	
	<div class="_trash_drag"><i class="_trash_drag_i" ondragover="onDragOverAllow(event)"  ondragleave="onDragLeave(event)" ondrop="onDrop(event)">delete_outline</i></div>
	
	
	</div>


<script>
var _s_b_tmpObj=0;
var _s_b_rows_count=2;
var _s_b_cols_count=3;
__s_col='<div ondrop="onDrop(event)" ondragover="onDragOverAllow(event)" ondragleave="onDragLeave(event)" style="width:'+(100/_s_b_cols_count)+'%" class="_s_b_col in"></div>';
__s_row=`<div class="_s_b_row">
	<div id="_s_b_box_tools">
		<div class="_s_b_tool _s_b_add b sb sdel in" onClick="_s_b_remove_row(this)"><?=l('Delete')?></div>
	</div>
</div>
`;
	
function onDragOverAllow(ev) {
	ev.preventDefault();
	if($(ev.target).hasClass('_trash_drag_i')){
		$('._trash_drag').css('background-color','red');
	}
	else if($(ev.target).find('._statistics_box').length==0)
		$(ev.target).css('background-color','#c1ffde');
	else if($(ev.target).find('._statistics_box').length>0 && $(ev.target).find('._statistics_box')[0]!=_s_b_tmpObj)
		$(ev.target).css('background-color','#ffd6d6');
}

function onDragOverDisallow(ev) {
	ev.stopPropagation();
}
	
function onDragStart(ev,elem) {
	if(elem.parentElement.classList.contains('_s_b_col')){
		_s_b_tmpObj = ev.target;
		$('._trash_drag').show(30);
		}
	else 
		_s_b_tmpObj=elem.cloneNode(true);
}
 
    
function onDrop(ev) {
//	p('ondrop');
  ev.preventDefault();
	if($(ev.target).find('._statistics_box').length>0){}
	else if($(ev.target).hasClass('_trash_drag_i')){
		$(_s_b_tmpObj).remove();
		$('._trash_drag').hide(50);
	}
	else{
		ev.target.appendChild(_s_b_tmpObj);
		event.stopPropagation();
	}
	onDragLeave(ev);
	rebuild_s_b();
	
}
	
function onDragLeave(ev){
	 if($(ev.target).hasClass('_trash_drag_i')){
//		$('._trash_drag').hide();
		 $('._trash_drag').css('background-color','');
	 }
	else
		$(ev.target).css('background-color','');
	
	
}
	
function rebuild_s_b(){
	var lines='';
	var ids=[];
	$(_s_b_wrap).find('._s_b_row').each(function(){
		line='';
		$(this).find('._s_b_col').each(function(){
			if($(this).find('._statistics_box').length==0)
				line+='. ';
			else{
				__id=$(this).find('._statistics_box').attr('data-legion-id');
				line+='grid_stats_'+__id+' ';
				if(!ids.includes(__id)){
					ids.push(__id);
					}
			}
			
		});
		lines+=`'`+line+`'`+'\n';
	});
	
	
	
//	$('[name=css]').val(lines);
	
	txt=`#stats_wrap_<?=$id?> {
	 display: grid;
  grid-template-areas:`+lines+`;
  gap: 10px;
}`;
	$('[name=css]').val(txt);
	$('[name=ids]').val(ids.join(','));
	
	//_s_b_quatro
	$('#_statistics_wrap ._statistics_box').each(function(){
		
		_length_in_sb=$(_s_b_wrap).find('._statistics_box[data-legion-id='+$(this).attr('data-legion-id')+']').length;
		if(_length_in_sb<=1){
			$(_s_b_wrap).find('._statistics_box[data-legion-id='+$(this).attr('data-legion-id')+'] ._s_b_quatro').hide();
		}else{
			$(_s_b_wrap).find('._statistics_box[data-legion-id='+$(this).attr('data-legion-id')+'] ._s_b_quatro').show(150);
		}
		
		if(_length_in_sb==0){
//			$(this).find('._s_box_state').html('<i>close</i>');
			$(this).find('._s_box_state').html('');
//			$(this).find('._s_box_state').css('background','gray');
//			$(this).find('._s_box_state').css('color','gray');
		}else if(_length_in_sb>0){
			$(this).find('._s_box_state').html('<span class="mid">'+_length_in_sb+'</div>');
//			$(this).find('._s_box_state').css('background','var(--greenG)');
//			$(this).find('._s_box_state').css('color','green');
		}
	});
	
	$('._statistics_box').each(function(){
		$(this).hover(function(){
			$('._statistics_box[data-legion-id='+$(this).attr('data-legion-id')+']').css('box-shadow','0 0 5px gray');
		},function(){
			$('._statistics_box[data-legion-id='+$(this).attr('data-legion-id')+']').css('box-shadow','');
		});
	});
	
	if($('[name=shortname]').val()==''){
		$('[name=shortname]').val('statistic_box_'+<?=$id?>);
	}
		
	$(_s_b_wrap).find('._statistics_box').each(function(){
			 $(this).attr('onclick','').removeClass('po');
		});
								 
}

function _stat_box(){
	
	$(_s_b_wrap).html('');
	
	//if there is data
	if($('[name=css]').html()!=''){
		var test_str = $('[name=css]').html();
		var start_pos = test_str.indexOf('grid-template-areas:');
		var end_pos = test_str.indexOf(';',start_pos);
		var text_to_get = test_str.substring(start_pos,end_pos);
		text_to_get=text_to_get.replace('grid-template-areas:','');
		arr = text_to_get.split('\n');
		arr.pop();
		_s_b_rows_count=arr.length;
		for(i=0;i<arr.length;i++){
			arr[i]=arr[i].replace(`'`,'');
			arr[i]=arr[i].replace(`'`,'');
			sub_arr=arr[i].split(' ');
			sub_arr.pop();
			_s_b_cols_count=sub_arr.length;
		}

//		return;
	}
	
	for(_i=0;_i<_s_b_rows_count;_i++){
		_s_b_add_row();
	}	

	
	if($('[name=css]').html()!=''){
		$('._s_b_row').each(function(index,elem){
		for(_i=0;_i<_s_b_cols_count;_i++){
			sub_arr=arr[index].split(' ');
			sub_arr.pop();
			for(k=0;k<sub_arr.length;k++){
				
				if(sub_arr[k]=='.'){continue;}
				id=sub_arr[k].split('_');
				tmp=$('#_statistics_wrap').find('[data-legion-id='+id[id.length-1]+']');
				$(this).find('._s_b_col').eq(k).html($(tmp).clone());
			}
		}
	});
	}
	
	__col_widths();
	rebuild_s_b();
}
	function __col_widths(){
		$('._s_b_col').each(function(){
			$(this).css("width",(100/_s_b_cols_count)+'%');
		});
	}
	
	function _s_b_add_row(incr=false){
		tmp=$(__s_row);
		$(_s_b_wrap).append(tmp);
		if(incr)_s_b_rows_count++;
		
		for(i=0;i<_s_b_cols_count;i++){
			_col=$(__s_col);
			$(tmp).append(_col);
		}
		
		__col_widths();
		rebuild_s_b();
	}
	
	function _s_b_add_column(){
		_s_b_cols_count++;
		$('._s_b_row').each(function(){
			_col=$(__s_col);
			$(this).append(_col);
		});
		
		__col_widths();
		rebuild_s_b();
	}
	
	
	function _s_b_remove_row(elem){
		$(elem).closest('._s_b_row').remove();
		_s_b_rows_count--;
		rebuild_s_b();
	}
	
$(function(){
	_s_b_wrap=$('#_s_b_wrap');
	_stat_box();
})
	
</script>

<div id="_s_b_grand">
	<div id="_s_b_grand_tools">
<!--		<div class="_s_b_tool _s_b_del" onClick="remove">-</div>-->
		<div class="_s_b_tool _s_b_add b in" onClick="_s_b_add_row(true)"><?=l('Add Row<>أضف صف')?></div>
		<div class="_s_b_tool _s_b_add b in" onClick="_s_b_add_column()"><?=l('Add Column<>أضف عمود')?></div>
	</div>
	<div id="_s_b_wrap">

	</div>
</div>


<style>
</style>