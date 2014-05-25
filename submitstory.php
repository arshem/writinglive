<?php
if(isset($_POST["storytext"]) && isset($_POST["title"]) && isset($_POST["category"]) && isset($_POST["rating"])) {
	include_once("include/config.php");
	require("include/DB.class.php");
	$DB = new Mysqlidb(DBHOST,DBUSER,DBPASS,DBNAME);
	$params = array(
		'title' => $_POST["title"],
		'story' => $_POST["storytext"],
		'category' => $_POST["category"],
		'rating' => $_POST["rating"]
		);
	$id = $DB->insert("stories",$params);
	echo "Story Saved!";exit;
} else {
	echo "ERROR: All fields are required!";exit;
}
?>