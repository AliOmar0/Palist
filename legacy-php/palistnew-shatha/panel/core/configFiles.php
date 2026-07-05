<?php
// Photo Handle info [Start]
//======================================================================
//-----------------------------------------------------
//  Photo Upload
//-----------------------------------------------------
//return type single or multi
//input_name which is set in the form
//file extention has to be array
//target dir, must be a defined in config.php


function gdImg($source){
	 $info=getimagesize($source);
	
	switch($info['mime']){
			case'image/jpeg':$img=imagecreatefromjpeg($source);break;
			case'image/gif':$img=imagecreatefromgif($source);break;
			case'image/webp':$img=imagecreatefromwebp($source);break;
			case'image/png':$img=imagecreatefrompng($source);break;
	}

	return $img;
}

function pdf($file_name,$xy=100){
	$file_name_thumb=$file_name.'_thumb.jpg';
	if(!file_exists(target_dir.$file_name_thumb)){	
		$pdfThumb=new imagick();
		$pdfThumb->setResolution($xy,$xy);
		$pdfThumb->readImage(target_dir.$file_name);
		$pdfThumb->setImageFormat('jpg');
//		$pdfThumb->setImageCompressionQuality(100);
		$fp=target_dir.$file_name_thumb;
		$pdfThumb->writeImage($fp);
	}
	return $file_name_thumb;
}


function avgColor($image,$path=NULL){
	if($path!=NULL){
		$image=gdImg($path);
	}
	
	if($image==false)return NULL;
	
    $scaled = imagescale($image, 100, 100, IMG_BILINEAR_FIXED); 
    $index = imagecolorat($scaled, 0, 0);
    $rgb = imagecolorsforindex($scaled, $index); 
    $red = round(round(($rgb['red'] / 0x33)) * 0x33); 
    $green = round(round(($rgb['green'] / 0x33)) * 0x33); 
    $blue = round(round(($rgb['blue'] / 0x33)) * 0x33); 
    return sprintf('#%02X%02X%02X', $red, $green, $blue); 
 }


function upload_file($return_type,$input_name,$file_extentions_array,$target_dir=target_dir,$module=NULL,$protected_file=false){
global $conn,$settings,$date_created,$admin_add_id,$module;


	
	if($protected_file)$target_dir=_protected;
	
	if(isset($_SESSION['user_id']))
		$user_id=$_SESSION['user_id'];
	else
		$user_id=NULL;
	
	if(isset($_SESSION['module_id']))
		$module_id=$_SESSION['module_id'];
	else
		$module_id=NULL;
	
	
//	$related_module_id=NULL;
	if($module==NULL){
		$related_module=0;
//		$related_module_id=NULL;
	}
	else {
		$related_module=mid($module);
		if($related_module==NULL)
			$related_module=0;
//		if(isset($id) && $id!=NULL && $id!=0){
//			$related_module_id=$id;
//		}
	}
	
	
$file_name_array=NULL;
for($i=0;$i<count($_FILES[$input_name]['name']);$i++){

	$file_size=$_FILES[$input_name]["size"][$i];
	$originalName=slugify($_FILES[$input_name]["name"][$i]);
	$target_file = str_replace(' ', '_', $_FILES[$input_name]["name"][$i]);
	
	$target_file=explode('.',$target_file); 
	$target_file[0]=time().rand();
	$extension=strtolower(end($target_file));
	$fileName=$target_file[0];
	$target_file=$fileName.'.'.$extension;
	
    $FileType=pathinfo($target_dir.$target_file, PATHINFO_EXTENSION);

    if($file_size>$settings['max_upload_size'])json(false,20);

    // Allow certain file formats
    else if(!in_array($FileType,$file_extentions_array))json(false,21);
	
	else {
		if($extension=='heic' || $extension=='HEIC'){
			$extension='jpg';
			$image_to_convert = new Imagick($_FILES[$input_name]["tmp_name"][$i]);
			$image_to_convert->setFormat("jpg");
			$target_file=$fileName.'.'.$extension;
			$__result=$image_to_convert->writeImage($target_dir.$target_file);
			$image_to_convert->clear(); 
			$image_to_convert->destroy();
			if($__result==false)json(false,22);

		}else{
			if(!move_uploaded_file($_FILES[$input_name]["tmp_name"][$i],$target_dir.$target_file))json(false,22);
		}
    }
	

//	$single=$target_file;
	$file_name_array.=$fileName.',';
//	array_push($file_name_array,$target_file);

	
		$dbWidth=0;
		$dbHeight=0;
		$avg='';
	if(in_array($extension,$settings['photo'])){
		fixOrientation($target_dir,$target_file);
		$img=webp($target_dir.$target_file,$target_dir.$fileName.'.webp');
		if($img==false)$avg='';
		else $avg=avgColor($img);

		$type='photo';
		$picInfo=picInfo($target_file,NULL,$target_dir);
		$dbWidth=$picInfo['width'];
		$dbHeight=$picInfo['height'];
		}
	else if(in_array($extension,array('woff','ttf','otf')))$type='font';
	else $type='file';
	
	$fullName=$fileName.'.'.$extension;
	mysqli_query($conn,"INSERT INTO files_1577206823 (full_name,name,original_name,extension,width,height,quality,type,size,admin_add_id,date_created,average_color,protected_file,uploader_module_prefix,uploader_user_id,related_module) VALUE ('$fullName','$fileName','$originalName','$extension','$dbWidth','$dbHeight','100','$type','".mb(filesize($target_dir.$target_file))."','$admin_add_id','$date_created','".$avg."','".((int)$protected_file)."','$module_id','$user_id','$related_module')");	
	
//	d($module);
//	dq();
} //for loop

	
	return $return_type=='single'?$target_file:rtrim($file_name_array,',');
}


