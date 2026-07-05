var beingDraggedElem=0;
var meSides=['top','right','bottom','left'];
var me_border_radius=['top-left','top-right','bottom-right','bottom-left'];
var me_grid_gap=['0','5','10','15','20','25','50','100'];

$(function(){
	init_meepo();
	meepoLoad(0);
});

function meepoSave(){
	$('body').append('<div id="tmp" class="hidden"></div>');
	$('#tmp').html($('#meBoard').html());
	
	
	$('#tmp .meBtn').each(function(){
		$(this).attr('href',$(this).attr('meepo-href'));
		$(this).removeAttr('meepo-href');
	});
	
	$('#tmp *').each(function(){
		$(this).removeAttr('meepo-elem-highlight');
	});
	
	
	$('#meepo_1646265283 textarea').val($('#tmp').html());
	
	$('#tmp').remove();
	
}

function handleDragStart(e,elem) {
	if(elem.parentElement.classList.contains('meColumn')){
		beingDraggedElem = e.target;
		}
	else 
		beingDraggedElem =$('#meSamples .' + $(e.target).attr('meepo-target-sample'))[0].cloneNode(true);
}

function handleDragOver(e){
	switch($(e.target).attr('meepo-elem-type')){
		case'board':
			if($(beingDraggedElem).hasClass('meRow'))
				allowDrop(e);
		break;

		case'column':
			if($(beingDraggedElem).hasClass('meElem'))
				allowDrop(e);
		break;

		case'label':case'photo':case'textarea':case'btn':
			allowDrop(e,$(e.target).parent());
		break;
		
		case'child-img':
			allowDrop(e,$(e.target).parent().parent());
		break;


	}

}

function allowDrop(e,destination_elem='') {
	e.preventDefault();
	if(destination_elem=='')destination_elem=e.target;
	if(!$(destination_elem).hasClass('meAllowDrop'))
		$(destination_elem).addClass('meAllowDrop');
}

function drop(e) {
	if($(e.target).parent().hasClass('meColumn')){
		destination_elem=$(e.target).parent();
	}else{
		destination_elem=e.target;
	}
  	e.preventDefault();
	$(destination_elem).append(beingDraggedElem);

	e.stopPropagation();
	dragEnd();
	init_meepo();
}

function dragEnd(){
	$('#meBoard .meElem').removeClass('meAllowDrop');
}



function init_meepo(){
	// $('.meControlBox').hide();
	var elems = $('#meBoard .meElem');
	if(elems.length==0){
		$('#meBoard').append($('#meSamples .meRow').clone());
		init_meepo();
		return;
	}

	$('#meBoard .meBtn').each(function(){
		$(this).attr('meepo-href',$(this).attr('href'));
		$(this).removeAttr('href');
	});

	
	$('#meBoard .meElem').each(function(){
		ran_id=ran();

		if(!$(this).attr('meepo-elem-id'))$(this).attr('meepo-elem-id',ran_id+rand()+rand());
		
		$(this).attr('onclick','meEdit(event,this)');

		//row
		if($(this).hasClass('meRow')){
			// $(this).attr('ondragover','ondragover(event)');
			}
		
		//column
		else if($(this).hasClass('meColumn')){
			// $(this).attr('ondragover','handleDragOver(event)');
			}
		
		//label
		else if($(this).hasClass('meLabel')){
			// $(this).attr('draggable','true');
			// $(this).attr('ondragstart','drag(event,this)');
			// $(this).attr('ondragover','handleDragOver(event)');
			}
		
		//photo
		else if($(this).hasClass('mePhoto')){
			// $(this).attr('draggable','true');
			// $(this).attr('ondragstart','drag(event,this)');
			// $(this).attr('ondragover','handleDragOver(event)');
			// $(this).find('.img').attr('draggable','false');
		}
		
		//textarea
		else if($(this).hasClass('meTextArea')){
			// $(this).attr('draggable','true');
			// $(this).attr('ondragstart','drag(event,this)');
			// $(this).attr('ondragover','handleDragOver(event)');
			
			}
		//btn
		else if($(this).hasClass('meBtn')){
			// $(this).attr('draggable','true');
			// $(this).attr('ondragstart','drag(event,this)');
			// $(this).attr('ondragover','handleDragOver(event)');
			}
		});
	

	meepoHighlight(true);
}




