function show(id,className='hidden'){
	if(id=='general_msg_area'){
		$('#'+id).removeClass('hidden');
		$('#'+id).slideDown(100);
		}
	else
		document.getElementById(id).classList.remove(className);
}

function showElement(elem,className='hidden'){
	
		elem.classList.remove(className);
}


function href(url,blank=false) {
	if(blank==true)
		window.open(url,'_blank').focus();
	else
		window.location.href=url;
}

function l_btn_activate(btn){
	$(btn).addClass('l_btn_active');
}

function l_btn_deactivate(btn){
	$(btn).removeClass('l_btn_active');
}

function l_btn_toggle(btn){
	$(btn).toggleClass('l_btn_active');
}

function href_hard(url,blank=false) {
	___legion_xhrs_exit();
	href(url,blank);
}

function visit(url,blank=false) {
	href(url,blank);
}

function hide(id,className='hidden'){
	if(id=='general_msg_area'){
		$('#'+id).slideUp(100,function(){
			$('#'+id).addClass('hidden');
		});
		}
	else
		document.getElementById(id).classList.add(className);
}

function hideElement(elem,className='hidden'){
	elem.classList.add(className);
}


function _s_b_fullscreen_toggle(elem){
	if($(elem).html()=='fullscreen'){
		$(elem).html('fullscreen_exit');
		$(elem).closest('.stats_wrapper').addClass('_s_b_fullscreen');
	}else{
		$(elem).html('fullscreen');
		$(elem).closest('.stats_wrapper').removeClass('_s_b_fullscreen');
	}
}

function toggle(id,className='hidden'){
	elem=document.getElementById(id);
if(elem.classList.contains(className))show(id,className);
else hide(id,className);
}

function classicToggle(id){
	 (function(style) {
            style.display = style.display === 'none' ? '' : 'none';
        })(document.getElementById(id).style);
	
}

function count(arr){
	return arr.length;
}

function genericDeleted(data,params){
		$(params['ids']).each(function(index,val){
			elem=$('.generic_row[data-id='+val+']');
			$(elem).slideUp(200);
			$(elem).remove();
			messenger(l('Deleted<>تم الحذف'));
		});
	}



function toggleClass(mainClass,className='hidden'){
	elems=document.querySelectorAll('.'+mainClass);
	for(i=0;i<elems.length;i++){
		elem=elems[i];
		
if(elem.classList.contains(className))showElement(elem,className);
else hideElement(elem,className);
		}
}




function d(obj){
	console.log(obj);
}

function p(obj){
	console.log(obj);
}

function pt(obj){
	console.table(obj);
}

function hideFields(fields){
		for(j=0;j<fields.length;j++){
			toggleClass(fields[j]);
			}
	}


function toggleArrow(id,elem){
	toggle(id);
	if(elem.innerHTML=='<i>arrow_drop_down</i>')elem.innerHTML='<i>arrow_drop_up</i>';
	else elem.innerHTML='<i>arrow_drop_down</i>';
	
}
function start_roll(msg) {
    msgDiv = document.getElementById('rolling_msg');
	if(msgDiv!=null || msgDiv!=""){
    msgDiv.innerHTML = msg;
    toggle('roller');}
}


function check_all(id){
    div = document.getElementById(id);
	checks=div.querySelectorAll('.css-checkbox');
	for(i=0;i<checks.length;i++){
		checks[i].checked = true;
	}
}
	
function uncheck_all(id){
    div = document.getElementById(id);
	checks=div.querySelectorAll('.css-checkbox');
	for(i=0;i<checks.length;i++){
		checks[i].checked = false;
	}
}

	
function getStyle(id, name)
{
    var element = document.getElementById(id);
    return element.currentStyle ? element.currentStyle[name] : window.getComputedStyle ? window.getComputedStyle(element, null).getPropertyValue(name) : null;
}




function changeMenuLayout(element,menu_style){
	
	toggle('icon_name');
	toggle('icon_only');
	if(menu_style=='Icon'){
//		$('.menu_span, #search_menu_wrap, #quick, #username, #menu_top_logo_holder, .legion_option').hide(30);
		$('body').append('<link id="menuCssFile" rel="stylesheet" type="text/css" href="'+url+'res/back/css/menu.css">');
		
	}
	else $('body').find('link#menuCssFile').remove();  

}

function darkMode(elem){
	if($(elem).is(':checked')){
//		$('body').append('<link class="darkCssFile" rel="stylesheet" type="text/css" href="'+url+'res/back/css/dark.css">');
//		$('body').append('<link class="darkCssFile" rel="stylesheet" type="text/css" href="'+url+'res/back/css/dark.css">');
		$('body').addClass('dark');
		}
	else 
		$('body').removeClass('dark');
//		$('body').find('link.darkCssFile').remove();  
	
		sub({'darkMode':$(elem).is(':checked'),'action':'edit'},false,true);

}


