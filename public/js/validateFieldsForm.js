function validateForm() { // SECURITY

    // Apply a display block to #pswd_info on focus on password
    $('#pswd').on('focus', function () {
        $('#pswd_info').css('display', 'block');
    });


    //display none to #pswd_info when blur
    $('#pswd').on('blur', function () {
        $('#pswd_info').css('display', 'none');
    });


    // on every key pressed
    // checked the password value
    $('#pswd').on('keyup', function () {
        //Gathering
        const passValue = $(this).val(); // this refere to the element that trigger the event
        console.log(passValue);
        //Logic
        // length >= 8
        const lengthCheck = (passValue.length >= 8);
        // at least one letter str.match(/[A-z]/)
        const oneLetterCheck = passValue.match(/[A-z]/);
        // at least one Capital letter str.match(/[A-Z]/)
        const oneCapitalCheck = passValue.match(/[A-Z]/);
        // at least one number str.match(/\d/)
        const numberCheck = passValue.match(/\d/);

        //display
        check('#length', lengthCheck);
        check('#letter', oneLetterCheck);
        check('#capital', oneCapitalCheck);
        check('#number', numberCheck);


    });

    $('form').on('submit', function (event) {
        event.preventDefault();
        //Gather
        const passValue = $('#pswd').val();
        const passConfirm = $('#pswdConfirm').val();
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
} // END OF JQUERY
