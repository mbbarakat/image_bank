<?php

function genenrate_password($pass){
	$password_hash = '';

	$mysalt = "applepiesdelight";
	$password_hash= hash('SHA256', "-".$mysalt."-".$pass."-");

	return $password_hash;
}