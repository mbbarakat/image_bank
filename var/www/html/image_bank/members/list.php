<?php

include("inc/loadincludes.php");

//If user isn't logged in.
if(!isset($_SESSION["user_name"])){
	header("Location:" . SITE_ROOT . MEMBER_LOGIN);
	exit();
}

//Get all images.
$statement = $GLOBALS['db']->query("SELECT * FROM file");
$statement->execute();

$images = $statement->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$errors = array();
	$fileId = $_POST["hiddenFormId"];
	$title = $_POST["hiddenFormTitle"];
	$description = $_POST["hiddenFormDescription"];
	$filename = $_POST["hiddenFormFilename"];

    if(isset($_POST['update'])) {
		if(empty($_POST["title"])){
			$errors[] = "Title field is empty.";
		}else{
			$title = $_POST["title"];
		}

		if(empty($_POST["description"])){
			$errors[] = "Description field is empty.";
		}else{
			$description = $_POST["description"];
		}

		if(empty($_POST["filename"])){
			$errors[] = "Filename field is empty.";
		}else{
			$filename = $_POST["filename"] . "." . $_POST['type'];
		}

		//Update DB columns
	    $statement = $GLOBALS["db"]->prepare("UPDATE file 
	    									SET title = ?, description = ?, filename = ? 
	    									WHERE fileid = ?");

		$statement->execute(array($title, $description, $filename, $fileId));

		header("Location:" . "list.php");
    }
}

include("html_head.html");
?>

<div id="background" class="background"></div>
<div id="popup" class="popup">
	<form class="imageDetails" method="post">
		<input type="hidden" name="hiddenFormId" id="hiddenFormId" value="TRUE"/>
		<input type="hidden" name="hiddenFormTitle" id="hiddenFormTitle" value="TRUE"/>
		<input type="hidden" name="hiddenFormDescription" id="hiddenFormDescription" value="TRUE"/>
		<input type="hidden" name="hiddenFormFilename" id="hiddenFormFilename" value="TRUE"/>
		<p><b>Filename:</b><br /> <input type="text" name="filename" id="formFilename" class="enabled" size="20" maxlength="20" /></p>
		<p><b>Title:</b><br /> <input type="text" name="title" id="formTitle" class="enabled" size="20" maxlength="20" /></p>
		<p><b>Description:</b><br /> <textarea style="resize:none" cols="40" rows="4" name="description" id="formDescription" class="enabled"></textarea>
		<br>
		<p><b>Type:</b><br /> <input type="text" name="type" id="formType" class="disabled" size="20" maxlength="20" DISABLED/></p>
		<p><b>Size:</b><br /> <input type="text" name="size" id="formSize" class="disabled" size="20" maxlength="20" DISABLED/></p>
		<p><b>Width:</b><br /> <input type="text" name="width" id="formWidth" class="disabled" size="20" maxlength="20" DISABLED/></p>
		<p><b>Height:</b><br /> <input type="text" name="height" id="formHeight" class="disabled" size="20" maxlength="20" DISABLED/></p>
		<p><b>Uploaded:</b><br /> <input type="text" name="uploaded" id="formUploaded" class="disabled" size="20" maxlength="20" DISABLED/></p>
		<p><b>Last Updated:</b><br /> <input type="text" name="updated" id="formupdated" class="disabled" size="20" maxlength="20" DISABLED/></p>
		<?php echo '<a href="#" id="formDownload"><img src="image.php?id=' . $images[0]['fileid'] . "&label=" . "_small" . "&ext=" . $images[0]['type'] . '" id="formImage"></a>';?>
		<p class="formSubmit"> <input type="button" value="Cancel" onclick="hidePopup()" /> </p> 
		<p class="formSubmit"> <input type="submit" value="Submit" onclick="hidePopup()" name="update"/></p>
	</form>
</div>
<?php

echo ("<h2>Images</h2>");

?>
<div class="list">
	<ul>
<?php

for ($i=0; $i < count($images); $i++) {
	$image = htmlspecialchars(json_encode($images[$i]), ENT_QUOTES, 'UTF-8');
	?>
		<li><?php echo '<a href="#" onclick="imageClicked('. $image .')"><img src="image.php?id=' . $images[$i]['fileid'] . "&label=" . "_thumb" . "&ext=" . $images[$i]['type'] . '"></a>';?></li>
	<?php
}

?>
	</ul>
</div>
<?php

include ("html_tail.html");

?>