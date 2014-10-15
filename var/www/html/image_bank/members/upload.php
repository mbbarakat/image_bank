<?php

include("inc/loadincludes.php");

//If user isn't logged in.
if(!isset($_SESSION["user_name"])){
	header("Location:" . SITE_ROOT . MEMBER_LOGIN);
	exit();
}

include("html_head.html");

echo ("<h2>Upload New Image</h2>");

//HTML form for uploading new image.
?>
<form enctype = "multipart/form-data" action="" method="post" name="post">
	<p>Title:<br />
		<input name="postTitle" type="text" size="45" />
	</p>

	<p>Description:<br />
		<input name="postDescription" type="text" size="45" />
	</p>

	<p>Image:<br />
	<input type="file" name="postImage" />
	</p>
 
	<input name="add_image" type="submit" value="Upload"/>
</form>

<?php

if(isset($_POST['add_image'])){
	//Errors array
	$errors = array();

	//Checks for title.
	if(empty($_POST["postTitle"])){
		$errors[] = "Title field is empty.";
	}else{
		$title = $_POST["postTitle"];
	}

	//Checks for description.
	if(empty($_POST["postDescription"])){
		$errors[] = "Description field is empty.";
	}else{
		$description = $_POST["postDescription"];
	}

	//Checks for image.
	if(empty($_FILES["postImage"]["name"])){
		$errors[] = "No image selected.";
	}else{
		$image = $_FILES["postImage"]["name"];
	}

	//Uploads image
	if(empty($errors)){
		//Get current owner id
		$username = $_SESSION["user_name"];

		$statement = $GLOBALS['db']->prepare("SELECT * FROM user WHERE username=? LIMIT 1");
		$statement->execute(array($username));

		$ownerId = $statement->fetchAll(PDO::FETCH_ASSOC);

		//Get image info
		$info = getimagesize($_FILES["postImage"]["tmp_name"]);
		$size = $_FILES["postImage"]["size"];

		$imageWidth = $info[0];
		$imageHeight = $info[1];

		$imagePath = $_FILES['postImage']['name'];
		$ext = pathinfo($imagePath, PATHINFO_EXTENSION);

		$currentDate = $today = date("F j, Y, g:i a");

	    //Upload image
		$statement = $db->prepare("INSERT INTO file (title, description, filename, owner, width, height, size, type, uploaded) 
											VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$statement->execute(array($title, $description, $image, $ownerId[0]['userid'], $imageWidth, $imageHeight, $size, $ext, $currentDate));

		$fileId = $db->lastInsertId();
		$fileName = basename($_FILES['postImage']['name']);
  		$fileFormat = substr($fileName, strrpos($fileName, '.') + 1);

    	$imagePath = BASEIMAGEPATH . $fileId . '/';

    	if(!file_exists($imagePath)){
			mkdir($imagePath, 0775, true);
    	}

		//move_uploaded_file($_FILES["postImage"]["tmp_name"], $imagePath . '/' . $image);
		move_uploaded_file($_FILES["postImage"]["tmp_name"], $imagePath . $fileId . '.' . $fileFormat);

		header("Location:" . SITE_ROOT . MEMBER_LOGGED);
    	exit();
	    }

}else{
	$errors = NULL;
}

//Page content.
if(!empty($errors)){
	echo '<div id="errorMsg"><h1 id="mainhead">Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	
	foreach($errors as $msg)
	{
		echo " - $msg<br />\n";
	}
	
	echo '</p><p>Please try again.</p>';
	echo '</div>';
}

include ("html_tail.html");