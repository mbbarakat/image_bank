<?php

//This is the array with all includes.
$includesArray = array(
	"../inc/config.php",
	"../inc/db.php",
	"../inc/SHA.php",
	"classes/Image.php",
	"session.php"
);

for ($i=0; $i < count($includesArray); $i++) { 
	include($includesArray[$i]);
}