//-----------------------------------------------------
//  Create webp photos
//-----------------------------------------------------
function webp($source,$destination){
	
	 $info = getimagesize($source);
	
	 if(isset($info[0]) && $info[0]>4200){
	 	$source=target_dir.img(end(explode('/',$source)),4200,100);
		$info = getimagesize($source);
		
	 }
	  if ($info['mime'] == 'image/jpeg'){
		  try{
			  $img=imagecreatefromjpeg($source);
		  		@imagewebp($img,$destination,90);
		  } catch (Exception $e) {}
            }

    	else if ($info['mime'] == 'image/gif') {
		
			$img=imagecreatefromgif($source);
			imagepalettetotruecolor($img);
			imagealphablending($img, true);
			imagesavealpha($img, true);
			imagewebp($img,$destination,100);

            }
	
		else if ($info['mime'] == 'image/webp') {
			imagewebp(imagecreatefromwebp($source),$destination,100);
            }


        else if ($info['mime'] == 'image/png'){
			
			$img=imagecreatefrompng($source);
			imagepalettetotruecolor($img);
			imagealphablending($img, true);
			imagesavealpha($img, true);
			imagewebp($img,$destination,100);

		}
		else{
			return false;
		}
	
	return $img;
}

//-----------------------------------------------------
//  Picture full html return
//-----------------------------------------------------
function pic($img,$width=1200,$quality=100,$alt=NULL,$echo=true,$id=NULL,$class=NULL,$div=NULL,$fixedWidth=NULL,$fixedHeight=NULL,$protected=false){
	
	if($protected)$target_dir=_protected;
	else $target_dir=target_dir;
	
	if(file_exists($target_dir.$img)){
			if($id!=NULL)$id=" id=\"$id\" ";
			if($class!=NULL)$class=" class=\"$class\" ";
			$pic= "<picture $id $class>
			<source srcset=\"".($protected?dimgp($img,$width,$quality,true):uimg($img,$width,$quality,true))."\" type=\"image/webp\">
			<img".($fixedWidth==NULL?'':' width="'.$fixedWidth.'"')."".($fixedWidth==NULL?'':' height="'.$fixedHeight.'"')." loading=\"lazy\" src=\"".($protected?dimgp($img,$width,$quality):uimg($img,$width,$quality))."\" alt=\"".$alt."\" />
			$div
</picture>";
	if($echo)echo $pic;
	else return $pic;
	}else{
	
	if($echo)echo 'NA';
	else return 'NA';
	}
}

