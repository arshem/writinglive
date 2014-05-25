<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Writing Live">

    <title>Writing Live - Watching writer's do what they do best</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/justified.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <div class="masthead">
        <h3 class="text-muted">Writing Live</h3>
        <ul class="nav nav-justified">
          <li class="active"><a href="index.php">Home</a></li>
          <?php if($_SESSION["userid"]) {?><li><a href="account.php">My Account</a></li><?php } else {?><li><a href="login.php">Start Writing</a></li><?php } ?>
          <li><a href="profiles.php">Start Watching</a></li>
          <li><a href="random.php">Random Writer</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>