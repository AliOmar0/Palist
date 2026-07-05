<?php
$_web=true;
$_POST['_d']=1;
$_POST['user_token']=isset($_SESSION['user_token'])?$_SESSION['user_token']:NULL;
include 'index.php';