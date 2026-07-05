<?php

include_once'../../panel/core/config.php';

if(!logged()) die('you are not signed in');

if($_GET['multi']!='false')$multi=true;else $multi=false;
if($_GET['allowedFiles']!='false')$allowedFiles=true;else $allowedFiles=false;

$files=array();
if($_GET['files']!='' && $multi){
	$files=explode(',',$_GET['files']);
}

##from here, trial
if(g('tiny')){
	require panel_dir.'sharedHeader.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo pres;?>css/reset.css<?php clearCache();?>"/>
<link rel="stylesheet" href="<?php echo pres?>css/main.css<?php clearCache();?>" /> 
<link rel="stylesheet" href="<?php echo pres?>css/responsive.css<?php clearCache();?>" /> 
<script  src="<?= pres?>js/submitter.js<?php clearCache();?>" defer></script>
	<script  src="<?= pres?>js/functions.js<?php clearCache();?>" defer></script>
	<script  src="<?= pres?>js/responser.js<?php clearCache();?>" defer></script>

<?php }
##to here
?>
<script src="<?= pres?>js/sortableDivs.js<?php clearCache();?>"></script>

<div id="files_wrap">
	<div id="files_options">
		<div class=" mid po stack">
		<form autocomplete="off" action="" onsubmit="return submitter(this,'<?php if(isset($controllerURL))echo $controllerURL;else echo urlPanel;?>');" method="post" enctype="multipart/form-data">
			<input type="hidden" value="" name="e"/>
			<input type="hidden" name="module" value="uploader"/> 
			<input type="hidden" name="json" value="true"/>
			<input id="fileInput" type="file" name="file[]" multiple/>
			<input type="submit" class="b mid" value="<?= l('Upload<>ارفع')?>"/>
		</form>
	</div>
		
		
	<div id="file_search_wrap" class="mid">
		<input type="text" placeholder="<?=l('search here..<>اكتب كلمة بحث..')?>" id="search_input_files" class="mid"/>
		<div class="po b mid" onClick="loadMore(true)"><?= l('Search<>ابحث')?></div>
	</div>
		
		
		<div id="media_sources_btns" class="mid">
			<div id="internal_media" class="media_source mid b mid active_media_source po" onClick="media_source(this)"><?=l('Internal<>صور من الخادم')?></div>
			<div id="external_media" class="media_source mid b mid po" onClick="media_source(this)"><?=l('External<>صور خارجية')?></div>
		</div>
		
		
		<div id="external_options" style="display:none;">
			<div id="external_orientation" class="external_option_sec in">
				<h2><?=l('Orientation<>التوجيه')?></h2>
				<div class="external_option_box in po active_external_option" onClick="media_option('orientation','landscape',this)">
					<i class="mid">crop_16_9</i><span class="mid"><?=l('Landscape<>أفقي')?></span>
				</div>

				<div class="external_option_box in po" onClick="media_option('orientation','portrait',this)">
					<i class="mid">crop_portrait</i><span class="mid"><?=l('Portrait<>عمودي')?></span>
				</div>


				<div class="external_option_box in po" onClick="media_option('orientation','square',this)">
					<i class="mid">crop_din</i><span class="mid"><?=l('Square<>مربّع')?></span>
				</div>
			</div>
			
			
			
			<div id="external_size" class="external_option_sec in">
				<h2><?=l('Minimum Size<>الحد الأدنى للحجم')?></h2>
				
				<div class="external_option_box in po" onClick="media_option('size','large',this)">
					<span class="mid">24MP/4K <?=l('Large<>كبير')?></span>
				</div>
				
				
				<div class="external_option_box in po active_external_option" onClick="media_option('size','medium',this)">
					<span class="mid">12MP/Full HD <?=l('Medium<>متوسط')?></span>
				</div>
				
				<div class="external_option_box in po" onClick="media_option('size','small',this)">
					<span class="mid">4MP/HD <?=l('Small<>صغير')?></span>
				</div>
				
			</div>
			
			
			
			<?php if($allowedFiles){?>
			<div id="external_file" class="external_option_sec in">
				<h2><?=l('File Type<>نوع الملف')?></h2>
				
				<div class="external_option_box in po active_external_option" id="video_type" onClick="media_option('type','videos',this)">
					<i class="mid">videocam</i><span class="mid"><?=l('Videos<>مقاطع متحركة')?></span>
				</div>
				
				
				<div class="external_option_box in po" id="photo_type" onClick="media_option('type','photos',this)">
					<i class="mid">landscape</i><span class="mid"><?=l('Photos<>صور')?></span>
				</div>
			
				
			</div>
			
			<?php }?>
			
			
			<div class="external_option_sec in" id="external_color" <?php if($allowedFiles){?>style="display:none"<?php }?>>
				<h2><?=l('Color<>اللّون')?></h2>
				
				<div class="external_option_box in po">
					<span class="mid"><input type="color" id="external_color_picker" value="#644b47" /></span>
				</div>
			
			</div>
			
			
			
			
			
		</div>
	
		
	
	<?php if($_GET['multi']!='false'){?>
		<div id="saveItems" onClick="prepareItems()" class="po btn mid"><?=l('Save<>حفظ')?></div>
		<?php } ?>
		</div>
	
	
	<div id="itemsWrap">
	<ul id="items">
		<?php foreach($files as $file){
		$detail=db('files_1577206823',"WHERE name='".$file."'",NULL,'LIMIT 1')[0];
		?>
		<li class="files_box in po stack" id="remove_<?=$file?>" data-name="<?=$file?>"><img src="<?= $detail['type']=='photo'?uploads_link.img($detail['full_name'],200,100):fileIcon($detail['full_name']);?>"/><div class="file_title"><?=$detail['original_name']?></div><div class="itemSign" onClick="removeItem('<?=$file?>')"><img src="<?= pres.'imgs/negative.png' ?>"/></div></li>
		<?php }?>
		
	</ul>
		
		
	</div>
	
	
	
	
	<div id="all_photos">
		<?php include'loadmore.php'?>
	</div>
	
	<div id="loadMorePhotos" style="display: none;" class="po noselect" onClick="loadMore()"><img id="rolling_img_load_more" class="mid" src="<?=uploads_link?>loading.gif" style="display:none;"><?= l('Load more<>اجلب المزيد')?></div>
	<div style="display: none;" id="noresult_browser"><?=l('No results<>لا يوجد نتائج')?></div>