function meepoDelete(meepo_elem_id){
	// if($(elem).closest('.meElem').find('#meColorOptions').length!=0)
	// 	$('#meOneElement').append($('#meColorOptions'));
	meElem=$('[meepo-elem-id='+meepo_elem_id+']');
	type=$(meElem).attr('meepo-elem-type');

	if(type=='row'){
		arr=$('#meBoard').find('.meRow');

		if(arr.length==1){
			messenger("Can't delete last row",1500,'Error');
			return;
		}
	}

	else if(type=='column'){
		arr=$(meElem).closest('.meRow').find('.meColumn');
		if(arr.length==1){
			messenger("Can't delete last column in row",1500,'Error');
			return;
		}
		
		
		// if(arr.length==1)
		// 	$(meElem).closest('.meRow').removeClass('l_grid l_grid-gap0');
		// // for(i=1;i<=8;i++){
		// 	$(meElem).closest('.meRow').removeClass('l_grid*');
		// // }

		// if(arr.length>1){
		// 	if(arr.length<=8)
		// 		$(meElem).closest('.meRow').addClass('l_grid'+arr.length);
		// 	else
		// 		$(meElem).closest('.meRow').addClass('l_grid'+arr.length);
		// }
	}
	
	tmpMeRow=$(meElem).closest('.meRow');
	$(meElem).remove();

	meepoColumnGridSetter($(tmpMeRow));
}


 function meEdit(e,meElem){
	$("#meControlWrap *").unbind();
	$('#meControlWrap :input').val('');

	$('#meepo-info-element-name').html($(meElem).attr('meepo-elem-type'));

	if($(meElem).parent().attr('id')=='meBoard'){
		$('#meepo-info-parent-btn').hide();
	}else{
		$('#meepo-info-parent-btn').show().find('.l_btn').attr('onclick',"$('[meepo-elem-id="+$(meElem).attr('meepo-elem-id')+"]').parent().click()");
	}


	if($(meElem).hasClass('meLabel')){
		canModify=['margin','padding','text','position','actions','border-radius'];
	}else if($(meElem).hasClass('meBtn')){
		canModify=['margin','padding','text','position','btn','actions','border-radius'];
	}else if($(meElem).hasClass('meTextArea')){
		canModify=['margin','padding','position','textarea','actions','border-radius'];
	}else if($(meElem).hasClass('meRow')){
		canModify=['margin','padding','position','row','actions','border-radius'];
	}else if($(meElem).hasClass('meColumn')){
		canModify=['margin','padding','position','actions','border-radius','column'];
	}else if($(meElem).hasClass('mePhoto')){
		canModify=['margin','padding','position','actions','photo','border-radius'];
	}

	
	$('.meControlBox').hide();
	for(i=0;i<canModify.length;i++){
		$('#meControl-'+canModify[i]).show();
	}
	
	//margin
	for(i=0;i<meSides.length;i++){
		$('#meControl-margin-'+meSides[i]).val($(meElem).css('margin-'+meSides[i]));
		$('#meControl-margin-'+meSides[i]).keyup(function(){
			$(meElem).css($(this).attr('meepo-target-css'),$(this).val());
		});
	}

	//padding
	for(i=0;i<meSides.length;i++){
		$('#meControl-padding-'+meSides[i]).val($(meElem).css('padding-'+meSides[i]));
		$('#meControl-padding-'+meSides[i]).keyup(function(){
			$(meElem).css($(this).attr('meepo-target-css'),$(this).val());
		});
	}


	//border-radius
	for(i=0;i<me_border_radius.length;i++){
		$('#meControl-border-radius-'+me_border_radius[i]).val($(meElem).css('border-'+meSides[i]+'-radious'));
		$('#meControl-border-radius-'+me_border_radius[i]).keyup(function(){
			$(meElem).css($(this).attr('meepo-target-css'),$(this).val());
		});
	}
	
	//color
	rgba=rgba2hex($(meElem).css('color'));
	$('#meControl-color').val(rgba);
	$('#meControl-color').attr('meepo-to-affect-id',$(meElem).attr('meepo-elem-id'));
	meControl_color.fromString(rgba);

	//font-size
	$('#meControl-font-size').val($(meElem).css('font-size'));
	$('#meControl-font-size').keyup(function(){
		$(meElem).css($(this).attr('meepo-target-css'),$(this).val());
	});


	//text
	$('#meControl-text-content').val($(meElem).html());
	$('#meControl-text-content').keyup(function(){
		$(meElem).html($(this).val());
	});

	//text align
	classes = $(meElem).attr('class').split(/\s+/);
	className='';
	
	for(i=0;i<classes.length;i++){
		if(classes[i]=='l_left'){
			className='l_left';
			break;
		}else if(classes[i]=='l_center'){
			className='l_center';
			break;
		}else if(classes[i]=='l_right'){
			className='l_right';
			break;
		}
	}
	
	
	$('#meControl-text-align option[value="'+className+'"]').prop('selected', true);
	
	$('#meControl-text-align').change(function(){
		$(meElem).removeClass('l_left l_center l_right');
		$(meElem).addClass($('#meControl-text-align').val());
	});


	//vertical inline block
	classes = $(meElem).attr("class").split(/\s+/);
	className='';

	for(i=0;i<classes.length;i++){
		if(classes[i]=='l_in'){
			className='l_in';
			break;
		}else if(classes[i]=='l_mid'){
			className='l_mid';
			break;
		}
	}
	
	$('#meControl-vertical-inline-block option[value="'+className+'"]').prop('selected', true);
	
	$('#meControl-vertical-inline-block').change(function(){
		$(meElem).removeClass('l_in l_mid');
		$(meElem).addClass($('#meControl-vertical-inline-block').val());
	});


	//btn
	
	//target
	$('#meControl-btn-target option[value="'+$(meElem).attr('target')+'"]').prop('selected', true);
	
	$('#meControl-btn-target').change(function(){
		$(meElem).attr('target',$(this).val());
	});

	//href
	$('#meControl-href').val($(meElem).attr('meepo-href'));
	$('#meControl-href').keyup(function(){
		$(meElem).attr('meepo-href',$(this).val());
	});

	//seo title
	$('#meControl-seo-title').val($(meElem).attr('seo-title'));
	$('#meControl-seo-title').keyup(function(){
		$(meElem).attr('title',$(this).val());
	});


	//textarea mce
	$('#meControl-textarea-content').attr('onclick','meEditTextAreaMCE('+$(meElem).attr('meepo-elem-id')+')');


	//row add column
	$('#meControl-add-column').attr('onclick','meepoAddColumn('+$(meElem).attr('meepo-elem-id')+')');

	//delete
	$('#meControl-delete').attr('onclick','meepoDelete('+$(meElem).attr('meepo-elem-id')+')');


	//photo change
	$('#meControl-photo-change').attr('onclick','meepoPhotoChange('+$(meElem).attr('meepo-elem-id')+')');


	//background color change
	$('#meControl-background-color').attr('onclick','meepoColor(this,'+$(meElem).attr('meepo-elem-id')+')');
	


	//grid gap
	className='';
	me_grid_gap.forEach(function(item){
		if($(meElem).hasClass('l_grid-gap'+item)){
			className='l_grid-gap'+item;
			return;
		}
	});
	
	$('#meControl-grid-gap option[value="'+className+'"]').prop('selected', true);
	
	$('#meControl-grid-gap').change(function(){
		$(meElem).alterClass('l_grid-gap*');
		$(meElem).addClass($('#meControl-grid-gap').val());
	});



	e.stopPropagation();
}



