<?php

try{
	//Connecting
	global $db;
	$db = new PDO(DB_CONSTRING, DB_USER, DB_PASS);

	//Error handler.
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//Charset to utf8.
	$db->exec("SET CHARACTER SET utf8");
}

//Error cather.
catch(PDOException $e){
	echo $e->getMessage();
	exit();
}