function picp($img,$width=1200,$quality=100,$alt=NULL,$echo=true,$id=NULL,$class=NULL,$div=NULL,$fixedWidth=NULL,$fixedHeight=NULL){
	return pic($img,$width,$quality,$alt,$echo,$id,$class,$div,$fixedWidth,$fixedHeight,true);
}


function bg($img,$width=1600,$quality=100,$echo=false,$style=true,$is_protected=false){
	if(file_exists(target_dir.$img)){
		$img_variant=img($img,$width,$quality,protected:$is_protected);
		$img_variant_webp=img($img,$width,$quality,true,protected:$is_protected);
		$info = getimagesize(target_dir.$img);
		$normal=$is_protected?protected_hasher($img,$img_variant):u.$img_variant;
		$webp=$is_protected?protected_hasher($img,$img_variant):u.$img_variant_webp;
		
		 /* Fallback */
		$fallback='background-image: url('.$normal.');';

  /* Chrome/Edge/Opera/Samsung, Safari will fallback to this as well */
		$webkit="background-image:-webkit-image-set(url('".$normal."') 1x,url('".$webp."') 1x);";
		
//  background-image: -webkit-image-set(url("platypus.png") 1x, url("platypus-2x.png") 2x);

  /* Standard use */
		$firefox="background-image:"."image-set('".$webp."' type('image/webp'),'".$normal."' type('".(isset($info['mime'])?$info['mime']:NULL)."'));";
//  background-image: image-set("platypus.png" 1x, "platypus-2x.png" 2x);
		
		
			$pic= ($style?'style="background-position:center;background-repeat:no-repeat;background-size:cover;':'').$fallback.$webkit.$firefox.($style?'"':'');
	if($echo)echo $pic;
	else return $pic;
	}else{
	
	if($echo)echo '';
	else return '';
		}
}


//-----------------------------------------------------
//  Photo fix orientation
//-----------------------------------------------------
function fixOrientation($directory,$file){
	$filen=explode(".",$file);
	$ext=end($filen);
	try {
		$exif=@exif_read_data($directory."/".$file);

		if(!isset($exif['Orientation']))return NULL;
		
		$orientation=$exif['Orientation'];
		

		if (isset($orientation) && $orientation!=1){
			$deg=NULL;
			switch($orientation){
				case 3:
				$deg=180;
				break;
				case 6:
				$deg=270;
				break;
				case 8:
				$deg=90;
				break;
			}

			if ($deg!=NULL) {
				// If png
				if ($ext == "png") {
					$img_new = imagecreatefrompng($directory.$file);
					$img_new = imagerotate($img_new, $deg, 0);
					// Save rotated image
					imagepng($img_new,$directory.$file,9);
				}else {
					$img_new = imagecreatefromjpeg($directory.$file);
					$img_new = imagerotate($img_new, $deg, 0);
					// Save rotated image
					imagejpeg($img_new,$directory.$file,100);
				}
			}
		}
	}catch (Exception $e) {
		}
}

//-----------------------------------------------------
//  photo resize
//-----------------------------------------------------
function uimg($file_name,$maxWidth=NULL,$quality=100,$webp=false,$frameHeight=NULL){
	return u.img($file_name,$maxWidth,$quality,$webp,$frameHeight);
}

function imgp($file_name,$maxWidth=NULL,$quality=100,$webp=false,$frameHeight=NULL){
	return img($file_name,$maxWidth,$quality,$webp,$frameHeight,true);
}

function dimgp($file_name,$maxWidth=NULL,$quality=100,$webp=false,$frameHeight=NULL){
	// m(img($file_name,$maxWidth,$quality,$webp,$frameHeight,true));
	return protected_hasher($file_name,img($file_name,$maxWidth,$quality,$webp,$frameHeight,true));
}