function meepoAddColumn(meepo_elem_id){
	meElem=$('[meepo-elem-id='+meepo_elem_id+']');
	$(meElem).append($('#meSamples > .meColumn').clone());
	meepoColumnGridSetter(meElem);
	init_meepo();
}

function meepoColumnGridSetter(meElem){
	arr = $(meElem).find('.meColumn');
	if(arr.length==1){
		$(meElem).alterClass('l_grid*');
		$(meElem).removeClass('l_grid');
		return;
	}

	if(!$(meElem).hasClass('l_grid'))
		$(meElem).addClass('l_grid');

	if(!$(meElem).hasClass('l_grid-gap*'))
		$(meElem).addClass('l_grid-gap0');

	for(i=1;i<=8;i++){
		$(meElem).removeClass('l_grid'+i);
	}

	if(arr.length>1){
		if(arr.length<=8)
			$(meElem).addClass('l_grid'+arr.length);
		else
			$(meElem).addClass('l_grid8');
	}
}

//photo
_me_photo='';
function meepoPhotoChange(meepo_elem_id){
	meElem=$('[meepo-elem-id='+meepo_elem_id+']');
	_me_photo=meElem;
	pvp_core('meepo',false,false);
}

function meepoPhotoReceived(data){
	$(_me_photo).find('img').attr('src',url+'/uploads/'+data.filename);
}


