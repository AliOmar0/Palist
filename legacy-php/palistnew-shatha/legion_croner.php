<?php
if((isset($_SERVER['PHP_AUTH_USER'] ) && ($_SERVER['PHP_AUTH_USER'] == "provision" )) &&
      ( isset($_SERVER['PHP_AUTH_PW'] ) && ( $_SERVER['PHP_AUTH_PW'] == "croner")))
    {
	require 'panel/core/config.php';
	include panel_dir.'croner.php';	
}else{
	//username and password from user
        header("WWW-Authenticate: " .
            "Basic realm=\"ProVision Area\"");
        header("HTTP/1.0 401 Unauthorized");

        //Show failure text, which browsers usually
        //show only after several failed attempts
        print("This page is protected by ProVision Engine - Legion");
    }

