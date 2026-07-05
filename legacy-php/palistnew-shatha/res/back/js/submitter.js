//responsible to send data of type post to Legion controller
var ___legion_xhrs_allow = true;
var ___legion_xhrs = {};
var ___update_developer_panel_xhrs_processing=false;
var __legion_xhr_unique_id=1;
var ___update_developer_panel_xhrs_activated=false;
var ___update_developer_panel_xhrs_pin=false;

percentage_upload_text=document.getElementById('percentage_upload_text');
percentage_upload_filler=document.getElementById('percentage_upload_filler');

function sub(params,roll=true,background=false) {
	return submitter(null,urlPanel,l('working..<>قيد العمل'),params,'post',false,roll,background);
}

function api(params,roll=true,background=false) {
	return submitter(null,url+'api/1.0/',l('working..<>قيد العمل'),params,'post',false,roll,background);
}

function ___update_developer_panel_xhrs_activate(){
	___update_developer_panel_xhrs_activated=true;
}

function ___update_developer_panel_xhrs_deactivate(){
	___update_developer_panel_xhrs_activated=false;
}

function ___update_developer_panel_xhrs_pin_activate(){
	___update_developer_panel_xhrs_pin=true;
}

function ___update_developer_panel_xhrs_pin_deactivate(){
	___update_developer_panel_xhrs_pin=false;
}

function ___update_developer_panel_xhrs_pin_toggle(btn){
	l_btn_toggle(btn);
	___update_developer_panel_xhrs_pin=!___update_developer_panel_xhrs_pin;
}

function ___legion_xhrs_exit(){
	___legion_xhrs_prevent();
	___legion_xhrs_abort();
	___legion_xhrs = {};
	___update_developer_panel_xhrs_processing=false;
	___update_developer_panel_xhrs();
}

// function ___legion_xhrs_resume(){
// 	___legion_xhrs_allow=true;
// }

function ___legion_xhrs_abort(){
	keys=Object.keys(___legion_xhrs);
	// p(___legion_xhrs);
	if(keys.length>0){
		for(i=0;i<keys.length;i++){
			___legion_xhrs[keys[i]].abort();
		}
	}
}

function ___legion_xhrs_prevent(){
	___legion_xhrs_allow=false;
}

function ___update_developer_panel_xhrs(){
	if(___update_developer_panel_xhrs_processing || !___update_developer_panel_xhrs_activated)return;
	___update_developer_panel_xhrs_processing=true;
	$(function(){
		keys=Object.keys(___legion_xhrs);

		
			$('[data-l_process_xhr_id]').each(function(i,elem){
				if(jQuery.inArray( $(elem).attr('data-l_process_xhr_id'),keys)<=-1){
					if(___update_developer_panel_xhrs_pin){
						$(elem).find('i').removeClass('l_grass_c',250).addClass('l_sand_c',250).removeClass('l_anim_360',1500);
					}else{
						$(elem).fadeOut(500,function(){$(this).remove()});
					}
				};
			});
		

		if(keys.length>0){
			$(keys).each(function(i,elem){
				if(elem==0)return;
				if($('[data-l_process_xhr_id='+elem+']').length){
					return;
				}

				___xhr_sentdata_entries_txt={};
				for (const pair of ___legion_xhrs[elem].sentData.entries()) {
					___xhr_sentdata_entries_txt[pair[0]]=pair[1];
				}

				ch=`<div class="l_mt5 po" data-l_process_xhr_id="`+elem+`" onclick="$(this).find('.__process_xhr_sent_data').toggle(500);">
					<div class="mid">
						<i class="l_f12 l_anim_360 l_grass_c mid l_mr5">settings</i>
						<div class="l_f12 mid"><duv class="mid">Proccessing XHR[</div><div class="mid l_purple_c">`+elem+`</div><div class="mid">]</div>
						<div class="l_f9 mid l_el1 l_wmax30" >`+JSON.stringify(___xhr_sentdata_entries_txt)+`</div>
					</div>
					<div class="l_f11 __process_xhr_sent_data l_nicebox l_mt5 l_pre l_lineh8 po" onclick="c(JSON.stringify(___xhr_sentdata_entries_txt))" style="display:none">`+JSON.stringify(___xhr_sentdata_entries_txt, null, '\n')+`</div>
					
				</div>`;
							
				$(ch).appendTo('#developer_panel_xhrs').hide().fadeIn(500);
			});
		}
		
	});
	___update_developer_panel_xhrs_processing=false;
}

