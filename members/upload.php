<?php

include("session.php");
include("../inc/config.php");
include("../inc/db.php");

//If user isn't logged in.
if(!isset($_SESSION["user_name"])){
	header("Location:" . SITE_ROOT . MEMBER_LOGIN);
	exit();
}

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
		$statement = $db->prepare("INSERT INTO file (title, description, filename) 
											VALUES (?, ?, ?)");
		$statement->execute(array($title, $description, $image));

		$fileId = $db->lastInsertId();

    	$path = '../img/' . $fileId . '/';
    	if(!file_exists($path)){
			mkdir($path, 0777, true);
    	}

		move_uploaded_file($_FILES["postImage"]["tmp_name"], $path . '/' . $image);

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