function getWidthOrHeight(id,type='width'){
	if(document.getElementById(id)==null)return 0;
	
	if(type=='width')
		return document.getElementById(id).offsetWidth;
	else 
		return document.getElementById(id).offsetHeight;

}

	function toggleCheck(name){
		var x = document.getElementsByName(name);
var i;
for (i = 0; i < x.length; i++) {
    if (x[i].type == "checkbox") {
		if (x[i].checked==true){
        x[i].checked = false;
			}
		else{
		x[i].checked = true;
			}
    }
}
	}


function enableBtns(){
		var submit_btns = document.querySelectorAll('input[type=submit]')
    for (var i = 0; i < submit_btns.length; i++) {
			submit_btns[i].removeAttribute('disabled');
	}
}

function disableBtns(){
	var submit_btns = document.querySelectorAll('input[type=submit]')
    for (var i = 0; i < submit_btns.length; i++) {

			submit_btns[i].setAttribute('disabled',true);

    } 
}







function browseFile(elem){
	elem.nextElementSibling.click();
}


function loadFile(event,elem,id){
	if(elem.hasAttribute('multiple')){
		if(elem.getAttribute('legionType')=='photo')
			elem.previousElementSibling.src = url+'uploads/photos.png';
			
			else
		elem.previousElementSibling.src = url+'uploads/files.png';
	}
	
	
	else{
		if(elem.getAttribute('legionType')=='file')
			elem.previousElementSibling.src = url+'uploads/filepicked.png';
			else
    elem.previousElementSibling.src = URL.createObjectURL(event.target.files[0]);
		}
	
	
	
	  elem.previousElementSibling.style.border='none';
	
	
	if(!(elem.hasAttribute('multiple')==false && elem.hasAttribute('legionType')=='photo')){
				placeDiv=document.getElementById(id);
		p(placeDiv);
				placeDiv.innerHTML='';
				for(i=0;i<event.target.files.length;i++){
					if(elem.getAttribute('legionType')=='photo' && elem.hasAttribute('multiple')==true)
					placeDiv.innerHTML= placeDiv.innerHTML + '<img class="photoPrev inline" src="'+URL.createObjectURL(event.target.files[i])+'"/>';
					else if(elem.getAttribute('legionType')=='file')
					placeDiv.innerHTML= placeDiv.innerHTML + '<div class="fileName">'+event.target.files[i].name+'</div>';

				}
	}
		
		
	show('clear-'+id);
			}
	






var fileHolders = ["photo.png", "file.png"];
function testFill(filename){
	for(i=0;i<fileHolders.length;i++){
		if(filename.includes(fileHolders[i]))
		return true;	
	}
	return false;
}


function checkFiles(formObj=document){
	var fileInputs = formObj.querySelectorAll('input[type=file]');
    for (var i = 0; i < fileInputs.length; i++) {
		if(fileInputs[i].hasAttribute('req') && testFill(fileInputs[i].previousElementSibling.src)){
			fileInputs[i].previousElementSibling.style.border='3px solid red';
			$("html, body").animate({ scrollTop: $($(fileInputs[i].previousElementSibling)).offset().top }, 500);
			stopSub=true;
		}
		else{
			fileInputs[i].previousElementSibling.style.border='none';
		}

    } 
}


function l_scroll(selector,from='html,body'){
	$(from).animate({
		scrollTop: $(selector).offset().top
	},200);
	return true;
}




function clearFiles(id,rand_id){
	
	//clear browser file select
		
			
			
				modified_id='input_'+rand_id;
				input=document.getElementById(modified_id);
				
				if(input==null){
					modified_id=id;
					input=document.querySelector("input[name='"+id+"[]']");
				}
	
	
			input.value='';
//reput the icon
			assignedImg=input.previousElementSibling;
			if(input.getAttribute('legionType')=='file')icon='file.png';
			else icon='photo.png';
			assignedImg.src=url+'uploads/'+icon;
	//clear the below previews
	//p(rand_id);
			document.getElementById(rand_id).innerHTML='';
	
	//tell model its cleared
	var newElement = document.createElement("INPUT");
newElement.setAttribute("type", "checkbox");
newElement.setAttribute("checked", "true");
newElement.setAttribute("class", "hidden");
newElement.setAttribute("name", "del_"+id);
input.parentNode.insertBefore(newElement, input.nextSibling);
	
	
	//show the clear btn no more
	p(modified_id);
	hide('clear-'+modified_id);

		}




	function randomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
      for (var i = 0; i < 6; i++ ) {
          color += letters[Math.floor(Math.random() * 16)];
      }
    return color;
}


function colorsArr(count=20) {
    var data =[];
    for (var i = 0; i < count; i++) {
        data.push(getRandomColor());
    }
    return data;
}

	function showPop(popSign,pop_title,pop_message,rollerMsg,module,action=null,id=null,action_confirm='Yes',action_cancel='No'){
		document.getElementById('popSign').innerHTML=popSign;
		document.getElementById('pop_title').innerHTML=pop_title;
		document.getElementById('pop_message').innerHTML=pop_message;
		document.getElementById('action_confirm').innerHTML=action_confirm;
		document.getElementById('action_cancel').innerHTML=action_cancel;
		document.getElementById('action_confirm').setAttribute("onclick", "toggle('popArea');return submitter(null,urlPanel,'"+rollerMsg+"',{ 'module' : '"+module+"','action' : '"+action+"','id' : "+id+",'e':''},'post',false);");
		toggle('popArea');
	}
	


