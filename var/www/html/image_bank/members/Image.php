<?php

include("../inc/config.php");
include("../inc/db.php");
include('classes/Image.php');

$id = $_GET['id'];

$image = new Image($id);

?>