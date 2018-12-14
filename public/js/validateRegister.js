$(document).ready(function() {

	
	
	// Apply a display block to full name info on focus on password
    $('#user_form_fullname').on('focus', function () {
        $('#fname').css('display', 'block');
    });
    
    
  //display none to full name when blur
    $('#user_form_fullname').on('blur', function () {
        $('#fname').css('display', 'none');
    });
    
 // on every key pressed
    // checked the 
    $('#user_form_fullname').on('keyup', function () {
        //Gathering
        const fnameValue = $(this).val(); // this refers to the element that trigger the event
        console.log(fnameValue);
        //Logic
        // length >= 8
        const lengthCheck = (fnameValue.length >= 8);
        // at least one letter str.match(/[A-z]/)
        const oneLetterCheck = fnameValue.match(/[A-z]/);
        // at least one Capital letter str.match(/[A-Z]/)
        const oneCapitalCheck = fnameValue.match(/[A-Z]/);
        // at least one space
        const oneSpaceCheck = fnameValue.match(/\s/);

        //display
        check('#length', lengthCheck);
        check('#letter', oneLetterCheck);
        check('#capital', oneCapitalCheck);
        check('#space', oneSpaceCheck);
    });
      
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
    

    

/* CHECK LENGTH OF USERNAME */

//Apply a display block to username on focus on password
	$('#user_form_username').on('focus', function () {
	    $('#usernameInfo').css('display', 'block');
	});
	
	
	//display none to username when blur
	$('#user_form_username').on('blur', function () {
	    $('#usernameInfo').css('display', 'none');
	});
	
	// on every key pressed
	// checked the 
	$('#user_form_username').on('keyup', function () {
	    //Gathering
	    const unameValue = $(this).val(); // this refers to the element that trigger the event
	    console.log(unameValue);
	    //Logic
	    // length > 8
	    const ulengthCheck = (unameValue.length >= 8);;
	    
	    //display
	    check('#ulength', ulengthCheck);
	
	});
	
/* CHECK E-MAIL FORMAT */

//Apply a display block to username on focus on password
	$('#user_form_email').on('focus', function () {
	    $('#emailCheck').css('display', 'block');
	});
	
	
	//display none to username when blur
	$('#user_form_email').on('blur', function () {
	    $('#emailCheck').css('display', 'none');
	});
	
	// on every key pressed
	// check email 
	$('#user_form_email').on('keyup', function () {
	    //Gathering
	    const emailValue = $(this).val(); // this refers to the element that trigger the event
	    console.log(emailValue);
	    //Logic
	    // length > 8
	    const emailChecking = emailValue.match(/[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/);
	    
	    //display
	    check('#emailChk', emailChecking);
	
	});

/* CHECK PASSWORD FORMAT */

//Apply a display block to username on focus on password
	$('#user_form_password_first').on('focus', function () {
	    $('#passwordCheck').css('display', 'block');
	});
	
	
	//display none to username when blur
	$('#user_form_password_first').on('blur', function () {
	    $('#passwordCheck').css('display', 'none');
	});
	
	$('#user_form_password_second').on('focus', function () {
	    $('#passwordCheck').css('display', 'block');
	});
	
	$('#user_form_password_second').on('blur', function () {
	    $('#passwordCheck').css('display', 'none');
	});
	
	// on every key pressed
	// check email 
	$('#user_form_password_first').on('keyup', function () {
	    //Gathering
	    const passwdValue = $('#user_form_password_first').val(); // this refers to the element that trigger the event
	    const passValue = $('#user_form_password_first').val();
        const passConfirm = $('#user_form_password_second').val();
        const sameCheck = (passConfirm === passValue);
        console.log(sameCheck);

	    //Logic
	    // length > 8
        const plengthCheck = (passwdValue.length >= 8);
        // at least one letter str.match(/[A-z]/)
        const poneLetterCheck = passwdValue.match(/[A-z]/);
        // at least one Capital letter str.match(/[A-Z]/)
        const poneCapitalCheck = passwdValue.match(/[A-Z]/);
        // at least one number str.match(/\d/)
	    const poneNumberCheck = passwdValue.match(/\d/);

	  //display
        check('#pLength', plengthCheck);
        check('#pLetter', poneLetterCheck);
        check('#pCapital', poneCapitalCheck);
        check('#pNumber', poneNumberCheck);
        check('#pConfirm',sameCheck);
	
	});
	
	/* CHECK CONFIRMATION PASSWORD TO MATCH PREVIOUS FIELD  */
	$('#user_form_password_second').on('keyup', function () {
		const passValue = $('#user_form_password_first').val();
        const passConfirm = $('#user_form_password_second').val();
        const sameCheck = (passConfirm === passValue);

	  //display
        check('#pConfirm',sameCheck);
        console.log(sameCheck);
        
	});
});