function l(multidata,neededPrefix=''){
	if(neededPrefix=='')neededPrefix=curr;
	multidata=multidata.split('<>');
	lang_result=langArr;
	//in case l applied on NOTlingual input, or if there is no <>, fresh data.
	if(multidata.length<=1){return multidata[0];}
	for(i=0;i<lang_result.length;i++){
		if(lang_result[i]['prefix']==neededPrefix){
			if(multidata[i]!='')
				return multidata[i];
			else {
				if(isset(multidata[i+1]) && multidata[i+1]!='')
					return multidata[i+1];
				return multidata[0];
			}
		}
	}
}


	function popSub(arr,popSign='!',pop_title='Warning<>تحذير',pop_message='Are you sure?<>هل انت متأكد؟',rollerMsg='Working<>قيد العمل',action_confirm='Yes<>نعم',action_cancel='No<>لا'){
		pop_title=l(pop_title);
		pop_message=l(pop_message);
		rollerMsg=l(pop_message);
		action_confirm=l(action_confirm);
		action_cancel=l(action_cancel);
		
		document.getElementById('popSign').innerHTML=popSign;
		document.getElementById('pop_title').innerHTML=pop_title;
		document.getElementById('pop_message').innerHTML=pop_message;
		document.getElementById('action_confirm').innerHTML=action_confirm;
		document.getElementById('action_cancel').innerHTML=action_cancel;
		document.getElementById('action_confirm').setAttribute("onclick", "toggle('popArea');sub("+JSON.stringify(arr)+");");
		toggle('popArea');
	}


	
function switchActive(data,params){
	elem=document.getElementById('switch_'+params['boolField']+'_'+params['id']);
	if(elem.innerHTML=='Off'){
		elem.innerHTML='On';
		elem.classList.remove('offSwitch');
		elem.classList.add('onSwitch');
	}
	else{
		elem.innerHTML='Off';
		elem.classList.remove('onSwitch');
		elem.classList.add('offSwitch');
	}
}

	
	function rand(min=111111, max=999999999999) {
    return Math.floor(Math.random() * (max - min) ) + min;
}


function exported(data,params){
	if($('#downlaod_btn').length!=0)$('#downlaod_btn').remove();
	
		$('body').append('<a target="_blank" id="downlaod_btn" class="greenG" href="'+params['link']+'">'+l('Downlaod<>تنزيل')+'</div>');
	}


function copy(elem="",containerid="") {
	if(elem=="")elem=document.getElementById(containerid);
	
    if (document.selection) { // IE
        var range = document.body.createTextRange();
        range.moveToElementText(elem);
        range.select();
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(elem);
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
    }
	
	document.execCommand("copy");
	 messenger('copied',1000);
}


function c(txt) {
 var tmp = $("<input>");
 $("body").append(tmp);
 tmp.val(txt).select();
 document.execCommand("copy");
 tmp.remove();
 messenger('copied',1000);
}


function cname(name) {
 var tmp = $("<input>");
 $("body").append(tmp);
 tmp.val($('input[name="'+name+'"]').val()).select();
 document.execCommand("copy");
 tmp.remove();
 messenger('copied',1000);
}


function massToggle(senderID,sendersClass,senderActiveClass,victimID,victimsClass){
	//buttons
	p(senderID);
	var btns = document.querySelectorAll('.'+sendersClass);
	for(i=0;i<btns.length;i++){
		show(btns[i].id,senderActiveClass);
		if(senderID==btns[i].id)feat_index=i;
	}
	hide(senderID,senderActiveClass);
	
	
	//effecting
	var victims = document.querySelectorAll('.'+victimsClass);
	for(i=0;i<victims.length;i++){
		hide(victims[i].id);
	}
	show(victimID);
}


function mass(sender,prefix,active_is_self=false){
	$('.'+prefix).each(function(){
		if(active_is_self)
			$(this).removeClass('.'+prefix+'_active');
		else
			$(this).removeClass('l_btn_active');
	});
	
	if(active_is_self)
		$(sender).addClass('.'+prefix+'_active');
	else
		$(sender).addClass('l_btn_active');
	
	$('.'+prefix+'_slave').hide();
	$('#'+$(sender).attr('id')+'_slave').show();
}







    function IntervalTimer(callback, interval) {
        var timerId, startTime, remaining = 0;
        var state = 0; //  0 = idle, 1 = running, 2 = paused, 3= resumed

        this.pause = function () {
            if (state != 1) return;

            remaining = interval - (new Date() - startTime);
            window.clearInterval(timerId);
            state = 2;
        };
		
//		this.reset = function (){
//			remaining=interval;
//		};

        this.resume = function () {
            if (state != 2) return;

            state = 3;
            window.setTimeout(this.timeoutCallback, remaining);
        };

        this.timeoutCallback = function () {
            if (state != 3) return;

            callback();

            startTime = new Date();
            timerId = window.setInterval(callback, interval);
            state = 1;
        };

        startTime = new Date();
        timerId = window.setInterval(callback, interval);
        state = 1;
    }



