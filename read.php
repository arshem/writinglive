<?php include("include/header.php"); ?>

<script>
	var wsUri = "ws://localhost:".$_GET["id"]."/writinglive.com/server.php"; 	
	var websocket = new WebSocket(wsUri); 	

	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var story = msg.story; //message text
		var title = msg.title;
		var category = msg.category;

		$('#title').text(title);
		//console.log(msg);
		$('#story').text(story);
	};
</script>
<h2 id="title"></h2>
<div id="story"></div>
<?php include("include/footer.php"); ?>