
$(document).ready(function(){
	$('form').submit(function(e){
		var username= $('#username').val();
		var password= $('#password').val(); 
		if ($.trim(username).length > 0 && $.trim(password).length > 0) {
			$.ajax({
				url: "../index_signin/login.php",
				method: "POST",
				data: {username:username, password:password},
				// cache: false,
				success: function(data){
					if (data) {
						window.location= "../show_profile/showuser.php?user_id=" + data;
					} else {
						$('#box').effect("shake", "fast");
						$('#login').val("TRY AGAIN");
						$('#error').html("<span class='text-danger'align='center'>Invalid username/password</span>");
						$('#error').delay(3000).fadeOut('slow');
					}
				}
			});
		} 
		e.preventDefault();
	});


	$('#login').click(function(){
		var username= $('#username').val();
		var password= $('#password').val(); 
		if (username == '' || password == '') {
			$('#box').effect("shake", "fast");
			$('#error').html("<span class='text-danger'align='center'>Missing a required field</span>");
			$('#username').focus();
			$('#error').delay(3000).fadeOut('slow');
		}
	});
});

