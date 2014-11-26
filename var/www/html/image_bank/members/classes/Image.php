<?php
 
class Image
{
  	function __construct($fileId) {
	 	$imageBasePath = BASEIMAGEPATH . $fileId . '/';
	 	$files = scandir($imageBasePath);
  		$label = '';
  		$download = "false";
  		$ext = '';
		if (isset($_GET['label'])){
		    $label = $_GET['label'];
		}
		if (isset($_GET['ext'])){
		    $ext = $_GET['ext'];
		}
		if (isset($_GET['download'])){
		    $download = $_GET['download'];
		}

		//If there is a label, use that image, otherwise use the original.
		if(strlen($label) > 2){
		 	for ($i=0; $i < count($files); $i++) { 
			  	if($files[$i] == $fileId . $label . '.' . $ext){
			   		$image = $files[$i];
			  	}
			}
		}else{
			$image = $files[2];
		}

	 	$imagePath = $imageBasePath . $image;

  		$statement = $GLOBALS['db']->prepare("SELECT * FROM file WHERE fileid=? LIMIT 1");
    	$statement->execute(array($fileId));

     	//Gets result.
     	$image = $statement->fetchAll(PDO::FETCH_ASSOC);

		if (file_exists($imagePath)) {
			if($download == "true"){
		      	header('Content-Disposition: attachment; filename='. $image[0]['filename']); //Download Image
     		}else{
		      	header('Content-Disposition: inline; filename='. $image[0]['filename']); //Show Image
     		}
     			header('Content-Description: File Transfer');
		      	header('Content-Type: image/jpeg');
		      	//header('Content-Type: application/octet-stream'); //Download PHP
		      	header('Expires: 0');
		      	header('Cache-Control: must-revalidate');
		      	header('Pragma: public');
		      	header('Content-Length: ' . filesize($imagePath));
		      	readfile($imagePath);
		      	exit;
	  	}
   	}
}

?>