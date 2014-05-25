<?php
include("include/config.php");
require_once("include/DB.class.php");
$DB = new Mysqlidb(DBHOST,DBUSER,DBPASS,DBNAME);


if(!$id) {
	
}
include("include/header.php");
?>



<?php
include("include/footer.php");
?>