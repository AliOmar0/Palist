<?php
if(!isset($_POST['json']))
require'core/config.php';

if(isset($_POST['json']))$mce=false;else $mce=true;

if(logged()){
	uploadProcessor('file',$mce);
}else{
	uploadNoPermission('file',$mce);
}