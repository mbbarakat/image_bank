<?php

include "inc/loadincludes.php";
include "createimage.php";

if (!empty($_FILES)) {
		$image = $_FILES["file"]["name"];

		//Get current owner id
		$username = $_SESSION["user_name"];

		$statement = $GLOBALS['db']->prepare("SELECT * FROM user WHERE username=? LIMIT 1");
		$statement->execute(array($username));

		$ownerId = $statement->fetchAll(PDO::FETCH_ASSOC);

		//Get image info
		$info = getimagesize($_FILES["file"]["tmp_name"]);
		$size = $_FILES["file"]["size"];

		$imageWidth = $info[0];
		$imageHeight = $info[1];

		$imagePath = $_FILES['file']['name'];
		$ext = pathinfo($imagePath, PATHINFO_EXTENSION);

		$currentDate = $today = date("F j, Y, g:i a");
		$title = "Enter Title";
		$description = "Enter Description";

	    //Upload image
		$statement = $db->prepare("INSERT INTO file (title, description, filename, owner, width, height, size, type, uploaded) 
											VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$statement->execute(array($title, $description, $image, $ownerId[0]['userid'], $imageWidth, $imageHeight, $size, $ext, $currentDate));

		$fileId = $db->lastInsertId();
		$fileName = basename($_FILES['file']['name']);
  		$fileFormat = substr($fileName, strrpos($fileName, '.') + 1);

    	$imagePath = BASEIMAGEPATH . $fileId . '/';

    	if(!file_exists($imagePath)){
			mkdir($imagePath, 0775, true);
    	}

		try {
		    move_uploaded_file($_FILES["file"]["tmp_name"], $imagePath . $fileId . '.' . $fileFormat);
		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		} finally {
		    resizeImage($imagePath, $fileId, '.' . $fileFormat, 100, '_thumb');
		    resizeImage($imagePath, $fileId, '.' . $fileFormat, 300, '_small');
		}
}

?>