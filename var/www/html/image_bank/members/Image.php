<?php
 
class Image
{
  function __construct($fileId) {
    	$imageBasePath = BASEIMAGEPATH . $fileId . '/';
    	$files = scandir($imageBasePath);
    	$image = $files[2];
    	$imagePath = $imageBasePath . $image;
    	print("<img src='$imagePath' />");
   }
}

?>