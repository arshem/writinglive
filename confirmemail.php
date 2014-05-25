<?php
session_start();
if($_REQUEST["email"] && $_REQUEST["code"]) {
	include("include/config.php");
	require_once("include/DB.class.php");
	$email = $_REQUEST["email"];
	$code = $_REQUEST["code"];
	$DB = new Mysqlidb(DBHOST,DBUSER,DBPASS,DBNAME);
	$result = $DB->where("email",$email)->getOne("confirm_email");
	if($result["code"] == $code) {
		$DB->where("email",$email);
		$DB->delete("confirm_email");
		$DB->where("email",$email);
		$data = array('confirmed'=>1);
		$DB->update("users",$data);
		$_SESSION["user"] = $DB->where("email",$email)->getOne("users");
		Header("Location: account.php");exit;
	} else {
		$msg = "Invalid Code/Email Combination";
	}
	unset($_REQUEST);
}
include("include/header.php");
?>
<div class="container">
	<div class="error"><?=$msg;?></div>
    <div class="row">
		<form role="form" class="col-md-9 go-right" method="POST" action="confirmemail.php">
			<h3>Enter your email address and code</h3>
		<div class="form-group">
			<input id="email" name="email" type="email" class="form-control" required>
			<label for="email">Email</label>
		</div>
		<div class="form-group">
			<input id="code" name="code" type="text" class="form-control" required>
			<label for="code">Code</label>
		</div>
		<div class="form-group">
			<button>Submit</button>
		</div>
		</form>
	</div>
</div>
<?php
include("include/footer.php");
?>