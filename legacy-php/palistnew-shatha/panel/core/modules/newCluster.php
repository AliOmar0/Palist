<?php
//$cluster_module='personnel_1582820247';
//$cluster_hide_field='area';
require core_dir.'configList.php';

#0 module initiate
if($cluster_module!=NULL){
$cm=db('module_settings',"WHERE module_prefix='$cluster_module'",NULL,"LIMIT 1");
    if($cm!=0 || $cm!=1){
        $cm=$cm[0];
$cm['info']=db('modules',"WHERE module_prefix='$cluster_module'",NULL,'LIMIT 1')[0];
$cm['module_id']=$cm['info']['id'];
    }
}


#1 fields from module_fields
list($cm,$c_main_field,$cf)=moduleFields($cm);
#2 permission
$CcanDelete=true;
$CcanEdit=true;



$clusterResp=db($cluster_module,"WHERE $cluster_hide_field='$original_edit_id' AND deleted=0",'ORDER BY id ASC');
?>


<table class="filling">
	<thead>
		<tr>
			<?php for($ci=0;$ci<count($c_main_field);$ci++){?>
				<th><?= l($cf[$c_main_field[$ci]]['label']);?>
			</th>
			<?php }?>
		</tr>
		
		
	</thead>
	<tbody>
		<?php if($clusterResp!=1 && $clusterResp!=0)
				for($ci=0;$ci<count($clusterResp);$ci++){?>
				<tr>
					<?php for($cj=0;$cj<count($c_main_field);$cj++){?>
						<td><?= td($c_main_field[$cj],$clusterResp[$ci],$cm,$CcanDelete,$CcanEdit,$cf);?></td>
					<?php }?>
				</tr>
			<?php } ?>
	</tbody>
	<tfoot>
	</tfoot>
</table>