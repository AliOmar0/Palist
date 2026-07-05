function handleResponse(response,background){
	if(!background)
		p(response);
	if(!isJson(response)){
		console.error("Server Error Response:", response);
		// استخراج أول 100 حرف من الخطأ لعرضها
		var errorText = response.replace(/<[^>]*>?/gm, '').trim().substring(0, 100);
		msg(l('Some attachments are courrpted<>بعض الملفات غير سليمة') + " (" + errorText + "...)", 6000, 'Error');
	}else{
	
	r=JSON.parse(response);
	if(r['extra']!=undefined && r['extra']['js']!=undefined){
		window[r['extra']['js']](r['data'],r['extra']);
	}
	
	else{
		if(!background)
			msg(r['desc'],3000,r['alert_icon']);
	}
		}
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

//used by select html input
function reloadSelect(db,fields,whereKey,whereValue,currentValue,selectNameToRefresh){
		submitter(null,urlPanel,'Refreshing Sub Select',{ 'type' : 'select', 'db' : db,'fields':fields,'whereKey':whereKey,'whereValue':whereValue,'currentValue':currentValue,'selectNameToRefresh':selectNameToRefresh},'post',false,true);		
}

//follows reloadSelect
function reload_options(data,params){

	
	selectElem=$(params['selector']);
	
	$(selectElem).html('');
	
	if(data===1){
		msg(l('No Results<>لا يوجد نتائج'));
		return false;
	}
	
	var txt='';
	
	vals=params['currentValue'].split(",");
	
	for(i=0;i<data.length;i++){
		
		$(vals).each(function(){
			if(data[i]['id']==this)
				selected=' selected ';
			else
				selected='';
		});
		
//		
		echovalues=params['echoValue'].split(",");
		echoTxt='';
		$(echovalues).each(function(){
			echoTxt=echoTxt+' '+data[i][('{0}',[this])];
		});
		
		txt=txt+'<option '+selected+' value="'+data[i]['id']+'">'+echoTxt+'</option>';
		}

	$(selectElem).html(txt);
	
	if(params['clear']==true){
		$(selectElem).select2("destroy");
		$(selectElem).select2();
	}
	
//	p(vals[0]);
//	if(vals.length>0){
//	if(vals.length>1)

		$(selectElem).val(vals).change();
//	else
//		$(selectElem).val(vals[0]).change();
//		}
//	else
//		$(selectElem).val(params['currentValue']).trigger('change');
	
//	$(selectElem).val(null).trigger('change');
//	$(selectElem).val([]).change();
	
//	if(data[i]['id']==params['currentValue'])
//		$(selectElem).val(params['currentValue']).change();

	
}


function redirect(data,params){
	msg(l('redirecting<>اعادة تحويل'));
	window.location=params['url'];
}

function redirects(data,params){
	msg(l('redirecting<>اعادة تحويل'));
	setTimeout(
    function() {
      window.location=params['url'];
    }, 2000);
	
	
}


function refresh(data,params){
	msg(l('refreshing<>قيد التحديث'));
	window.location=window.location;
}



function updateBackUpList(data,params){
	document.getElementById('backuplist').innerHTML=data;
	msg(l('Backup succeeded<>تم نجاز النسخ الاحتياطي'));
}


function msg(message,timePeriod=3000,icon='Default'){
	msgDiv = document.getElementById('general_msg_area');
	
	switch(icon){
//		case'Correct':
//			msgDiv.style.borderColor="#4CAF50";
//			msgDiv.innerHTML = '<i class="general_msg_i">done</i>' + message;
//			break;
			
		case'Error':
			msgDiv.innerHTML = '<i class="general_msg_i">priority_high</i>' + message;
			$('.general_msg_i').css('background',"#f44336");
			break;
			
		default: 
			msgDiv.innerHTML = '<i class="general_msg_i">done</i>' + message;
			$('.general_msg_i').css('background',"#4CAF50");
	}
	
    show(msgDiv.id);
    msgTimeOut=setTimeout("hide(\'general_msg_area\');", timePeriod);
	
}

function messenger(message,timePeriod=3000,icon='Default') {
    return msg(message,timePeriod,icon);
}

//function blockremover(data,params){
//	item=document.getElementById(params['blockremover']);
//	item.parentNode.removeChild(item);
//	msg(l('Item Removed<>تم الحذف'));
//}