function img($file_name,$maxWidth=NULL,$quality=100,$webp=false,$frameHeight=NULL,$protected=false){
    #if null
	if($file_name==NULL || $file_name=="")return $file_name;
	
	$x=explode('.',$file_name);
	if($x!=false && NULL!==end($x) && end($x)=='gif')return $file_name;

	if($protected)$target_dir=_protected;
	else $target_dir=target_dir;
	
	$source=$target_dir.$file_name;
	#if the requested is webp, make one first
	
	if($webp==true){
		$file_name=explode('.',$file_name)[0].'.webp';
		if(!file_exists($target_dir.$file_name))
			webp($source,$target_dir.$file_name);
		$source=$target_dir.$file_name;
	}
	#if it exists
	
	if(!file_exists($source) && $webp==false) {
			return $file_name;
	}
    
    $info = getimagesize($source);
	
	if($info==FALSE){
		if($webp)return 'corrupted.webp';
		return 'corrupted.png';
	}
	
    list($width, $height) = $info;

    
    if($maxWidth!=NULL && $width>$maxWidth){
    $newwidth = $maxWidth;
    $newheight = (int)(($height/$width)*$newwidth) ;

    }
    
else{
    $newwidth = $width;
    $newheight = $height;
}

	$nameshit=$frameHeight==NULL ? $newheight:$frameHeight;
    $newName=$quality.'Q'.$newwidth.'W'.$nameshit.'H'.$file_name;
    $destination=$target_dir.$newName;
if(file_exists($destination))return $newName;
   
        if ($info['mime'] == 'image/jpeg'){
            $image = imagecreatefromjpeg($source);
            $imgExtFunc='imagejpeg';
            }

        else if ($info['mime'] == 'image/gif') {
			echo 'here';
            $image = imagecreatefromgif($source);
		//	var_dump($image);
            $imgExtFunc='imagegif';
            }
	
		else if ($info['mime'] == 'image/webp') {
            $image = imagecreatefromwebp($source);
            $imgExtFunc='imagewebp';
            }


        else if ($info['mime'] == 'image/png'){
            $image = imagecreatefrompng($source);
            
            if($quality>90)$quality=9;
            else $quality = (int)(($quality-10)/10);
            
            $imgExtFunc='imagepng';
            }

    $frame = imagecreatetruecolor($newwidth, $nameshit);
    
	//save transperancy
    imagealphablending( $frame, false );
    imagesavealpha( $frame, true );
    imageresolution($frame, $newwidth, $newwidth);
	
	$destX=0;
    imagecopyresampled($frame, $image, 0, $destX, 0, 0, $newwidth, $newheight, $width, $height);
    $imgExtFunc($frame, $destination, $quality);
	//var_dump($imgExtFunc($frame, $destination, $quality));

    return $newName;
    }

//-----------------------------------------------------
//  photo size
//-----------------------------------------------------
function picInfo($name,$width=NULL,$target_dir=NULL){
	if($width!=NULL)
		$name=img($name,$width);
	
	if($target_dir==NULL)$target_dir=target_dir;
	
	$img=getimagesize($target_dir.$name);
	return array('width'=>$img[0],'height'=>$img[1]);
}
//======================================================================


function mb($bytes, $to='M', $decimal_places = 5) {
    $formulas = array(
        'K' => round($bytes / 1024, $decimal_places),
        'M' => round($bytes / 1048576, $decimal_places),
        'G' => round($bytes / 1073741824, $decimal_places)
    );
    return isset($formulas[$to]) ? $formulas[$to] : 0;
}


function filers($resp,$fields){
	for($i=0;$i<count($fields);$i++){
		if($resp[$fields[$i]]!='')
			$resp[$fields[$i]]=u.img($resp[$fields[$i]],600,100);
	}
	return $resp;
}

// Photo Handle info [End]







#if mce
function fileFlipper($PostFileFieldName){
	
	$tmp=array();
	$tmp[$PostFileFieldName]=$_FILES[$PostFileFieldName];
	$_FILES=array();
	$_FILES[$PostFileFieldName]=array();
	
	$keys=array_keys($tmp[$PostFileFieldName]);
	
	for($i=0;$i<count($keys);$i++){
		$_FILES[$PostFileFieldName][$keys[$i]]=array();
		$_FILES[$PostFileFieldName][$keys[$i]][]=$tmp[$PostFileFieldName][$keys[$i]];
	}
	
	
}


