<?php

switch($_POST["action"]) {
	case 'email':
		checkEmail();
	break;
	case 'username':
		checkUsername();
	break;
}

function checkEmail() {
	include("include/config.php");
	require_once("../include/DB.class.php");
	$DB = new Mysqlidb(DBHOST,DBUSER,DBPASS,DBNAME);	
	$DB->where("email",$_POST["email"]);
	$row = $DB->getOne("users");
	if($row) {
		echo "<strong>Already Exists!</strong>";
	} else {
		echo "<strong>Looks Good!</strong>";
	}
	exit;
}

function checkUsername() {
	include("include/config.php");
	require_once("../include/DB.class.php");
	$DB = new Mysqlidb(DBHOST,DBUSER,DBPASS,DBNAME);	
	$DB->where("uname",$_POST["username"]);
	$row = $DB->getOne("users");
	if($row) {
		echo "<strong>Already Exists!</strong>";
	} else {
		echo "<strong>Looks Good!</strong>";
	}
	exit;
}
exit;