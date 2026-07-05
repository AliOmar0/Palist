<?php
//make sure no empty fields
if(
	 !isset($_POST['menu_style']) || $_POST['menu_style']=="" 
) json(false,4);

/**************************************************/
//real escape to use with DB
$menu_style=e('menu_style');


if(!mysqli_query($conn,"UPDATE admins SET menu_style='$menu_style' WHERE id='".$_SESSION['user_id']."' LIMIT 1")) json(false,3);

json(true,24);