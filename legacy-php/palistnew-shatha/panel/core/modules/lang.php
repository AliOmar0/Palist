<?php
/**
 * @todo re=engineer, make public JS and custom caller
 */
$langs=db('languages_1557157519');

?>
<script>
	___langs=<?=json_encode($langs)?>;
</script>

<div id="lang_box" class="l_nos" style="display: none;">
	<?php for($i=0;$i<count($langs);$i++){?>
		<div 
			class="l_po lang_item <?php if(curr()==$langs[$i]['prefix'])echo 'active_lang';?>" 
			onClick="switch_lang(<?= $i;?>);"
			<?php if(curr()==$langs[$i]['prefix'])echo 'data-l_default_lang="'.$i.'"'; ?>
			data-l_lang_index="<?= $i;?>" data-l_lang_dir="<?=$langs[$i]['direction']?>"
			data-l_lang_prefix="<?=$langs[$i]['prefix']?>"
			data-l_lang_direction="<?=$langs[$i]['direction']?>"
		>
			<?=$langs[$i]['language_name'];?>
			<span class="shortcut_in_button">ctrl + b</span>
		</div>
	<?php 
	}
	?>
</div>

<script type="application/javascript">
	var curr_lang;
	var curr_lang_prefix;
	var curr_lang_direction;
	var __lang_setup;
	var lang_index;
	var __lang_form_keys;
	var __lang_forms;
	var types;

	function __lang_init(){
		
		curr_lang=0;
		curr_lang_prefix='<?=curr()?>';
		curr_lang_direction='<?=curr()?>';
		__lang_setup=false;
		lang_index=document.getElementsByClassName('active_lang')[0].getAttribute('data-l_default_lang');
		__lang_form_keys=[];
		__lang_forms={};
		types=document.querySelectorAll('[name="action"]');

		
		
		for (i=0;i<types.length;i++){
			// if(typeof(forceSpecificForm) !== 'undefined' && types[i].value!=forceSpecificForm)continue;
			
			if(types[i].form.querySelectorAll('[name="noML"]').length>0)continue;
			
			if(types[i].value=='edit' || types[i].value=='add' || (typeof forceSpecificForm!='undefined' && types[i].value==forceSpecificForm)){
				
				submit_form=types[i].form;
				//add the swith language function
				submit_form.setAttribute("onsubmit","combine_lang_input(this);"+submit_form.getAttribute("onsubmit"));
				__lang_forms[submit_form.getAttribute('id')]={};
				
				if(!__lang_setup){
					//add the language menu 
					lang_menu=document.getElementById('lang_box');
					document.getElementById('lang_box').outerHTML="";
					bread = document.querySelector('[id="bread"]');
					lang_menu.style.display='inline-block';	

					bread.insertAdjacentHTML('beforeend',lang_menu.outerHTML);
					
				}
				__lang_setup=true;
				__inputs_tmp=submit_form.querySelectorAll('[data-l_is_ml]');
				__lang_forms[submit_form.getAttribute('id')]['inputs']=[];
				__lang_forms[submit_form.getAttribute('id')]['content_arr']=[];
				__lang_forms[submit_form.getAttribute('id')]['lang_content_array']=[];
				if(__inputs_tmp.length>0){
					for(__j=0;__j<__inputs_tmp.length;__j++){
						//take the value
						__lang_forms[submit_form.getAttribute('id')]['content_arr'].push(__inputs_tmp[__j].value);

						//add onchange for all inputs that are unforbidden of translation
						$(__inputs_tmp[__j]).attr('onchange','change_lang_values(this,\'field\')');

						//initiate content array per language in the main array
						for(__k=0;__k<___langs.length;__k++){
							__lang_forms[submit_form.getAttribute('id')]['lang_content_array'][__k]=[];
						}

						//split content array and spread data into languages array
						for (__o=0;__o<__lang_forms[submit_form.getAttribute('id')]['lang_content_array'].length;__o++){
							//per lang array
							for (__z=0;__z<__lang_forms[submit_form.getAttribute('id')]['content_arr'].length;__z++) {
								if(__lang_forms[submit_form.getAttribute('id')]['content_arr'][__z].split("<>")[__o]===undefined)
									__lang_forms[submit_form.getAttribute('id')]['lang_content_array'][__o].push("");
								else
									__lang_forms[submit_form.getAttribute('id')]['lang_content_array'][__o].push(__lang_forms[submit_form.getAttribute('id')]['content_arr'][__z].split("<>")[__o]); 
							}
						}
						__lang_forms[submit_form.getAttribute('id')]['inputs'].push(__inputs_tmp[__j]);
					}
				}
				
			}	
		}

		__lang_form_keys=Object.keys(__lang_forms);
	}

	
	function switch_lang(new_lang,withTiny=true){
		if(typeof __lang_forms=='undefined')return;
		//bcoz die('36') is ajax, no refresh, so no new lang requested
		if(typeof new_lang=='undefined' || new_lang==null)new_lang=lang_index;
		//remove active class from all
		$('.active_lang').removeClass('active_lang');
		//add class active lang to the current lang
		$("[data-l_lang_index='"+new_lang+"']").addClass('active_lang');
		

		//change lang index for general usage #! jquery used
		curr_lang=lang_index=new_lang;
		curr_lang_prefix=$('.active_lang').attr('data-l_lang_prefix');
		curr_lang_direction=$('.active_lang').attr('data-l_lang_direction');
		
	   //switch language inputs
		for(j=0;j<__lang_form_keys.length;j++){
			for(i=0;i<__lang_forms[__lang_form_keys[j]]['content_arr'].length;i++){
				if(__lang_forms[__lang_form_keys[j]]['inputs'][i].type=="textarea" && !$(__lang_forms[__lang_form_keys[j]]['inputs'][i]).hasClass('mceNoEditor') && withTiny){
					tinyMCE.get(__lang_forms[__lang_form_keys[j]]['inputs'][i].id).setContent(__lang_forms[__lang_form_keys[j]]['lang_content_array'][new_lang][i]);
				}
				else{
					// p(__lang_forms[__lang_form_keys[j]]['lang_content_array'][new_lang]);
					__lang_forms[__lang_form_keys[j]]['inputs'][i].value=__lang_forms[__lang_form_keys[j]]['lang_content_array'][new_lang][i];
				}
				
				//set direction
				__lang_forms[__lang_form_keys[j]]['inputs'][i].style.direction=___langs[new_lang]['direction'];
				}
		}
		 
		 if(withTiny && typeof tinyMCE!='undefined'){
			editors=tinyMCE.get();
			if(editors.length>0){
				for (i=0;i<editors.length;i++){
					editors[i].execCommand('mceDirection'+$("#lang_box").find("[data-l_lang_index='"+lang_index+"']").attr('data-l_lang_dir'));
				}
			}
		}

		//trigger other plugins/modules
		if(typeof __seo_init == 'function'){
			$(function(){
				__seo_init(true);
			});
		}

		if(typeof field_checkerCallback == 'function'){
			$(function(){
				$('[data-l_field_checker_bordered]').css('border','');
				// $('[onkeyup^=field_checker]').trigger('keyup');
			});
		}
		
	}
	
	//when user changes inputs
	function change_lang_values(elem,type='form'){
		//get the form of this elem
		if(type=='mce'){
			form_id=$('textarea[id='+elem+']').closest('form').attr('id');
		}
		else if(type=='form'){
			form_id=elem.id;
		}else if(type=='field'){
			form_id=$(elem).closest('form').eq(0).attr('id');
		}

		//get index of the element being changed
		for(i=0;i<__lang_forms[form_id]['inputs'].length;i++){
			//get the input to change itself, not the whole values to save performance, but if its textarea and is tinymce, its value saved differently, which we need to get tincymce api to get the content
			if(__lang_forms[form_id]['inputs'][i].name==elem.name || (type=='mce' && __lang_forms[form_id]['inputs'][i].name==$('#'+elem).attr('name'))){
				if(__lang_forms[form_id]['inputs'][i].type=="textarea" && !$(__lang_forms[form_id]['inputs'][i]).hasClass('mceNoEditor') ){
					
					__lang_forms[form_id]['lang_content_array'][lang_index][i]=tinymce.get(__lang_forms[form_id]['inputs'][i].id).getContent();
				}
				else{
					__lang_forms[form_id]['lang_content_array'][lang_index][i]=elem.value;
				}
	 			break;
			}
		}
		// p(lang_content_array);
	}
	
	function combine_lang_input(elem){
		//get the form of this elem
		form_id=$(elem).attr('id');
	
		if(__lang_forms[form_id]==undefined || __lang_forms[form_id]['lang_content_array']==undefined)return;
		
		$('.hidden_inputs').remove();
		
		for(i=0;i<__lang_forms[form_id]['inputs'].length;i++){
			var combined_value="";
			for(j=0;j<__lang_forms[form_id]['lang_content_array'].length;j++){
				combined_value=combined_value+__lang_forms[form_id]['lang_content_array'][j][i]+"<>";
			}
			
			if(__lang_forms[form_id]['inputs'][i].type=='textarea'){
				var hidden_input = document.createElement("textarea");
			}
			else{
				var hidden_input = document.createElement("input");
				$(hidden_input).attr('type','hidden');
			}
			
			$(__lang_forms[form_id]['inputs'][i]).after(hidden_input);
			$(hidden_input).addClass('hidden_inputs');
			$(hidden_input).addClass('hidden');
			$(hidden_input).attr('name',__lang_forms[form_id]['inputs'][i].name);
			$(hidden_input).val(combined_value);
		}
	}
	




	
	
	__lang_init();
	
	

	// (async()=>{
	// 	while(!window.hasOwnProperty("jQuery")){
	// 		await new Promise(resolve=>setTimeout(resolve,100));
	// 	}
		
	// 	console.log("jQuery is loaded.");
		$(function(){
			switch_lang(lang_index,false);
		});
	// })();
	

	function tinyIsReady(){
		switch_lang(lang_index);
	}



	
</script>