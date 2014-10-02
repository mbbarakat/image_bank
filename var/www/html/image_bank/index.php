<?php 
	include "inc/loadincludes.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<title>Image Bank</title>
		<meta name="description" content="" />
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
	<?php 
		if(!isset($_SESSION["user_name"])){
			header("Location:" . SITE_ROOT . MEMBER_LOGIN);
			exit();
		}else{ 
			header("Location:" . SITE_ROOT . MEMBER_LOGGED);
			exit();
		}
	?>
	
</body>
</html>