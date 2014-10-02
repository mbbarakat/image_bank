<?php

//This is the array with all includes.
$includesArray = array(
	"members/session.php",
	"inc/config.php",
	"inc/db.php",
	"inc/SHA.php",
);

for ($i=0; $i < count($includesArray); $i++) { 
	include($includesArray[$i]);
}
