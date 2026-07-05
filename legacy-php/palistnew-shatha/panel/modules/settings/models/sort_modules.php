<?php
//make sure no empty fields
if(    
!isset($_POST['sort_module']) || $_POST['sort_module']==""
) json(false,4);

/**************************************************/


for($i=0;$i<count($_POST['sort_module']);$i++){
	$id=mysqli_real_escape_string($conn,$_POST['sort_module'][$i]);
	mysqli_query($conn,"UPDATE modules SET order_by='$i' WHERE id='$id' LIMIT 1");
}
json(true,2,NULL,NULL,['js'=>'refresh']);