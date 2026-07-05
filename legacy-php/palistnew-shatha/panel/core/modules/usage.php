<?php
if(!privilege($module,'usage'))echo $noPermission;else{
$csvFields=$intro=$txt=$ml=NULL;
$clean=[];
$mod=unserialize(base64_decode(file_get_contents(modules_dir.$module.'/others/modulePOST.php')));

?>
<div class="l_mb10 nos">
	<div class="l_btn usage_tab l_btn_active" id="usage_tab_front" onClick="mass(this,'usage_tab')">Front End</div>
	
	<div class="l_btn usage_tab" id="usage_tab_api" onClick="mass(this,'usage_tab')">API</div>
	<div class="l_btn usage_tab" id="usage_tab_single" onClick="mass(this,'usage_tab')">Single API</div>
	<div class="l_btn usage_tab" id="usage_tab_tree" onClick="mass(this,'usage_tab')">Tree API</div>
	<div class="l_btn usage_tab" id="usage_tab_csv" onClick="mass(this,'usage_tab')">CSV Data</div>
	<div class="l_btn usage_tab" id="usage_tab_table" onClick="mass(this,'usage_tab')">Table</div>
	<div class="l_btn usage_tab" id="usage_tab_fields" onClick="mass(this,'usage_tab')">Fields</div>
	
</div>

<?php
if(isset($mod['edit_only_function']))$editOnly="\$i=0;";
else $editOnly=NULL;

$photo=NULL;
for($i=0;$i<count($mod['field_name']);$i++){
	if($mod['field_name'][$i]!=NULL  && $mod['type'][$i]!='group'){
		if($mod['type'][$i]=='file' && $mod['filetype'][$i]=='photo'){
		$photo.="
<?php ".($mod['protected_file'][$i]==1?'picp':'pic')."(\$resp[\$i]['".$mod['field_name'][$i]."'],400,100,l(\$resp[\$i]['title']),true,NULL,'".$mod['cleaned_module_name'].'_'.$mod['field_name'][$i]."_picture');?>";

			}
	}
}

$order_num_exist=false;
$fields_forResp=NULL;
for($i=0;$i<count($mod['field_name']);$i++){
	if($mod['field_name'][$i]=='order_number' && !$order_num_exist)$order_num_exist=true;

	if($mod['field_name'][$i]!=NULL && !$mod['multi_select'][$i]  && $mod['type'][$i]!='group')$fields_forResp.=','.$mod['field_name'][$i];
}


for($i=0;$i<count($mod['field_name']);$i++){
$date_field='date_created';
	$custom_date=false;
	if($mod['publish_date_field'][$i]){
		$custom_date=true;
		$date_field=$mod['field_name'][$i];
		break;
	}
}


if($order_num_exist)
	$order_txt="'ORDER BY order_number ASC'";
else if($custom_date)
	$order_txt="'ORDER BY $date_field DESC'";
else 
	$order_txt='NULL';


	for($i=0;$i<count($mod['field_name']);$i++){
		if($mod['field_name'][$i]==NULL)continue;
		$clean[$mod['field_name'][$i]]=[];
		$clean[$mod['field_name'][$i]]['resolver']='$resp[$i][\''.$mod['field_name'][$i].'\']';
	}




$code="
<?php \$_m='$module';$editOnly?>
<section id=\"".$mod['cleaned_module_name']."_wrap\" class=\"major_section w1200\">
<!--<?php
\$resp=db(\$_m,NULL,$order_txt);
if(\$resp==1) echo '<div class=\"no_data\">'.l('No Data<>لا مُدخلات').'</div>';
else { for(\$i=0;\$i<count(\$resp);\$i++){?>
--><a class=\"".$mod['cleaned_module_name']."_box in\" title=\"<?=l(\$resp[\$i]['title']) ?>\" href=\"<?=url(\$_m,'single',\$resp[\$i]['id'])?>\">$photo";

	for($i=0;$i<count($mod['field_name']);$i++){
		if($mod['field_name'][$i]==NULL)continue;
		
		$className=$mod['cleaned_module_name']."_".$mod['field_name'][$i];
		if($mod['type'][$i]=='text' && $mod['type'][$i]!='group'){
			$csvFields.="				'".$mod['field_name'][$i]."'=>\$finale[\$i]['".$mod['field_name'][$i]."'],
";

			$div="	<h2 class=\"$className\">";
			$divClose="</h2>";
		}
		else if($mod['type'][$i]=='textarea'){
			$csvFields.="				'".$mod['field_name'][$i]."'=>strip_tags(\$finale[\$i]['".$mod['field_name'][$i]."']),
";


			if($mod['noMCE'][$i]==1){
				$div="	<div class=\"$className\">";
				$divClose="</div>";
			}else{
				$div="	<p class=\"$className\">";
				$divClose="</p>";
				}
		}
		else if($mod['type'][$i]=='material-icon'){


			$div="	<i>";
			$divClose="</i>";
		}else if($mod['type'][$i]=='file' && $mod['filetype'][$i]=='file'){


			$div="	<a target=\"_blank\" title=\"<?=l(\$resp[\$i]['title'])?>\" href=\"<?=".($mod['protected_file'][$i]==1?'d':'u').".\$resp[\$i]['".$mod['field_name'][$i]."']?>\">";
			$divClose="</a>";
		}
		else{
//			else if($mod['type'][$i]!='password'  && $mod['type'][$i]!='group' && $mod['field_name'][$i]!=NULL){
//				$csvFields.="				'".$mod['field_name'][$i]."'=>\$finale[\$i]['".$mod['field_name'][$i]."'],
//";
			$div="	<div class=\"$className\">";
			$divClose="</div>";
		}



if($mod['field_name'][$i]!=NULL  && $mod['type'][$i]!='group' && $mod['field_name'][$i]!='order_number'){
	if($mod['ml'][$i]=='1'){
		$csvFields.="				'".$mod['field_name'][$i]."'=>l(\$finale[\$i]['".$mod['field_name'][$i]."']),
";
		$code.="
$div<?=l(\$resp[\$i]['".$mod['field_name'][$i]."']);?>$divClose";
	}
	else {
		if($mod['type'][$i]=='select' && !$mod['multi_select'][$i]){
			$csvFields.="				'".$mod['field_name'][$i]."'=>l(detail('".$mod['select_table'][$i]."','".$mod['select_echo'][$i]."','id',\$finale[\$i]['".$mod['field_name'][$i]."'])),
";

			$code.="
$div<?=l(detail('".$mod['select_table'][$i]."','".$mod['select_echo'][$i]."','id',\$resp[\$i]['".$mod['field_name'][$i]."']))?>$divClose";
		}

		else if($mod['type'][$i]=='file' && $mod['filetype'][$i]=='file')$code.="
$div<?=l('Download<>تحميل')?>$divClose";

		else if($mod['type'][$i]=='select' && $mod['multi_select'][$i])$code.="
	<!--<?php
	\$comp=comp('".$module."',\$resp[\$i]['id'],'".$mod['select_table'][$i]."');
	if(\$comp!=1){
		for(\$_z=0;\$_z<count(\$comp);\$_z++){
			\$tmp=db('".$mod['select_table'][$i]."',\"WHERE id='\".\$comp[\$_z]['child_id'].\"'\",NULL,'LIMIT 1')[0]?>
			--><div class=\"list_comp_item in\"><?=l(\$tmp['title'])?></div><!--
	<?php }
		}
	?>-->";

		else if($mod['type'][$i]!='file')$code.="
$div<?=\$resp[\$i]['".$mod['field_name'][$i]."']?>$divClose";
	}
}}



	$csvFields.="				'date_created'=>\$finale[\$i]['date_created'],
";

	$code.="
	<time datetime=\"<?=\$resp[\$i]['$date_field']?>\"><?=cleanDate(\$resp[\$i]['$date_field'])?></time>
</a><!--
<?php 
}//for
}//else
unset(\$resp);?>
-->
</section>";



echo "<div class=\"usage_tab_slave\" id=\"usage_tab_front_slave\">
<div class=\"l_btn l_green l_black_c\"  onClick=\"copy('','front');\">Copy</div>
<pre  id=\"front\">
<code class=\"l_scroll_x\">".highlight_string($code,TRUE).'</code></pre></div>';




	$active=NULL;
for($i=0;$i<count($mod['field_name']);$i++){
	if($mod['field_name'][$i]!=NULL  && $mod['type'][$i]!='group'){
		if($mod['field_name'][$i]=='Active'){
		$active=" AND active=1";
		break;
			}
	}
	}

	$photo=NULL;
for($i=0;$i<count($mod['field_name']);$i++){
	if($mod['field_name'][$i]!=NULL  && $mod['type'][$i]!='group'){
		if($mod['type'][$i]=='file' && $mod['filetype'][$i]=='photo'){
		$photo.="
\$resp[\$i]['".$mod['field_name'][$i]."']=\$resp[\$i]['".$mod['field_name'][$i]."']==NULL?'':urlencode(".($mod['protected_file'][$i]==1?'dimgp':'uimg')."(\$resp[\$i]['".$mod['field_name'][$i]."'],400,100));";

			}
	}
}



$nodes=NULL;
		for($i=0;$i<count($mod['field_name']);$i++){
if($mod['type'][$i]=='select' && $mod['multi_select'][$i])$nodes.="
\$_m='".$module."';
\$_t='".$mod['select_table'][$i]."';    
\$comp=comp(\$_m,\$resp[\$i]['id'],\$_t);
	if(\$comp!=1){
		 \$resp[\$i]['".$mod['field_name'][$i]."_value']=array();
		for(\$j=0;\$j<count(\$comp);\$j++){
			 \$resp[\$i]['".$mod['field_name'][$i]."_value'][]=fc(fl(db(\$_t,\"WHERE id='\".\$comp[\$j]['child_id'].\"'\",NULL,'LIMIT 1'))[0],array('photo','icon'));
	 }
	}else  \$resp[\$i]['target_groups_value']=-1;";


			else if($mod['type'][$i]=='textarea' && $mod['noMCE'][$i]==1){
	$ml.="
\$resp[\$i]['".$mod['field_name'][$i]."']=l(\$resp[\$i]['".$mod['field_name'][$i]."']);";
	}
		}



	$ml=NULL;
	if(isset($mod['ml_module'])){			
		for($i=0;$i<count($mod['field_name']);$i++){

			$_tmp_res=NULL;
	if($mod['type'][$i]=='select'  && !$mod['multi_select'][$i])$_tmp_res="
\$resp[\$i]['".$mod['field_name'][$i]."']=l(detail('".$mod['select_table'][$i]."','".$mod['select_echo'][$i]."','id',\$resp[\$i]['".$mod['field_name'][$i]."']));";


else if($mod['type'][$i]=='textarea' && $mod['noMCE'][$i]==0){
	$_tmp_res="
\$resp[\$i]['".$mod['field_name'][$i]."']=htmll(\$resp[\$i]['".$mod['field_name'][$i]."']);";
	}

		else if($mod['field_name'][$i]!=NULL  && $mod['type'][$i]!='group' && $mod['ml'][$i]=='1'){
			$_tmp_res="
\$resp[\$i]['".$mod['field_name'][$i]."']=l(\$resp[\$i]['".$mod['field_name'][$i]."']);";

		}


		$ml.=$_tmp_res;
		$clean[$mod['field_name'][$i]]['resolver']=$_tmp_res;
		}

	}


	$selects=NULL;
for($i=0;$i<count($mod['field_name']);$i++){
	if($mod['field_name'][$i]!=NULL  && $mod['type'][$i]!='group'  && !$mod['multi_select'][$i] && !isset($mod[ 'ml_module'])){
		$_tmp_res=NULL;
		if($mod['type'][$i]=='select'){
		$_tmp_res="
\$resp[\$i]['".$mod['field_name'][$i]."_value']=l(detail('".$mod['select_table'][$i]."','".$mod['select_echo'][$i]."','id',\$resp[\$i]['".$mod['field_name'][$i]."']));";
		$selects.=$_tmp_res;
		$clean[$mod['field_name'][$i]]['resolver']=$_tmp_res;
			}
	}
}



	for($i=0;$i<count($mod['field_name']);$i++){
	if($mod['field_name'][$i]!=NULL && !$mod['multi_select'][$i]  && $mod['type'][$i]!='group')$txt=$txt.','.$mod['field_name'][$i];
}
		$intro.= "<div class=\"usage_tab_slave\" id=\"usage_tab_api_slave\" ".dn(true).">
<div class=\"l_btn l_green l_black_c\"  onClick=\"copy('','code');\">Copy</div>
<pre  id=\"code\">
<code class=\"l_scroll_x\">".str_replace('?&gt;','',str_replace('&lt;?php','',highlight_string("
<?php 
case'".$mod['cleaned_module_name']."':
\$resp=db('".$module."',\"WHERE deleted=0 $active\".\$search,$order_txt,\$limit,'id,date_created$txt');$editOnly
if(\$resp==1)json(true,-1);
\$res=array();
for(\$i=0;\$i<count(\$resp);\$i++){".( $photo!=NULL ? $photo:'')."
\$resp[\$i]['date_created']=cleanDate(\$resp[\$i]['date_created']);$ml $selects $nodes
\$res[]=\$resp[\$i];
}
json(true,1,\$res);
break;?>
	",TRUE))). '</code>
	</pre>
</div>';

//		for($i=0;$i<count($mod['field_name']);$i++){
//	if($mod['field_name'][$i]!=NULL  && $mod['type'][$i]!='group'){
//		$intro=$intro."
//	
//		
//		";
//	}}



		$intro.="<div class=\"usage_tab_slave\" id=\"usage_tab_single_slave\" ".dn(true).">
<div class=\"l_btn l_green l_black_c\"  onClick=\"copy('','single');\">Copy</div>
<pre  id=\"single\">
<code class=\"l_scroll_x\">".str_replace('?&gt;','',str_replace('&lt;?php','',highlight_string("
<?php 
case'single_".$mod['cleaned_module_name']."':
\$resp=db('".$module."',\"WHERE id='\".id().\"' AND deleted=0 $active\",NULL,'LIMIT 1','id,date_created$txt');$editOnly
if(\$resp==1)json(true,-1);
\$i=0;
".( $photo!=NULL ? $photo:'')."
\$resp[\$i]['date_created']=cleanDate(\$resp[\$i]['date_created']);$ml $selects $nodes

json(true,1,\$resp[\$i]);
break;?>
	",TRUE))). '</code>
	</pre>
</div>';

















	$intro.="<div class=\"usage_tab_slave\" id=\"usage_tab_tree_slave\" ".dn(true).">
<div class=\"l_btn l_green l_black_c\"  onClick=\"copy('','tree');\">Copy</div>
<pre  id=\"tree\">
<code class=\"l_scroll_x\">".str_replace('?&gt;','',str_replace('&lt;?php','',highlight_string("
<?php 
	case'".$mod['cleaned_module_name']."':
		\$_POST['user']=\$user_id;
		\$_m='$module';

		switch(\$_POST['sub']){
			case'add':
				co(\$_m);
				r(\$_m,'add');
			break;

			case'delete':
				mysqli_query(\$conn,\"UPDATE \$_m SET deleted=1 WHERE id='\".e('id').\"' AND user=\$user_id LIMIT 1\");
			break;

			case'list':
				\$resp=commer(db(\$_m,\"WHERE user=\$user_id AND deleted=0\",NULL,\$limit));
				/*
				foreach(\$resp as &\$r){

				}
				*/
				json(true,1,\$resp);
			break;

			case'edit':
				\$id=e('id');
				if(db(\$_m,\"WHERE id=\$id AND user=\$user_id\")==1)json(false,88);
				co(\$_m,\$id);
				r(\$_m,'edit');
			break;
		}
	json();
	break;?>
	",TRUE))). '</code>
	</pre>
</div>';



$intro.="<div class=\"usage_tab_slave\" id=\"usage_tab_csv_slave\" ".dn(true).">
<div class=\"l_btn l_green l_black_c\"  onClick=\"copy('','csv');\">Copy</div>
<pre  id=\"csv\">
<code class=\"l_scroll_x\">".str_replace('?&gt;','',str_replace('&lt;?php','',highlight_string("
<?php
		\$tmp=array();
		for(\$i=0;\$i<count(\$finale);\$i++){
			\$tmp[]=array(
$csvFields
			);
		}
		\$file=csv(\$tmp);
		?>
	<a class=\"btn in download\" href=\"<?=urlPanel.'exported/'.\$file?>\"><?=l('Download<>تنزيل')?></a>",TRUE))). '</code>
	</pre>
</div>';


$fields=NULL;
$liner=[];

for($i=0;$i<count($mod['field_name']);$i++){
	if($mod['field_name'][$i]==NULL)continue;
	$fields.='
	<div class="l_grid4 l_mtb10">
		<div class="po l_nicebox" onclick="c(this.innerHTML)">'.$mod['field_name'][$i].'</div>
		<div class="po l_nicebox l_grid_span25" onclick="c(this.innerHTML)">'.$clean[$mod['field_name'][$i]]['resolver'].'</div>
	</div>';

	$liner[]=$mod['field_name'][$i];
}

$intro.="<div class=\"usage_tab_slave\" id=\"usage_tab_fields_slave\" ".dn(true).">";

$intro.='<div onclick="c(this.innerHTML)" class="l_nicebox po">'.implode(',',$liner).'</div>';
$intro.=$fields;

$intro.="</div>";


echo $intro;
}