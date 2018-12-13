(function () {
    'use strict';
    
$(document).ready(function() {
 
  $('form[name="user_form"]').submit(function(e) {
    e.preventDefault();
    var fullName = $('#user_form_fullname').val();
    var userName = $('#user_form_username').val();
    var email = $('#user_form_email').val();
    var password = $('#user_form_password_first').val();
    var confPassword = $('#user_form_password_second').val();
 
    $(".error").remove();
 
//    Check for fullname to include a space between first and last name
    if (fullName.length < 1) {
      $('#user_form_fullname').after('<span class="error">This field is required</span>');
    } else {
    	var regEx = /\s/gm;
    	var fullName = regEx.test(fullName);
    	if (!fullName) {
            $('#user_form_fullname').after('<span class="error">Enter a space between your first and last name</span>');
          }
    }
    
// 	Check for username length
    if (userName.length < 1) {
    	$('#user_form_username').after('<span class="error">This field is required</span>');
    	} else {
    		if (!username) {
                $('#user_form_username').after('<span class="error">Enter a username with at least 8 characters</span>');
              } else if (username.length <= 8)
    	}
    }
  
//	Check for e-mail length and special characters to be included
    if (email.length < 1) {
      $('#user_form_email').after('<span class="error">This field is required</span>');
    } else {
      var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
      var validEmail = regEx.test(email);
      if (!validEmail) {
        $('#user_form_email').after('<span class="error">Enter a valid email</span>');
      }
    }
    
//	Check for password length to be equal to 8 characters or smaller    
    if (password.length <= 8) {
      $('#user_form_password_first').after('<span class="error">Password must be at least 8 characters long</span>');
    }
  });
  
  
 // Check for confirm password to be equal to the first password field
  if (confPassword < 1) {
	     $('#user_form_password_second').after('<span class="error">This field is required</span>');
	    } else if ($('#user_form_password_first') !== $('#user_form_password_second')) {
	     $('#user_form_password_second').after("<li> You password does not match the confirmed password </li>");
	    }
});