function toEnglishDigits(elem) {
		str=elem.value


    // convert arabic indic digits [٠١٢٣٤٥٦٧٨٩]
    e = '٠'.charCodeAt(0);
    str = str.replace(/[٠-٩]/g, function(t) {
        return t.charCodeAt(0) - e;
    });
    
		elem.value=str;
}



function getSelectedIds(){
				selected=[];
				$( ".selectChecker:checked" ).each(function( index ) {
					selected.push($(this).val());
				});
				return selected;
			}

function toggleCheck(elem,selector){
		
		$(selector).each(function (index){
			$(this).prop('checked', $(elem).prop('checked'));
		});
	}

function updateListRow(data,params){
	$('.bigPopClose').click();
	$('#tr_'+params['id']).replaceWith(params['tr']);
}

//
//$('.pop_media_thumb').removeClass('active_pop_media_thumb');
//$('.pop_media_thumb').eq($(this).parent().children('.active_pop_media_thumb').index()).addClass('active_pop_media_thumb');
//$('#media_viewer').css('background-image','url('+$('.action_pop_media_thumb').eq($(this).parent().children('.active_pop_media_thumb').index()).css('background-image')+')');
//
//
//indexx=$(this).parent().children('.active_pop_media_thumb').index();
//p(indexx);
//if(indexx>$('.pop_media_thumb').length)indexx=0;
//p(indexx);
//$('.pop_media_thumb').removeClass('active_pop_media_thumb');
//$('.pop_media_thumb').eq(indexx).addClass('active_pop_media_thumb');
//$('#media_viewer').css('background-image','url('+$('.action_pop_media_thumb').eq(indexx).css('background-image')+')');
//


document.addEventListener("keyup", function(e){
	if($('#mediaPopContent').is(':visible')){
		if(e.keyCode == 37) // left arrow
		{
			$('.pop_media_thumb_nav_prev').click();
		}
		else if(e.keyCode == 39)    // right arrow
		{ 
			$('.pop_media_thumb_nav_next').click();
		}
	}
});


function popMediaCropLink(link){
	$('#media_crop_btn').attr('onclick',"imagine('"+link+"')");
}

function popMediaNav(elem,where){
	
	tmp=$(elem).parent().children('.pop_media_thumb');

	if(where=='prev'){
		for(i=0;i<tmp.length;i++){
			if($(tmp[i]).hasClass('active_pop_media_thumb'))
				indexx=i-1;
		}
	
		if(indexx<0)
			indexx=tmp.length-1;
	}

	else if(where=='next'){
		for(i=0;i<tmp.length;i++){
			if($(tmp[i]).hasClass('active_pop_media_thumb'))
				indexx=i+1;
		}
	
		if(indexx>=tmp.length)
			indexx=0;
	}

	link=$('.pop_media_thumb').eq(indexx).attr('data-legion-pop-media-link');
//	p(link);
	$('.pop_media_thumb').removeClass('active_pop_media_thumb');
	$('.pop_media_thumb').eq(indexx).addClass('active_pop_media_thumb');
	$('#media_viewer').css('background-image','url('+link+')');
	popMediaCropLink($('.pop_media_thumb').eq(indexx).attr('data-legion-pop-media-link-original'));
}

function popMedia(link,type='',multi='',multi_originals,multi_compressed){
	thumbs='';
	if(multi!='' && type=='photo'){
		multi=multi.split(',');
//		p(multi);
		multi_originals=multi_originals.split(',');
		multi_compressed=multi_compressed.split(',');
		
		$.each(multi,function(index,value){
			thumbs+=`<div class="pop_media_thumb nicebox mid po `+(link==multi_compressed[index]?'active_pop_media_thumb':'')+`" data-legion-pop-media-link="`+multi_compressed[index]+`" data-legion-pop-media-link-original="`+multi_originals[index]+`" onclick="
			$('.pop_media_thumb').removeClass('active_pop_media_thumb');
			$(this).addClass('active_pop_media_thumb');
			$('#media_viewer').css('background-image','url(`+multi_compressed[index]+`)');
			popMediaCropLink('`+multi_originals[index]+`');
			"><div class="pop_media_thumb_photo" style="background-image:url(`+value+`)"></div></div>`;
			
			if(link==multi_compressed[index])
				link_to_crop=multi_originals[index];
		});
		
		
		thumbs=`<div class="pop_media_thumbs_wrap po nos">

			<i class="pop_media_thumb_nav pop_media_thumb_nav_prev mid po" onclick="popMediaNav(this,'prev')">`+l('arrow_back_ios_new<>arrow_forward_ios')+`</i>
			`+thumbs+`
			<i class="pop_media_thumb_nav pop_media_thumb_nav_next mid po" onclick="popMediaNav(this,'next')">`+l('arrow_forward_ios<>arrow_back_ios_new')+`</i>

			</div>`;
		
		
		
		
	}else{
		link_to_crop=multi_originals;
	}
	crop=`<div id="media_crop_btn" class="l_btn  l_abs_top_left" onClick="imagine('`+link_to_crop+`')">`+l('Crop<>قص')+`</div>`;
	txt='';
	
	if(type=='photo'){
		txt=thumbs+`<div id="media_viewer" style="background-image:url(`+link+`)"></div>`+crop;
	}else if(type=='file'){
		if(link.includes('mp4')){
		txt=`<div id="media_viewer"><video class="l_hmax l_wmax" controls>
			<source src="`+link+`" type="video/mp4">
			</video></div>`;
		}
	}
	
	if(txt==''){
		 window.open(link, '_blank').focus();
		return;
	}
//	l('Unviewable<>غير قابل للعرض')
	
	$('body').css('overflow','hidden');
	$("#mediaPop #mediaPopContent").html(txt);
	$('#mediaPop').show(50);
}

