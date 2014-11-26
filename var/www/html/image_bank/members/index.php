<?php 
	include "inc/loadincludes.php";
	include("html_head.html");

	if(!isset($_SESSION["user_name"])){
	header("Location:" . SITE_ROOT . MEMBER_LOGIN);
	exit();
	}
?>
	<form action="upload.php" class="dropzone" id="my-dropzone"></form>

<?php include ("html_tail.html"); ?>