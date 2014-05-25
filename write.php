<?php session_start(); ?>
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "ws://localhost:9000/writinglive.com/server.php?id=".$_SESSION["userid"]; 	
	var websocket = new WebSocket(wsUri); 
	
	websocket.onopen = function(ev) { // connection is open 
		$('#message_box').html("<div class=\"system_msg\">Connected!</div>"); //notify user
	}

	$('#storytext').keyup(function(){ //use clicks message send button	
		var category = $('#category').val(); //get message text
		var title = $('#title').val(); //get user name
		var story1 = $('#storytext').val();
		
		if(story1 != "") {
			//prepare json data
			var msg = {
			story: story1,
			title: title,
			category: category
			};
			//convert and send data to server
			websocket.send(JSON.stringify(msg));
		}
	});
	
	websocket.onerror	= function(ev){$('#message_box').html("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");}; 
	websocket.onclose 	= function(ev){$('#message_box').html("<div class=\"system_msg\">Connection Closed</div>");}; 
});
</script>


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

<span id="message_box"></span>
<form name="storybox" method="POST" action="submitstory.php">
Title: <input type="text" name="title" id="title" value="" /><br />
Category: <select name="category" id="category"><option value="" default>-Select-</option><option value="0">0</option></select><br />
Rating: <select name="rating" id="rating"><option value="" default>-Select-</option><option value="G">G</option><option value="PG">PG</option><option value="R">R</option><option value="X">X</option></select><br />
Story: <textarea id="storytext" name="storytext" cols=175 rows=10></textarea><br />
<button>Submit</button>
</form>


      <!-- Site footer -->
      <div class="footer">
        <p>&copy; WritingLive.com 2014</p>
      </div>

    </div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


</body>
</html>