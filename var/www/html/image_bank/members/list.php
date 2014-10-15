<?php

include("inc/loadincludes.php");

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

for ($i=0; $i < count($images); $i++) { 
	//echo '<a href="image.php?id=' . $images[$i]['fileid'] . '">' . $images[$i]['title'] . '</a><br>';
	$href = "";
	$href = '<a href="image.php?id=';
	$href.= $images[$i]['fileid'];
	$href.= '">';
	$href.= $images[$i]['title'];
	$href.= '</a><br/>';
	echo $href;
	//echo '<img src="image.php?id=' . $images[$i]['fileid'] . '">';
}

include ("html_tail.html");

?>