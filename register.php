<?php

include("inc/loadincludes.php");

?>
<html>
<head>
	<title>Register</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<div id="wrapper">
		<header id="header">
			<h1>Register</h1>
		</header><!-- .header -->

		<div class="register">
			<form action="register.php" method="post">
				<input type="hidden" name="submitted" value="TRUE" />
				<p><b>Full Name:</b><br /> <input type="text" name="name" size="20" maxlength="40" /></p>
				<p><b>Username:</b><br /> <input type="text" name="user_name" size="20" maxlength="40" /></p>
				<p><b>Password:</b><br /> <input type="password" name="user_pw" size="20" maxlength="20" /></p>
				<p><input type="submit" name="submit" value="Register" /></p>
				<br />
				<br />
				<a href="login.php" class="link"><b>Login</b></a>
			</form>
			<?php

			if(isset($_POST['submitted'])){
				//Errors array
				$errors = array();

				//Checks for name.
				if(empty($_POST["name"])){
					$errors[] = "Full Name field is empty.";
				}else{
					$name = $_POST["name"];
				}

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

				//Creates user
				if(empty($errors)){
					$statement = $db->prepare("SELECT * FROM user WHERE username=? LIMIT 1");
				    $statement->execute(array($user));

				    //Gets result.
				    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

				    if($results){
				    	$errors[] = "Username is already taken.";
				    }
				    else{
				    	$statement = $db->prepare("INSERT INTO user (name, username, password) 
															VALUES (?, ?, ?)");
				    	$statement->execute(array($name, $user, $pw));

					//Return to admin page.
					header("Location:" . SITE_ROOT . MEMBER_LOGGED);
			    	exit();
				    }
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
			?>

		</div>
	</div>
</body>
</html>