</div>




<script>
	
	var backup='';
	var external_per_page=40;
	var external_page=1;
	var nexter='';
	var credit='<a target="_blank" class="credit_src_link" href="https://www.pexels.com"><?=l('Photos & videos provided by Pexels, you are not obligated to write credit of the photographer, but it would be nice. Pexels limits generally the amount of usage of their files via API, so ProVision is not obligated to provide this service. Its just a nice bonus feature!<>الصور والمقاطع المتحركة هي من موقع بكسلز، انت لست ملزماً بذكر اسم المصور، لكن سيكون لطيفاً ان ذكرت\ها، ان هذه الخدمة محدودة الاستخدام من ناحية عدد التحميل، شركة بروفجن قدمت لكم هذه الخدمة مجانية، اي انها ليست الزامية في الدعم الفني او ان وصلتم حد الاستخدام الاعلى.')?></a>';
	var media='';
	
	var in_server='<div class="in_server media_info mid"><i class="mid">download_done</i><span class="mid"><?=l('In Server<>في الخادم')?></span></div>';
							
	var download='<div class="download_to_server media_info mid"><i class="mid">download</i><span class="mid"><?=l('Download<>تنزيل')?></span></div>';
	
	
	var external_orientation='horizontal';
	var external_size='medium';
	var external_options='';
	
	var default_external_topic='technology';

	var file_type='photos';
	
	
	function media_option(type,value,elem){
		
		
		if(type=='size'){
			$('#external_size .external_option_box').removeClass('active_external_option');
			$(elem).addClass('active_external_option');
			external_size=value;
			
		}	
		
		else if(type=='orientation'){
			$('#external_orientation .external_option_box').removeClass('active_external_option');
			$(elem).addClass('active_external_option');
			external_size=value;
			
		}	
	
		
		else if(type=='type'){
			$('#external_file .external_option_box').removeClass('active_external_option');
			$(elem).addClass('active_external_option');
			if(value=='photos'){
				$("#external_color").show(30);
			}else
				$("#external_color").hide(30);
		}	
		
		
		external_option_builder();
	}
	
	function external_option_builder(){
		external_options='';
		external_options+='&size='+external_size;
		external_options+='&orientation='+external_orientation;
		
		if($('#external_color_picker').val()!='#644b47'){
			external_options+='&color='+$('#external_color_picker').val();
			}
		
		return external_options;
	}
	
	
	var el = document.getElementById('items');
		var sortable = Sortable.create(el);
	
	
	function result_foot(loadmore=true,noresults=true){
		if(loadmore)
			$('#loadMorePhotos').show(30);
		else
			$('#loadMorePhotos').hide(30);
		
		
		if(noresults)
			$('#noresult_browser').show(30);
		else
			$('#noresult_browser').hide(30);
	}
	
	
	
	
	function selectFile(url,original_name,filename,thumbnail_url,name){
		if($('#remove_'+name).length>0){
			removeItem(name);
			return;
		}
		
		$('#items').append('<li class="files_box in po stack" id="remove_'+name+'" data-name="'+name+'">'+$('#insert_'+name+' img').prop('outerHTML')+'<div class="file_title">'+ original_name +'</div><div class="itemSign" onClick="removeItem(\''+name+'\')"><img src="<?= pres.'imgs/negative.png' ?>"/></div></li>');
		$('#insert_'+name).prepend('<div class="itemSign" onClick="removeItem('+name+')"><img src="<?= pres.'imgs/checked.png' ?>"/></div>');
	}
	
	function removeItem(name){
		$('#insert_'+name+' .itemSign').remove();
		$('#remove_'+name).remove();
	}
		
	var items='';
	function prepareItems(){
		
		$('#items li').each(function(){
			items = items + $(this).attr('data-name') + ',';
			
		});
		items = items.slice(0,-1);
		insert();
		toggle('framer');
		$('body').css('overflow','hidden');
		
	}
	
	function insert(url,original_name,filename,thumbnail_url,name='') {
    window.parent.postMessage({
        mceAction: 'photo_inserter_caller',
        url: url,
		filename:filename,
		thumbnail_url: thumbnail_url,
		field_class: '<?= $_GET['field_class']?>',
		desc:original_name,
		selectedCount: $('#items li').length,
		selectedArray: items,
    }, '*');
		
}	
	
	
	function uploadedFile(data,params){
		for(i=0;i<data.length;i++){
		$('#all_photos').prepend('<div id="insert_'+data[i]['name']+'" class="files_box in po stack" onclick="<?= $multi ? 'selectFile':'insert'?>(\''+ data[i]['url'] +'\',\''+ data[i]['originalFileName']+'\',\''+ data[i]['filename'] +'\',\''+ data[i]['thumbnail_url'] +'\',\''+ data[i]['name'] +'\')"><img src="'+ data[i]['thumbnail_url'] +'"/><div class="file_title">'+ data[i]['originalFileName']+'</div></div>');
		
			}
		$('#noresult_browser,#loadMorePhotos').hide(10);
	}
	

	
