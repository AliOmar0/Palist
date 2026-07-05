<?php

if(!mysqli_query($conn,"DELETE FROM connections_1565698558 WHERE id='1' LIMIT 1"))json(false,3);
if(!mysqli_query($conn,"INSERT INTO `connections_1565698558` (`id`) VALUES ('1');"))json(false,3);

json(true,2,NULL,'Reset connections successfully');