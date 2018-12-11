$(function () { 
	
	// 	 fields of the Register Form
	//	 #user_form_fullname
	//	 #user_form_email
	//	 #user_form_username
	//	 #user_form_password_first
	//	 #user_form_password_second
	
    // Apply a display block to #pswd_info on focus on password
    $('#user_form_password_first').on('focus', function () {
        $('#pswd_info').css('display', 'block');
    });


    //display none to #pswd_info when blur
    $('#user_form_password_first').on('blur', function () {
        $('#pswd_info').css('display', 'none');
    });
	
    
	// on every key pressed
    // checked the password value
	 $('#user_form_fullname').on('keyup', function () {
		 
		 const passValue = $(this).val(); // this refere to the element that trigger the event
	     console.log(passValue);
	     //Logic
	     // length >= 8
	     const lengthCheck = (passValue.length >= 8);
	     // at least one letter str.match(/[A-z]/)
	     const oneLetterCheck = passValue.match(/[A-z]/);
	     // at least one Capital letter str.match(/[A-Z]/)
	     const oneCapitalCheck = passValue.match(/[A-Z]/);
	    
	
	     //display
	     check('#length', lengthCheck);
	     check('#letter', oneLetterCheck);
	     check('#capital', oneCapitalCheck);
	  		 
	 })
 
 
	 $('#user_form_email').on('keyup', function () {
		 const passValue = $(this).val(); // this refere to the element that trigger the event
	     console.log(passValue);
	     const emailFormat = passValue.match(/\S+@+\S+\.\S+/); // Pattern that must have the input email 
	     
	     check('#Format', emailFormat);
		 
	 })
 
	 
	 
	// on every key pressed
    // checked the password value
	 $('#user_form_username').on('keyup', function () {
		 
		 const passValue = $(this).val(); // this refere to the element that trigger the event
	     console.log(passValue);
	     //Logic
	     // length >= 8
	     const lengthCheck = (passValue.length >= 8);
	     // at least one letter str.match(/[A-z]/)
	     const oneLetterCheck = passValue.match(/[A-z]/);
	     	   	
	     //display
	     check('#length', lengthCheck);
	     check('#letter', oneLetterCheck);
	     
	    		 
	 })
 
 
 	$('user_form').on('submit', function (event) {
        event.preventDefault();
        //Gather
        const passValue = $('#user_form_password_first').val();
        const passConfirm = $('#user_form_password_second').val();
        const sameCheck = (passConfirm === passValue)
        //console.log(passValue + '/' + passConfirm + '=>' + sameCheck);
        const lengthCheck = (passValue.length >= 8);
        // at least one letter str.match(/[A-z]/)
        const oneLetterCheck = passValue.match(/[A-z]/);
        // at least one Capital letter str.match(/[A-Z]/)
        const oneCapitalCheck = passValue.match(/[A-Z]/);
        // at least one number str.match(/\d/)
        const numberCheck = passValue.match(/\d/);

        const formValid = sameCheck && lengthCheck && oneLetterCheck && oneCapitalCheck && numberCheck;
        if (formValid) {
            $('form').text('Success');
        }

    })
    
    // on submit 
    //if confirmation password is same as password 
    //and password check all the cases
    //Replace the form with "Success"
 
    function check(selector, validCheck) {
	     //if ok => class change to "valid"
	     // else class change to "invalid"
	     if (validCheck) {
	         $(selector).addClass('valid');
	         $(selector).removeClass('invalid');
	     } else {
	         $(selector).addClass('invalid');
	         $(selector).removeClass('valid');
	     }
	}

}); // END OF JQUERY