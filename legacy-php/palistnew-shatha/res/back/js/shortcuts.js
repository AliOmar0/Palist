bread_save = document.getElementById('bread_save');
bread_save_new = document.getElementById('bread_save_new');

lang_buttons=document.querySelectorAll('.lang_item');

document.addEventListener("keyup", function(e){
	var key = e.which || e.keyCode;
	
	
	//ctrl+s
 if ((e.ctrlKey || e.metaKey) && key == 83) {
			bread_save.click();
  }
	
	
	//ctrl+d
	else if ((e.ctrlKey || e.metaKey) && key == 68) {
			bread_save_new.click();
  }
	
	
	
	//ctrl+b
else  if ((e.ctrlKey || e.metaKey) && key == 66) {
		activeElementX=document.activeElement;
			 	document.activeElement.blur();
	
	 for(i=0;i<lang_buttons.length;i++){
		 if(lang_buttons[i].classList.contains('active_lang')==false){
			lang_buttons[i].click();
			 break;
		 }
	 }
	
	activeElementX.focus();
  }
	
	
}, false);
