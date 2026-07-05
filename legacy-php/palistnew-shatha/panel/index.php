<?php
$title='Dashboard<>الرئيسية';
require 'header.php';

if(db('module_fields',"WHERE module_id='".mid($module)."' AND type='location'")!=1)$mapHere=true;else $mapHere=false;
if ($module!=NULL && $action!=NULL) {
    if($action=='import'){
        if(!privilege($module, 'add'))
            die($noPermission);
    }
    elseif(!privilege($module, $action) && !($module=='admins' && $action=='edit' && $_SESSION['user_id']==$_GET['id']))
        die($noPermission);
    
    if($action=='list'){
		require_once core_dir.'modules/list.php';
		if($mapHere)include_once core_dir.'modules/mapView.php';
	}
    else {
		$noSaveArr=array('editModule','usage','editBackup','errorLogs','view','updater','import','sitemap','guard');
        if(in_array($action,$noSaveArr))$noSave=true;
        require_once core_dir.'modules/bread.php';
        echo "<div class=\"working_area\">";
		if($action=='usage')
			include core_dir.'modules/usage.php';
        elseif($action=='import')
			include modules_dir.'settings/views/import.php';
        else{
            echo '<div class="l_nicebox">';
			require_once modules_dir.$module.'/views/'.$action.'.php';
            echo '</div>';

            if($action=='edit' && isset($_form_resp)){
                $__creator=NULL;
                if(isset($_form_resp[0]['admin_add_id']) && $_form_resp[0]['admin_add_id']!='' && $_form_resp[0]['admin_add_id']!=0){
                    $__creator=db('admins',"WHERE id=".$_form_resp[0]['admin_add_id'],NULL,'LIMIT 1')[0];
                    $__creator='<div class="">'.l('Creator<>المُنشئ').': '.$__creator['first_name'].' '.$__creator['last_name'].' '.$__creator['username'].'</div>';
                }

                $__single_link=NULL;
                if(db('link_handler_1566934564',"WHERE module_prefix='".mid($module)."' AND !deleted AND single!=''",NULL,'LIMIT 1')!=1){
                    $__single_link='<div class="">'.l('Preview Link (testing feature)<>استعراض الرابط (خاصية تحت التجربة)').': <a href="'.url($module,'single',$_form_resp[0]['id']).'" target="_blink">'.url($module,'single',$_form_resp[0]['id']).'</a></div>';
                }
                
                echo '<div class="l_nicebox l_mtb10">
                <div class="l_f12 l_mb5 ">'.l('Entry Details<>معلومات المُدخل').'</div>
                <div class="l_grid4 l_gray_c l_f11">
                <div class="">'.l('Date Created<>تاريخ الإنشاء').': '.$_form_resp[0]['date_created'].'</div>
                    '.$__creator.'
                <div class="">'.l('ID<>المعرف').': '.$_form_resp[0]['id'].'</div>
                '.$__single_link.'
                </div>
                '.entry_history($module,$_form_resp[0]['id'],$action).'
                </div>';
            }
           
        }

        
        

		require_once core_dir.'preViewFormEnd.php';
        if (detail('modules','ml','module_prefix',$module)==true && $action!='usage') {
            echo "<script>
			var ml_supp_input_names=".json_encode(explode(',',$m['ml_fields'])).";</script>";
            require panel_dir.'core/modules/lang.php';
        }
		
		if($mapHere)include_once core_dir.'modules/map.php';
        echo '</div>';
    }
} else {
?>

<div id="bread">
	<div id="module_title" class="mid">
		<i class="mid">dashboard</i>
		<span class="mid"><?=l('Dashboard<>لوحة التحكم')?></span>
	</div>
	<?php include_once core_dir.'preBread.php'?>
</div>

<div id="dashboard" class="working_area">
<?php
    require custom_dir.'custom_index.php';
    require panel_dir.'dashboard.php';
    echo '</div>';
}
require 'footer.php';