function uploadProcessor($PostFileFieldName,$mce=false,$return=false){

	global $settings;
	$res=array();
	$fileGeneratedNames=NULL;
	
	if($mce){
		
		fileFlipper($PostFileFieldName);
		$sysname=upload_file('single',$PostFileFieldName,$settings['photo'],target_dir);
		$img=img($sysname,1200,100,false);

		echo json_encode(array('location'=>$img));
	}

	else{
		
		
		$imgs=upload_file('multiple',$PostFileFieldName,$settings['file'],target_dir);
		
		$imgs=explode(',',$imgs);
		
		for($i=0;$i<count($imgs);$i++){
			
		$tmp=o('files_1577206823',$imgs[$i],'name')[0];
			
			if($tmp['type']!='photo'){
				 $itsFile=true;
				$thumbnail_url=icon($tmp['extension']);
			}else{
				$img=img($tmp['full_name'],1200,100,false);
				$itsFile=false;
				$thumbnail_url=uimg($tmp['full_name'],200,100);
			}
		
	
		$res[]=array('url'=>$itsFile?u.$tmp['full_name']: u.$img,'desca'=>'','filename'=>$tmp['full_name'],'thumbnail_url'=>$thumbnail_url,'originalFileName'=>$tmp['original_name'],'name'=>$img[$i]);
			
			$fileGeneratedNames[]=$imgs[$i];
		
	}
		if($return)return array('files'=>$res,'databaseLine'=>implode(',',$fileGeneratedNames));
		else json(true,1,$res,NULL,array('js'=>'uploadedFile'));
	}
	
}

function download_content($url) {
	$url=str_replace(' ','%20',$url);
    $ch = curl_init();
    $timeout = 25;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Firefox 72.0");
    $data = curl_exec($ch);
    curl_close($ch);
	// mark($data);
    return $data;
}

function fileFromLink($url,$type='photo'){
	global $conn,$settings,$date_created,$admin_add_id;
	
	$content=download_content($url);
	if($content===false)return('');
	$originalName=clean(end(explode('/',$url)));
	
	$extension=strtolower(end(explode('.',$url)));
	if(!in_array($extension,$settings['photo'])){
		$extension=NULL;
	}
	$fileName=time().rand();
	$target_file=$fileName.'.'.$extension;
	file_put_contents(target_dir.$target_file, $content);
	if($extension==NULL){
		$size = getimagesize(target_dir.$target_file);
		if($size==NULL)return false;
		$extension = str_replace('.','',image_type_to_extension($size[2]));
		rename(target_dir.$target_file,target_dir.$target_file.$extension);
		$target_file=$target_file.$extension;
	}
	

	$fullName=$target_file;
	
	$picInfo=picInfo($target_file);
	// mark($picInfo);
	$dbWidth=$picInfo['width'];
	$dbHeight=$picInfo['height'];
	
	$avg=avgColor(NULL,target_dir.$target_file);

	// mark($avg);
	
	
	if(isset($_SESSION['user_id']))
		$user_id=$_SESSION['user_id'];
	else
		$user_id=NULL;
	
	if(isset($_SESSION['module_id']))
		$module_id=$_SESSION['module_id'];
	else
		$module_id=NULL;
	
	$tmp=$_POST;
	$_POST=[
		'full_name'=>$fullName,
		'name'=>$fileName,
		'original_name'=>$originalName,
		'extension'=>$extension,
		'width'=>$dbWidth,
		'height'=>$dbHeight,
		'quality'=>100,
		'type'=>$type,
		'size'=>mb(filesize(target_dir.$target_file)),
		'average_color'=>$avg,
		'uploader_module_prefix'=>$module_id,
		'uploader_user_id'=>$user_id
	];
	co('files_1577206823');
	r('files_1577206823');
	
	$_POST=$tmp;
	return $target_file;
}



function uploadNoPermission($json){
	if($json){
		json(true,1,array('url'=>u.'noPermission.png','desca'=>'','filename'=>'noPermission.png','thumbnail_url'=>u.'noPermission.png','name'=>'noPermission'),NULL,array('js'=>'uploadedFile'));
	}
	echo json_encode(array('location'=>'noPermission.png'));
}


function fa($files){
	$res=array();
	if($files=='')return;
	// d($files);
	$files=explode(',',$files);  
	// d($files);
	for($i=0;$i<count($files);$i++){
		// d(db('files_1577206823',"WHERE name='".$files[$i]."'",NULL,'LIMIT 1'));
		$res[]=db('files_1577206823',"WHERE name='".$files[$i]."'",NULL,'LIMIT 1')[0];
	}
	// d($res);
	return $res;
}