function loadMore(search=false){
	if($('.active_media_source').attr('id')=='external_media'){
		
		
		if($('#external_file').length!=0){
			if($('#external_file .active_external_option').attr('id')=='video_type'){
				file_type='videos';
			}else file_type='photos';
		}
		
	
		if(file_type=='photos')
			link='https://api.pexels.com/v1/search?query='+default_external_topic+'&page='+external_page+'&per_page='+external_per_page+external_option_builder();
		else
			link='https://api.pexels.com/videos/search?query='+default_external_topic+'&page='+external_page+'&per_page='+external_per_page+external_option_builder();
		
		if(nexter!=''){
			link=nexter;
		}
		
		if(search){
			$('#all_photos').html(credit);
			result_foot(false,true);
			nexter='';

			if(file_type=='photos')
				link='https://api.pexels.com/v1/search?query='+($('#search_input_files').val()==''?default_external_topic:$('#search_input_files').val())+'&page='+external_page+'&per_page='+external_per_page+external_option_builder();
			else
				link='https://api.pexels.com/videos/search?query='+($('#search_input_files').val()==''?default_external_topic:$('#search_input_files').val())+'&page='+external_page+'&per_page='+external_per_page+external_option_builder();
		}
		
		sub({'pexel':true,'file_type':file_type,'link':link},true,true);
		
		return;
	}

	
	$('#rolling_img_load_more').show();
	if(search){
		$("#all_photos").html('');
		offset = 0; 
	}else offset = $(".files_box").length;
  $.ajax({url: "<?= url.'plugins/tinymce/loadmore.php?offset='?>"+offset+'&search='+$('#search_input_files').val()+'&multi=<?= $_GET['multi']?>'+'&files=<?= $_GET['files']?>&allowedFiles=<?=$_GET['allowedFiles']?>', success: function(result){
	  if(result=="nomore")$('#loadMorePhotos').html('<div id="noresult_browser"><?= l('No more results<>لا يوجد مزيد')?></div>');
	  else if(result=='noresult')$('#loadMorePhotos').html('<div id="noresult_browser"><?= l('No results<>لا يوجد نتائج')?></div>');
	  else{
		  $("#all_photos").append(result);
		  }
	  
	  $('#rolling_img_load_more').hide();
  }});

	
}
	
	
	
	function media_source(elem){
				$('.media_source').removeClass('active_media_source');
				$(elem).addClass('active_media_source');
				
				if(elem.id=='external_media'){
						backup=$("#all_photos").html();
						$("#all_photos").html(credit);
						$('#external_options').show(30);
						loadMore($('#search_input_files').val()==''?false:true);
					}
				else if(elem.id=='internal_media'){
					$('#external_options').hide(30);
					$("#all_photos").html(backup);
				}
			}
			
	
	
	
	function pexel_process(data,params){
	
					
					if(data==undefined || data[file_type]=='undefined' || data[file_type].length==0){
						nexter='';
						result_foot(false,true);
					}
					else{
						media=data[file_type];
						if($('#media_count').length==0)
							$('#all_photos').append('<div id="media_count"><?=l('Result Count:<>عدد النتائج:')?> <media_num>'+data['total_results']+'</media_num></div>');
						
						result_foot(false,false);
						if(data['next_page']!=undefined){
								nexter=data['next_page'];
								result_foot(true,false);
						}else{
							nexter='';
							result_foot(false,false);
						}
						
						
						for(i=0;i<media.length;i++){

							if(media[i]['in_server']){
								media_info_server=in_server;
								onclick_func='insert(\''+media[i]['server_file_info']['url']+'\',\''+media[i]['server_file_info']['name']+'\',\''+media[i]['server_file_info']['filename']+'\',\''+media[i]['server_file_info']['thumbnail_url']+'\')';
					
								
							}else{
								media_info_server=download;
								
								onclick_func='media_from_link('+i+')';
							}
							
							
							
							if(file_type=='photos'){
									info='<div class="file_title">'+media[i]['alt']+' <div class="pexels_credit_info">'+media[i]['photographer']+' - pexels.com</div></div>';
									$('#all_photos').append('<div id="insert_'+media[i]['id']+'" class="files_box in po stack" onclick="'+onclick_func+'"><img src="'+media[i]['src']['small']+'"><div class="media_info_wrap">'+media_info_server+'</div>'+info+'</div>');
								}
							else{
									info='<div class="file_title"><?=l('Duration:<>المدّة:')?> '+media[i]['duration']+' <?=l('seconds<>ثانية')?>'+' <div class="pexels_credit_info">'+media[i]['user']['name']+' - pexels.com</div></div>';
									$('#all_photos').append('<div id="insert_'+media[i]['id']+'" class="files_box in po stack video_box" onclick="'+onclick_func+'"><img src="'+media[i]['image']+'"><div class="media_info_wrap">'+media_info_server+'</div>'+info+'</div>');
								}
						}
					}
				
	}
	
	
	
	function media_from_link(index){
		sub({'download_pexel':true,'file_type':file_type,'pexel_item':JSON.stringify(media[index])});
	}
	
	function file_from_link_callback(data,params){
		
		$('#insert_'+data['reference']+' .media_info_wrap').find('.download_to_server').hide(100,function(){
			$('#insert_'+data['reference']+' .media_info_wrap').append(in_server);
		});
		
		
		$('#insert_'+data['reference']).attr('onclick','insert(\''+data['url']+'\',\''+data['name']+'\',\''+data['filename']+'\',\''+data['thumbnail_url']+'\')');
		
	}
	
	
	
//	$(function(){
//		loadMore();
//	});

</script>
<div id="roller" class="hidden" class="main_color_bg">
	<img id="rolling_img" class="mid" loading="lazy" src="<?= uploads_link.'loading.gif';?>"/>
<div id="rolling_msg" class="mid"></div>
	<div id="percentage_upload_box">
		<div id="percentage_upload_text"></div>
		<div id="percentage_upload_filler" class="main_color_bg"></div>
	</div>
</div>
	

<div id="general_msg_area" style="display:none" class="hidden"></div>
<?php //include_once panel_dir.'sharedFooter.php';?>