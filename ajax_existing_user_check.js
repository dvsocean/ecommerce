$(function(){
		$('#username').blur(function(){
			var username= $(this).val();
			$.ajax({
				url: "../check_database/check_ajax.php",
				method: "POST",
				data: {user_name:username},
				dataType: "text",
				success: function(html){
					var errorMessage= $('#check_username_only');
					errorMessage.html(html);
					if (errorMessage.text()) {
						$('#username').focus();
					}
				}
			});
		});
