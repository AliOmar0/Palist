<?php
require'core/config.php';
 
if (!isset($_SESSION))session_start();

include(cd.'custom_logout.php');

//cookies
if(isset($_COOKIE['legion']) && logged($_SESSION['module_id'])){
    list ($user_id,$token,$module_id, $hash) = explode(':', $_COOKIE['legion']);
	$token=escape($token);
	
	mysqli_query($conn,"DELETE FROM cookies_1565697908 WHERE user_id='".$_SESSION['user_id']."' AND module_id='".$_SESSION['module_id']."' AND token='$token' LIMIT 1");

    setcookie('legion','',time()-1000,'/',NULL,$settings['http'],true);
	unset($_COOKIE["legion"]); 	
}
//cookies

logout();



// if(isset($_GET['location']))
// 	header('Location: '.$_GET['location']);
// else if(isset($_GET['url']))
// 	header('Location: '.$_GET['url']);
// else if(isset($_GET['link']))
// 	header('Location: '.$_GET['link']);
// else 
	header("Location: ".url);