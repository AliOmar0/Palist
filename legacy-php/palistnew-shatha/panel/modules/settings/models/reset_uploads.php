<?php
$defaults=array(	
			'support.jpg',
			'notification.mp3',			
			'loading.gif',			
			'corrupted.png',			
			'corrupted.webp',			
			'default_fav.png',			
			'default_logo.png',			
			'default_profile.png',			
			'facebook.jpg',			
			'file.png',			
			'filepicked.png',			
			'files.png',			
			'nointernet.png',			
			'noPermission.png',			
			'provision.png',			
			'provision_logo.png',			
			'provision_logo_web.png',			
			'slogan_provision.png',			
			'photo.png',			
			'photos.png',
			'download_android.png',
			'download_ios.png'
		);


	$fileSystemIterator = new FilesystemIterator(target_dir);

	$counter=0;
	foreach ($fileSystemIterator as $fileInfo){
		$fileName=$fileInfo->getFilename();
		if(!in_array($fileName,$defaults)){
			trash(target_dir.$fileName);
			$counter++;
			}
	}
	
	fonts(true);
	indexer(target_dir);

	$counter2=0;
	if(file_exists(_protected)){

		$fileSystemIteratorProtected = new FilesystemIterator(_protected);

		
		foreach ($fileSystemIteratorProtected as $fileInfo){
			$fileName=$fileInfo->getFilename();
				trash(_protected.$fileName);
				$counter2++;
		}
	}
	
	indexer(_protected);
	$ht=fopen(_protected.'.htaccess','w');
	fwrite($ht,'Deny from  all');
	fclose($ht);



     mysqli_query($conn,"DELETE FROM fonts_1582219344");
    mysqli_query($conn,"DELETE FROM files_1577206823");
    mysqli_query($conn,"DELETE FROM uploader_1585790561");

	json(true,2,NULL,'Cleaned '.$counter.' normal files & '.$counter2.' protected files.');