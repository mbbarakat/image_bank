<?php 

include("inc/loadincludes.php");

$_SESSION = array();
session_destroy();
header("Location:" . SITE_ROOT . MEMBER_LOGIN);