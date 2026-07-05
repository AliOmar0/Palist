<div id="lang_box" style="display: none;">
	 		<?php $lang_result=$langArr;
			for($i=0;$i<count($lang_result);$i++){
			?>
			<div 
			class="po lang_item <?php if(curr()==$lang_result[$i]['prefix'])echo 'active_lang'; ?>" 
			onClick="switch_lang(<?= $i;?>);"
			 <?php if(curr()==$lang_result[$i]['prefix'])echo 'data-defaultlang="'.$i.'"'; ?>
			 data-langindex="<?= $i;?>" data-lang_dir="<?=$lang_result[$i]['direction']?>"
			 >
			<?= $lang_result[$i]['language_name'];?>
		<span class="shortcut_in_button">ctrl + b</span>
	</div>
			<?php 
			}
?>
</div>

<script type="application/javascript">
	var curr_lang=0;
	// Get the container element
	var types=	document.querySelectorAll('[name="action"]');
	for (i=0;i<types.length;i++){
		if(typeof(forceSpecificForm) !== 'undefined' && types[i].value!=forceSpecificForm)continue;
		if(types[i].form.querySelectorAll('[name="noML"]').length>0)continue;
		if(types[i].value=='edit' || types[i].value=='add' || types[i].value=='add_in_menu'){
			submit_form=types[i].form;
			// p(types[i]);
			//add the swith language function
			submit_form.setAttribute("onsubmit","combine_lang_input();"+submit_form.getAttribute("onsubmit"));
			//add the language menu 
			lang_menu=document.getElementById('lang_box');
			document.getElementById('lang_box').outerHTML="";
			bread = document.querySelector('[id="bread"]');
			lang_menu.style.display='inline-block';	

			
			
			bread.insertAdjacentHTML('beforeend',lang_menu.outerHTML);
		
			break;
		}	
	}
	
	//default language
	var lang=document.getElementsByClassName('active_lang')[0].getAttribute('data-defaultlang');
	
	//query slector reuturns frozen nodelist
	var inputs = new Array(ml_supp_input_names.length);
	
	if(typeof submit_form!='undefined')
	for(b=0;b<ml_supp_input_names.length;b++){
		inputs[b]=submit_form.querySelector('[name="'+ml_supp_input_names[b]+'"]');
	}


	
	//add onchange for all inputs that are unforbidden of translation
	var content_arr=[];
	for (i = 0; i < inputs.length; i++) {
		if(typeof inputs[i]=='undefined')continue;
		if(inputs[i].value==null)inputs[i].value='b';
    	//take the value
		content_arr.push(inputs[i].value);
		//add on change event listner
//   		inputs[i].onchange = change_lang_values;
//		p(inputs[i]);
		$(inputs[i]).attr('onchange','change_lang_values(this)');
	}	

	//initiate language array of array
	var lang_content_array= new Array(<?= count($lang_result);?>);
	
	//languages info
	var languages_info = <?= json_encode($lang_result); ?>;
	
	//initiate content array per language in the main array
	for(i=0;i<lang_content_array.length;i++){
		lang_content_array[i]=new Array(0);
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
	 
	
	
	function afterLoadNewData(){
		
		//initiate language array of array
		lang_content_array= new Array(<?= count($lang_result);?>);

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
	
	function switch_lang(new_lang,withTiny=true){
		//bcoz die('36') is ajax, no refresh, so no new lang requested
		if(new_lang==undefined || new_lang==null)new_lang=lang;
		//remove active class from all
		var lang_box=document.getElementById('lang_box');
		
		lang_box.getElementsByClassName("active_lang")[0].classList.remove('active_lang');
		
		//add class active lang to the current lang
		document.querySelector("[data-langindex='"+new_lang+"']").classList.add('active_lang');
		
		
		//change lang index for general usage
		curr_lang=lang=new_lang;
		 
	   //switch language inputs
		for (var i = 0; i < content_arr.length; i++) {
			var is_normal_textarea=(inputs[i].classList.contains('mceNoEditor'));
				if(inputs[i].type=="textarea" && is_normal_textarea==false && withTiny){
//					p(inputs[i].id);
//					p(tinyMCE.get(inputs[i].id));
					tinyMCE.get(inputs[i].id).setContent(lang_content_array[new_lang][i]);
					
//					tinyMCE.activeEditor.execCommand('mceDirection'+$("#lang_box").find("[data-langindex='"+lang+"']").attr('data-lang_dir'));
					

				}
				else
					inputs[i].value=lang_content_array[new_lang][i];
				//set direction
				inputs[i].style.direction=languages_info[new_lang]['direction'];
			
		
			}
		 
		 if(withTiny && typeof tinyMCE!='undefined'){
			editors=tinyMCE.get();
			if(editors.length>0){
				for (i=0;i<editors.length;i++){
							editors[i].execCommand('mceDirection'+$("#lang_box").find("[data-langindex='"+lang+"']").attr('data-lang_dir'));
						}
				}
			}
//		 $(document).scrollTop(0);
//		 p(tinyMCE.editors.length);
		
//		counterInit();
		}
	
	//when user changes inputs
	function change_lang_values(elem){
//		p(inputs);
//		p(elem);
//		p(tinymce_name);
//		p($('#'+tinymce_name).attr('name'));
//		p(elem);
//		tinymce_name = '';
//		p(tinymce_name);
//		if(tinymce_name!='' && tinymce_name!=undefined && tinymce_name!='undefined'){
////				p(inputs[i]);
////				tinymce_name=$('#'+tinymce_name).attr('name');
////				p(5);
////				p(tinymce_name);
////				p(6);
//			}
		//get index of the element being changed
		for(i=0;i<inputs.length;i++){
//			p(inputs[i].name);
//			p($(inputs[i]).name);
//			p($(elem).attr('name'));
//			p(inputs[i]);
			
			//get the input to change itself, not the whole values to save performance, but if its textarea and is tinymce, its value saved differently, which we need to get tincymce api to get the content
			if(inputs[i].name==elem.name || (typeof(elem)=='string' && elem.indexOf("mce")=='0' && inputs[i].name==$('#'+elem).attr('name'))){
//				p(3);
				var is_normal_textarea=(inputs[i].classList.contains('mceNoEditor'));
				if(inputs[i].type=="textarea" && is_normal_textarea==false){
					lang_content_array[lang][i]=tinymce.get(inputs[i].id).getContent();
				}
				else{
					
					lang_content_array[lang][i]=elem.value;
//					lang_content_array[lang][i]=l(elem.value);
				}
	 			break;
			}
		}
		
//		p(lang_content_array);
		
	}
	
	function combine_lang_input(){
			$('.hidden_inputs').remove();
		
		for(i=0;i<inputs.length;i++){
			var combined_value="";
			for(j=0;j<lang_content_array.length;j++){
				combined_value=combined_value+lang_content_array[j][i]+"<>";
			}
			
//			p(inputs[i].type);
			if(inputs[i].type=='textarea'){
				var hidden_input = document.createElement("textarea");
				$(hidden_input).addClass('hidden');
				
			}
			else{
				var hidden_input = document.createElement("input");
				$(hidden_input).attr('type','hidden');
				
//				var hidden_input='<input type="hidden" class="hidden_inputs" name="'+inputs[i].name+'"/>';
			}
			
			$(inputs[i]).after(hidden_input);
			$(hidden_input).addClass('hidden_inputs');
			$(hidden_input).addClass('hidden');
			$(hidden_input).attr('name',inputs[i].name);
			$(hidden_input).val(combined_value);
			
			
//			inputs[i].value=combined_value;
		}
	}
	
	
	switch_lang(lang,false);
	
	function tinyIsReady(){
		switch_lang();
	}
	
	
</script>