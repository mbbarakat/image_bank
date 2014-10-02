<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<?php

include('Image.php');
include("session.php");
include("../inc/config.php");
include("../inc/db.php");

//If user isn't logged in.
if(!isset($_SESSION["user_name"])){
	header("Location:" . SITE_ROOT . MEMBER_LOGIN);
	exit();
}

include("html_head.html");

echo ("<h2>Images</h2>");

//Get all images.
$statement = $GLOBALS['db']->query("SELECT * FROM file");
$statement->execute();

$images = $statement->fetchAll(PDO::FETCH_ASSOC);

//$image = new Image(44);

for ($i=0; $i < count($images); $i++) { 
	echo '<a href="#" onclick="showImage(' . $images[$i]['fileid'] .')">' . $images[$i]['title'] . '</a><br>';
}

function showImage($fileId){
	$image = new Image($fileId);
}

include ("html_tail.html");

?>