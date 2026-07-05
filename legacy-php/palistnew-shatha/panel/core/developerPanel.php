<?php if(super()){?>
	
	<div class="l_fixed developer_panel_wrap l_bottom0 l_right0 l_z1">
		<div class="mid l_lava po l_pad10 l_op3 l_op_hover10 l_trans1" onclick="
		$('#devloper_panel').slideToggle();
		get_error_files_caller();
		___update_developer_panel_xhrs_activate();
		">Errors</div><!--
	--><div class="mid l_petrol po l_pad10 l_op3 l_op_hover10 l_trans1" onclick="
	$('#devloper_panel').slideToggle();
	___update_developer_panel_xhrs_activate();
	">Developer Panel</div>
	
		<div id="devloper_panel" class=" l_fixed l_right0 l_bottom0 l_black l_nicebox" <?=dn()?>>
			<div id="developer_panel_top_btns" class="l_grid3 l_center l_pad5 l_mb10 l_nicebox">
					<div class="po l_grid_span14" onclick="
					$('#devloper_panel').slideToggle();
					___update_developer_panel_xhrs_deactivate();
					error_log_auto_reload_deactivate();
					___update_developer_panel_xhrs_pin_deactivate();
					">Close</div>
				</div>
				<div class="l_grid3 l_hfull l_nicebox">
					<div class="l_pad10 l_nicebox">
						<!--error logs-->
						<div class="po" onclick="get_error_files_caller()">Error Logs</div>
						<div id="error_logs_files"></div>
						<!--legion guard-->
						<div class="l_mt20">Legion Guard</div>
						<div class="l_ml5 l_mt5">
							<div onClick="showPop('!','Reset HTACCESS','Are you sure?','Creating new HTACCESS','settings','reset_htaccess')" class="l_btn l_mt5 l_btn_small mid" title="Reset HTACCESS">Reset & Regenerate</div>
						</div>
						<!--APIs-->
						<div class="l_mt20">Pudge (APIs)</div>
						<div class="l_btn l_btn_small l_mt5 l_mb5 mid" onclick="___pudge_arrayToAPI()">Test API Ready Array</div>
						<!--current XHRs-->
						<div class="l_mt20">Current Processes (XHRs)</div>
						<div class="l_btn l_btn_small l_mt5 l_mb5 mid" onclick="___legion_xhrs_exit()">Abort and Prevent</div>
						<div class="l_btn l_btn_small l_mt5 l_mb5 mid" onclick="___update_developer_panel_xhrs_pin_toggle(this)">Pin Processes</div>
						<!-- <div class="l_btn l_btn_small l_mt5 l_mb5" onclick="___legion_xhrs_resume()">Resume</div> -->
						<div id="developer_panel_xhrs" class="l_ml5 l_mt5"></div>
					</div>
					<div id="developer_panel_working_area" class="l_grid_span24 l_pad10 l_hfull l_f14 l_nicebox">
						<div id="developer_panel_working_area_btns" class="l_grid4 l_mb10">
							<div data-l_developer_panel_working_area_btn_type="error_log" class="l_btn l_btn_small" onclick="error_log_auto_reload_toggle(this);" <?=dn()?>>Auto Reload</div>

							<div data-l_developer_panel_working_area_btn_type="error_log" class="l_btn l_btn_small" onclick="error_log_auto_reload_toggle(this);" <?=dn()?>>Auto Reload</div>
						</div>
						<div id="developer_panel_working_area_content"></div>
					</div>
			</div>

			
		</div>
	</div>








	<script>

		function ___pudge_arrayToAPI(){
			$('#developer_panel_working_area_content').html('');

		}

		function get_error_files_caller(){
			sub({'get_error_files_list':true,'js':'get_error_files_list_callback'})
		}

		function get_error_files_list_callback(data,params){
			parent=$('#error_logs_files').html('');
			$('#developer_panel_working_area_content').html('');
			if(data!=1){
				$(data).each(function(i,elem){
					$(parent).append(`
					<div data-l-developer-log-name="`+escape(elem['name'])+`" class="po l_f12 l_pad5" onclick="sub({'error_log_content':'`+elem['name']+`','js':'error_log_content_callback','x[name]':'`+elem['name']+`'})">
						`+elem['name']+`
						<div class="l_f10  l_ml5 mid l_black l_white_c">`+elem['elapse']+`</div>
						<div class="l_f10 `+(elem['size']=='0 KB'?'l_black':'l_lava')+` l_white_c l_ml5 mid">`+elem['size']+`</div>
						<i class="mid po nos l_grass_c" onclick="href('`+urlPanel+`?module=settings&action=errorLogs&dir=`+elem['name']+`,true)">visibility</i>
						<i class="mid po nos l_purple_c" onclick="sub({'error_log_handle':'mop','js':'get_error_files_caller','dir':'`+elem['name']+`'})">mop</i>
						<i class="mid po nos l_lava_c " onclick="sub({'error_log_handle':'del','js':'get_error_files_caller','dir':'`+elem['name']+`'})">delete</i>
					</div>`);
				});

				$('#error_logs_files').find('div').eq(0).click();
			}
		}

		var developer_panel_curr_name = '';
		function error_log_content_callback(data,params){
			$('#developer_panel_working_area_btns l_btn').hide();
			$('#developer_panel_working_area_btns [data-l_developer_panel_working_area_btn_type=error_log]').show();

			if(data==undefined)return;
			if(params['name']!=undefined)developer_panel_curr_name=params['name'];

			$('#developer_panel_working_area_content').html(data+"<div id=\"developer_panel_working_area_content\"></div>");
			l_scroll('#developer_panel_working_area_content','#developer_panel_working_area_content');
					
		}

		var error_log_auto_reload_timer='';
		function error_log_auto_reload_toggle(elem){
			if(error_log_auto_reload_timer == ''){
				l_btn_activate(elem);
				error_log_auto_reload_timer = setInterval(() => {
					$('[data-l-developer-log-name="'+developer_panel_curr_name+'"]').eq(0).click();
				}, 5000);
			}else{
				error_log_auto_reload_deactivate(elem);
			}
		}

		function error_log_auto_reload_deactivate(elem){
			l_btn_deactivate(elem);
			clearInterval(error_log_auto_reload_timer);
			error_log_auto_reload_timer = '';
		}

	</script>

	<style>
		#devloper_panel {
			height: 70vh;
			width:100vw;
		}
		#developer_panel_working_area_content{
			overflow: auto scroll;
			white-space: pre;
			line-height: 16px;
			width: 100%;
			padding-bottom: 50px;
			max-width: 1300px;
			max-height: calc(70vh - 110px);
		}
	</style>


<?php }?>