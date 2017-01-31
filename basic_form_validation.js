//signup form validation
//no need for complex validations as users are previous clients
		$('form').submit(function(){
			var firstName= $('#first_name');
			var lastName= $('#last_name');
			var email= $('#email');
			var employmentStatus= $('#who_are_you');
			var response= $('#check_name');
			var responseTop= $('#responseBoxTop');
			var shippingResponse= $('#shippingResponse');
			var user_pic= $('#user_pic');
			var shipping_address= $('#shipping_address');
			var shipping_space= $('#shipping_space');
			var shipping_city= $('#shipping_city');
			var shipping_state= $('#shipping_state');
			var shipping_zipcode= $('#shipping_zipcode');
			var username= $('#username');
			var password= $('#password');
			var confirm_password= $('#confirm_password');
			
			if (!firstName.val()) {
				responseTop.text('First name required').show();
				responseTop.delay(3000).fadeOut('slow').delay(2000);
				firstName.focus();
				return false;
			}
			if (!lastName.val()) {
				responseTop.text('Last name required').show();
				responseTop.delay(3000).fadeOut('slow');
				lastName.focus();
				return false;
			}

			if(!email.val()) {
				responseTop.text('Email address').show();
				responseTop.delay(3000).fadeOut('slow');
				email.focus();
				return false;
			}
				
			if (!username.val()) {
				responseTop.text('Choose a username').show();
				responseTop.delay(4000).fadeOut('slow');
				username.focus();
				return false;
			}
			
			if (!password.val()) {
				responseTop.text('Create a password').show();
				responseTop.delay(4000).fadeOut('slow');
				password.focus();
				return false;
			}	
			
			if(!confirm_password.val()) {
				responseTop.text('Confirm password').show();
				responseTop.delay(4000).fadeOut('slow');
				confirm_password.focus();
				return false;
			}

			
			if (password.val() != confirm_password.val()) {
				responseTop.text('Passwords must match').show();
				responseTop.delay(3000).fadeOut('slow');
				return false;
			}
			
			confirm_password.blur(function(){
				if (password.val() == confirm_password.val()) {
				responseTop.fadeOut('slow');
				return true;
				}
			});

			if (!shipping_address.val()) {
				shippingResponse.text('Shipping address').show();
				shippingResponse.delay(4000).fadeOut('slow');
				shipping_address.focus();
				return false;
			}

			if (!shipping_city.val()) {
				shippingResponse.text('City').show();
				shippingResponse.delay(4000).fadeOut('slow');
				shipping_city.focus();
				return false;
			}

			if (!shipping_state.val()) {
				shippingResponse.text('State').show();
				shippingResponse.delay(4000).fadeOut('slow');
				shipping_state.focus();
				return false;
			}

			if (!shipping_zipcode.val()) {
				shippingResponse.text('Zipcode').show();
				shippingResponse.delay(4000).fadeOut('slow');
				shipping_zipcode.focus();
				return false;
			}
		});
	});