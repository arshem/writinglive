<?php
if(isset($_POST["fname"])) {
	if(isset($_POST["fname"]) & isset($_POST["lname"]) & isset($_POST["email"]) & isset($_POST["email1"]) & isset($_POST["username"])) {
		include("include/config.php");
		require_once("include/DB.class.php");
		$DB = new Mysqlidb(DBHOST,DBUSER,DBPASS,DBNAME);
		include("include/password.php");
		$uhash = password_hash($_POST["pass"],PASSWORD_BCRYPT);
		if(!password_verify($_POST["pass"],$uhash)) {
			echo "Something went badly wrong!";exit;
		}
		$data = array (
			'fname' => $_POST["fname"],
			'lname' => $_POST["lname"],
			'uname' => $_POST["username"],
			'email' => $_POST["email"],
			'uhash' => $uhash,
			'created' => time(),
		);
		$id = $DB->insert("users",$data);
		$data = array (
			'user_id' => $id,
		);
		$DB->insert("users_profile",$data);

		include("include/PHPMailerAutoload.php");
		$mail = new PHPMailer;

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup server
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'writinglivecom@gmail.com';                            // SMTP username
		$mail->Password = 'yF98xm2r';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
		$mail->Port       = 587;
		$mail->From = 'writinglivecom@gmail.com';
		$mail->FromName = 'WritingLive.com';
		$mail->addAddress($_POST["email"], $_POST["fname"]." ".$_POST["lname"]);  // Add a recipient

		$mail->isHTML(true);   

		$uid = uniqid("", true);
	    $data = $namespace;
	    $data .= $_SERVER['REQUEST_TIME'];
	    $data .= $_SERVER['HTTP_USER_AGENT'];
	    $data .= $_SERVER['LOCAL_ADDR'];
	    $data .= $_SERVER['LOCAL_PORT'];
	    $data .= $_SERVER['REMOTE_ADDR'];
	    $data .= $_SERVER['REMOTE_PORT'];
	    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
	    $code =    
            substr($hash,  0,  8) . 
            '-' .
            substr($hash,  8,  4) .
            '-' .
            substr($hash, 12,  4) .
            '-' .
            substr($hash, 16,  4) .
            '-' .
            substr($hash, 20, 12);		
        $data = array ('email' => $_POST["email"],'code'=>$code,'created'=>time());
		$DB->insert("confirm_email",$data);

		$mail->Subject = 'WritingLive.com - Please confirm your email address.';
		$mail->Body    = str_replace(array(':url:',':fname:',':email:',':code:'),array(URL,$_POST["fname"],$_POST["email"],$code),file_get_contents("templates/confirm_email.html"));
		$mail->AltBody = 'Hi '.$_POST["fname"].",
		Please use the following link to confirm your registration. If you did not ask to be registered to www.writinglive.com, please ignore this email and your information will be out of the system within 24-48 hours.
		".URL."/confirmemail.php?email=".$_POST["email"]."&code=".$code."

		Best Wishes,
		Writing Live Staff";

		if(!$mail->send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
		}



		Header("Location: confirmemail.php");exit;
	} else {
		$error = "All fields on this page are required!";
	}
	unset($_POST);
}
include("include/header.php"); 
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,600);

.form-control{
    background: transparent;
}
form {
	width: 320px;
	margin: 20px;
}
form > div {
	position: relative;
	overflow: hidden;
}
form input, form textarea {
	width: 100%;
	border: 2px solid gray;
	background: none;
	position: relative;
	top: 0;
	left: 0;
	z-index: 1;
	padding: 8px 12px;
	outline: 0;
}
form input:valid, form textarea:valid {
	background: white;
}
form input:focus, form textarea:focus {
	border-color: #357EBD;
}
form input:focus + label, form textarea:focus + label {
	background: #357EBD;
	color: white;
	font-size: 70%;
	padding: 1px 6px;
	z-index: 2;
	text-transform: uppercase;
}
form label {
	-webkit-transition: background 0.2s, color 0.2s, top 0.2s, bottom 0.2s, right 0.2s, left 0.2s;
	transition: background 0.2s, color 0.2s, top 0.2s, bottom 0.2s, right 0.2s, left 0.2s;
	position: absolute;
	color: #999;
	padding: 7px 6px;
	font-weight: normal;
}
form textarea {
	display: block;
	resize: vertical;
}
form.go-bottom input, form.go-bottom textarea {
	padding: 12px 12px 12px 12px;
}
form.go-bottom label {
	top: 0;
	bottom: 0;
	left: 0;
	width: 100%;
}
form.go-bottom input:focus, form.go-bottom textarea:focus {
	padding: 4px 6px 20px 6px;
}
form.go-bottom input:focus + label, form.go-bottom textarea:focus + label {
	top: 100%;
	margin-top: -16px;
}
form.go-right label {
	border-radius: 0 5px 5px 0;
	height: 100%;
	top: 0;
	right: 100%;
	width: 100%;
	margin-right: -100%;
}
form.go-right input:focus + label, form.go-right textarea:focus + label {
	right: 0;
	margin-right: 0;
	width: 40%;
	padding-top: 5px;
}
</style>
<div id="error"><?=$error;?></div>
<script type="text/javascript" src="js/checkRegistration.js" language="javascript"></script>
    <div class="row">
		<form role="form" class="col-md-9 go-right" method="POST" action="register.php">
			<h2>Sign Up</h2>
		<div class="form-group">
			<input id="fname" name="fname" type="text" class="form-control" required>
			<label for="fname">First Name</label>
		</div>
		<div class="form-group">
			<input id="lname" name="lname" type="text" class="form-control" required>
			<label for="lname">Last Name</label>
		</div>
		<div class="form-group">
			<input id="username" name="username" type="text" class="form-control" required>
			<label for="username">Username</label>
			<span id="user-result"></span>
		</div>
		<div class="form-group">
			<input id="email" name="email" type="email" class="form-control" required>
			<label for="email">Email Address</label>
			<span id="email-result"></span>
		</div>
		<div class="form-group">
			<input id="email1" name="email1" type="email" class="form-control" required>
			<label for="email1">Confirm Email</label>
			<span id="confirm-result"></span>
		</div>
		<div class="form-group">
			<input id="pass" name="pass" type="password" class="form-control" required>
			<label for="pass">Password</label>
			<span id="passstrength"></span>
		</div>
		<div class="form-group">
			<input id="pass1" name="pass1" type="password" class="form-control" required>
			<label for="pass1">Confirm Password</label>
			<span id="confirm2-result"></span>
		</div>
		<div class="form-group">
			<!-- Captcha Goes Here -->
		</div>
		<div class="form-group">
			<button>Submit</button>
		</div>
		</form>
	</div>

<?php include("include/footer.php"); ?>