function popEdit(module,id,arr='',list,addToLink=''){
	$("#bigPop #bigPopBread").html('');
	
		$("#bigPop .bigPopWrap").html('');
	
		$("#bigPop .bigPopWrap").load(urlPanel+"controller.php?viewMod="+module+"&id="+id+addToLink, function() {
			
			$('.bigPop #below_bread').remove();
			
			if(arr!=''){
				keys=Object.keys(arr);
				for(i=0;i<keys.length;i++){
					$('.'+module+'_'+keys[i]).remove();
				}
			}
			
			oldFormID=module;
			newFormID=oldFormID+'_'+rand(3,99);
			
			$('select').select2();
			show('bigPop');
			$('body').css('overflow','hidden');
			
				$('#bigPop').find('form').attr('id',newFormID);
				$('#bigPop').find('input[type=submit]').attr('form',newFormID);
			
			
			if(arr!=''){
				for(i=0;i<keys.length;i++){
					$('#bigPop').find('form').append(`<input type="hidden" name="`+keys[i]+`" value='`+arr[keys[i]]+`' form="`+newFormID+`"/>`);
				}
			}
			
			
			$('#bigPop #bigPopBread').prepend($('#bigPop .bigPopWrap #bread'));
			
			$('#bigPop #bigPopBread').append(`<div class="bigPopClose close_pop po nos" onClick="$('body').css('overflow','initial');hide('bigPop')">X</div>`);
			
			newOnClick=$('#bigPop #bread #bread_save').attr('onclick').replace(oldFormID,newFormID);

		
			if(list){
				$('#bigPop').find('form').append('<input type="hidden" name="updateListRow" value="true"/>');
			}else{
				$('#bigPop').find('form').append('<input type="hidden" name="force_refresh" value="true"/>');
			}
			
			
			$('#bigPop #bread #bread_save').attr('onclick',newOnClick);
			
			
			if($('#lang_box').length>0)
				$('#bigPop #bread').append($('#lang_box'));
		});
	
		
		
	}


function swap(id1,id2){
	hide(id1);
	show(id2);
}
		
		
function star_rate(elem,fieldName=''){
	which=$(elem).parent();
	stars=$(which).find('.star_item').index(elem);
	stars=stars+1;
	$(which).find('.star_item').each(function(index){
			$(this).addClass('empty_star');
			$(this).removeClass('full_star');
//		
		if(index<stars){
////			$(this).removeClass('empty_star');
			$(this).addClass('full_star');
		}
			
//		else
//			$(this).addClass('full_star');
	});

	if(fieldName!='')
		$('input[name="'+fieldName+'"]').val(stars);
}



window.addEventListener('message', function(event) {
        
    if(event.data.mceAction === 'photo_inserter_caller'){
		
		hide('framer');
		$('body').css('overflow','initial');
		
		$('#framer_content').html(' ');
	
		
		if(event.data.field_class.indexOf("meepo")==0){
			meepoPhotoReceived(event.data);
			return;
		}
		
		if(!$('.pvp_chooser').length)return false;
		
	
		if($('.' + event.data.field_class + ' .pvp_chooser').attr('data-multi')=='true'){
			$('.' + event.data.field_class + ' input').val(event.data.selectedArray);
			$('.' + event.data.field_class + ' .count span').html(event.data.selectedCount);
		}else{
			$('.' + event.data.field_class + ' .pvp_chooser').html('<img src="'+ event.data.thumbnail_url +'" />');
			$('.' + event.data.field_class + ' input').val(event.data.filename);
			$('.' + event.data.field_class + ' .count span').html(1);
			$('.' + event.data.field_class + ' .count .fileFullname').html(event.data.desc);
			$('.' + event.data.field_class + ' .fileName:not(.count)').html(event.data.desc);
		}
		
		$('.' + event.data.field_class + ' .clearFiles').removeClass('hidden');
    }
});
		
		function pvp_clear(field_class){
            if(!$('.pvp_chooser').length)return false;
            
			$('.' + field_class + ' input').val('');
			if($('.' + field_class + ' .pvp_chooser').attr('data-filetype')=='photo'){
				$('.' + field_class + ' .pvp_chooser').html('<img src="'+ u +'photo'+ ($('.' + field_class + ' .pvp_chooser').attr('data-multi')=='true' ? 's':'')+'.png">');
			}
			else if($('.' + field_class + ' .pvp_chooser').attr('data-filetype')=='file'){
				$('.' + field_class + ' .pvp_chooser').html('<img src="'+ u +'file'+ ($('.' + field_class + ' .pvp_chooser').attr('data-multi')=='true' ? 's':'')+'.png">');
			}
			
			$('.' + field_class + ' .count .fileFullname').html('');
			$('.' + field_class + ' .clearFiles').addClass('hidden');
			$('.' + field_class + ' .count span').html('0');
		}
		
		function pvp_core(field_class,multi=false,allowedFiles=false){
			
			$("#framer_content").load(url+"plugins/tinymce/filebrowser.php?field_class="+field_class+'&multi='+multi+'&allowedFiles='+allowedFiles+'&files='+$('.'+field_class+' input').val()+'&lang='+curr);
			toggle('framer');
			$('body').css('overflow','hidden');
			$('#framer_title').html(l('Browser<>المعرض'));
		}


