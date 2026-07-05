/*
ProVision Co.
-------------
This web application design and development by ProVision Co.

 All source files, presentable or core, graphics and layout are owned/controlled by PPB and ProVision, and no one, entity or individual, can use/modify/destribute at anytime or at anywhere without a written approval from ProVision.
--------------
Omar Shamali
www.provision.ps 
*/
function animateValue(id, start, end, duration) {
    var range = end - start;
    var current = start;
    var increment = end > start? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = document.getElementById(id);
    var timer = setInterval(function() {
        current += increment;
        obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}


	

	function search(){
				toggleShowHide('search_window');
				//toggleShowHide('main');
				if(document.getElementById('search_window').style.display!='none'){
					document.getElementById('search_field').focus();
					}
			}
			
			
			function menu(){
				toggleShowHide('menu_window');
				//toggleShowHide('main');
				
			}



$(document).ready(function(){
  $("#quickSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#listings .listing_item").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});





function applySuccess(){
	console.log('all good');
	hide('applied_1568566494');
	hide('alreadyApplied');
	show('applySuccess');
}


function alreadyApplied(){
	console.log('already applied');
	hide('applied_1568566494');
	show('alreadyApplied');
	hide('applySuccess');
}