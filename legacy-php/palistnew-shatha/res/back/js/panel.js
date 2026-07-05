searchField=document.getElementById('search_menu_field');

	if(searchField!=null){
		
	searchField.addEventListener("keydown", function(event) {
		if(event.keyCode==27){
		searchField.value='';
		searchField.innerHTML='';
			}
	})
		
		
	searchField.focus();

	window.addEventListener("load", function(){
		$(document).ready(function(){
			$("#search_menu_field").on("keyup", function(e) {
				if(e.key === 'Enter') {
					$('#menu li:visible').find('a').eq(0)[0].click();
					return;
				}

				var value = $(this).val().toLowerCase();

				if(value==''){
					$("#menu .menu_search").each(function() {
						elem = $(this).closest('.parent_menu');
						$(elem).show();
					});

					$('.panel_collapsed_menu').hide();
					$('#menu_collapse_wrap').show();

				}else{
					$('#menu_collapse_wrap').hide();
					$("#menu .menu_search").filter(function() {
						elem = $(this).closest('.parent_menu');
						if($(this).text().toLowerCase().indexOf(value) > -1){
							$(elem).show();
						}
						else{
							$(elem).hide();
						}
					});

				}

			});
		});
					
		}, false);

}


function mark_seen_notification(data,params){
	$('#notification_'+params['id']).removeClass('unseen_notification');
	$('#notification_'+params['id']).find('i').html('notifications_none');
	
	refresh_notifications();
}

function refresh_notifications(){
	c = $('.unseen_notification').length;

	if(c==0){
		$('noti_counter').html('');
		$('#notification_btn i').html('notifications_none');
		$('#notification_btn i').removeClass('noti_icon_gold');
		}
	else if(c>0){
		$('noti_counter').html(c);
		$('#notification_btn i').html('notifications_active');
		$('#notification_btn i').addClass('noti_icon_gold');
	}
}