$(document).ready(function() {
	$("#username").keyup(function() { //user types username on inputfiled
   		var username = $(this).val(); //get the string typed by user
   		$.post('ajax/checkReg.php', {'action':'username','username':username}, function(data) { //make ajax call to check_username.php
   			$("#user-result").html(data); //dump the data received from PHP page
 		});
 		return true;
	});
	$("#email").keyup(function() {
		var email = $(this).val();
		$.post('ajax/checkReg.php', {'action':'email','email':email}, function(data) {
			$("#email-result").html(data);
		});
		return true;
	});
	$("#email1").keyup(function() {
		var email = $("#email").val();
		var confirmemail = $(this).val();
		if(email!=confirmemail) {
			$("#confirm-result").html("<strong>Doesn't Match!</strong>");
		} else {
			$("#confirm-result").html("<strong>Looks Good!</strong>");
		}
		return true;
	});
	$("#pass").keyup(function() {
	    var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     	var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     	var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     	if (false == enoughRegex.test($(this).val())) {
             $('#passstrength').html('<strong>More Characters</strong>');
     	} else if (strongRegex.test($(this).val())) {
             $('#passstrength').className = 'ok';
             $('#passstrength').html('<strong>Strong!</strong>');
     	} else if (mediumRegex.test($(this).val())) {
             $('#passstrength').className = 'alert';
             $('#passstrength').html('<strong>Medium!</strong>');
     	} else {
             $('#passstrength').className = 'error';
             $('#passstrength').html('<strong>Weak!</strong>');
     	}
     	return true;
	});
	$("#pass1").keyup(function() {
		var password = $("#pass").val();
		var confirmpass = $(this).val();
		if(password!=confirmpass) {
			$("#confirm2-result").html("<strong>Doesn't Match!</strong>");
		} else {
			$("#confirm2-result").html("<strong>Looks Good!</strong>");
		}
	});
});