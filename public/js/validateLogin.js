// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

function validate(e){
	var email = document.getElementById("inputEmail").value;
	var password = document.getElementById("inputPassword").value;
	var errors = [];

	
	
	if (!checkLength(email, 6)) {
		return false;
	} else if (email.indexOf("@") == -1) {
		return false;
	} else if (email.indexOf(".") == -1) {
		return false;
	}
	else if (email.lastIndexOf(".") < email.lastIndexOf("@")) {
		return false;
	}

	if (!checkLength(inputPassword,1,100)) {
		errors[errors.length] = "You must enter a password.";
	}

	if (errors.length > 0) {
		reportErrors(errors);
		e.preventDefault();
	}
}


function checkLength(text, min, max){

	if (text.length < min || text.length > max) {
		return false;
	}
	return true;
}

function reportErrors(errors){
	var msg = "There were some problems...\n";
	var numError;
	for (var i=0; i<errors.length; i++) {
		numError = i + 1;
		msg += "\n" + numError + ". " + errors[i];
	}
	alert(msg);
}

window.onload = function() {
	document.getElementById("logInForm").addEventListener("submit", function(e){
    	e.preventDefault();
		validate(e);
	});
}