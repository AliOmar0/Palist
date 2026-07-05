<?php
$resp=db('admins');
$c=$resp==1?0:count($resp);

$resp=db('privileges_1565709771',"WHERE id!=1");
$cc=$resp==1?0:count($resp);

mysqli_query($conn,"DELETE from admins WHERE id!=1");
mysqli_query($conn,"DELETE from admin_settings WHERE admin!=1");

mysqli_query($conn,"TRUNCATE TABLE privileges_1565709771");

mysqli_query($conn,"ALTER TABLE admins AUTO_INCREMENT=2");

json(true,2,NULL,"Erased $c admins and $cc privileges");