function showPassword(elem){
			var inp=$(elem).siblings('input');
			if($(inp).attr('type')=='password')
				$(inp).attr('type','text');
			else
				$(inp).attr('type','password');
		}





function popAdd(module,arr){
		$("#bigPop .bigPopWrap").html('');
			$("#bigPop .bigPopWrap").load(urlPanel+"controller.php?addMod="+module, function() {


			$('select').select2();
				
			keys=Object.keys(arr);
			for(i=0;i<keys.length;i++){
				$('.'+module+'_'+keys[i]).remove();
			}
				
				
			show('bigPop');
				
			$('body').css('overflow','hidden');
			
				
				$('#bigPop #bigPopBread').prepend($('#bigPop .bigPopWrap #bread'));
			
			$('#bigPop #bigPopBread').append(`<div class="bigPopClose close_pop po nos" onClick="$('#bigPop').css('z-index','');$('body').css('overflow','initial');hide('bigPop')">X</div>`);
				
				$('#bigPop').find('form').attr('id',$('#bigPop').find('form').attr('id')+'_pop_add');
				$('#bigPop').find('input[type=submit]').attr('form',$('#bigPop').find('form').attr('id'));
				$('#bigPop').find('input[name=force_refresh]').attr('form',$('#bigPop').find('form').attr('id'));
				
			for(i=0;i<keys.length;i++){
				$('#bigPop').find('form').append(`<input type="hidden" name="`+keys[i]+`" value='`+arr[keys[i]]+`' form="`+$('#bigPop').find('form').attr('id')+`"/>`);
			}
				
		});
		
	}


	function uniqueId(length=16) {
	
		return parseInt(Math.ceil(Math.random() * Date.now()).toPrecision(length).toString().replace(".", ""))
	  }
	function ran(){
		return (new Date()).getTime();
	}
	
	function imagine(filename){
		$("#bigPop .bigPopWrap").html('');
			$("#bigPop .bigPopWrap").load(urlPanel+"controller.php?imagine="+filename, function() {
			show('bigPop');
			$('#bigPop').css('z-index',5);
			$('body').css('overflow','hidden');
			$('#bigPop #bigPopBread').prepend($('#bigPop .bigPopWrap #bread'));
			$('#bigPop #bigPopBread').append(`<div class="bigPopClose close_pop po nos" onClick="$('#bigPop').css('z-index','');$('body').css('overflow','initial');hide('bigPop')">X</div>`);
		});
	}





	function pop(block){
		// p(block);
		$("#bigPop .bigPopWrap").html(block);
			// $("#bigPop .bigPopWrap").load(urlPanel+"controller.php?imagine="+filename, function() {
			show('bigPop');
			$('#bigPop').css('z-index',5);
			$('body').css('overflow','hidden');
			$('#bigPop #bigPopBread').prepend($('#bigPop .bigPopWrap #bread'));
			$('#bigPop #bigPopBread').append(`<div class="bigPopClose close_pop po nos" onClick="$('#bigPop').css('z-index','');$('body').css('overflow','initial');hide('bigPop')">X</div>`);
		// });
	}






	function rgba2hex(orig) {
		var a, isPercent,
		  rgb = orig.replace(/\s/g, '').match(/^rgba?\((\d+),(\d+),(\d+),?([^,\s)]+)?/i),
		  alpha = (rgb && rgb[4] || "").trim(),
		  hex = rgb ?
		  (rgb[1] | 1 << 8).toString(16).slice(1) +
		  (rgb[2] | 1 << 8).toString(16).slice(1) +
		  (rgb[3] | 1 << 8).toString(16).slice(1) : orig;
	  
		if (alpha !== "") {
		  a = alpha;
		} else {
		  a = 01;
		}
		// multiply before convert to HEX
		a = ((a * 255) | 1 << 8).toString(16).slice(1)
		hex = hex + a;
	  
		return hex;
	  }
	

	
	
	
	
	
	  
	  (function ( $ ) {
		
		$.fn.alterClass = function ( removals, additions ) {
			
			var self = this;
			
			if ( removals.indexOf( '*' ) === -1 ) {
				// Use native jQuery methods if there is no wildcard matching
				self.removeClass( removals );
				return !additions ? self : self.addClass( additions );
			}
		
			var patt = new RegExp( '\\s' + 
					removals.
						replace( /\*/g, '[A-Za-z0-9-_]+' ).
						split( ' ' ).
						join( '\\s|\\s' ) + 
					'\\s', 'g' );
		
			self.each( function ( i, it ) {
				var cn = ' ' + it.className + ' ';
				while ( patt.test( cn ) ) {
					cn = cn.replace( patt, ' ' );
				}
				it.className = $.trim( cn );
			});
		
			return !additions ? self : self.addClass( additions );
		};
		
		})( jQuery );



		function urlify(text) {
			var urlRegex = /(https?:\/\/[^\s]+)/g;
			return text.replace(urlRegex, function(url) {
			  return '<a class="tip_help_a" target="_blank" href="' + url + '">' + url + '</a>';
			})
			// or alternatively
			// return text.replace(urlRegex, '<a href="$1">$1</a>')
		  }





		function l_multi_select_add(elem){
			if($(elem).val()==0 || $(elem).val()=='0')return true;

			if($(elem).attr('data-l-allow-double-multi-select')==undefined
			&&
			$('#'+$(elem).attr('id')+'_chosen_wrap').find('[data-l-chosen-val='+$(elem).val()+']').length
			){
				
			}
			else{
				unique_num=ran();
				newDiv='<div id="l_chosen_'+unique_num+'" data-l-select-id="'+$(elem).attr('id')+'" data-l-chosen-val="'+$(elem).val()+'" class="l_chosen in l_tag l_f13 l_m5"><i class="l_lava_c mid po" onclick="l_multi_select_delete(this)">delete</i><span class="mid l_ml5 l_mr5">'+$("#"+$(elem).attr('id')+' option:selected').text()+'</span><div class="l_chosen_counter"></div><input type="hidden" name="'+$(elem).attr('data-l-name')+'" value="'+$(elem).val()+'"/></div>';
				$('#'+$(elem).attr('id')+'_chosen_wrap').append(newDiv);
			
				$('#l_chosen_'+unique_num).hide().fadeIn("fast");
			
				l_multi_select_colorize($(elem).attr('id'),$(elem).val());
			
			}

			$(elem).val('0');
			$(elem).trigger('change');
		}
		
		
		function l_multi_select_delete(elem){
			l_chosen = $(elem).closest('.l_chosen');
		
			select_id = $(l_chosen).attr('data-l-select-id');
		
			val = $(l_chosen).attr('data-l-chosen-val');
		
			$(l_chosen).fadeOut('fast', function(){ 
				$(this).remove();
				l_multi_select_colorize(select_id,val);
			});
		}
		
		function l_multi_select_colorize(select_id,val){
			sameChosen = $('#'+select_id+"_chosen_wrap .l_chosen[data-l-chosen-val='"+val+"']");
			// p(sameChosen);
			l_chosen_counter_elem='<div class="l_chosen_counter_elem mid"></div>';

				if(sameChosen.length==1){
					$(sameChosen.each(function(ind,elem){
						// $(elem).attr('style','');
						$(elem).find('.l_chosen_counter').html('');
						// $(elem).find('.l_chosen_counter').append(l_chosen_counter_elem);
					}));
				}else if(sameChosen.length==2){
					$(sameChosen.each(function(ind,elem){
						// $(elem).attr('style','box-shadow: 0 0 2px var(--greenC)');
						$(elem).find('.l_chosen_counter').html('');
						for(i=0;i<sameChosen.length;i++){
							$(elem).find('.l_chosen_counter').append(l_chosen_counter_elem);
						}
					}));
				}else if(sameChosen.length>2){
					$(sameChosen.each(function(ind,elem){
						// $(elem).attr('style','box-shadow: 0 0 4px var(--orangeC)');
						$(elem).find('.l_chosen_counter').html('');
						for(i=0;i<sameChosen.length;i++){
							$(elem).find('.l_chosen_counter').append(l_chosen_counter_elem);
						}
					}));
				}
		}



