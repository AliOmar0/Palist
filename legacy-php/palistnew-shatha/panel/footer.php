</div><!--wrap-->
</div>
<?php if ($settings['exec_time']==true){?>
<div class="clear"></div>
<div id="exec_time"><span><?=l('Execution time<>مدة المعالجة')?></span><?= round((microtime(true) - $time_start),2);?> <?=l('seconds<>ثانية')?></div>
<?php } ?>


<script src="<?= pres?>js/panel.js<?php clearCache();?>"></script>
<script src="<?= pres?>js/shortcuts.js<?php clearCache();?>" defer></script>
<script src="<?= pres?>js/materialPicker.js<?php clearCache();?>" defer></script>
<?php if(!isset($doubleScroll)){?>
	<script src="<?= pres?>js/doubleScroll.js<?php clearCache();?>" defer></script>
<?php }?>
<script>
	var elem = $('#notifications_wrap')[0];
	$(function(){
		$(document).on('click',function(e){
			if(e.target.id=='wrap')$('#notifications_wrap').addClass('hidden');
//			p(e.target.id);
//			if ($(e.target).closest(elem).length===0){
//				if($(e.target).closest(elem).prevObject[0].id=='wrap')
//					$('#notifications_wrap').addClass('hidden');
//			}
		});
	});
	
                

var _arr=['#uploadFast','#mediaPop','#framer','#popArea','#notifications_wrap','#add_quick_access_help','#social_chooser_wrap','#sort_list_wrap','#bigPop','#devloper_panel'];
$(document).on('keydown',function(e){
    if(e.keyCode===27) {
		for(i=0;i<_arr.length;i++){
			if($(_arr[i]).length==0)continue;
			if($(_arr[i]).css('display')=='none'){
				continue;
			}

			p(_arr[i]);
			p($(_arr[i]).css('display'));

			if((_arr[i]=='#sort_list_wrap' || _arr[i]=='#social_chooser_wrap' || _arr[i]=='#mediaPop' || _arr[i]=='#uploadFast') && !$(_arr[i]).css('display')==''){
//				p($(_arr[i]));
				p('here1');
				$(_arr[i]).slideUp(100);
				$('body').css('overflow','initial');
				$(_arr[i]).find('video').each(function(){
					$(this).get(0).pause();
				});
				break;
				}
		
			else if(_arr[i]=='#devloper_panel' && $(_arr[i]).css('display')!=''){
				p('here2');
				$(_arr[i]).slideUp(100);
				
				break;
			}
				
			
			else if(!$(_arr[i]).hasClass('hidden')){
				p('here3');
				$(_arr[i]).addClass('hidden');
				$('body').css('overflow','initial');
				break;
				}
		}
		
    }
});
	
	
//	
//	 var lis = $('.below_bread_sub i'), str;
// for(var x=1; x<= lis.length; x++){
//   str=(1000*(x-1))+"ms";    
//   lis.eq(x-1).css({"animation": "show 1s " + str + " 1"});
// }
/*tables to cards*/
	var _txt='<style>@media all and (max-width: 575px){';
	$('table th').each(function(index){
		_txt=_txt+'td:nth-of-type('+(index+1)+')::before{content:"'+($(this).text()).replace(/\t/g, '').replace(/\n|\r/g,'').replace('▲▼','')+'"}';
		$('body').append(_txt);
	});
	$('body').append(_txt+'}</style>');

	
	/*tables to cards*/
	
	
$(document).ready(function() {
   $('table').doubleScroll();
});
	
</script>

<?php 
require core_dir.'developerPanel.php';
require panel_dir.'sharedFooter.php';
?>
</body>
</html>