function ___legion_xhr_remove(__legion_xhr_unique_id){
	delete ___legion_xhrs[__legion_xhr_unique_id];
	___update_developer_panel_xhrs();
}

function submitter(formObject,controllerUrl,rollerMsg='loading', params, method='post',isForm=true,roll=true,background=false) {
	__legion_xhr_unique_id++;
	if(!___legion_xhrs_allow)return false;
	
	//disable all buttons
	if(!background)disableBtns();
	
	if(isForm==false){
		var form = document.createElement("form");
		form.setAttribute("method", method);
		form.setAttribute("action", '');
		form.setAttribute("onsubmit",'return submitter(this,urlPanel);');
		form.setAttribute("enctype", 'multipart/form-data');

		for(var key in params) {
			if(params.hasOwnProperty(key)) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", key);
				hiddenField.setAttribute("value", params[key]);
				form.appendChild(hiddenField);
			}
		}

		document.body.appendChild(form);
		formObject=form;
	}
	
	//check required file fields
	stopSub=false;
	checkFiles(formObject);
	if(stopSub==true){if(!background)enableBtns();return false;}
	//hide previous msgs, kill their timer that set in responser.js
	if (typeof msgTimeOut != "undefined" && msgTimeOut != null) clearTimeout(msgTimeOut);
	//hide previous msgs
	if(!background)hide('general_msg_area');
	//start rolling
	if(roll===true && !background){
	 start_roll(rollerMsg);
	}
	
	if(window.XMLHttpRequest){
        var formData = new FormData(formObject);
		___legion_xhrs[__legion_xhr_unique_id]=new XMLHttpRequest();
		___legion_xhrs[__legion_xhr_unique_id].__legion_xhr_unique_id = __legion_xhr_unique_id;
		___update_developer_panel_xhrs();
        ___legion_xhrs[__legion_xhr_unique_id].open("POST", controllerUrl + 'controller.php', true);
    }

    //the response checker
    ___legion_xhrs[__legion_xhr_unique_id].onreadystatechange = function() {
		if (this.readyState == 4){
			if(this.status == 200){
				handleResponse(this.responseText,background);
			}
			___legion_xhr_remove(this.__legion_xhr_unique_id);
		}else if(this.status == 500){
			messenger('Not specific error',3000,'Error');
			___update_developer_panel_xhrs();
		}

		//stop rolling
		if(!background)hide('roller');

		//dtogglebuttons
		if(!background)enableBtns();

		//reset uploader percentage
		if(percentage_upload_text!=undefined)percentage_upload_text.innerHTML='0%';
		if(percentage_upload_filler!=undefined)percentage_upload_filler.style.width='0%';
		
		//remove newly made form if !isForm
		$(form).remove();
	}

	//moniter uploading
	___legion_xhrs[__legion_xhr_unique_id].upload.addEventListener('progress', function(e) {
		var percent_complete = ~~((e.loaded / e.total)*100);
		// Percentage of upload completed
		if(percentage_upload_text!=undefined)percentage_upload_text.innerHTML=percent_complete+'%';
		if(percentage_upload_filler!=undefined)percentage_upload_filler.style.width=percent_complete+'%';
	});
	
    //Send to server
	// p(formData);
	___legion_xhrs[__legion_xhr_unique_id].sentData=formData;
    ___legion_xhrs[__legion_xhr_unique_id].send(formData);

    //to prevent form of reloading
    return false;
}