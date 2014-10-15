<?php
 
class Image
{
  function __construct($fileId) {
    	$imageBasePath = BASEIMAGEPATH . $fileId . '/';
    	$files = scandir($imageBasePath);
    	$image = $files[2];
    	$imagePath = $imageBasePath . $image;

		$statement = $GLOBALS['db']->prepare("SELECT * FROM file WHERE fileid=? LIMIT 1");
	    $statement->execute(array($fileId));

	    //Gets result.
	    $image = $statement->fetchAll(PDO::FETCH_ASSOC);

		if (file_exists($imagePath)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: image/jpeg'); //Show Image
		    //header('Content-Type: application/octet-stream'); //Download image
		    header('Content-Disposition: inline; filename='. $image[0]['filename']);
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