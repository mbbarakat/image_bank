<?php

include("inc/loadincludes.php");

if(!isset($_SESSION["user_name"])){
    if(isset($_POST['submittedLogin'])){
        //Checks for username.
        if(!empty($_POST["user_name"])){
            $user = $_POST["user_name"];
        }

        //Checks for password.
        if(!empty($_POST["user_pw"])){
            $pw = $_POST["user_pw"];
            $pw = genenrate_password($pw);
        }

        $statement = $db->prepare("SELECT * FROM user WHERE username=? AND password=?");
        $statement->execute(array($user, $pw));

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($results){
            session_name("sup");
            session_set_cookie_params(0, "", "");
            session_start();
            $_SESSION["user_name"] = $_POST["user_name"];
            
            ob_start();
            header("Location:" . SITE_ROOT . MEMBER_LOGGED);
            exit();
        }
    }

    if(isset($_POST['submittedSignup'])){
        $errors = array();
         //Checks for username.
        if(!empty($_POST["user_name_signup"])){
            $user = $_POST["user_name_signup"];

            $statement = $db->prepare("SELECT * FROM user WHERE username=? LIMIT 1");
            $statement->execute(array($user));

            //Gets result.
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        //Checks for password.
        if(!empty($_POST["user_pw_signup"])){
            $pw = $_POST["user_pw_signup"];
            $pw = genenrate_password($pw);
        }

        //Checks for name.
        if(!empty($_POST["full_name_signup"])){
            $name = $_POST["full_name_signup"];
        }

        if($results){
            $errors[] = "Invalid username, already taken.";
        }else{
            $statement = $db->prepare("INSERT INTO user (name, username, password) 
                                                VALUES (?, ?, ?)");
            $statement->execute(array($name, $user, $pw));

            header("Location:" . "#tologin");
            exit();
        }
    }
}else{
    header("Location:" . SITE_ROOT . MEMBER_LOGGED);
    exit();
}

?>
<html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login and Registration</title>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <section>               
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form class="logform" method="post">
                                <input type="hidden" name="submittedLogin" value="TRUE" />
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your username </label>
                                    <input id="username" name="user_name" required="required" type="text" placeholder="myusername"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="user_pw" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="login button"> 
                                    <input type="submit" name="submit" value="Login" />
                                </p>
                                <p class="change_link">
                                    Dont have an account yet?
                                    <a href="#toregister" class="to_register">Sign up</a>
                                </p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form class="logform" method="post">
                                <input type="hidden" name="submittedSignup" value="TRUE" />
                                <h1> Sign up </h1>
                                <p> 
                                    <label for="fullnamesignup" class="fullnamesignup" data-icon="u">Your name</label>
                                    <input id="fullnamesignup" name="full_name_signup" required="required" type="text" placeholder="Your name" />
                                </p>
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="user_name_signup" required="required" type="text" placeholder="Your username" />
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="user_pw_signup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p class="signin button"> 
                                    <input type="submit" value="Sign up"/> 
                                </p>
                                <p class="change_link">  
                                    Already a member ?
                                    <a href="#tologin" class="to_register"> Go and log in </a>
                                </p>
                            </form>
                            <?php
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
                </div>  
            </section>
        </div>
    </body>
</html>