function ownRelatedFiles($_module,$_id){
	global $conn;
	$___fields=db('module_fields',"WHERE module_id='".mid($_module)."' AND protected_file=1 AND deleted=0");
	if($___fields!=1){
		$___tmp=db($_module,"WHERE id=$_id",NULL,'LIMIT 1');
		if($___tmp!=1){
			foreach($___fields as $field){
				if($___tmp[0][$field['field_name']]!='' && $___tmp[0][$field['field_name']]!=NULL){
					if($field['multi_files']==0)
						mysqli_query($conn,"UPDATE files_1577206823 SET related_module_id=$_id WHERE full_name='".$___tmp[0][$field['field_name']]."' LIMIT 1");
					else{
						$___files=fa($___tmp[0][$field['field_name']]);
						if(!empty($___files)){
							foreach($___files as $file){
								mysqli_query($conn,"UPDATE files_1577206823 SET related_module_id=$_id WHERE name='".$file['name']."' LIMIT 1");
							}
						}
					}
				}
			}
		}
	}
}



function imgOnImg($frame,$img,$posX,$posY,$newWidth,$newHeight,$destination=NULL,$objShape='square'){
	global $conn,$settings,$date_created,$admin_add_id;
	
    //Get the actual image size 
    list( $w, $h, $t, $a )=getimagesize($img);
    $opacity=100;

    //x,y where to place image of girl
    $x=0;
    $y=0;

    //Create source images to manipulate
    $target = imagecreatefromjpeg($frame);
	if($objShape=='square'){
		$img_new=resize_image($img,$newWidth,$newHeight);
//		$img_new = imagecreatefromjpeg($img);
		
	}
	elseif($objShape=='circle'){
		$img_new=resize_image($img,$newWidth,$newHeight,true);
		$img_new=circle($img_new,$newWidth,$newHeight);
	}
	$copy = imagecreatetruecolor($newWidth,$newHeight );
	
    //Resize image of girl to fit viewport of camera
	if($objShape=='square')
    	imagecopyresampled( $copy, $img_new, 0, 0, 0, 0, $newWidth, $newHeight, $w, $h );

	//Merge the two images to form desired result
    imagecopymerge( $target, $img_new, $posX, $posY, $x, $y, $newWidth, $newHeight, $opacity );

	$tmp=$target;
	imagedestroy( $target );
	imagedestroy( $copy );
	imagedestroy( $img_new );
	
	if($destination==NULL){
		header('Content-Type: image/png');
		imagepng($tmp);
	}
#!record in files database so we keep track of files 
	else{
		imagejpeg($tmp,$destination,100);
		return end(explode('/',$destination));
	}
    
}


function resize_image($resource, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($resource);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
//    $src = imagecreatefromjpeg($resource);
    $src = gdImg($resource);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}


function circle($target,$w,$h){
	
	
	// Step 1 - Start with image as layer 1 (canvas).
//	$img1 = ImageCreateFromjpeg($target);
	$img1 = $target;
//	list( $original_w, $original_h, $original_t, $original_a )=getimagesize($img);
	$x=$w;
	$y=$h;
	// Step 2 - Create a blank image.
	$img2 = imagecreatetruecolor($w, $h);
	$bg = imagecolorallocate($img2, 255, 255, 255); // white background
	imagefill($img2, 0, 0, $bg);
	// Step 3 - Create the ellipse OR circle mask.
	$e = imagecolorallocate($img2, 0, 0, 0); // black mask color
	// Draw a circle mask
	$r = $x <= $y ? $x : $y; // use smallest side as radius & center shape
	imagefilledellipse ($img2, ($x/2), ($y/2), $r, $r, $e); 
	// Step 4 - Make shape color transparent
	imagecolortransparent($img2, $e);
	// Step 5 - Merge the mask into canvas with 100 percent opacity
	imagecopymerge($img1, $img2, 0, 0, 0, 0, $x, $y, 100);
	// Step 6 - Make outside border color around circle transparent
	imagecolortransparent($img1, $bg);

	$tmp=$img1;
	imagedestroy($img2); // kill mask first
	imagedestroy($img1); // kill canvas last
	return $img1;
}