function __list_search_sign(elem){
	$(elem).closest('.__list_search_signs').find('[data-l-list-search-sign]').removeClass('l_btn_light_active');

	$(elem).addClass('l_btn_light_active');

	$(elem).closest('.__list_search_signs').find('input').val($(elem).attr('data-l-list-search-sign'));
}

var _live_stats_ids=[];
var _live_stats_box_ids=[];
var loading_liveStats=false;

// $(function(){
function checkLiveStatItems(){
	$('[data-l-live-stat=1]').each(function(){
		_live_stats_ids.push($(this).attr('data-legion-id'));
		_live_stats_box_ids.push($(this).attr('data-legion-box-id'));
	});
	
	if(_live_stats_ids.length!=0){
		var _stats_time = setInterval(function(){
			liveStats();
		},5000);
	}
}
// });

function liveStats(){
	if(_live_stats_ids.length!=0 && !loading_liveStats){
		loading_liveStats=true;
		sub({'stats_check':1,'ids':_live_stats_ids,'box_ids':_live_stats_box_ids,'js':'_stats_checkCallback'},false,true);
	}
}


function _stats_checkCallback(data,params){
	if(data.length>0){
		$(data).each(function(){
			if($(this)[0]['type']=='Chart'){
				for(i=0;i<$(this)[0]['data'].length;i++){
					window['stats_'+$(this)[0]['box_id']+'_'+$(this)[0]['id']+'ChartInitial'].data.datasets[i].data=$(this)[0]['data'][i]['data'];
				}
				window['stats_'+$(this)[0]['box_id']+'_'+$(this)[0]['id']+'ChartInitial'].data.labels=$(this)[0]['labels'];
				window['stats_'+$(this)[0]['box_id']+'_'+$(this)[0]['id']+'ChartInitial'].options.animation=false;
				window['stats_'+$(this)[0]['box_id']+'_'+$(this)[0]['id']+'ChartInitial'].update();
			}else{
				elem=$('.stats_box[data-legion-id='+$(this)[0]['id']+'][data-legion-box-id='+$(this)[0]['box_id']+']').find('.stats_count_num');
				delta_wrap=$('.stats_box[data-legion-id='+$(this)[0]['id']+'][data-legion-box-id='+$(this)[0]['box_id']+']').find('.stats_delta_wrap');
				delta=$('.stats_box[data-legion-id='+$(this)[0]['id']+'][data-legion-box-id='+$(this)[0]['box_id']+']').find('.stats_delta_num');
				
				new_count=$(this)[0]['data'][0]['total'];
				curr_count=parseInt($(elem).html());
				delta_value=parseInt($(delta).text());

				if(new_count!=curr_count)
					$(elem).addClass('pulse_anim');

				if(new_count>curr_count){
					$(elem).removeClass('l_lava_c').addClass('l_grass_c pulse_anim');
					$(delta).html(
						delta_value+(new_count-curr_count)
					);
					}
				else if(new_count<curr_count){
					$(elem).removeClass('l_grass_c').addClass('l_lava_c pulse_anim');
					$(delta).html(
						delta_value-(curr_count-new_count)
					);
				}
					
				
				$(elem).closest('.stats_box').hover(function(){
					$(this).find('.stats_count_num').removeClass('l_grass_c l_lava_c pulse_anim');
					$(this).find('.stats_delta_wrap').fadeOut();
					$(this).find('.stats_delta_num').html('0');
				});

				new_delta_value=parseInt($(delta).text());

				if(new_delta_value==0)
					$(delta_wrap).fadeOut().removeClass('l_lava_c l_grass_c');
				else {
					if(new_delta_value>0)$(delta_wrap).addClass('l_grass_c').removeClass('l_lava_c');
					else $(delta_wrap).addClass('l_lava_c').removeClass('l_grass_c');
					$(delta_wrap).fadeIn();
				}
				
				$(elem).html(new_count);
			}
		});
		loading_liveStats=false;
	}
}
//lazyCaller.js when was seperate file Starts

