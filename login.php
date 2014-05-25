<?php 
session_start(); 

if(isset($_POST["email"]) && isset($_POST["password"])) {
  //doLogin
  include_once("include/config.php");
  require("include/DB.class.php");
  include("include/password.php");
  $DB = new Mysqlidb(DBHOST,DBUSER,DBPASS,DBNAME);
  $hash = password_hash($_POST["password"],PASSWORD_BCRYPT);
  $DB->where("email",$_POST["email"]);
  $row = $DB->getOne("users");
  if($row["id"]) {
    if(password_verify($_POST["password"],$row["uhash"])) {
      return true;
    } else {
      unset($_SESSION);
      return false;
    }
  } else {
    unset($_SESSION);
    return false;
  }
}
include("include/header.php"); ?>
<style>
@import url(http://weloveiconfonts.com/api/?family=brandico|entypo|openwebicons|zocial);

/* brandico */
[class*="brandico-"]:before {
  font-family: 'brandico', sans-serif;
}

/* entypo */
[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
}

/* openwebicons */
[class*="openwebicons-"]:before {
  font-family: 'OpenWeb Icons', sans-serif;
}

/* zocial */
[class*="zocial-"]:before {
  font-family: 'zocial', sans-serif;
}

.form-signin{
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}


.login-input {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.login-input-pass {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}


.signup-input {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

.signup-input-confirm {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}



.create-account {
  text-align: center;
  width: 100%;
  display: block;
}

.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.btn-center{
  width: 50%;
  text-align: center;
  margin: inherit;
}

.social-login-btn {
  margin: 5px;
  width: 20%;
  font-size: 250%;
  padding: 0;
}

.social-login-more {
  width: 45%;
}

.social-google {
  background-color: #da573b;
  border-color: #be5238;
}
.social-google:hover{
  background-color: #be5238;
  border-color: #9b4631;
}

.social-twitter {
  background-color: #1daee3;
  border-color: #3997ba;
}
.social-twitter:hover {
  background-color: #3997ba;
  border-color: #347b95;
}

.social-facebook {
  background-color: #4c699e;
  border-color: #47618d;
}
.social-facebook:hover {
  background-color: #47618d;
  border-color: #3c5173;
}

.social-linkedin {
  background-color: #4875B4;
  border-color: #466b99;
}
.social-linkedin:hover {
  background-color: #466b99;
  border-color: #3b5a7c;
}
</style>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">

<div class="container">
  <div class="col-lg-12">
      
      <script id="metamorph-1-start" type="text/x-placeholder"></script><script id="metamorph-21-start" type="text/x-placeholder"></script>

	<div class="container text-center">
	    <form class="form-signin" data-ember-action="2" action="login.php" method="POST">
	    	<h2 class="form-signin-heading">Sign in</h2>


		    <small class="text-muted">Sign in with your email and password</small>
		    <br><br>
	    	
	        <input id="ember360" name="email" class="ember-view ember-text-field form-control login-input" placeholder="Email Address" type="email">
	        <input id="ember361" name="password" class="ember-view ember-text-field form-control login-input-pass" placeholder="Password" type="password">

	        <script id="metamorph-22-start" type="text/x-placeholder"></script><script id="metamorph-22-end" type="text/x-placeholder"></script>

	        <button class="btn btn-lg btn-primary btn-block btn-center" type="submit" data-bindattr-3="3">Sign in</button>
	        <br>
	        <small class="create-account text-muted">Dont have an account? <a id="ember363" class="ember-view btn btn-sm btn-default" href="register.php">Sign Up </a> </small>
	    </form>
    </div></div>
 <?php include("include/footer.php"); ?>