//color & gradx
function meepoColor(control_option,meepo_elem_id){
	meElem=$('[meepo-elem-id='+meepo_elem_id+']');
	css_affected=$(control_option).attr('meepo-target-css');

	$('#meepo-manual-background').attr('meepo-to-affect-id',$(meElem).attr('meepo-elem-id'));

	if($(meElem).css(css_affected).indexOf('gradient')<=0){
		rgba=rgba2hex($(meElem).css(css_affected));
		$('#meepo-manual-background').val(rgba);
		meControl_background.fromString(rgba);
	}else{
		$('#meepo-manual-background').val('NA');
		meControl_background.fromString('NA');
	}



	// $('#meControlWrap').prepe d($('#meColorOptions'));
	$('#meColorOptions').toggle();
	gradxClose();

	if(css_affected=='background')
		$('#meColorOptions .meGradientPicker').show();
	else
		$('#meColorOptions .meGradientPicker').hide();

	$('#meColorOptions .color_palette_color').each(function(){
		$(this).attr('onclick','meepoColorChoose(this,'+meepo_elem_id+')');
		$(this).attr('meepo-target-css',css_affected);
		
		if(css_affected=='color')
			me_css_to_get_from_pallete_box='background-color';
		else
			me_css_to_get_from_pallete_box='background';
		
		$(this).attr('meepo-target-css_to_get_from_pallete_box',me_css_to_get_from_pallete_box);
	});

	$('#meColorOptions .color_palette_color').each(function(){
		$(this).removeClass('active_palette_color');
		if($(meElem).css(css_affected)==$(this).css(css_affected)
		|| ($(meElem).css(css_affected).indexOf('gradient')>0 && $(this).attr('meepo-color-gradient')=='true')
		){
			$(this).addClass('active_palette_color');
			return;
		}
	});

	
}

function meepoColorChoose(elem,meepo_elem_id){	
	//elem is colorbox
	meElem=$('[meepo-elem-id='+meepo_elem_id+']');
	
	if($(elem).attr('meepo-color-gradient')=='true'){
		init_gradx(elem,meepo_elem_id);
		$('#meColorOptions').append($('#gradX'));
		$('#gradX').show(30);
		return;
	}
	
	else if($(elem).hasClass('gradx_btn')){
		value=$(elem).closest('.gradx').find('#gradx_panel_gradX').css(css_affected);
		css_affected='background';
//		value=gradx_styles[4];
		$(meElem).attr('meepo-gradx-sliders',encodeURI(JSON.stringify(gradx_sliders)));
	}else if($(elem).attr('id')=='meepo-manual-background'){
		css_affected=$(elem).attr('meepo-target-css');
		me_css_to_get_from_pallete_box=$(elem).attr('meepo-target-css_to_get_from_pallete_box');
		value=$(elem).val();
		p('haai');
	}else{
		css_affected=$(elem).attr('meepo-target-css');
		me_css_to_get_from_pallete_box=$(elem).attr('meepo-target-css_to_get_from_pallete_box');
		value=$(elem).css(me_css_to_get_from_pallete_box);
		}
	
	// $('#meColorOptions,#gradX').hide();
	$(meElem).css(css_affected,value);
	// event.stopPropagation();

	$('#meColorOptions .color_palette_color').each(function(){
		$(this).removeClass('active_palette_color');
		if($(meElem).css(css_affected)==$(this).css(css_affected)
		|| ($(meElem).css(css_affected).indexOf('gradient')>0 && $(this).attr('meepo-color-gradient')=='true')
		){
			$(this).addClass('active_palette_color');
			return;
		}
	});
	
	
	if($(elem).hasClass('gradx_btn'))
		$('#meepo-manual-background').val('');
	else
		$('#meepo-manual-background').val($(meElem).css(css_affected));
	
	// jscolor.trigger('input change');
	
	gradxClose();	
}