function init(){
	var vidDefer = document.getElementsByTagName('iframe');
	for(i=0;i<vidDefer.length;i++){
	if(vidDefer[i].getAttribute('data-src')){
	vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
	}
	} 
}

$(document).ready(function(){
	$.ajaxSetup({cache: false});
	$.ajaxSetup({async: true});

	if($.isFunction($.fn.select2)){
		$(function(){
		$("select").not('.noSelect2').select2();
		});
	}


	if($.isFunction($.fn.nestedSortable)){
		$('.sortable').nestedSortable({
			handle: 'div',
			items: 'li',
			toleranceElement: '> div',
			update: function(event,ui){
				if(typeof sort_save==="function"){
					sort_save();
				}
			},
		});
	}
});

window.addEventListener("load",init,false);

//lazyCaller.js when was seperate file Ends



//lang
function afterLoadNewData(){
		// switch_lang();
		__lang_init();
		return;
	//initiate language array of array
	lang_content_array= langArr;

	//initiate content array per language in the main array
	for(i=0;i<lang_content_array.length;i++){
		lang_content_array[i]=new Array(0);
	}

	content_arr=[];
	for (i = 0; i < inputs.length; i++) {
		if(inputs[i].value==null)inputs[i].value='b';
		//take the value
		content_arr.push(inputs[i].value);
	}	

	//split content array and spread data into languages array
	for (var j=0;j<lang_content_array.length;j++){
		//per lang array
		for (var i = 0; i < content_arr.length; i++) {
			if(content_arr[i].split("<>")[j]===undefined)
				lang_content_array[j].push("");
			else
				lang_content_array[j].push(content_arr[i].split("<>")[j]); 
		}
	}
	
	switch_lang();
	
}