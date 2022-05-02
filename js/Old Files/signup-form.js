/* 
Signup Form Validation (Javascript/jQuery) File for UDW CMS Site
Note: Uses Validate Plugin
Author: Blake J. Anderson (540244)
*/

/*
------------------------------------------------------------------------------------------------------------------
--------------------------------- A Guide to Regular Expressions (for me, Blake) ---------------------------------
------------------------------------------------------------------------------------------------------------------
(?=.*\d)						=	should contain at least 1 digit
(?=.*[a-z])						=	should contain at least 1 lower case
(?=.*[A-Z])						=	should contain at least 1 upper case
[A-Za-z]						= 	should only contain letters 
[a-zA-Z0-9]{*num*,*num*}		=	should contain at least the specified's number worth of mentioned characters
+\. OR +\@						= 	adds a "." or an "@"
_.+-							= 	acceptable characters
/^								= 	start of expression
+$/								= 	end of expression
------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------
*/

/*	Method for Regular Expression	*/
$.validator.addMethod("regex", function (value, element, regexpr) {
	return regexpr.test(value);
});

/*	Student Registration Form Validation */
$("#signupFormStudent").validate({
	rules: {
		studentID: {
			required: true,
			rangelength: [6,6],
			regex: /^([0-9])+$/,
		},

		firstName: {
			required: true,
			minlength: 2,
			regex: /^([A-Za-z])+$/
		},
		surName: {
			required: true,
			minlength: 2,
			regex: /^([A-Za-z])+$/
		},
		password: {
			required: true,
			rangelength: [6, 12],
			//Checks that one of each required element is present, and of allowed characters
			regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!?@#$%^])([a-zA-Z0-9\-_!?@#$%^])+$/
		},
		confirmPassword: {
			required: true,
			equalTo: "#password"
		},
		email: {
			required: true,
			email: true
			//Need to check for existing email in DB
		},

	},

	messages: {
		studentID: {
			required: "Please enter your student ID.",
			rangelength: "Your ID should be 6 digits long.",
			regex: "Please enter a vaild ID (no characters).",
		},

		firstName: {
			required: "Please enter your first name.",
			minlength: "Your first name must consist of at least 2 characters.",
			regex: "Please enter a vaild name (no numbers or characters)."
		},
		surName: {
			required: "Please enter your surname.",
			minlength: "Your surname must consist of at least 2 characters.",
			regex: "Please enter a vaild surname (no numbers or characters)."
		},
		password: {
			required: "Please enter a password.",
			rangelength: "Password needs to be 6 to 12 characters long.",
			regex: "Password needs to contain 1 Uppercase, 1 Lowercase, and 1 number and one of following special characters: ! @ # $ % ^"
		},
		confirmPassword: {
			required: "Please re-enter your password.",
			equalTo: "Please re-enter the same password as above."
		},
		email: {
			required: "Please enter a email.",
			email: "Please enter a valid email address."
		},
	},
});

/*	Staff Registration Form Validation	*/
$("#signupFormStaff").validate({
	rules: {
		staffID: {
			required: true,
			rangelength: [6,6],
			regex: /^([0-9])+$/
		},

		firstName: {
			required: true,
			minlength: 2,
			regex: /^([A-Za-z])+$/
		},
		surName: {
			required: true,
			minlength: 2,
			regex: /^([A-Za-z])+$/
		},
		staffpassword: {
			required: true,
			rangelength: [6, 12],
			//Checks that one of each required element is present, and of allowed characters
			regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!?@#$%^])([a-zA-Z0-9\-_!?@#$%^])+$/
		},
		staffconfirmPassword: {
			required: true,
			equalTo: "#staffpassword"
		},
		email: {
			required: true,
			email: true
		},
		qualification: {
			required: true,
			minlength: 2
		},
		expertise: {
			required: true,
			minlength: 2
		},
		phoneNo: {
			required: false,
			rangelength: [10, 10],
			regex: /^\D*0(\D*\d){9}\D*$/
		},
	},

	messages: {
		staffID: {
			required: "Please enter your staff ID.",
			rangelength: "Your ID should be 6 digits long",
			regex: "Please enter a vaild ID (no characters)."
		},

		firstName: {
			required: "Please enter your first name.",
			minlength: "Your first name must consist of at least 2 characters.",
			regex: "Please enter a vaild name (no numbers or characters)."
		},
		surName: {
			required: "Please enter your surname.",
			minlength: "Your surname must consist of at least 2 characters.",
			regex: "Please enter a vaild surname (no numbers or characters)."
		},
		staffpassword: {
			required: "Please enter a password.",
			rangelength: "Password needs to be 6 to 12 characters long.",
			regex: "Password needs to contain 1 Uppercase, 1 Lowercase, and 1 number and one of following special characters: ! @ # $ % ^"
		},
		staffconfirmPassword: {
			required: "Please re-enter your password.",
			equalTo: "Please re-enter the same password as above."
		},
		email: {
			required: "Please enter a email.",
			email: "Please enter a valid email address."
		},

		qualification: {
			required: "Please enter your qualification.",
			minlength: "Your qualification must consist of at least 2 characters."
		},
		expertise: {
			required: "Please enter your expertise.",
			minlength: "Your expertise must consist of at least 2 characters."
		},
		phoneNo: {
			required: "Please enter your phone number.",
			rangelength: "Ensure your number is 10 digits long.",
			regex: "Your phone number must be Australian (e.g. 0421233356)."
		},
	},
});


/*
• Registration Page
	This is where new student and staff can register to use CMS.
	To use CMS, students must first register by providing Student ID, Name, E-mail address, Password.
	As mentioned, Address, Date of Birth, and Phone number are optional.

	To use CMS, academic staff must first register by providing, Name, Staff ID, password, E-mail
	address, qualification (e.g. PhD, Master, etc.), expertise (e.g. Information Systems, Human Computer
	Interaction, Network Administration, etc.), phone number. Once added to the system, UC also can
	use the Master List of academic staff to allocate tutor for the unit.

	Proper input validation for whoever wants to register must be applied at this point including
		• New user must fill in every mandatory fields in the registration form
		• Double entry password check
		• Email format check
		• Password is
			o 6 to 12 characters in length
			o Contains at least 1 lower case letter, 1 uppercase letter, 1 number and one of following special characters ! @ # $ % ^
*/