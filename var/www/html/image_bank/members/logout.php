<?php 

include("session.php");
include("../inc/config.php");
include("../inc/db.php");

$_SESSION = array();
session_destroy();
header("Location:" . SITE_ROOT . MEMBER_LOGIN);