function init_gradx(elem,meepo_elem_id){
	$('#gradX').html('');
	meElem=$('[meepo-elem-id='+meepo_elem_id+']');

	gradx_sliders=$(meElem).attr('meepo-gradx-sliders')
	if(gradx_sliders==undefined)
		already_sliders=[{'color':"rgb(74, 59, 55)",'position':9},{'color':"rgb(174, 59, 15)",'position':49}];
	else
		already_sliders=ArrayToObject(JSON.parse(decodeURI(gradx_sliders)));

	gradX("#gradX", {
		sliders:already_sliders,
		custom_function:'meepoColorChoose',
		custom_var:meepo_elem_id,
		change: function(sliders, styles){gradXSaver(sliders, styles)}
        });

}    

function gradxClose(){
	$('#gradX').hide();
	event.stopPropagation();
}

var gradx_sliders='';
var gradx_styles='';
function gradXSaver(sliders, styles){
	gradx_sliders=sliders;
	gradx_styles=styles;
	
	
}

function ArrayToObject(arr){
	tmp=[];
   for(i=0;i<arr.length;i++){
	   tmp[i]={'color':arr[i][0],'position':arr[i][1]};
   }
	return tmp;
}



function meEditTextAreaMCE(meepo_elem_id){
	elem=$('[meepo-elem-id='+meepo_elem_id+']');
	
	designated_html=`<div onclick="meSaveTinyMCE(`+meepo_elem_id+`)" class="l_btn">Save</div>
	<textarea id="meTextAreaMCE">`+elem.html()+`</textarea>`;
	pop(designated_html);
	initiateMCE();
	
}

function meSaveTinyMCE(meepo_elem_id){
	
	$('[meepo-elem-id='+meepo_elem_id+']').html(tinymce.get('meTextAreaMCE').getContent());
	$('.bigPopClose').click();
	$("#bigPop .bigPopWrap").html('');

}

function meepoHighlight(refresh=false){
	alreadyOn=$('#meBoard').attr('meepo-elem-highlight')=='';

	if(alreadyOn && !refresh){
		$('#meBoard .meElem').removeAttr('meepo-elem-highlight');
		$('#meBoard').removeAttr('meepo-elem-highlight');
	}else if(alreadyOn && refresh){
		$('#meBoard .meElem').attr('meepo-elem-highlight','');
		$('#meBoard').attr('meepo-elem-highlight','');
	}else if(!alreadyOn && !refresh){
		$('#meBoard .meElem').attr('meepo-elem-highlight','');
		$('#meBoard').attr('meepo-elem-highlight','');
	}
  }


  function meepoLoad(id){
	if(id==0)
		sub({'meepoLoad':id,'js':'meepoLoadAllCallback'});
	else
		sub({'meepoLoad':id,'js':'meepoLoadCallback'});
  }


  function meepoLoadAllCallback(data,params){
	sel=$('#meList select');
	$(sel).html('');
	if(data!=1){
		data.forEach(function(item){
			$(sel).append('<option value="'+item['id']+'">'+item['title']+'</option>');
		});
	}
  }


  function meepoLoadCallback(data,params){
	$('#meBoard').html(data[0]['html']);
	$('#meepo_1646265283 [name=id]').val(data[0]['id']);
	$('#meFinder [name=title]').val(data[0]['title']);
	$('#meepo_1646265283 [name=action]').val('edit');
	$('#meepoCallerInfo').html('Caller: <span class="po" onclick="c(\'#meepo'+data[0]['id']+'#\')">#meepo'+data[0]['id']+'#</span>');
	init_meepo();
  }


  function meepoSaved(data,params){
	if($('#meepo_1646265283 [name=action]').val()=='add'){
		meepoLoad(0);
		$('#meepoCallerInfo').html('Caller: <span class="po" onclick="c(\'#meepo'+params['last_id']+'#\')">#meepo'+params['last_id']+'#</span>');
	}
	$('#meepo_1646265283 [name=action]').val('edit');
	$('#meepo_1646265283 [name=id]').val(params['last_id']);
	
  }

  var meepoSaveTimer='';
  function meepoAutoSaveToggle(elem){
	if($(elem).attr('meepo-autosave-state')=='on'){
		$(elem).attr('meepo-autosave-state','off');
		$(elem).removeClass('l_anim_pulse l_grass');
		clearInterval(meepoSaveTimer);
	}else{
		$(elem).attr('meepo-autosave-state','on');
		$(elem).addClass('l_anim_pulse l_grass');
		meepoSaveTimer = setInterval(function() {
			$('#meepo_1646265283').submit();
		  }, 10000);
	}
  }

  