<?php
if(privilege($module,'add')){
	$target_module=$module;
	$arr=array();
	$original_data=array();
	$handle = fopen($_FILES['file']['tmp_name'], "r");
//	$headers = fgetcsv($handle, 0, ",");
	

	switch($_POST['importer_action']){
			case'check_file':
				
				while (($data = fgetcsv($handle, 10000, ",")) !== FALSE){
						$original_data[]=$data;	
				}
				$table=NULL;

				$k=0;
				$table.='<thead><tr><th colspan="'.count($original_data[0]).'">Total results: '.count($original_data).'</th></tr><tr>';
				foreach($original_data[0] as $data){
					$table.='<th>'.$k.'</th>';
					$k++;
				}
				$table.='</tr></thead>';
				for($i=0;$i<count($original_data);$i++){
					$table.='<tr>';
					foreach($original_data[$i] as $data){
						$table.='<td>'.$data.'</td>';
					}
					$table.='</tr>';
				}
				fclose($handle);

				$table='<table class="imported_table filling">'.$table.'</table>';
				
				// d($table);
				json(true,1,NULL,NULL,array('js'=>'excel_good','note'=>$table));
			break;
			
			
			
			case'compare_file':
				$counter=-1;
//			dp();
//			dd();

				while (($data = fgetcsv($handle, 10000, ",")) !== FALSE){
					$counter++;
					
					if($_POST['dont_import_if_this_index_null']!='' && ($data[(int)$_POST['dont_import_if_this_index_null']]=='' || $data[(int)$_POST['dont_import_if_this_index_null']]==NULL || $data[(int)$_POST['dont_import_if_this_index_null']]=='NULL' || $data[(int)$_POST['dont_import_if_this_index_null']]==' '))continue;

					if($_POST['dont_import_up_to_row_index']!='' && (int)$_POST['dont_import_up_to_row_index']>=$counter)continue;
					
					
					
					$tmp=array();
					for($i=0;$i<count($_POST['original_field']);$i++){
						// mark($_POST['file_index_column'][$i]);
						if($_POST['file_index_column'][$i]==NULL){
							$tmp[$_POST['original_field'][$i]]='';
						}

						elseif($_POST['file_index_column'][$i]=='' && isset($_POST[$_POST['original_field'][$i]]) && $_POST[$_POST['original_field'][$i]]!=''){
							$tmp[$_POST['original_field'][$i]]=$_POST[$_POST['original_field'][$i]];	
						}
						
						elseif($_POST['original_field'][$i]=='date_created')$tmp[$_POST['original_field'][$i]]=$date_created;
						
						
						else if($_POST['original_field'][$i]=='admin_add_id')$tmp[$_POST['original_field'][$i]]=$admin_add_id;
						
						else if($_POST['spec'][$i]=='location'){
							$x=explode(',',$_POST['file_index_column'][$i]);
							if($data[$x[0]]=='' || $data[$x[1]]=='')$tmp[$_POST['original_field'][$i]]='';
							else
								$tmp[$_POST['original_field'][$i]]=$data[$x[0]].','.$data[$x[1]];
						}
						
						
						else if($_POST['spec'][$i]=='combine_and'){
							$x=explode(',',$_POST['file_index_column'][$i]);
							if($data[$x[0]]=='' || $data[$x[1]]=='')$tmp[$_POST['original_field'][$i]]=$data[$x[0]].$data[$x[1]].($_POST['is_ml'][$i]=='0'?'':'<>');
							else
								$tmp[$_POST['original_field'][$i]]=$data[$x[0]].' & '.$data[$x[1]].($_POST['is_ml'][$i]=='0'?'':'<>');
						}
						
						
						
						else if($_POST['spec'][$i]=='photo_link'){
							$x=explode(',',$_POST['file_index_column'][$i]);
							if($data[$x[0]]==NULL || $data[$x[0]]=='' || $data[$x[0]]=='NULL' || $data[$x[0]]=='null')$tmp[$_POST['original_field'][$i]]='';
							else $tmp[$_POST['original_field'][$i]]=$x[1].$data[$x[0]];
						}


						else if($_POST['spec'][$i]=='na_if_empty' && $data[$_POST['file_index_column'][$i]]==''){
							$tmp[$_POST['original_field'][$i]]='NA';
						}

						else if($_POST['spec'][$i]=='alternative_if_empty'){
							$x=explode(',',$_POST['file_index_column'][$i]);
							if($data[$x[0]]=='')$tmp[$_POST['original_field'][$i]]=$data[$x[1]];
							else
								$tmp[$_POST['original_field'][$i]]=$data[$x[0]];
						}
						
						
						else if($data[$_POST['file_index_column'][$i]]==NULL || $data[$_POST['file_index_column'][$i]]=='' || $data[$_POST['file_index_column'][$i]]=='NULL' || $data[$_POST['file_index_column'][$i]]=='null')
							$tmp[$_POST['original_field'][$i]]='';

						
						else
							$tmp[$_POST['original_field'][$i]]=$data[$_POST['file_index_column'][$i]].($_POST['is_ml'][$i]=='0'?'':'<>');
//						dd($tmp);
					}
					$arr[]=$tmp;
				}
			
			
				$table=NULL;

				$k=0;
				$table.='<thead><tr>';
				$keys=array_keys($arr[0]);
				foreach($keys as $key){
					$table.='<th>'.$key.'</th>';
					$k++;
				}
				$table.='</tr></thead>';
				for($i=0;$i<count($arr);$i++){
					$table.='<tr>';
					foreach($keys as $key){
						$table.='<td>'.$arr[$i][$key].'</td>';
					}
					$table.='</tr>';
				}
				fclose($handle);

				$table='<table class="imported_table filling">'.$table.'</table>';
				json(true,1,NULL,NULL,array('js'=>'excel_good','note'=>$table));
			break;
			
			
			
			case'import_file':
				$counter=-1;
				while (($data = fgetcsv($handle, 10000, ",")) !== FALSE){
					$counter++;
					
					if($_POST['dont_import_if_this_index_null']!='' && ($data[(int)$_POST['dont_import_if_this_index_null']]=='' || $data[(int)$_POST['dont_import_if_this_index_null']]==NULL || $data[(int)$_POST['dont_import_if_this_index_null']]=='NULL' || $data[(int)$_POST['dont_import_if_this_index_null']]==' '))continue;

					if($_POST['dont_import_up_to_row_index']!='' && (int)$_POST['dont_import_up_to_row_index']>=$counter)continue;
					
					$tmp=array();
					for($i=0;$i<count($_POST['original_field']);$i++){
						if($_POST['file_index_column'][$i]==NULL){
							$tmp[$_POST['original_field'][$i]]='';
						}

						elseif($_POST['file_index_column'][$i]=='' && isset($_POST[$_POST['original_field'][$i]]) && $_POST[$_POST['original_field'][$i]]!=''){
							$tmp[$_POST['original_field'][$i]]=$_POST[$_POST['original_field'][$i]];	
						}
						
						elseif($_POST['original_field'][$i]=='date_created')$tmp[$_POST['original_field'][$i]]=$date_created;
						
						else if($_POST['original_field'][$i]=='admin_add_id')$tmp[$_POST['original_field'][$i]]=$admin_add_id;
						
						else if($_POST['spec'][$i]=='location'){
							$x=explode(',',$_POST['file_index_column'][$i]);
							if($data[$x[0]]=='' || $data[$x[1]]=='')$tmp[$_POST['original_field'][$i]]='';
							else
								$tmp[$_POST['original_field'][$i]]=$data[$x[0]].','.$data[$x[1]];
						}
						
						else if($_POST['spec'][$i]=='combine_and'){
							$x=explode(',',$_POST['file_index_column'][$i]);
							if($data[$x[0]]=='' || $data[$x[1]]=='')$tmp[$_POST['original_field'][$i]]=$data[$x[0]].$data[$x[1]].($_POST['is_ml'][$i]=='0'?'':'<>');
							else
								$tmp[$_POST['original_field'][$i]]=$data[$x[0]].' & '.$data[$x[1]].($_POST['is_ml'][$i]=='0'?'':'<>');
						}
						
						
						else if($_POST['spec'][$i]=='photo_link'){
							$x=explode(',',$_POST['file_index_column'][$i]);
							if($data[$x[0]]==NULL || $data[$x[0]]=='' || $data[$x[0]]=='NULL' || $data[$x[0]]=='null')$tmp[$_POST['original_field'][$i]]='';
							else $tmp[$_POST['original_field'][$i]]=fileFromLink($x[1].$data[$x[0]]);

						}
						

						else if($_POST['spec'][$i]=='na_if_empty' && $data[$_POST['file_index_column'][$i]]==''){
							$tmp[$_POST['original_field'][$i]]='NA';
						}


						else if($_POST['spec'][$i]=='alternative_if_empty'){
							$x=explode(',',$_POST['file_index_column'][$i]);
							if($data[$x[0]]=='')$tmp[$_POST['original_field'][$i]]=$data[$x[1]];
							else
								$tmp[$_POST['original_field'][$i]]=$data[$x[0]];
						}
						
						else if($data[$_POST['file_index_column'][$i]]==NULL || $data[$_POST['file_index_column'][$i]]=='' || $data[$_POST['file_index_column'][$i]]=='NULL' || $data[$_POST['file_index_column'][$i]]=='null')
							$tmp[$_POST['original_field'][$i]]='';

						

						else
							$tmp[$_POST['original_field'][$i]]=$data[$_POST['file_index_column'][$i]].($_POST['is_ml'][$i]=='0'?'':'<>');
					}
					$arr[]=$tmp;
				}
			
			
				$table=NULL;

				$k=0;
				$table.='<thead><tr>';
				$keys=array_keys($arr[0]);
				foreach($keys as $key){
					$table.='<th>'.$key.'</th>';
					$k++;
				}
				$table.="<th>Import Result</th>";
				$table.='</tr></thead>';
				for($i=0;$i<count($arr);$i++){
					
					$_POST=array();
					$_POST=$arr[$i];
					completer($target_module);
					// if($i==0)dp();
					
					$last_id=r($target_module);
					$table.='<tr>';
					foreach($keys as $key){
						$table.='<td>'.$arr[$i][$key].'</td>';
					}
					$table.='<td>'.$last_id.'</td>';
					$table.='</tr>';
					
					
				}
				fclose($handle);

				$table='<table class="imported_table filling">'.$table.'</table>';
				json(true,1,NULL,NULL,array('js'=>'excel_good','note'=>$table));
			break;
		
		default:json(false);
	}	
}else{
	json(false);
}