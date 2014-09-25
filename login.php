<?php

include("inc/loadincludes.php");

?>
<html>
<head>
	<title>Login</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<div id="wrapper">
		<header id="header">
			<h1>Login</h1>
		</header><!-- .header -->

		<div class="login">
			<form class="logform" action="login.php" method="post">
				<input type="hidden" name="submitted" value="TRUE" />
				<p><b>Username:</b><br /> <input type="text" name="user_name" size="20" maxlength="40" /></p>
				<p><b>Password:</b><br /> <input type="password" name="user_pw" size="20" maxlength="20" /></p>
				<p><input type="submit" name="submit" value="Login" /></p>
				<br />
				<br />
				<a href="register.php" class="link"><b>Register</b></a>
			</form>
			<?php

			if(isset($_POST['submitted'])){
				//Errors array
				$errors = array();

				//Checks for username.
				if(empty($_POST["user_name"])){
					$errors[] = "Username field is empty.";
				}else{
					$user = $_POST["user_name"];
				}

				//Checks for password.
				if(empty($_POST["user_pw"])){
					$errors[] = "Password field is empty.";
				}else{
					$pw = $_POST["user_pw"];
					$pw = genenrate_password($pw);
				}

				//Checks for match.
				if(empty($errors)){
					$statement = $db->prepare("SELECT * FROM user WHERE username=? AND password=?");
					$statement->execute(array($user, $pw));

					$results = $statement->fetchAll(PDO::FETCH_ASSOC);

					if($results){
						session_name("sup");
						session_set_cookie_params(0, "", "");	
						session_start();
						$_SESSION["user_name"] = $_POST["user_name"];
						
						header("Location:" . SITE_ROOT . MEMBER_LOGGED);
						//header("Location" . SITE_ROOT)

						exit();

					}else{
						$errors[] = "Username and password did not match.";
					}
				}
			}else{
				$errors = NULL;
			}


			//Page content.
			if(!empty($errors)){
				echo '<div id="errorMsg"><h2 id="mainhead">Error!</h2>
				<p class="error">The following error(s) occurred:<br />';
				
				foreach($errors as $msg)
				{
					
					echo " - $msg<br />\n";
				}
				
				echo '</p><p>Please try again.</p>';
				echo '</div>';
			}

			//Login form.
			?>
		</div>
	</div>
</body>
</html>